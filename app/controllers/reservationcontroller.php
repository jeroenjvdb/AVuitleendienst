
<?php

class reservationcontroller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct(Reservation $reservation)
	{
		$this->reservation = $reservation;

	}

	public function index()
	{
		$reservations = $this->reservation->getReservationsWhereUserId(Auth::id());
		return View::make('reservations.myreservations',['reservations' => $reservations]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$beginDate = str_replace ( "%20", " " , Request::segment(3) );
		$beginHour = str_replace ( "%20", " " , Request::segment(4) );
		$begin = $beginDate . ' ' . $beginHour;
		var_dump(date("Y-m-d H:i:s"));
		var_dump($begin);
		$now = strtotime('now');
		$beginStamp = strtotime($begin);
		

		$materialId = Request::segment(5);
		//checken of de geselecteerde datum nog niet voorbij is
		if($beginStamp >= $now)
		{
			//checken of het item op deze datum nog niet gereserveerd is
			if(!in_array($begin, $this->reservation->getAllReservedDatesArray($materialId)))
			{
				$users = User::where('type','!=','admin')->where('id','!=',Auth::id())->paginate(12);
				$material = Material::find($materialId);
				return View::make('reservations.new',['begin' => $beginDate, 'beginHour' => $beginHour , 'material' =>$material, 'users' => $users]);
			}
			else
			{
				return View::make('errors.message',['message' => 'Op deze datum wordt dit item al verleend.','url' => '/materials/'.$materialId]);
			}
			
		}
		else{
			return View::make('errors.message',['message' => 'U moet een datum selecteren die nog niet voorbij is.','url' => '/materials/'.$materialId]);
		}
		

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Request::ajax())
		{
			$input = Input::all();

			$this->reservation->begin 	= $input['start'];
			$this->reservation->end 	= $input['stop'];
			$materialId 				= $input['material_id'];
			$reservations = array();
			$this->reservation->fill($input);
			if( $this->reservation->isValid())
			{
				//checken of er geen reservatie overlapt bij het hoofdarticle
				if(!$this->reservation->checkReservationCollision($this->reservation->begin,$this->reservation->end,$materialId))
				{
					if($input['chainReservations'] != null)
					{
						$allValid = true;
						foreach($input['chainReservations'] as $accessorieId)
						{	//checken of er geen reservatie overlapt bij de accessories

							if($this->reservation->checkReservationCollision($this->reservation->begin,$this->reservation->end,$accessorieId))
							{
								$allValid = false;
								// $this->makeReservation(Input::get('users'),Input::all(),Input::get('endDate_submit'),Input::get('endHour_submit'),$accessorieId);	
							}
							// else
							// {
							// 	$material = Material::find($accessorieId);
							// 	return Redirect::back()->withInput()->with('message','De gekozen periode overlapt met een andere reservatie voor '.$material->name.' .');
							// }
						}

						if(!$allValid) {
							// return Redirect::back()->withInput()->with('message','De gekozen periode overlapt met een andere reservatie voor test .');
							return Response::json(['errorMessage' => 'De gekozen periode overlapt met een andere reservatie voor één van de gekozen koppel accessoires'],400);
						}
						else{
							foreach($input['chainReservations'] as $accessorieId)
							{
								$reservations[] = $this->makeReservation($input['users'],$input,$this->reservation->begin,$this->reservation->end,$accessorieId);	
							}
						}
					}
					$reservations[] = $this->makeReservation($input['users'],$input,$this->reservation->begin,$this->reservation->end,$materialId);
					return Response::json(['message' => 'Je reservatie is successvol geplaatst <br> Na het sluiten van deze popup wordt de pagina automatisch herladen.','reservations' => $reservations],200);

				}
				else
				{
					$material = Material::find($materialId);
					return Response::json(['errorMessage'=>'De gekozen periode overlapt met een andere reservatie voor '.$material->name.' .'],400);
				}
					
			}
			else
			{
				// return Redirect::back()->withInput()->withErrors($this->reservation->errors);
				return Response::json(['errorMessage'=>'Er waren validatie errors','errros' => $this->reservation->errors],400);
			}
		}
		else
		{
			return Redirect::back();
		}		
	}

	public function makeReservation($users,$Input,$begin, $endDate,$materialId)
	{
		$this->reservation = new Reservation;
		$this->reservation->fill($Input);
		$this->reservation->end = $endDate;
		$this->reservation->begin = $begin;
		$this->reservation->save();
		$resId = $this->reservation->id;
		$this->reservation->saveReservationMaterial($resId,$materialId);
		$this->reservation->saveReservationUser($resId, Auth::id(),'Hoofdverantwoordelijk');
		if($users)
		{
			foreach($users as $user)
			{
				$this->reservation->saveReservationUser($resId,$user,'verantwoordelijk');
			}
		}
		$this->reservation->users = $this->reservation->getUsersAttribute();
		return $this->reservation;
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}

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
		$begin = str_replace ( "%20", " " , Request::segment(3) );
		$materialId = Request::segment(4);
		//checken of de geselecteerde datum nog niet voorbij is
		if($begin >= date("Y-m-d H:i:s"))
		{
			//checken of het item op deze datum nog niet gereserveerd is
			if(!in_array($begin, $this->reservation->getAllReservedDatesArray($materialId)))
			{
				$users = User::where('type','!=','admin')->where('id','!=',Auth::id())->paginate(12);
				$material = Material::find($materialId);
				return View::make('reservations.new',['begin' => $begin , 'material' =>$material, 'users' => $users]);
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
		$this->reservation->fill(Input::all());
		$this->reservation->end = Input::get('endDate_submit')." ".str_replace("s", "00", Input::get('endHour_submit'));
		$materialId = Input::get('materialId');
		if( $this->reservation->isValid())
		{
			//checken of er geen reservatie overlapt bij het hoofdarticle
			if(!$this->reservation->checkReservationCollision($this->reservation->begin,$this->reservation->end,$materialId))
			{
				if(Input::get('accessories'))
				{
					foreach(Input::get('accessories') as $accessorieId)
					{	//checken of er geen reservatie overlapt bij de accessories
						if(!$this->reservation->checkReservationCollision($this->reservation->begin,$this->reservation->end,$accessorieId))
						{
							$this->makeReservation(Input::get('users'),Input::all(),Input::get('endDate_submit'),Input::get('endHour_submit'),$accessorieId);	
						}
						else
						{
							$material = Material::find($accessorieId);
							return Redirect::back()->withInput()->with('message','De gekozen eind datum overlapt met een andere reservatie voor '.$material->name.' .');
						}
					}
				}
				$this->makeReservation(Input::get('users'),Input::all(),Input::get('endDate_submit'),Input::get('endHour_submit'),$materialId);
				return Redirect::to('materials/'.$materialId)->with('message','U hebt succesvol u reservatie geplaatst');

			}
			else
			{
				$material = Material::find($materialId);
				return Redirect::back()->withInput()->with('message','De gekozen eind datum overlapt met een andere reservatie voor '.$material->name.' .');
			}
				
		}
		else
		{
			return Redirect::back()->withInput()->withErrors($this->reservation->errors);
		}
		
	}

	public function makeReservation($users,$Input,$endDate,$endHour,$materialId)
	{
		$this->reservation = new Reservation;
		$this->reservation->fill($Input);
		$this->reservation->end = $endDate." ".str_replace("s", "00", $endHour);
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

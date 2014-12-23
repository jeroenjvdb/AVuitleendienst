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
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$begin = str_replace ( "%20", " " , Request::segment(3) );
		$users = User::where('type','!=','admin')->where('id','!=',Auth::id())->get();
		$materialId = Request::segment(4);
		$material = Material::find($materialId);
		return View::make('reservations.new',['begin' => $begin , 'material' =>$material, 'users' => $users]);

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
		if( $this->reservation->isValid())
		{
			if($this->reservation->end > date("Y-m-d H:i:s"))
			{
				$this->makeReservation(Input::get('users'),Input::all(),Input::get('endDate_submit'),Input::get('endDHour_submit'),Input::get('materialId'));
				foreach(Input::get('accessories') as $accessorieId)
				{
					$this->makeReservation(Input::get('users'),Input::all(),Input::get('endDate_submit'),Input::get('endDHour_submit'),$accessorieId);
				}
				return Redirect::to('materials/'.Input::get('materialId'))->with('message','U hebt succesvol u reservatie geplaatst');
			}
			else
			{
				return Redirect::back()->withInput()->with('message','De eind datum moet een geldige datum zijn');
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
		foreach($users as $user)
		{
			$this->reservation->saveReservationUser($resId,$user,'verantwoordelijk');
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

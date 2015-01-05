<?php

class messagecontroller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct(User $user, Material $material, Reservation $reservation)
	{
		$this->user = $user;
		$this->material = $material;
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
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		$message = Message::find($id);
		$message->fill(Input::all());
		$message->save();
		$material = Material::find(Input::get('materialid'));
		$material->status = 'ok';
		$material->save();
		return Redirect::to('/beheer');
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

	public function sendMails()
	{
		//gedeelte dat mails verstuurd wanneer er iets deffect of vermist is
		$teachers =  User::where('type','=','teacher')->get();
		$messages = Message::where('status','=','unsolved')
							->where('mailsend','=',false)
							->get();
		if(!$messages->isEmpty())
		{
			Mail::send('emails.message', array('messages' => $messages), function($message) use($teachers) 
			{
				foreach($teachers as $teacher)
				{
					$message->to($teacher->email, $teacher->lastname.' '.$teacher->firstname)->subject("Alle berichten van uitleendienst");
				}
			});
		}

		foreach($messages as $message)
		{
			$message->mailsend  = true;
			$message->save();
		}

		//gedeelte dat studenten op de hoogt brengt wanneer hun materiaal nog niet binnen is wanneer iemand anders zijn reservatie start

		// de gebruikers + details van reservatie waarvan het materiaal nog niet binnen is of het gebroken of vermist is 
		$usersMaterialNotAvailable = $this->reservation->checkMaterialAvailable();
		if(!empty($usersMaterialNotAvailable))
		{
			foreach($usersMaterialNotAvailable as $reservation)
			{
				Mail::send('emails.notavailable', array('reservation' => $reservation), function($message) use($reservation) 
				{
					$message->to( $reservation->email, $reservation->lastname.' '.$reservation->firstname)->subject('materiaal voor reservatie niet binnen');
				});
			}	
		}
		// gedeelte waarbij student op de hoogte word gebracht wanneer materiaal niet binnen is na de opgegeven eind tijd
		$usersMaterialBringback = $this->reservation->checkMaterialBroughtBack();

		if(!empty($usersMaterialBringback))
		{
			foreach($usersMaterialBringback as $reservation)
			{
				Mail::send('emails.bringBack', array('reservation' => $reservation), function($message) use($reservation) 
				{
					$message->to($reservation->email, $reservation->lastname.' '.$reservation->firstname)->subject('materiaal voor reservatie niet binnen gebracht');
				});
			}	
		}
		
	}


}

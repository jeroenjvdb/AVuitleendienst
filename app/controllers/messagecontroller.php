<?php

class messagecontroller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
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
		
	}


}

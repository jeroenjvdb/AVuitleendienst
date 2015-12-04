<?php

class usercontroller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct(User $user, Material $material,Categorie $categorie)
	{
		$this->user = $user;
		$this->material = $material;
		$this->categorie = $categorie;

	}

	public function index()
	{
		if(Auth::check())
		{
			$categories = $this->categorie->getCategoriesWhitMaterials();
			return View::make('users.index',['categories' => $categories]);
		}
		else
		{
			return Redirect::to('/');
		}
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		if(Auth::check())
		{
			return View::make('users.admin.addUser');
		}
		else
		{
			return Redirect::to('/');
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		if(Auth::check())
		{
			if (!$this->user->isValid($input = Input::all())) 
			{
				//The form was not valid, so redirect back with the error messages of the model
				return Redirect::back()->withInput()->withErrors($this->user->errormessages);
			}

			$this->user->create([
				"email"		=> Input::get("email"),
				"password" 	=> Hash::make(Input::get("password")),
				"firstname"	=> Input::get("firstname"),
				"lastname"	=> Input::get("lastname"),
				"type"		=> Input::get("type")
			]);

			return Redirect::to("/beheer/gebruikers");
		}
		else
		{
			return Redirect::to('/');
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
		
		if(Auth::check())
		{
			//Get specifieke gebruiker
			$gebruiker = $this->user->find($id);
			return View::make("users.admin.editGebruiker", ["gebruiker" => $gebruiker]);
		}
		else
		{
			return Redirect::to('/');
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		
		if(Auth::check())
		{
			$gebruiker = $this->user->find($id);

			if ($gebruiker->email != Input::get("email")) 
			{
				$input = Input::all();
				if (!$this->user->isValid($input)) 
				{
					//The form was not valid, so redirect back with the error messages of the model
					return Redirect::back()->withInput()->withErrors($this->user->errormessages);
				}
	 
			}
			else
			{
				$input = Input::except("email");
				if (!$this->user->isValidEdit($input)) 
				{
					//The form was not valid, so redirect back with the error messages of the model
					return Redirect::back()->withInput()->withErrors($this->user->errormessages);
				}
			}

			

			//$gebruiker = $this->user->find($id);
			$gebruiker->email = Input::get("email");
			$gebruiker->firstname = Input::get("firstname");
			$gebruiker->lastname = Input::get("lastname");
			$gebruiker->type = Input::get("type");
			$gebruiker->save();

			return Redirect::to("/beheer/gebruikers");
		}
		else
		{
			return Redirect::to('/');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::findOrFail($id);

		$hasMessages = $user->messages()->first();
		//Message::where("fk_usersid", "=", $id)->first();
		$hasReservations = $user->reservations()->first();
		
		if($hasMessages || $hasReservations)
		{
			return View::make('errors.message',['message' => 'Deze gebruiker kan niet verwijderd worden. Hij beschikt nog over reservaties/berichten, gelieve deze eerst te verwijderen.','url' => '/beheer/gebruikers']);
		}
		else
		{
			$userDelete = $this->user->find($id);
			$userDelete->delete();
			return Redirect::to("/beheer/gebruikers");
		}
		
	}


	public function test()
	{
		
	}


}

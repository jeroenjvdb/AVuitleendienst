<?php

class HomeController extends BaseController {

	public function __construct(Categorie $categorie)
	{
		$this->categorie = $categorie;
	}

	public function beheer(){
		if(Auth::check())
		{
			$messages = Message::where('status','=','unsolved')->get();
			return View::make('users.admin.beheer',['messages' => $messages]);
		}
		else
		{
			return Redirect::to('/');
		}
	}

	public function beheerGebruikers(){
		if(Auth::check())
		{
			$gebruikers = User::get();
			return View::make('users.admin.beheerGebruikers', ["gebruikers" => $gebruikers]);
		}
		else
		{
			return Redirect::to('/');
		}
	}

	public function beheerMateriaal(){
		if(Auth::check())
		{
			$categories = $this->categorie->getCategoriesWhitMaterials();
			return View::make('users.admin.beheerMateriaal',['categories' => $categories]);
		}
		else
		{
			return Redirect::to('/');
		}
	}

}



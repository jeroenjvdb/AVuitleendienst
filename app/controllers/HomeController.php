<?php

class HomeController extends BaseController {

	public function __construct(Categorie $categorie)
	{
		$this->categorie = $categorie;
	}

	public function beheer(){
		if(Auth::check())
		{
			return View::make('users.admin.beheer');
		}
		else
		{
			return Redirect::to('/');
		}
	}

	public function beheerGebruikers(){
		if(Auth::check())
		{
			return View::make('users.admin.beheerGebruikers');
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



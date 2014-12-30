<?php

class HomeController extends BaseController {

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
			$materials= Material::get();
			return View::make('users.admin.beheerMateriaal');
		}
		else
		{
			return Redirect::to('/');
		}
	}

}



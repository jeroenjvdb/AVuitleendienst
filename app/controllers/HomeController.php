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
			return View::make('users.admin.beheerMateriaal');
		}
		else
		{
			return Redirect::to('/');
		}
	}

}



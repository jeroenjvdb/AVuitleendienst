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

}



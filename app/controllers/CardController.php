<?php

class CardController extends \BaseController {

	public function getLogin()
	{
		// echo 'getlogin';
		$data = [];
		return View::make('Card.login', $data);
	}

	public function login()
	{
		$user = User::find(Request::input('barcode'));

		// var_dump($user);
		if($user)
		{
			Auth::login($user);
			return Redirect::route('checkin');
		} else
		{
			return Redirect::back()->withInput()->withError('Deze gebruiker bestaat niet, neem contact op met de verantwoordelijke');
		}

	}

	public function createBaseLaptop()
	{
		// $cookie = 
		Cookie::make('baseLaptop', 'test', 20);
		return Redirect::to('/')->withCookie(Cookie::make('baseLaptop', 'test', 20))->with(['success' => 'met dit machien kan u nu materiaal afhalen en terugbrengen']);
	}


}

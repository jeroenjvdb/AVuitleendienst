<?php

use Carbon\Carbon;

class NotificationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// echo '<pre>';
		$notifications = Notification::where('show_from', '<', Carbon::now())->where('show_until', '>', Carbon::now())->orderby('important', 'desc')->orderby('updated_at', 'desc')->get();
		// var_dump($notifications);
		$data['notifications'] = $notifications;
		return View::make('notifications.dashboard')->with($data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('notifications.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		echo '<pre>';
		var_dump(Input::all());

		$date = Input::get('from');
		$fromYear = substr($date, 0, 4);
		$fromMonth = substr($date, 5,2);
		$fromDay = substr($date, 8, 2);
		$fromDt = Carbon::create($fromYear, $fromMonth, $fromDay, Input::get('fromHour'), Input::get('fromMinute'), 0);
		var_dump($fromDt);

		$toDate = Input::get('until');
		$toYear = substr($toDate, 0, 4);
		$toMonth = substr($toDate, 5,2);
		$toDay = substr($toDate, 8, 2);
		$toDt = Carbon::create($toYear, $toMonth, $toDay, Input::get('untilHour'), Input::get('untilMinute'), 0);
		var_dump($toDt);



		$message = Input::get('message');

		$notification = New Notification;
		$notification->message = $message;
		if(Input::get('important'))
		{
			$notification->important = true;
		} else
		{
			$notification->important = false;
		}
		$notification->show_from = $fromDt;
		$notification->show_until = $toDt;

		$notification->save();

		return Redirect::route('dashboard');
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

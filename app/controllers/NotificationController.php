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
		$notifications = Notification::where('show_from', '<', Carbon::now())->where('show_until', '>', Carbon::now())->orderby('important', 'desc')->orderby('updated_at', 'desc')->get();
		$data['notifications'] = $notifications;
		return View::make('notifications.dashboard')->with($data);
	}

	protected function validator($data)
	{
		return Validator::make($data, [
				'message' 	=> 'required|max:255',
				'from'		=> 'required|date',
				'fromHour' 	=> 'required|between:0,23',
				'fromMinute'=> 'required|between:0,59',
				'until'		=> 'required|date',
				'untilHour' => 'required|between:0,23',
				'untilMinute'=> 'required|between:0,59',
			]);
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
		// echo '<pre>';
		// var_dump(Input::all());


		$message = Input::get('message');
		$fromDt = Input::get('dateStart');
		$toDt = Input::get('dateStop');

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
		$notification = Notification::findorfail($id);
		$from = Carbon::createFromFormat('Y-m-d H:i:s', $notification->show_from);
		$notification->from = $from->year .'-' . $from->month .'-'. $from->day  ;
		$notification->fromHour = $from->hour;
		$notification->fromMinute = $from->minute;

		$until = Carbon::createFromFormat('Y-m-d H:i:s', $notification->show_until);
		$notification->until = $until->year .'-' . $until->month .'-'. $until->day  ;
		$notification->untilHour = $until->hour;
		$notification->untilMinute = $until->minute;

		$data['notification'] = $notification;
		return View::make('notifications.edit')->with($data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = $this->validator(Input::all());
		if($validator->fails())
		{
			return Redirect::route('notifications.edit', ['id' => $id])->withInput(Input::all())->withErrors($validator->messages());
		}
		//set startdate visibility
		$fromDate = Input::get('from');
		$from = Carbon::parse($fromDate);
		$from->hour = Input::get('fromHour');
		$from->minute = Input::get('fromMinute');

		//set enddate visibility
		$toDate = Input::get('until');
		$to = Carbon::parse($toDate);
		$to->hour = Input::get('untilHour');
		$to->minute = Input::get('untilMinute');

		$message = Input::get('message');

		$notification = Notification::findorfail($id);
		$notification->message = $message;

		if(Input::get('important'))
		{
			$notification->important = true;
		} else
		{
			$notification->important = false;
		}

		$notification->show_from = $from;
		$notification->show_until = $to;

		$notification->save();

		return Redirect::route('dashboard');

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

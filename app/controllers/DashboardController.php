<?php

use Carbon\Carbon;

class DashboardController extends \BaseController {

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
}

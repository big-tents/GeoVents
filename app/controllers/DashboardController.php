<?php

class DashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user_id = Auth::user()->id;

		$joined_events = JoinedEvents::with('event')->where('attendee_id', '=', $user_id)->get();

		$hosted_events = EEvent::where('user_id', '=', $user_id)->get();

		return View::make('dashboard.dashboard')
			->with('title', 'Dashboard')
			->with('joined_events', $joined_events)
			->with('hosted_events', $hosted_events);
	}


}

<?php

class EventController extends BaseController{
	/*
	|	Look up events
	*/
	public function getEvents()
	{
		$events = EEvent::with('eventType')->get();

		return View::make('event.events')
			->with('title', 'Events')
			->with('events', $events);

	}

}
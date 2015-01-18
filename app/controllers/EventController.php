<?php

class EventController extends BaseController{
	/*
	|	Look up events
	*/
	public function getEvents()
	{

		$events = EEvent::all();

		return View::make('event.events')
			->with('title', 'Events')
			->with('events', $events);
	}

}
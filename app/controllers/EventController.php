<?php

class EventController extends BaseController{
	/*
	|	Look up events
	*/
	public function getEvents()
	{

		$events = EEvent::all();
		// echo EventType::find(1)->first()->e_type;
		// $event_type = EventType::where('id', '=', EEvent::all());

		return View::make('event.events')
			->with('title', 'Events')
			->with('events', $events);
	}

}
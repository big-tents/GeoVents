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
	/*
	|	Host Event (GET())
	*/
	public function getHostEvent()
	{

		// echo $eventTypes = EventType::all();
		$eventTypes = EventType::lists('type');

		return View::make('event.host')
			->with('title', 'Host Event')
			->with('eventTypes', $eventTypes);
	}

	/*
	|	Host Event (POST)
	*/
	public function postHostEvent()
	{
		//Validation Rules
		$validation = Validator::make(Input::all(), [
			'event_name'	=> 'required|min:3|basic_title', 
			'event_type' => 'required|min:3',
			'event_date'	=>	'required|date_format:d-m-Y|after_now',
			'event_location'	=> 'required|min:3',
			'EventLatitude'	=>	'required|float',
			'EventLongitude'	=>	'required|float',
			'max_attendees'	=>	'required|numeric',
			'audience'	=>	'required|numeric|max:2'
		]);

		//If validation fails
		if($validation->fails()){
			return Redirect::route('event-host')
				->withErrors($validation)
				->withInput();
		}else{
		
			$event_type_exists = EventType::where('type', '=', Input::get('event_type'))->exists();
			
			//If event type does not exist
			if(!$event_type_exists){
				//Then create a new type and store it into eventTypes table
				EventType::create([
					'type'	=>	Input::get('event_type')
				]);

			}

			//Convert date
			$timestamp = DateTime::createFromFormat('j-n-Y', Input::get('event_date'))->getTimeStamp();

			//Get event_type_id
			$event_type_id = EventType::where('type', '=', Input::get('event_type'))->first()->id;

			//Store data into events table
			EEvent::create([
				'e_name'	=>	Input::get('event_name'),
				'e_date'	=>	$timestamp,
				'e_location'	=>	Input::get('event_location'),
				'total_attendees'	=>	Input::get('max_attendees'),
				'e_lat'	=>	Input::get('EventLatitude'),
				'e_lng'	=>	Input::get('EventLongitude'),
				'user_id'	=>	Auth::user()->id,
				'audience'	=>	Input::get('audience'),
				'etype_id'	=> $event_type_id
			]);
			
			return Redirect::route('events')
				->with('message', 'Event Created.');

		}
	}

	/*
	|	Event Types (API)
	*/
	public function getEventTypes($input)
	{
		$event_types = EventType::where('type', 'LIKE', '%' . $input . '%')->get();
		
		return Response::json($event_types);

	}

}
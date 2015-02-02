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
			'event_name'     => 'required|min:3|basic_title', 
			'event_type'     => 'required|min:3',
			'event_date'     =>	'required|date_format:d-m-Y|after_now',
			'event_location' => 'required|min:3',
			'EventLatitude'  =>	'required|float',
			'EventLongitude' =>	'required|float',
			'max_attendees'  =>	'required|numeric',
			'audience'       =>	'required|numeric|max:2'
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
				'e_name'          =>	Input::get('event_name'),
				'e_date'          =>	$timestamp,
				'e_location'      =>	Input::get('event_location'),
				'total_attendees' =>	Input::get('max_attendees'),
				'e_lat'           =>	Input::get('EventLatitude'),
				'e_lng'           =>	Input::get('EventLongitude'),
				'user_id'         =>	Auth::user()->id,
				'audience'        =>	Input::get('audience'),
				'etype_id'        => $event_type_id
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

	/*
	|	Join Event (GET)
	*/
	public function getJoinEvent($event_id)
	{
		$event = EEvent::with('eventType')->where('id', '=', $event_id)->get()->first();

		//If event exists
		if($event){
			return View::make('event.join')
				->with('title', 'Join Event :: ' . $event->e_name)
				->with('e', $event);
		}
		//If event id not found
		return Redirect::route('events')
			->with('message', 'Sorry, event <b>' . $event_id . '</b> not found.');
	}

	/*
	|	Join Event (POST)
	*/
	public function postJoinEvent()
	{
		$attendee_id = Auth::user()->id;
		$event_id = Input::get('event_id');
		$host_id = EEvent::where('id', '=', $event_id)->get()->first()->user_id;

		//Last Url
		$last_url = 'event/' . $event_id;

		//A host cannot also be an attendee
		if($attendee_id == $host_id){
			return Redirect::to('event/' . $event_id)
				->with('message', 'Hey.. you\'re the host of this event!');
		}

		// Prevent attendees joining an event twice
		$isJoined = JoinedEvents::where('attendee_id', '=', $attendee_id)
			->where('event_id', '=', $event_id);

		//If already joined
		if($isJoined->count()){
			return Redirect::to('event/' . $event_id)
				->with('message', 'You want to join an event twice? really?');
		}

		//Event Audience
		switch(Input::get('audience')){

			//Public (Anyone can join)
			case 0:
				JoinedEvents::create([
					'attendee_id'	=>	$attendee_id,
					'host_id'	=>	$host_id,
					'event_id'	=>	$event_id
				]);
				return Redirect::to($last_url)
					->with('message', 'You\'ve joined an event.');
			break;

			//Private (Friends/Invites only) | Invisible to public
			case 1:
				return Redirect::to($last_url)
					->with('message', 'Sorry, this event is private.');
			break;

			//Restricted (Friends/Invites only) | Invisible to public
			case 2:
				return Redirect::to($last_url)
					->with('message', 'Sorry, this event is restricted.');
			break;

			//Worst case scenario
			default:
				return Redirect::to($last_url)
					->with('message', 'Where do you come from? really.');

		}
	}

}
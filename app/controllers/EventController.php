<?php

class EventController extends BaseController{




	/**
	  * (GET) Events :: This method is responsible to retrieve all events 
	  * in the database and send it to view.
	  *
	  *	@return View in Views/event/events.blade.php
	  */
	public function getEvents()
	{
		$events = EEvent::with('eventType')->get();

		return View::make('event.events')
			->with('title', 'Events')
			->with('events', $events);

	}




	/**
	  * (GET) Host Event :: This method is responsible to retrieve all 
	  *	host event types stored in the database.
	  *
	  *	@return View in Views/event/host.blade.php
	  */
	public function getHostEvent()
	{

		$eventTypes = EventType::lists('type');

		return View::make('event.host')
			->with('title', 'Host Event')
			->with('eventTypes', $eventTypes);
	}




	/**
	  * (POST) Store user inputs into the database.
	  *
	  *	@return Redirect user back to find event page
	  */
	public function postHostEvent()
	{
		//Calculate how many events a user has hosted
		
		$host_id = Auth::user()->id;
		$total_hosted_events = EEvent::where('user_id', '=', $host_id)->count();
		$max_allowed_host = 8;

		//If it's more than 10, then not allowed to host
		if($total_hosted_events > $max_allowed_host){
			return Redirect::route('event-host')
				->with('message', 'You\'ve reach the limit of hosting more than 10 events.');
		}

		//Validation Rules
		$validation = Validator::make(Input::all(), [
			'event_name'     => 'required|min:3|basic_title|max:50', 
			'event_type'     => 'required|min:3|max:20',
			'event_date'     =>	'required|date_format:d-m-Y|after_now|one_year',
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

		//If validation succeeds

			//Check if event type exists
			$event_type_exists = EventType::where('type', '=', Input::get('event_type'))->exists();
			
			//If event type does not exist
			if(!$event_type_exists){

				//Then create a new type and store it into eventTypes table
				EventType::create([
					'type'	=>	Input::get('event_type')
				]);

			}

			//Convert date into UK format
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
			
			//Redirect user back to 'find events' page
			return Redirect::route('events')
				->with('message', 'Event Created.');

		}
	}




	/**
	  * (GET) Event Types :: It suggests a list of event types that are stored into the database.
	  *
	  * @param string    $input
	  *
	  *	@return Response found event types as JSON
	  */
	public function getEventTypes($input)
	{
		$event_types = EventType::where('type', 'LIKE', '%' . $input . '%')->get();
		
		return Response::json($event_types);

	}




	/**
	  * (GET) Join Event :: This method is responsible to create a view of the selected events.
	  *
	  * @param int    $event_id
	  *
	  *	@return event/join.blade.php | events page
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




	/**
	  * (POST) Join Event :: 
	  *
	  *
	  *	@return 
	  */
	public function postJoinEvent()
	{
		$attendee_id = Auth::user()->id;
		$event_id = Input::get('event_id');
		$host_id = EEvent::where('id', '=', $event_id)->get()->first()->user_id;

		//Last Url
		$last_url = 'event/' . $event_id;

		//Calculate how many events the attendee have joined
		$total_joined_events = JoinedEvents::where('attendee_id', '=', $attendee_id)->count();
		$max_allowed_join = 10;

		//If it's more than 10, then not allowed to join
		if($total_joined_events > $max_allowed_join){
			return Redirect::to($last_url)
				->with('message', 'You\'ve reach the limit of joining more than 10 events.');
		}

		
		//A host cannot also be an attendee
		if($attendee_id == $host_id){
			return Redirect::to($last_url)
				->with('message', 'Hey.. you\'re the host of this event!');
		}

		// Prevent attendees joining an event twice
		$isJoined = JoinedEvents::where('attendee_id', '=', $attendee_id)
			->where('event_id', '=', $event_id);

		//If already joined
		if($isJoined->count()){
			return Redirect::to($last_url)
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
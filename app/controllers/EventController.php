<?php

class EventController extends BaseController{




	/**
	  * --------------------------- NOT USED ---------------------------
	  * (GET) Events :: This method is responsible to retrieve all events 
	  * in the database and send it to view.
	  * 
	  *	@return View in Views/event/eventsv2.blade.php
	  */
	public function getEvents()
	{
		$events = EEvent::with('eventType', 'attendees')->get();

		//If logged
		if(Auth::check()){

			//Retrieve user joined events
			$joined_events = JoinedEvents::where('attendee_id', '=', Auth::user()->id)->get();

			//Creare an empty array
			$joined_events_id = [];

			//Push the joined events' id into the created array
			foreach($joined_events as $je){
				array_push($joined_events_id, $je->event_id);
			}

			//Return view
			return View::make('event.eventsv2')
				->with('title', 'Events')
				->with('events', $events)
				->with('joined_events_id', $joined_events_id);

		//If NOT logged
		}else{

			//Return view
			return View::make('event.eventsv2')
				->with('title', 'Events')
				->with('events', $events);
		}

	}




	/**
	  * (GET) Host Event :: This method is responsible to retrieve all 
	  *	host event types stored in the database.
	  *
	  *	@return View in Views/event/host.blade.php
	  */
	public function getHostEvent()
	{

		//Retrieve all event types
		$eventTypes = EventType::lists('type');

		//Send event types to view
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
		//Configurations:
		$max_allowed_host = 8;

		//Get host id (current user id)
		$host_id = Auth::user()->id;

		//Calculate how many events a user has hosted
		$total_hosted_events = EEvent::where('user_id', '=', $host_id)->count();
		
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
	  * (GET) Join Event :: This method is responsible to create a view of the selected events.
	  *
	  * @param int    $event_id
	  *
	  *	@return event/join.blade.php | events page
	  */
	public function getJoinEvent($event_id)
	{

		//Get selected event 
		$event = EEvent::with('eventType')->where('id', '=', $event_id)->get()->first();

		//Check if user is the host of the event
		$isHost = EEvent::where('user_id', '=', Auth::user()->id)->where('id', '=', $event_id);
		
		//If user is the host then set isHost = 1, else 0
		$isHost = $isHost->count();

		//Check if user has already joined the clicked event
		$isJoined = JoinedEvents::where('attendee_id', '=', Auth::user()->id)->where('event_id', '=', $event->id);

		//If user has joined then set isJoined = 1, else 0
		$isJoined = $isJoined->count();

		//If event exists
		if($event){
			return View::make('event.join')
				->with('title', $event->e_name)
				->with('e', $event)
				->with('isJoined', $isJoined)
				->with('isHost', $isHost);
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
		//Configurations:
		$max_allowed_join = 10;

		$attendee_id = Auth::user()->id;
		$event_id = Input::get('event_id');
		$host_id = EEvent::where('id', '=', $event_id)->get()->first()->user_id;

		//Last Url
		$last_url = 'event/' . $event_id;

		/*********** Validations **********/
		/*---------------------------------------*/

		//(1) Calculate total joined attendees
		$total_joined_attendees = JoinedEvents::where('event_id', '=', $event_id)->count();
		$max_attendees = EEvent::where('id', '=', $event_id)->first()->total_attendees;

		//If event is full
		if($total_joined_attendees >= $max_attendees){
			return Redirect::to($last_url)
				->with('message', 'Sorry, you\'re one step too late. This event is currently full.');
		}

		//(2) Calculate how many events the attendee have joined
		$total_joined_events = JoinedEvents::where('attendee_id', '=', $attendee_id)->count();
		
		//If joined more than 10 events, then not allowed to join
		if($total_joined_events > $max_allowed_join){
			return Redirect::to($last_url)
				->with('message', 'You\'ve reach the limit of joining more than 10 events.');
		}

		//(3) A host cannot also be an attendee
		if($attendee_id == $host_id){
			return Redirect::to($last_url)
				->with('message', 'Hey.. you\'re the host of this event!');
		}

		//(4) Prevent attendees joining an event twice
		$isJoined = JoinedEvents::where('attendee_id', '=', $attendee_id)->where('event_id', '=', $event_id);
		
		//If already joined
		if($isJoined->count()){
			return Redirect::to($last_url)
				->with('message', 'You want to join an event twice? really?');
		}

		/*---------------------------------------*/
		/*********** Validations Ends **********/

		//Event Audience
		switch(Input::get('audience')){

			//Public (Anyone can join)
			case 0:

				//Save details into database
				JoinedEvents::create([
					'attendee_id'	=>	$attendee_id,
					'host_id'	=>	$host_id,
					'event_id'	=>	$event_id
				]);

				//Redirect user back to joined event
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





	/**
	  * (POST) Leave Event :: Allow users to leave events
	  *
	  *	@return event/join.blade.php | events page
	  */
	public function postLeaveEvent()
	{
		//Get Event
		$event = EEvent::where('id', '=', Input::get('event_id'))->first();

		//Get leaving event name
		$event_name = $event->e_name;

		//Get Joined Event
		$joined_event = JoinedEvents::where('attendee_id', '=', Auth::user()->id)->where('event_id', '=', $event->id);
		
		//Leave Event
		$joined_event->delete();

		//Delete Assoicated Entries
		return Redirect::route('events')
			->with('message', 'You\'ve just left <b><i>' . $event_name . '</i></b> event.');
	}




	/**
	  * (POST) Delete Event :: Allow hosts to delete an event and remove its related entries
	  *    
	  *
	  *	@return dashboard/dashboard.blade.php | dashboard
	  */
	public function postDeleteEvent()
	{
		//Get event id from hidden input
		$event_id = Input::get('event_id');

		//Get Event
		$event = EEvent::where('id', '=', $event_id);

		//Get delete event name
		$event_name = $event->first()->e_name;

		//Check if user is the host of the event
		$isHost = EEvent::where('user_id', '=', Auth::user()->id)->where('id', '=', $event_id);;

		//Only allow hosts to delete its own events
		if($isHost->count()){

			//Retrieve all assoicated joined events entries 
			$affected_entries = JoinedEvents::where('event_id', '=', $event_id);

			//Delete entries
			$affected_entries->delete();

			//Remove event
			$event->delete();

			//Redirect user back to dashboard
			return Redirect::route('dashboard')
				->with('message', 'You have successfully deleted <b><i>' . $event_name . '</i></b>.');

		//If user is not the host of the event
		}else{
			return Redirect::to('event/' . $event_id)
				->with('message', 'Are you trying to delete an event that\'s not yours??');
		}
		
	}
}
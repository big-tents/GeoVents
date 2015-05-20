<?php

class RecommendedController extends BaseController 
{


	public function getIndex()
	{

		# Most popular of 6miles (10Km) of the current user
		$mostPvD = $this->mostPopularViaDistance(100, 10);
		

		# Most popular via joined friends (100 friends only)
		$mostPvF = $this->mostPopularViaFriends(100);
		

		return View::make('recommended.index')
					->with('title', 'Recommendations')
					->with('mostPvD', $mostPvD)
					->with('mostPvF', $mostPvF);

	}



	public function postLocation()
	{

		$e_lat = Input::get('e_lat');
		$e_lng = Input::get('e_lng');


	    if ( abs($e_lat) != 0 && abs($e_lng) != 0 )
	    {

			$user = User::find( Auth::user()->id );
			$user->e_lat = $e_lat;
			$user->e_lng = $e_lng;
			$user->save();

		}


		return Redirect::back();

	}



	private function mostPopularViaFriends($seachDepth)
	{

		$userID = Auth::user()->id;
		$popularEvents = DB::table('friends_users')
							->where('friends_users.user_id', '=', $userID)
							->where('friends_users.status', '=', "accepted")
							->join('joined_events', 'joined_events.attendee_id', '=', 'friends_users.friend_id')

							->select(DB::raw("joined_events.event_id, count('joined_events.event_id') as event_count"))
							->groupBy('joined_events.host_id')
							->orderBy('event_count', 'DESC')
							->take($seachDepth)
							->get();



		# Then we check the array and sort it
		if ( !empty($popularEvents) ) 
		{
			arsort($popularEvents);
		}



		# Finally we return that array ( O(1) ) :D
		return $popularEvents;


	}



	private function mostPopularViaDistance($seachDepth, $distance)
	{

		# First we get the users location
		$userLat = Auth::user()->e_lat;
		$userLng = AutH::user()->e_lng;
		if ( abs($userLat) == 0 && abs($userLng) == 0 ) return array();


		# We get the most popular events in the database
		$popularEvents = DB::table('joined_events')
							->select(DB::raw("event_id, count('event_id') as event_count"))
							->groupBy('host_id')
							->orderBy('event_count', 'DESC')
							->take($seachDepth)
							->get();


		# Then we create a named array to sort later ( O(n) )
		foreach ($popularEvents as $event )
		{
			$eventCount[$event->event_id] = 0; 
		}


		# Then for each of the most popular events, we get the locations 
		# of all the attendees to that event ( O(n^2) )
		foreach ($popularEvents as $event )
		{

			# We join the joined_events table to the users table, 
			# and grap the lat and long of each user
			$attendees = DB::table('joined_events')
							->where('event_id', '=', $event->event_id)
							->join('users', 'joined_events.attendee_id', '=', 'users.id')
							->select('users.e_lat', 'users.e_lng')
							->get();


			# Next we see if they are in range of the current user, 
			# i.e if they are in the local area of the user
			foreach($attendees as $attendee)
			{

				# If the user is in local range
				if ( $this->distance($userLat, $attendee->e_lat, $userLng, $attendee->e_lng, "K") <= $distance )
				{

					# Then we add one to the event count
					$eventCount[$event->event_id] += 1;

				}

			}

		}


		# Then we check the array and sort it
		if ( !empty($popularEvents) ) 
		{
			arsort($popularEvents);
		}



		# Finally we return that array ( O(N) + O(N^2) = O(N^2) ) :'(
		return $eventCount;

	}



	private function distance($latA, $latB, $lngA, $lngB, $unit)
	{


		# Calculate distance from two points
		$theta = $lngA - $lngB;
		$dist = sin(deg2rad($latA)) * sin(deg2rad($latB)) +  cos(deg2rad($latA)) * cos(deg2rad($latB)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);



		# We want to convert the result the unit we want to work with (K = KM)
		$result = 0;
		if ($unit == "K")
		{
			$result = ($miles * 1.609344);
		} 
		else
		{
			$result = $miles;
		}



		# Finally we return our result
		return $result;
		

	}

}

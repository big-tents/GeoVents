<?php

class EEvent extends Eloquent{

	protected $table = 'events';
	protected $filleable = ['e_name', 'e_data', 'e_location', 'total_attendees', 'status'];
	protected $guarded = ['create_at', 'updated_at', 'e_organizer_id', 'e_type_id', 'test_id'];

	//Define Relationship

	// events <==> event_types
	public function eventType()
	{
		return $this->belongsTo('EventType', 'etype_id', 'id');
	}

	//	events <==> users
	public function host()
	{
		return $this->belongsTo('User', 'host_id', 'id');
	}

	//	events <==> attendees
	public function attendees()
	{
		return $this->hasMany('JoinedEvents', 'event_id', 'id');
	}

	//Override array
	public function toArray(){
		$array = parent::toArray();

		//Check if user is the host of the event
		$isHost = EEvent::where('host_id', '=', Auth::user()->id)
		->where('id', '=', $array['id'])
		->count();

		//Check if user has already joined the event
		$isJoined = JoinedEvents::where('attendee_id', '=', Auth::user()->id)
		->where('event_id', '=', $array['id'])
		->count();

		//Total joined attendees
		$totalJoined = JoinedEvents::where('event_id', '=', $array['id'])->count();

		//Append these two 'columns' to the parent's array
		$array['hosting'] = $isHost; 
		$array['joined'] = $isJoined; 
		$array['totalJoined'] = $totalJoined; 
		
		//Update custom attributes to result
		return $array;
	}
}

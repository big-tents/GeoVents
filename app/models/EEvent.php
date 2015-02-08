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
		return $this->belongsTo('User', 'user_id', 'id');
	}

	//	events <==> attendees
	public function attendees()
	{
		return $this->hasMany('JoinedEvents', 'event_id', 'id');
	}

}

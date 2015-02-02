<?php

class JoinedEvents extends Eloquent{

	protected $table = 'joined_events';
	protected $guarded = ['create_at', 'updated_at'];

	//Define Relationship
	public function event()
	{
		return $this->hasMany('EEvent', 'id', 'event_id');
	}

}

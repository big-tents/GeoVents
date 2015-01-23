<?php

class EventType extends Eloquent{

	protected $table = 'event_types';
	protected $filleable = ['e_type'];
	public $timestamps = false;

	//Define Relationship
	public function event()
	{
		return $this->hasMany('event', 'e_type_id', 'id');
	}
}

<?php

class EventType extends Eloquent{

	protected $table = 'event_types';
	// protected $filleable = ['e_type'];
	protected $guarded = ['e_type'];
	public $timestamps = false;

	//Define Relationship
	public function event()
	{
		return $this->hasMany('EEvent', 'etype_id', 'id');
	}
}

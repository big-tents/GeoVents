<?php

class EventType extends Eloquent{

	protected $table = 'event_types';
	protected $filleable = ['e_type'];
	public $timestamps = false;
	// protected $guarded = 'id';

	// public function event()
	// {
	// 	return $this->morphOne('EEvent', 'eventable');
	// }

	public function eevent(){
		return $this->belongsTo('EEvents');
	}
}

<?php

class EEvent extends Eloquent{

	protected $table = 'events';
	protected $filleable = ['e_type', 'e_name', 'e_data', 'e_location', 'total_attendees', 'status'];
	protected $guarded = ['create_at', 'updated_at', 'e_organizer_id'];
}

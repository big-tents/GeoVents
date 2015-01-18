<?php

class Profile extends Eloquent{

	protected $table = 'profiles';
	protected $filleable = ['profile_name', 'description', 'image'];
	protected $guarded = ['create_at', 'updated_at'];
}

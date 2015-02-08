<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $fillable = ['username', 'profile_name', 'password', 'private_settings', 'email', 'acc_type', 'code', 'remember_token'];
	protected $guarded = ['verified', 'created_at', 'updated_at'];
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	//Define Relationship
	
	//	users <==> events
	public function event()
	{
		return $this->hasMany('EEvent', 'user_id', 'id');
	}

	//	user <==> joinedEvents
	public function joinedEvents()
	{
		return $this->hasMany('JoinedEvents', 'attendee_id', 'id');
	}
}

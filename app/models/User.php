<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface 
{

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'users';
	protected $fillable = ['username', 'profile_name', 'password', 'private_settings', 'email', 'acc_type', 'code', 'remember_token'];
	protected $guarded = ['verified', 'created_at', 'updated_at'];
	

	/**
	 * The attributes excluded from the model's JSON form.
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	
	//	users <==> events
	public function event()
	{
		return $this->hasMany('EEvent', 'host_id', 'id');
	}



	//	user <==> joinedEvents
	public function joinedEvents()
	{
		return $this->hasMany('JoinedEvents', 'attendee_id', 'id');
	}



	/**
	 * Create a pivot table :D
	 */
	public function friends()
	{

		return $this->belongsToMany('User', 'friends_users', 'user_id', 'friend_id')
					->withPivot('status')->withTimestamps();

	}


	/**
	 * Create a pivot table :D
	 */
	public function friendsMyRequests()
	{

		return $this->belongsToMany('User', 'friends_users', 'friend_id', 'user_id')
					->withPivot('status')->withTimestamps()->wherePivot('status', '=', 'rev');

	}


	/**
	 * Create a pivot table :D
	 */
	public function friendsMyFriends()
	{

		return $this->belongsToMany('User', 'friends_users', 'user_id', 'friend_id')
					->withPivot('status')->withTimestamps()->wherePivot('status', '=', 'accepted');

	}


	/**
	 * Send friend request
	 */
	public function sendRequest($user)
    {

        $this->friends()->attach($user, array('status' => 'rev'));
 		$this->friendsMyRequests()->attach($user, array('status' => 'sent'));

    }
 

    /**
     * Accept friend request from another user
     */
    public function acceptRequest($user)
    {

    	$this->friendsMyRequests()->detach($user);
    	$this->friendsMyRequests()->attach($user, array('status' => 'accepted'));

    	$this->friends()->detach($user);
    	$this->friends()->attach($user, array('status' => 'accepted'));

    }


    /**
     * Decline request or remove friend
     */
    public function removeRequest($user)
    {

    	$this->friendsMyRequests()->detach($user);
    	$this->friends()->detach($user);


    }

}

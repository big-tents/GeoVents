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
	protected $fillable = ['username', 'profile_name', 'password', 'private_settings', 'email', 'acc_type', 'code', 'remember_token', 'e_lat', 'e_lng'];
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
    
    
    // ------------------------------------------------------------------------------------------------------------



	 /**
	 * Create a pivot table :D
	 */
	public function Invites()
	{
	
		return $this->belongsToMany('User', 'friends_events', 'user_id', 'friend_id', 'event_id')
					->withPivot('event_id')->withPivot('status')->withTimestamps();
	
	}
	
	
	
	/**
	 * Create a pivot table :D
	 */
	public function InvitesRe()
	{
	
		return $this->belongsToMany('User', 'friends_events', 'friend_id', 'user_id', 'event_id')
					->withPivot('event_id')->withPivot('status')->withTimestamps();
	
	}
	
	
	
	/**
	 * Create a pivot table :D
	 */
	public function inviteMyRequests()
	{
	
		return $this->belongsToMany('User', 'friends_events', 'friend_id', 'user_id', 'event_id')
					->withPivot('event_id')->withPivot('status')->withTimestamps()->wherePivot('status', '=', 'rev');
	
	}
	
	
	/**
	 * Create a pivot table :D
	 */
	public function inviteMyEvents()
	{
	
		return $this->belongsToMany('User', 'friends_events', 'friend_id', 'user_id', 'event_id')
					->withPivot('event_id')->withPivot('status')->withTimestamps()->wherePivot('status', '=', 'accepted');
	
	}
	
	
	
	/**
	 * Send friend request
	 */
	public function sendEventInvite($user, $event)
	{
	
	    $user_id = Auth::user()->id;
	    $result = DB::table('joined_events')
			    	->where('attendee_id', '=', $user)
			    	->where('host_id', '=', $user_id)
			    	->where('event_id', '=', $event)
			    	->get();
	
	
	
		if ( $result == NULL )
		{
	
	        $this->Invites()->attach($user, array('event_id' => $event, 'status' => 'rev'));
	 		$this->InvitesRe()->attach($user, array('event_id' => $event, 'status' => 'sent'));
	
	 	}
	
	
	}
 


    /**
     * Accept friend request from another user
     */
    public function acceptEventInvite($user, $event)
    {

    	$user_id = Auth::user()->id;
    	DB::table('friends_events')
    		->where('user_id', '=', $user_id)
    		->where('friend_id', '=', $user)
    		->where('event_id', '=', $event)
    		->update( array('status' => "accepted") );



    	DB::table('friends_events')
    		->where('user_id', '=', $user)
    		->where('friend_id', '=', $user_id)
    		->where('event_id', '=', $event)
    		->update( array('status' => "accepted") );



	    DB::table('joined_events')
	    	->insert( array(
	    			'attendee_id' => $user_id,
	    			'host_id' => $user, 
	    			'event_id' => $event,
	    			'status' => 0
	    		));



    }



    /**
     * Decline request or remove friend
     */
    public function removeEventInvite($user, $event)
    {


   	$user_id = Auth::user()->id;
    	DB::table('friends_events')
    		->where('user_id', '=', $user_id)
    		->where('friend_id', '=', $user)
    		->where('event_id', '=', $event)
    		->delete();


    	DB::table('friends_events')
    		->where('user_id', '=', $user)
    		->where('friend_id', '=', $user_id)
    		->where('event_id', '=', $event)
    		->delete();


	    DB::table('joined_events')
	    	->where('attendee_id', '=', $user_id)
	    	->where('host_id', '=', $user)
	    	->where('event_id', '=', $event)
	    	->delete();


    }


}

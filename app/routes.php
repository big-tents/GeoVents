<?php

/*
|--------------------------------------------------------------------------
| Appplication Routes
|---------------------------------date_range-----------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
|===============================================	
|	              Normal group                 |
|===============================================
*/
/*
|	Home Page
*/
Route::get('/', [
	'as'   => 'home', 
	'uses' => 'AccountController@getLogin'
]);


/*
|	Events Page
*/
Route::get('/eventsv2/',[
	'uses' => 'EventController@getEvents'
]);

/*
|	Expected typo redirection
*/
Route::get('/event/', function(){return Redirect::route('events');});

/*
|	Events (API) - (WHEN NOT LOGGED IN)
*/
Route::get('/api/events-nearby/{input?}', [
	'as' => 'api-filter-events-nearby',
	'uses' => 'EventControllerAPI@getNearbyEvents'
]);	

/*
|===============================================	
|	          Authenticated group              |
|===============================================
*/
Route::group(['before'=>'auth'], function(){
	
	/*
	|	Profile Page
	*/
	Route::get('/user/{username}',[
		'as'   => 'profile-user',
		'uses' => 'ProfileController@getUser'
	]);

	/*
	| Invite (GET)
	*/
	Route::get('/recommend/', [
		'as'   => 'recommend',
		'uses' => 'RecommendedController@getIndex'
	]);


	/*
	| Invite (Post)
	*/
	Route::post('/recommend/location', [
		'as'   => 'recommend-post',
		'uses' => 'RecommendedController@postLocation'
	]);

	/*
	| Invite (GET)
	*/
	Route::get('/invite/', [
		'as'   => 'invite',
		'uses' => 'InviteController@getIndex'
	]);


	/*
	| Invite (POST)
	*/
	Route::post('/invite/post', [
		'as'   => 'invite-post',
		'uses' => 'InviteController@postInvites'
	]);


	/*
	| Invite (GET)
	*/
	Route::get('/invite/post-accept/{user}/{event}', [
		'as'   => 'invite-accept',
		'uses' => 'InviteController@getAcceptInvite'
	]);


	/*
	| Invite (GET)
	*/
	Route::get('/invite/post-remove/{user}/{event}', [
		'as'   => 'invite-remove',
		'uses' => 'InviteController@getRemoveInvite'
	]);
	
	
	/*
	| Friend (GET)
	*/
	Route::get('/friend/', [
		'as'   => 'friend',
		'uses' => 'FriendController@getIndex'
	]);


	/*
	| Send Friend Request (GET)
	*/
	Route::get('/friend/send-frequest/{id}', [
		'as'   => 'friend-request',
		'uses' => 'FriendController@getSendRequest'
	]);


	/*
	| Accept Friend Request (GET)
	*/
	Route::get('/friend/accept-frequest/{id}', [
		'as'   => 'friend-accept',
		'uses' => 'FriendController@getAcceptRequest'
	]);


	/*
	| Remove/Decline Friend Request  (GET)
	*/
	Route::get('/friend/remove-frequest/{id}', [
		'as'   => 'friend-remove',
		'uses' => 'FriendController@getRemoveRequest'
	]);
	
	
	/*
	|	Logout (GET)
	*/
	Route::get('/account/logout', [
		'as'   => 'account-logout',
		'uses' => 'AccountController@getLogout'
	]);

	/*
	|	Settings (GET)
	*/
	Route::get('/account/settings', [
		'as'   => 'account-settings',
		'uses' => 'AccountController@getSettings'
	]);

	/*
	|	Delete Account (GET)
	*/
	Route::get('/account/delete', [
		'as'   => 'account-delete',
		'uses' => 'AccountController@getDelete'
	]);

	/*
	|	Delete Account (POST)
	*/
	Route::post('/account/delete', [
		'as'   => 'account-delete-post',
		'uses' => 'AccountController@postDelete'
	]);

	/*
	|	Create Profile (GET)
	*/
	Route::get('/profile/create', [
		'as'   => 'profile-create',
		'uses' =>'ProfileController@getCreateProfile'
	]);

	/*
	|	Edit Profile (GET)
	*/
	Route::get('/profile/edit', [
		'as'   => 'profile-edit',
		'uses' => 'ProfileController@getEditProfile'
	]);

	/*
	|	Dashboard (GET)
	*/
	Route::get('/dashboard/', [
		'as' => 'dashboard',
		'uses' => 'DashboardController@index'
	]);

	/*
	|===============================================	
	|	               Event Group                 |
	|===============================================
	*/
	Route::group(['prefix'=>'event'], function(){
		/*
		|	Host Event (GET)
		*/
		Route::get('/host/', [
			'as' => 'event-host',
			'uses' => 'EventController@getHostEvent'
		]);

		/*
		|	Edit Event (GET)
		*/
		Route::get('/{event_id}/edit/', [
			'uses' => 'EventController@getEditEvent'
		]);

		/*
		|	Join Event (GET)
		*/
		Route::get('/{event_id}/', [
			'as' => 'event-join',
			'uses' => 'EventController@getJoinEvent'
		]);
		/*
		|	Join Event (POST)
		*/
		Route::post('/join/', [
			'as' => 'event-join-request',
			'uses' => 'EventController@postJoinEvent'
		]);
		/*
		|	Leave Event (POST)
		*/
		Route::post('/leave/', [
			'as' => 'event-leave-request',
			'uses' => 'EventController@postLeaveEvent'
		]);

		/*
		|	Delete Event (POST)
		*/
		Route::get('/delete/{event_id}', [
			'as' => 'event-delete',
			'uses' => 'EventController@getDeleteEvent'
		]);

		/*
		Xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx	
		X	           CSRF PROTECTED GROUP            X
		Xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		*/
		Route::group(['before'=>'csrf'], function(){

			/*
			|	Host Event (POST)
			*/
			Route::post('/host/', [
				'as' => 'event-host-post',
				'uses' => 'EventController@postHostEvent'
			]);

			/*
			|	Edit Event (POST)
			*/
			Route::post('/{$event_id}/edit/', [
				'as' => 'event-edit',
				'uses' => 'EventController@postEditEvent'
			]);
		});// End CSRF PROTECTED GROUP

	});// End Event Group 


	/*
	|===============================================	
	|	            CSRF PROTECT GROUP             |
	|===============================================
	*/
	Route::group(['before'=>'csrf'], function(){
	
		/*
		|	Settings (POST)
		*/
		Route::post('/account/settings', [
			'as'   => 'account-settings-post',
			'uses' => 'AccountController@postSettings'
		]);

		/*
		|	Create Profile (POST)
		*/
		Route::post('/profile/create', [
			'as'   => 'profile-create-post',
			'uses' =>'ProfileController@postCreateProfile'
		]);

		/*
		|	Edit Profile (POST)
		*/
		Route::post('/profile/edit', [
			'as'   => 'profile-edit-post',
			'uses' => 'ProfileController@postEditProfile'
		]);

	});
});




/*
|===============================================	
|	         Unauthenticated group             |
|===============================================
*/
Route::group(['before'=>'guest'], function(){

	/*
	|	CSRF protection group
	*/
	Route::group(['before'=>'csrf'], function(){

		/*
		|	Create account (POST)
		*/
		Route::post('/account/register', [
			'as'   => 'account-register-post',
			'uses' => 'AccountController@postRegister'
		]);

		/*
		|	Login (POST)
		*/
		Route::post('/account/login', [
			'as'   => 'account-login-post',
			'uses' => 'AccountController@postLogin'
		]);

		/*
		|	Forgot Password (POST)
		*/
		Route::post('/account/forgot-password', [
			'as'   => 'account-forgot-password-post',
			'uses' => 'AccountController@postForgotPassword'
		]);
	});

	/*
	|	Forgot Password (GET)
	*/
	Route::get('/account/forgot-password', [
		'as'   => 'account-forgot-password',
		'uses' => 'AccountController@getForgotPassword'
	]);

	/*
	|	Account Recovery (GET)
	*/
	Route::get('/account/recover/{code}', [
		'as'   => 'account-recover',
		'uses' => 'AccountController@getRecover'
	]);

	/*
	|	Login (GET)
	*/
	Route::get('/account/login', [
		'as'   => 'account-login',
		'uses' => 'AccountController@getLogin'
	]);

	/*
	|	Create account (GET)
	*/
	Route::get('/account/register', [
		'as'   => 'account-register',
		'uses' => 'AccountController@getRegister'
	]);

	/*
	|	Verify Account (GET)
	*/
	Route::get('/account/verify/{code}', [
		'as'   => 'account-verify',
		'uses' => 'AccountController@getVerify'
	]);

});

/*
|===============================================	
|	               API group                   |
|===============================================
*/

/*
|------------------------------
|     Authenticated group     |
|------------------------------
*/
Route::group(['before'=>'auth'], function(){
	/*
	|	Host Event (API) - Event Type Dropdown List
	*/
	Route::get('/api/event-types/{input}', [
		'as'   => 'api-event-types',
		'uses' => 'EventControllerAPI@getEventTypes'
	]);

	/*
	|	Events (API) - Search Events
	*/
	Route::get('/api/events/{input?}', [
		'as' => 'api-filter-events',
		'uses' => 'EventControllerAPI@getFilterEvents'
	]);	

	/*
	|	Events (API) - Return events page
	*/
	Route::get('/events/', [
		'as'   => 'events',
		'uses' => 'EventControllerAPI@getEvents'
	]);

});

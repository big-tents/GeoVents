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
	'uses' => 'HomeController@getIndex'
]);

/*
|	Profile Page
*/
Route::get('/user/{username}',[
	'as'   => 'profile-user',
	'uses' => 'ProfileController@getUser'
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
|===============================================	
|	          Authenticated group              |
|===============================================
*/
Route::group(['before'=>'auth'], function(){


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
	|	Host Event (GET)
	*/
	Route::get('/event/host', [
		'as' => 'event-host',
		'uses' => 'EventController@getHostEvent'
	]);

	/*
	|	Edit Event (GET)
	*/
	Route::get('/event/{event_id}/edit/', [
		'uses' => 'EventController@getEditEvent'
	]);

	/*
	|	Join Event (GET)
	*/
	Route::get('/event/{event_id}', [
		'as' => 'event-join',
		'uses' => 'EventController@getJoinEvent'
	]);

	/*
	|	Join Event (POST)
	*/
	Route::post('/event/join/', [
		'as' => 'event-join-request',
		'uses' => 'EventController@postJoinEvent'
	]);

	/*
	|	Leave Event (POST)
	*/
	Route::post('/event/leave', [
		'as' => 'event-leave-request',
		'uses' => 'EventController@postLeaveEvent'
	]);

	/*
	|	Delete Event (POST)
	*/
	Route::post('/event/{$event_id}/delete', [
		'as' => 'event-delete',
		'uses' => 'EventController@postDeleteEvent'
	]);
	/*
	|	Dashboard (GET)
	*/
	Route::get('/dashboard/', [
		'as' => 'dashboard',
		'uses' => 'DashboardController@index'
	]);

	/*
	|	CSRF Protected Group
	*/
	Route::group(['before'=>'csrf'], function(){
		/*
		|	Host Event (POST)
		*/
		Route::post('/event/host', [
			'as' => 'event-host-post',
			'uses' => 'EventController@postHostEvent'
		]);

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

		/*
		|	Edit Event (POST)
		*/
		// Route::post('/event/{event_id}/edit', [
		// 	'as'   => 'event-edit',
		// 	'uses' => 'EventController@postEditEvent'
		// ]);

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

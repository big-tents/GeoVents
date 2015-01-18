<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
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
	'as' => 'profile-user',
	'uses' => 'ProfileController@getUser'
]);

Route::get('/user/', [
	'as' => 'profile'
]);
/*
|	Authenticated group
*/
Route::group(['before'=>'auth'], function(){

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
	|	Settings (POST)
	*/
	Route::post('/account/settings', [
		'as' => 'account-settings-post',
		'uses' => 'AccountController@postSettings'
	]);

	/*
	|	Create Profile (GET)
	*/
	Route::get('/profile/create', [
		'as' => 'profile-create',
		'uses' =>'ProfileController@getCreateProfile'
	]);

	/*
	|	Create Profile (POST)
	*/
	Route::post('/profile/create', [
		'as' => 'profile-create-post',
		'uses' =>'ProfileController@postCreateProfile'
	]);

	/*
	|	Edit Profile (GET)
	*/
	Route::get('/profile/edit', [
		'as' => 'profile-edit',
		'uses' => 'ProfileController@getEditProfile'
	]);

	/*
	|	Edit Profile (POST)
	*/
	Route::post('/profile/edit', [
		'as' => 'profile-edit-post',
		'uses' => 'ProfileController@postEditProfile'
	]);

});


/*
|	Unauthenticated group
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
			'as' => 'account-login-post',
			'uses' => 'AccountController@postLogin'
		]);
	});

	/*
	|	Login (GET)
	*/
	Route::get('/account/login', [
		'as' => 'account-login',
		'uses' => 'AccountController@getLogin'
	]);

	/*
	|	Create account (GET)
	*/
	Route::get('/account/register', [
		'as'   => 'account-register',
		'uses' => 'AccountController@getRegister'
	]);

	Route::get('/account/verify/{code}', [
		'as'   => 'account-verify',
		'uses' => 'AccountController@getVerify'
	]);
});
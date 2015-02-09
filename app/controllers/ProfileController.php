<?php

class ProfileController extends BaseController{



	/*
	|	Look up user by their username
	*/
	public function getUser($username){

		$user_exists = User::where('username', '=', $username)->exists();

		//Check if user exists
		if($user_exists){

			$user = User::where('username', '=', $username)->first();
			$user_id = $user->id;
			$profile = Profile::where('user_id', '=', $user_id)->first();

			//If user has created a profile already
			if($profile){
				return View::make('profile.user')
					->with('title', $username . "'s Profile")
					->with('profile', $profile)
					->with('user_id', $user_id);
			}else{

				//If user has not created a profile but it's logged, and current user equals to username on the url
				//Go to create profile page
				if(Auth::check() && Auth::user()->username == $username){
					return Redirect::route('profile-create')
						->with('message', 'It seems like you haven\'t created a profile yet.
	Let\'s get started!');
				}else{

				//Show global message when user hasn't created a profile yet.
					return 'This user hasn\'t created a profile yet.';
				}
			}
		}else{

			//If user not exist
			return 'User does\'t not exists';
		}
	}




	/*
	|	Create profile (GET)
	*/
	public function getCreateProfile()
	{
		//Check if user has already created a profile
		$hasProfile = Profile::where('user_id', '=', Auth::user()->id)->exists();

		//If already has a profile
		if($hasProfile){

			//Redirect back to profile page
			return Redirect::to('user/' . Auth::user()->username)
				->with('message', 'You\'ve already created a profile!');
		}

		//Return to create profile page
		return View::make('profile.create')
			->with('title', 'Create Profile');
	}





	/*
	|	Create Profile (POST)
	*/
	public function postCreateProfile()
	{		
		//Validation Rules
		$validation = Validator::make(Input::all(), [
			'profile_name'       => 'required|min:3|max:20|unique:profiles',
			'description'       => 'required|min:10',
			'img_url'	=>	'url'
		]);

		//If validation fails
		if($validation->fails()){
			return Redirect::route('profile-create')
				->withErrors($validation)
				->withInput();
		}else{

		//If validation succeeds, insert data into profiles table
			Profile::create([
				'user_id'      => Auth::user()->id,
				'profile_name' => Input::get('profile_name'),
				'description'  => Input::get('description'),
				'image'        => Input::get('img_url')
			]);

			//Return user back to their newly created profile page
			return Redirect::to('user/' . Auth::user()->username)
				->with('message', 'Profile created!');
		}


	}




	/*
	|	Edit Profile (GET)
	*/
	public function getEditProfile()
	{
		$profile = Profile::where('user_id', '=', Auth::user()->id)->first();

		return View::make('profile.edit')
			->with('title', 'Edit Profile')
			->with('profile_name', $profile->profile_name)
			->with('description', $profile->description)
			->with('img_url', $profile->image);
	}




	/*
	|	Edit Profile (POST)
	*/
	public function postEditProfile()
	{
		//Validation Rules
		$validation = Validator::make(Input::all(), [
			'description'       => 'required|min:10',
			'img_url'	=>	'url'
		]);

		//If validation fails
		if($validation->fails()){
			return Redirect::route('profile-edit')
				->withErrors($validation)
				->withInput();
		}else{
			//Find profile
			$profile = Profile::where('user_id', '=', Auth::user()->id)->first();

			//set data from user inputs
			$profile->description = Input::get('description');
			$profile->image = Input::get('img_url');

			//Update data
			if($profile->save()){
				//Return to profile page
				return Redirect::to('user/' . Auth::user()->username)
					->with('message', 'Profile Updated!');
			}
			
		}
	}

}
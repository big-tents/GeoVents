<?php

class AccountController extends BaseController{
	
	/*
	|	View registration form
	*/
	public function getRegister()
	{
		return View::make('account.register')
			->with('title', 'Register');
	}

	/*
	|	Submitting registration form
	*/
	public function postRegister()
	{ 
		//Validation Rules
		$validation = Validator::make(Input::all(), [
			'username'       => 'required|min:3|max:20|unique:users',
			'password'       => 'required|min:5',
			'password_again' => 'required|same:password',
			'email'          => 'required|email|max:50|unique:users',
			'account_type'   => 'required',
		]);

		//If validation fails
		if($validation->fails()){
			return Redirect::to('account/register')
				->withErrors($validation)
				->withInput();
		}else{
			//Generate random activation code
			$code = str_random(60);

			//Insert details to table
			User::create([
				'username'     => Input::get('username'),
				'password'     => Hash::make(Input::get('password')),
				'email'        => Input::get('email'),
				'acc_type'     => Input::get('account_type'),
				'code'         => $code,
			]);

			//Send verification code to user
			Mail::send('emails.auth.verify', [
				'link'     => URL::route('account-verify', $code),
				'username' => Input::get('username')
			], function($message){
				$message
				->to(Input::get('email'), Input::get('username'))
				->subject('Verify your account');
			});

			//Redirect back to home
			return Redirect::route('home')
				->with('message', 'Your account has been sucuessfully registered! Please check your email to verify your account.');
		}
	}

	/*
	|	Verify user by the code sent to their email address
	*/
	public function getVerify($code)
	{
		// return $code;
		$user = User::where('code', '=', $code)
			->where('verified', '=', 0);

		if($user->count()){
			$user = $user->first();

			//Set verified state to 1 and empty code
			$user->verified = 1;
			$user->code     = '';

			//Update settings
			if($user->save()){
				return Redirect::route('home')
					->with('message', 'Your account has been sucessfully verified!');
			}
		}

		return Redirect::route('home')
			->with('message', 'Sorry, your account cannot be verified. If you have any problems please contact us: BigTents2015@gmail.com');
	}

	/*
	|	View the login form
	*/
	public function getLogin()
	{
		return View::make('account.login')
			->with('title', 'Login');
	}

	/*
	|	Loggin
	*/
	public function postLogin()
	{
		//Validation Rules
		$validation = Validator::make(Input::all(), [
			'email'          => 'required|email|max:50',
			'password'       => 'required|min:5',
		]);

		//If validation fails
		if($validation->fails()){
			return Redirect::to('account/login')
				->withErrors($validation)
				->withInput();
		}else{

		//If validation succeeds
			//Return true or fasle value of remembering user
			$remember = (Input::has('remember')) ? true : false;

			//Attemping to login user
			$auth = Auth::attempt([
				'email'    => Input::get('email'),
				'password' => Input::get('password'),
				'verified' => 1
			], $remember);

			//If user has been logged in
			if($auth){
				return Redirect::intended(route('events'))
					->with('message', 'You have successfully logged in, ' . Auth::user()->username . '.');
			}else{
				return Redirect::route('account-login')
					->with('message', 'Email/Password wrong, or account not verified.');
			}
		}

		//If everything's alright but still can't log user in
		return Redirect::route('account-login')
			->with('message', 'There was a problem logging you in.');
	}

	/*
	|	Logout user
	*/
	public function getLogout()
	{
		Auth::logout();
		return Redirect::route('home')
			->with('message', 'You have been sucessfully logged out.');
	}

	/*
	|	Account Settings (GET) - View the form
	*/
	public function getSettings()
	{
		return View::make('account.settings')
			->with('title', 'Settings');
	}

	/*
	|	Account Settings (POST)
	*/
	public function postSettings()
	{
		//Validation Rules
		$validation = Validator::make(Input::all(), [
			'old_password'       => 'required|min:5',
			'new_password'       => 'required|min:5',
			'new_password_again' => 'required|min:5|same:new_password',
		]);

		//If validation fails
		if($validation->fails()){
			return Redirect::route('account-settings')
				->withErrors($validation)
				->withInput();
		}else{
		//If validation succeeds 
			$user = Auth::user();
			$old_password = Input::get('old_password');
			$new_password = Input::get('new_password');

			//If old password matches password in database
			if(Hash::check($old_password, $user->password)){
				$user->password = Hash::make($new_password);
				//Update settings
				if($user->save()){
					return Redirect::route('account-settings')
						->with('message', 'You have changed your password.');
				}
			}else{
			//If old password not match
				return Redirect::route('account-settings')
					->with('message', 'Incorrect old password.');
			}
		}
	}

}
<?php

class AccountController extends BaseController{
	
	/*
	|	View registration form
	*/
	public function getRegister()
	{
		return View::make('account.register')
			->with('title', 'Big Tents :: Register');
	}

	/*
	|	Submitting registration form
	*/
	public function postRegister()
	{ 
		//Validation Rules
		$validation = Validator::make(Input::all(), [
			'username'       => 'required|min:3|max:20|unique:users',
			'profile_name'   => 'required|min:3|max:20|unique:users',
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
				'profile_name' => Input::get('profile_name'),
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
			$user->code = '';

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
	|	Viewing the login form
	*/
	public function getLogin()
	{
		return View::make('account.login')
			->with('title', 'Big Tents :: Login Page');
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
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'verified' => 1
			], $remember);

			//If user has been logged in
			if($auth){
				return Redirect::intended(route('home'))
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
}
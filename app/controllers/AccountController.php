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
			'username'       => 'required|min:3|max:20|alpha_dash|unique:users',
			'password'       => 'required|min:5|required_alphanumeric',
			'password_again' => 'required|same:password',
			'email'          => 'required|email|max:50|unique:users',
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
				'code'         => $code,
				'e_lat'		=> Input::get('e_lat'),
				'e_lng'		=> Input::get('e_lng')
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
			->with('title', 'Settings')
			->with('user', Auth::user());
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

	/*
	|	Account Deletion (GET) - View the form
	*/
	public function getDelete()
	{
		return View::make('account.delete')
			->with('title', 'Delete my account');
	}

	/*
	|	Account Deletion (POST) - Remove user from database
	*/
	public function postDelete()
	{
		$user_id = Auth::user()->id;
		$user = User::find($user_id);
		$profile = Profile::where('user_id', '=', $user_id);

		//Logout user
		Auth::logout();

		//If successfully deleted a user account
		if($user->delete() && $profile->delete()){
			return Redirect::route('home')
				->with('message', 'Account deleted. We are sorry to see you go :(');
		}else{
		//If account could not be deleted.
			return Redirect::route('account-delete')
				->with('message', 'Sorry, for some reasons you account could not be deleted. Please contact customer support.');
		}
	}

	/*
	|	Forgot Password (GET)
	*/
	public function getForgotPassword()
	{
		return View::make('account.forgot')
			->with('title', 'Forgot Password');
	}

	/*
	|	Forgot Password (POST)
	*/
	public function postForgotPassword()
	{
		$validation = Validator::make(Input::all(),[
			'email' => 'required|email'
		]);

		if($validation->fails()){
			return Redirect::route('account-forgot-password')
				->withErrors($validation)
				->withInput();
		}else{
			$user_exists = User::where('email', '=', Input::get('email'))->exists();

			if($user_exists){
				$user = User::where('email', '=', Input::get('email'))->first();
				
				//Generate new code and password
				$code                = str_random(60);
				$password            = str_random(10);
				$user->code          = $code;
				$user->password_temp = Hash::make($password);

				if($user->save()){

					Mail::send('emails.auth.forgot', [
						'link'     =>URL::route('account-recover', $code), 
						'username' => $user->username, 
						'password' => $password
					], function($message) use ($user){
						$message
							->to($user->email, $user->username)
							->subject('Your new password');
					});

					return Redirect::route('home')
						->with('message', 'New password has been sent to your email.');
				}else{

				}

			}else{
				return Redirect::route('account-forgot-password')
					->with('message', 'User does\'t not exists');
			}
		}

		return Redirect::route('account-forgot-password')
			->with('message', 'New password could not be requested.');
	}

	/*
	|	Recover Password (GET)
	*/
	public function getRecover($code)
	{
		$user = User::where('code', '=', $code)
			->where('password_temp', '!=', '');

		//Check if user exists
		if($user->count()){
			
			$user = $user->first();
			
			$user->password      = $user->password_temp;
			$user->password_temp = '';
			$user->code          = '';

			if($user->save()){
				return Redirect::route('home')
					->with('message', 'Your account has been recovered. Use your new password to login.');
			}else{

			}
		}

		//Worst case scenario
		return Redirect::route('home')
			->with('message', 'Account could not be recovered.');
	}
}

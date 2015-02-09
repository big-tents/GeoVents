<?php

class AccountControllerTestCases extends Illuminate\Foundation\Testing\TestCase {




	/**
	 * Creates the application.
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{

		$unitTesting = true;
		$testEnvironment = 'testing';
		return require __DIR__.'/../../bootstrap/start.php';
	}



	public function testGetRegister()
	{

		$response = $this->action('GET', 'account-register');
		$this->assertResponseStatus(200);
		
	}
	


	public function testPostRegisterVaild()
	{

		$code = str_random(5);


		$credentials = [ 

			'account_type' => 0,
			'username' => "testCase" . $code,
			'password' => "hacker123",
			'password_again' => "hacker123",
			'email' => "testCase@testCase" . $code . ".com",

		];


		$response = $this->action('POST', 'account-register-post', null, $credentials);
		$this->assertRedirectedTo("/");

	}



	public function testPostRegisterInvaild()
	{

		$credentials = [ 

			'account_type' => 0,
			'username' => "",
			'password' => "hacker123",
			'password_again' => "hacker123",
			'email' => "testCase@testCase.com",
			'csrf_token' => csrf_token()

		];


		$response = $this->action('POST', 'account-register-post', null, $credentials);
		$this->assertRedirectedTo("account/register");

	}



	public function testGetLogin()
	{
		

		$response = $this->action('GET', 'account-login');
		$this->assertResponseStatus(200);

	}



	public function testGetLogout()
	{

		$user = User::find(1);
		$this->be($user);

		$this->action('GET', 'account-logout');
		$this->assertRedirectedTo('/');

	}



	public function testPostLoginValid()
	{


		$credentials = [ 
			'password' => "hacker1",
			'email' => "hacker@hacker.com",
		];


		$response = $this->action('POST', 'account-login-post', null, $credentials);
		$this->assertRedirectedTo('/events/');
	}



	public function testPostLoginInvalid()
	{


		$credentials = [ 
			'password' => "",
			'email' => "hacker@hacker.com",
		];


		$response = $this->action('POST', 'account-login-post', null, $credentials);
		$this->assertRedirectedTo('account/login');
	}



	public function testGetSettings()
	{

		$user = User::find(1);
		$this->be($user);

		$this->action('GET', 'account-settings');
		$this->assertResponseStatus(200);

	}



	public function testPostSettingsVaild()
	{

		$user = User::find(1);
		$this->be($user);



		$credentials =  array(
			'old_password'       => 'hacker1',
			'new_password'       => 'hacker1',
			'new_password_again' => 'hacker1',
		);



		$response = $this->action('POST', 'AccountController@postSettings', null, $credentials);
		$message =  Session::get('message');
		$this->assertEquals('You have changed your password.', $message);


	}



	public function testPostSettingsInvaild()
	{

		$user = User::find(1);
		$this->be($user);


		$credentials =  array(
			'old_password'       => '12345s',
			'new_password'       => 'hacker1',
			'new_password_again' => 'hacker1',
		);


		$response = $this->action('POST', 'AccountController@postSettings', null, $credentials);
		$message =  Session::get('message');
		$this->assertEquals('Incorrect old password.', $message);

	}



	public function testGetForgotPassword()
	{

	
		$this->action('GET', 'account-forgot-password');
		$this->assertResponseStatus(200);

	}



	public function testPostForgotPasswordVaild()
	{

		$credentials = array(
			'email' => "hacker@hacker.com"
		);


		$response = $this->action('POST', 'account-forgot-password-post', null, $credentials);
		$message =  Session::get('message');
		$this->assertEquals('New password has been sent to your email.', $message);


	}



	public function testPostForgotPasswordInvaild()
	{


		$credentials = array(
			'email' => "sdf@sdf.com"
		);


		$response = $this->action('POST', 'account-forgot-password-post', null, $credentials);
		$message =  Session::get('message');
		$this->assertEquals('User does\'t not exists', $message);

	}



	public function testGetDelete()
	{

		$user = User::find(1);
		$this->be($user);

		$this->action('GET', 'account-delete', null, array('username' => 'hacker'));
		$this->assertResponseStatus(200);

	}



	public function testDeletePostVaild()
	{

		$user = User::find(27);
		$this->be($user);


		$response = $this->action('POST', 'account-delete-post');
		$message =  Session::get('message');


		$this->assertEquals('Account deleted. We are sorry to see you go :(', $message);
		$this->assertRedirectedTo('/');

	}


	public function testGetVerify()
	{
		// Needs to complete -----
	}


	public function testPostForgotPassword()
	{
		// Needs to complete -----
	}


	public function testGetRecover()
	{
		// Needs to complete -----
	}


}

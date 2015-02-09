<?php

class ProfileControllerTestCases extends Illuminate\Foundation\Testing\TestCase {


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



	public function testGetUser()
	{

		// call($method, $uri, $parameters
		$response = $this->call('GET', '/user/hacker');
		$this->assertResponseStatus(200);


	}



	public function testOwnProfile()
	{

		// Needs to be complete ---

	}



	public function testGetCreateProfile()
	{

		$user = User::find(15);
		$this->be($user);

		$response = $this->action('GET', 'profile-create');
		$this->assertResponseStatus(200);

	}



	public function testPostCreateProfileVaild()
	{


		$user = User::find(22);
		$this->be($user);


		$code = str_random(10);
		$credentials =  array(
			'profile_name' => 'Test' . $code,
			'description' => 'I love cheese and chicken, and cheesey stuff!',
			'img_url'	=> 'http://yourmomma.com/'

		);



		$response = $this->action('POST', 'profile-create-post', null, $credentials);
		$message =  Session::get('message');
		$this->assertEquals('Profile created!', $message);


	}



	public function testPostCreateProfileInvaild()
	{


		$user = User::find(26);
		$this->be($user);



		$credentials =  array(
			'profile_name' => '',
			'description' => 'I love cheese and chicken, and cheesey stuff!',
			'img_url'	=> 'http://yourmomma.com/'

		);



		$response = $this->action('POST', 'profile-create-post', null, $credentials);
		$this->assertSessionHas('errors');


	}



	public function testGetEditProfile()
	{

		$user = User::find(1);
		$this->be($user);

		$response = $this->action('GET', 'profile-edit');
		$this->assertResponseStatus(200);
	}



	public function testPostEditProfileVaild()
	{

		$user = User::find(1);
		$this->be($user);


		$credentials =  array(
			'description' => 'I love cheese and ninjas and stuff! WOOOP!',
			'img_url'	=>	'http://google.com'

		);


		$response = $this->action('POST', 'profile-edit', null, $credentials);
		$this->assertRedirectedTo('user/hacker');


	}



	public function testPostEditProfileInvaild()
	{

		$user = User::find(1);
		$this->be($user);


		$credentials =  array(
			'description' => '',
			'img_url'	=>	'http://google.com'

		);


		$response = $this->action('POST', 'profile-edit', null, $credentials);
		$this->assertRedirectedTo('profile/edit');


	}

}

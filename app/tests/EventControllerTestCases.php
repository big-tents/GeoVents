<?php

class EventControllerTestCases extends Illuminate\Foundation\Testing\TestCase {
	

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



	public function testGetHostEvent()
	{

		$response = $this->action('GET', 'event-host');
		$this->assertResponseStatus(200);

	}



	public function testPostHostEventVaild()
	{

		$user = User::find(1);
		$this->be($user);


		$credentials =  array(
			'event_name' => 'bar+crawlell',
			'event_type' => 'pubb',
			'event_date' => '03-02-2015',
			'event_location' => 'lancs',
			'EventLatitude'  =>	'53.9690089',
			'EventLongitude' =>	'-2.627690799999982',
			'max_attendees'  =>	'8',
			'audience'       =>	'0'

		);



		$response = $this->action('POST', 'event-host-post', null, $credentials);
		$message =  Session::get('message');


		$this->assertEquals('Event Created.', $message);
		$this->assertRedirectedTo('events');



	}



	public function testPostHostEventInvaild()
	{

		$user = User::find(1);
		$this->be($user);


		$credentials =  array(
			'event_name' => '',
			'event_type' => 'pub',
			'event_date' => '03-02-2015',
			'event_location' => 'lancs',
			'EventLatitude'  =>	'',
			'EventLongitude' =>	'',
			'max_attendees'  =>	'8',
			'audience'       =>	'0'

		);



		$response = $this->action('POST', 'event-host-post', null, $credentials);
		// Assert needed

	}



	public function testGetEventTypes()
	{

		// Needs to be completed -----

	}



	public function testGetJoinEventVaild()
	{

		$user = User::find(1);
		$this->be($user);

		$response = $this->action('GET', 'event-join', 1 );
		$this->assertResponseStatus(200);

	}



	public function testPostLeaveEvent()
	{

		$user = User::find(1);
		$this->be($user);



		$credentials = array(
			'event_id' => 16,
		);




		$response = $this->action('POST', 'event-leave-request', null, $credentials);
		$message =  Session::get('message');
		$this->assertContains('You\'ve just left', $message);

	}



	public function testPostJoinEventVaild()
	{

		$user = User::find(1);
		$this->be($user);



		$credentials = array(
			'username' => 'hacker',
			'event_id' => 16,
			'audience' => 0,
			'EventLatitude'  =>	'-2.800740',
			'EventLongitude' =>	'54.046574',
		);




		$response = $this->action('POST', 'event-join-request', null, $credentials);
		$message =  Session::get('message');
		$this->assertContains('You\'ve joined an event', $message);

	}



	public function testPostJoinEventInvaild()
	{

		$user = User::find(1);
		$this->be($user);



		$credentials = array(
			'event_id' => 2,
			'audience' => 0,
			'EventLatitude'  =>	'-2.8007400',
			'EventLongitude' =>	'54.046574',
		);




		$response = $this->action('POST', 'event-join-request', null, $credentials);
		$message =  Session::get('flash');
	}


}

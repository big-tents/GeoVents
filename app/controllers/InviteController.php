<?php

class InviteController extends BaseController 
{


	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function getIndex()
	{

		$user_id = Auth::user()->id;
		$friends = Auth::user()->friendsMyFriends;
		$event_invites = Auth::user()->inviteMyRequests;
		$hosted_events = EEvent::with('attendees')->where('host_id', '=', $user_id)->get();


		return View::make('invite.index')
			->with('title', 'Invites')
			->with('event_invites', $event_invites)
			->with('hosted_events', $hosted_events)
			->with('friends', $friends);
			
	}




	public function getAcceptInvite($user, $event)
	{

		try
		{
			
			Auth::user()->acceptEventInvite($user, $event);
			
		}
		catch ( Exception $e )
		{

			print_r($e->getMessage());

		}



		return Redirect::back();

	}


	public function getRemoveInvite($user, $event)
	{

		try
		{
			
			Auth::user()->removeEventInvite($user, $event);
			
		}
		catch ( Exception $e )
		{

			print_r($e->getMessage());

		}



		return Redirect::back();

	}



	public function postInvites()
	{


		$events = Input::get('events');
		$friends = Input::get('friends');
		

		if ( is_array($events) && is_array($friends) )
		{

			foreach ( $events as $event )
			{ 


				foreach ( $friends as $friend )
				{

					try
					{
						
						Auth::user()->sendEventInvite($friend, $event);
						
					}
					catch ( Exception $e )
					{

						print_r($e->getMessage());
						continue;
					}


				} 

			} 

		}



		return Redirect::back();

	}



}

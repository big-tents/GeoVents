<?php

class FriendController extends BaseController
{

	public function getIndex() 
	{


		// Were the user id is not the current users
		$nfr = User::where('id', '!=', Auth::user()->id)->where('verified', '=', 1);


		// Check to see if user has friends
		if ( Auth::user()->friends->count() )
		{

			// If they do, remove them from the selection
			$nfr->whereNotIn('id', Auth::user()->friends->modelKeys());

		}


		// Then get the selection and append them to the session
		$nfr = $nfr->get();


		// Get all pending requests
		$afr = Auth::user()->friendsMyRequests;
		

		// Finally we return the result of our queries
		return View::make('friend.index')->with('title', 'Friends')->with('nfr', $nfr)->with('afr', $afr);

	}



	public function getSendRequest($id)
	{
		$message = "You request has been sent";

		try
		{
			$user = User::find($id);
		  	Auth::user()->sendRequest($id);
	  	}
	  	catch ( Exception $e )
	  	{
	  		$message = "You have already sent a friend request";
	  	}


	  	return Redirect::back()->with('message', $message);

	}



	public function getAcceptRequest($id)
	{

		// Do stuff here
		$message = "You have accepted the request";

		try
		{
			$user = User::find($id);
		  	Auth::user()->acceptRequest($id);
	  	}
	  	catch ( Exception $e )
	  	{
	  		$message = "You have already accepted the request";
	  	}

	  	return Redirect::back()->with('message', $message);

	}



	public function getRemoveRequest($id)
	{

		$message = "You declined the request";

		try
		{
			$user = User::find($id);
	  		Auth::user()->removeRequest($user);
		}
		catch ( Exception $e )
		{
			$message = "You have already declined the reqest";
		}


	  	return Redirect::back()->with('message', $message);

	}



}


?>

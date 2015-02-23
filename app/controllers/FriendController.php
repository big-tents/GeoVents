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

		$user = User::find($id);
	  	Auth::user()->sendRequest($id);
	  	return Redirect::back();

	}



	public function getAcceptRequest($id)
	{

		// Do stuff here
		$user = User::find($id);
	  	Auth::user()->acceptRequest($id);
	  	return Redirect::back();

	}



	public function getRemoveRequest($id)
	{

		$user = User::find($id);
	  	Auth::user()->removeRequest($user);
	  	return Redirect::back();

	}



}


?>

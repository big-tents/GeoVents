<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 *	a consturctor to share global variables to all views
	 *
	 */
	public function __construct()
	{
		// Configure Site name:
		View::share('app_name', 'Geovents');
	}

}

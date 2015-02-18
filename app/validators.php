<?php

/*
|--------------------------------------------------------------------------
|  Allow float number only
|--------------------------------------------------------------------------
*/
Validator::extend('float', function($attribute, $value, $parameters)
{
  return preg_match("/^[+-]?\d+\.\d+$/", $value);
});


/*
|--------------------------------------------------------------------------
|  Requires alphanumeric
|--------------------------------------------------------------------------
*/
Validator::extend('required_alphanumeric', function($attribute, $value, $parameters)
{
  return preg_match("/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/", $value);
});

/*
|--------------------------------------------------------------------------
|  Allow character, number, space, period (.), comma (,), plus (+), single quote('), and dash (-)
|--------------------------------------------------------------------------
*/
Validator::extend('basic_title', function($attribute, $value, $parameters)
{
  return preg_match("/^[a-zA-Z 0-9\.\'\,\+\-]*$/", $value);
});

/*
|--------------------------------------------------------------------------
|  Date must be greater than now (Chosen timestamp must be greater than current timestamp)
|--------------------------------------------------------------------------
*/
Validator::extend('after_now', function($attribute, $value, $parameters)
{
	//Convert chosen time into timestamp
	$chosen_time = DateTime::createFromFormat('j-n-Y', $value)->getTimeStamp();

	//Calculates total seconds in a day
	$day = 24 * 60 * 60;

	//Current time
	$current_time = time();
	
	return $chosen_time + $day > $current_time;
});

/*
|--------------------------------------------------------------------------
|  Date must with a year
|--------------------------------------------------------------------------
*/
Validator::extend('one_year', function($attribute, $value, $parameters)
{
	//Conver chosen time into timestamp
	$chosen_time = DateTime::createFromFormat('j-n-Y', $value)->getTimeStamp();

	//Only allow user to create event within a year (31536000 seconds)			
	$date_range = time() + 31536000;

	return $chosen_time > $date_range ? false : true;
});


/*
|--------------------------------------------------------------------------
|  Email must end with @lancaster.ac.uk
|--------------------------------------------------------------------------
*/
Validator::extend('lancaster', function($attribute, $value, $parameters)
{
	// $test = 'testing@lancaster.ac.uk';

	$domain_white_list = ['lancaster.ac.uk'];
	$email = explode('@', $value);

	return in_array($email[1], $domain_white_list);
});

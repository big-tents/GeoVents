<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGeolocationToEvents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Add event lattitude 'e_lat' and event longitutde 'e_lng' columns to 'events' table
		Schema::table('events', function($table){
			$table->float('e_lat', 8, 6);
			$table->float('e_lng', 8 , 6);
			$table->integer('user_id');
			$table->tinyInteger('audience');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Drop 'e_lat', 'e_lng' column from 'events' table
		Schema::table('events', function($table)
		{
			$table->dropColumn('e_lat');
			$table->dropColumn('e_lng');
			$table->dropColumn('user_id');
			$table->dropColumn('audience');;
		});
	}

}

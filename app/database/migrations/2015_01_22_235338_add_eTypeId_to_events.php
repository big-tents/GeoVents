<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddETypeIdToEvents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Add 'e_type_id' column to 'events' table
		Schema::table('events', function($table)
		{
			$table->integer('e_type_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Drop 'e_type_id' table from 'events' table
		Schema::table('events', function($table)
		{
			$table->dropColumn('e_type_id');
		});
	}

}

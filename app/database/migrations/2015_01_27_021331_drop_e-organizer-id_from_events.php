<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropEOrganizerIdFromEvents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Drop 'e_organizer_id' column
		Schema::table('events', function($table)
		{
			$table->dropColumn('e_organizer_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Add back 'e_organizer_id' column
		Schema::table('events', function($table)
		{
			$table->string('e_organizer_id');
		});
	}

}

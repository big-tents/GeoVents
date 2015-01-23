<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropETypeFromEvents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Drop 'e_type' column
		Schema::table('events', function($table)
		{
			$table->dropColumn('e_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Add back 'e_type' column
		Schema::table('events', function($table)
		{
			$table->string('e_type');
		});
	}

}

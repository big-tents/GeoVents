<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReformatEdateFromEventsToDatetime extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('events', function($table)
		{
			$table->dropColumn('e_date');
		});
		Schema::table('events', function($table)
		{
			$table->integer('e_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::table('events', function($table)
		{
			$table->dropColumn('e_date');
		});
		Schema::table('events', function($table)
		{
			$table->timestamp('e_date');
		});
	}

}

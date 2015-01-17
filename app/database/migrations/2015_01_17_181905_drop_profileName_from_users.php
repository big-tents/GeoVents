<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropProfileNameFromUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Dropping 'Profile_Name' column
		Schema::table('users', function($table)
		{
			$table->dropColumn('profile_name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Add back 'Profile_name' column
		Schema::table('users', function($table)
		{
			$table->string('profile_name');
		});
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPasswordTempToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Add 'password_temp' column to 'users' table
		Schema::table('users', function($table)
		{
			$table->string('password_temp');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Drop 'password_temp' column from 'users' table
		Schema::table('users', function($table)
		{
			$table->dropColumn('password_temp');
		});
	}

}

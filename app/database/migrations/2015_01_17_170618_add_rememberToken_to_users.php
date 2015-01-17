<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRememberTokenToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Add 'remember_token' column to 'users' table
		Schema::table('users', function($table)
		{
			$table->string('remember_token');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Drop 'remember_token' table from 'users' table
		Schema::table('users', function($table)
		{
			$table->dropColumn('remember_token');
		});
	}

}

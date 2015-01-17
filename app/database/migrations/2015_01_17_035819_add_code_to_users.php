<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Add 'code' column to 'users' table
		Schema::table('users', function($table)
		{
			$table->string('code');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Remove 'code' colume from 'users' table
		Schema::table('users', function($table)
		{
			$table->dropColumn('code');
		});
	}

}

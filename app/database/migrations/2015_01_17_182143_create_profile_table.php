<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create 'profile' table
		Schema::create('profiles', function($table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('profile_name');
			$table->text('description');
			$table->text('image');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Drop 'profile' table
		Schema::drop('profiles');
	}

}

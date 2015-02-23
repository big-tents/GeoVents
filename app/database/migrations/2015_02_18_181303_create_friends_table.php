<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		  // Create friends table
		  Schema::Create( 'friends_users', function($table){

			$table->integer('user_id')->unsigned();
			$table->integer('friend_id')->unsigned();
			$table->string('status');

			$table->foreign('user_id')->references('id')->on('users');
      $table->foreign('friend_id')->references('id')->on('users');
			$table->primary( array('user_id', 'friend_id') );

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
		// Drop friends table
		Schema::Drop('friends_users');
	}

}

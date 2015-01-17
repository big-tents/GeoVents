<?php

class UsersTableSeeder extends Seeder{
	
	public function run()
	{
		DB::table('users')->delete();

		User::create([
			'username' => 'anson',
			'profile_name' => 'Anson',
			'password' => Hash::make('12345'),
			'verified' => 0,
			'acc_type' => 0,
			'private_settings' => 0,
			'email' => 'ansonox@gmail.com'
		]);
		User::create([
			'username' => 'ash',
			'profile_name' => 'Ash',
			'password' => Hash::make('12345'),
			'verified' => 0,
			'acc_type' => 0,
			'private_settings' => 0
		]);
		User::create([
			'username' => 'josh',
			'profile_name' => 'Josh',
			'password' => Hash::make('12345'),
			'verified' => 0,
			'acc_type' => 0,
			'private_settings' => 0
		]);
		User::create([
			'username' => 'liam',
			'profile_name' => 'Liam',
			'password' => Hash::make('12345'),
			'verified' => 0,
			'acc_type' => 0,
			'private_settings' => 0
		]);
		User::create([
			'username' => 'andrew',
			'profile_name' => 'Lucifier',
			'password' => Hash::make('12345'),
			'verified' => 0,
			'acc_type' => 0,
			'private_settings' => 0
		]);
	}
}
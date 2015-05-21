<?php

class UsersTableSeeder extends Seeder{
	
	public function run()
	{
		DB::table('users')->delete();

		User::create([
			'username' => 'anson',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'email' => 'ansonox@gmail.com',
			'e_lat' => 54.04858,
			'e_lng' => -2.807801
		]);

		User::create([
			'username' => 'ash',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'e_lat' => 54.041979,
			'e_lng' => -2.800419
		]);

		User::create([
			'username' => 'josh',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'e_lat' => 54.04858,
			'e_lng' => -2.807801
		]);

		User::create([
			'username' => 'liam',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'e_lat' => 54.04858,
			'e_lng' => -2.807801
		]);

		User::create([
			'username' => 'andrew',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'e_lat' => 54.02368,
			'e_lng' => -2.794068
		]);


		// ------------------------------------------------------------
		// Preston
		//-------------------------------------------------------------


		User::create([
			'username' => 'panson',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'email' => 'pansonox@gmail.com',
			'e_lat' => 53.761879,
			'e_lng' => -2.701027
		]);

		User::create([
			'username' => 'pash',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'e_lat' => 53.753202,
			'e_lng' => -2.710211
		]);

		User::create([
			'username' => 'pjosh',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'e_lat' => 53.75206,
			'e_lng' => -2.691586
		]);

		User::create([
			'username' => 'pliam',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'e_lat' => 53.763858,
			'e_lng' => -2.675707
		]);

		User::create([
			'username' => 'pandrew',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'e_lat' => 53.776388,
			'e_lng' => -2.669871
		]);



		// ------------------------------------------------------------
		// Mancasters!
		//-------------------------------------------------------------


		User::create([
			'username' => 'manson',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'email' => 'mansonox@gmail.com',
			'e_lat' => 53.477294,
			'e_lng' => -2.247241
		]);

		User::create([
			'username' => 'mash',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'e_lat' => 53.465237,
			'e_lng' => -2.260458
		]);

		User::create([
			'username' => 'mjosh',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'e_lat' => 53.466566,
			'e_lng' => -2.202437
		]);

		User::create([
			'username' => 'mliam',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'e_lat' => 53.497109,
			'e_lng' => -2.201407
		]);

		User::create([
			'username' => 'mandrew',
			'password' => Hash::make('12345'),
			'verified' => 1,
			'e_lat' => 53.499866,
			'e_lng' => -2.2596
		]);
	}
}

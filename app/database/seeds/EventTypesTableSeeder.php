<?php

class EventTypesTableSeeder extends Seeder{

	public function run()
	{
		Eloquent::unguard();
		
		DB::table('event_types')->delete();

		EventType::create([
			'e_type' => 'nightout'
		]);
		EventType::create([
			'e_type' => 'lunch'
		]);
		EventType::create([
			'e_type' => 'dinner'
		]);
		EventType::create([
			'e_type' => 'breakfast'
		]);
		EventType::create([
			'e_type' => 'sport'
		]);
		EventType::create([
			'e_type' => 'predrink'
		]);


	}

}
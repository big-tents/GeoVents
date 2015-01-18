<?php

class EventsTableSeeder extends Seeder{
	public function run()
	{
		DB::table('events')->delete();

		EEvent::create([
			'e_type'          => 'Sports',
			'e_name'          => 'Cartmel Vs. Pendle',
			'e_date'          => '2015-01-21 12:35:00',
			'e_location'      => 'Sport Centre',
			'total_attendees' => 18,
			'status'          => 0
		]);
		EEvent::create([
			'e_type'          => 'dinner',
			'e_name'          => 'Pendle big night out!',
			'e_date'          => '2015-01-30 00:00:00',
			'e_location'      => 'Pendle bar avenue',
			'total_attendees' => 50,
			'status'          => 0
		]);
		EEvent::create([
			'e_type'          => 'lunch',
			'e_name'          => 'vegetarain lunch',
			'e_date'          => '2015-01-19 01:15:25',
			'e_location'      => 'cafe21',
			'total_attendees' => 8,
			'status'          => 0
		]);
		EEvent::create([
			'e_type'          => '20mins',
			'e_name'          => '20mins game',
			'e_date'          => '2015-01-22 12:00:00',
			'e_location'      => 'anywhere on campus',
			'total_attendees' => 100,
			'status'          => 0
		]);
		EEvent::create([
			'e_type'          => 'drink',
			'e_name'          => 'drinking game flat 11',
			'e_date'          => '2015-02-01 22:30:00',
			'e_location'      => 'flat 11 d floor',
			'total_attendees' => 12,
			'status'          => 0
		]);
		EEvent::create([
			'e_type'          => 'predrink',
			'e_name'          => 'predrink at ann\'s place',
			'e_date'          => '2015-01-24 20:00:00',
			'e_location'      => 'flat 32',
			'total_attendees' => 30,
			'status'          => 0
		]);
		EEvent::create([
			'e_type'          => 'outdoor',
			'e_name'          => 'Just Chill...',
			'e_date'          => '2015-01-19 17:00:00',
			'e_location'      => 'sport centre',
			'total_attendees' => 4,
			'status'          => 1
		]);
		EEvent::create([
			'e_type'          => 'indoor',
			'e_name'          => 'whatever',
			'e_date'          => '2015-01-23 14:00:00',
			'e_location'      => 'Furness bar',
			'total_attendees' => 8,
			'status'          => 0
		]);
		EEvent::create([
			'e_type'          => 'ict',
			'e_name'          => 'study time',
			'e_date'          => '2015-01-21 09:00:00',
			'e_location'      => 'infolab',
			'total_attendees' => 15,
			'status'          => 0
		]);
	}
}
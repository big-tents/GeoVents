<?php

class ProfilesTableSeeder extends Seeder{
	
	public function run()
	{
		DB::table('profiles')->delete();

		Profile::create([
			'user_id'      =>  1,
			'profile_name' => 'MyProfileName',
			'description'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis nostrum reiciendis, laboriosam aspernatur dolorem fugiat neque temporibus officiis, possimus, voluptates perspiciatis. Eius, nisi dolores corrupti aperiam tempora dignissimos ea voluptas!',
			'image'        => ''
		]);

	}
}
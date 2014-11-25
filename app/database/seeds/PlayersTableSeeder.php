<?php

class PlayersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('players')->delete();
		
		Player::create(array('rfid' => '6A0049E128EA', 'name' => 'Myles', 'profile_picture' => '', 'music' => ''));
		Player::create(array('rfid' => '6A0049E128EB', 'name' => 'Jarrad', 'profile_picture' => '', 'music' => ''));
	}

}

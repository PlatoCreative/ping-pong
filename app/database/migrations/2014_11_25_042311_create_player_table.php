<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerTable extends Migration {

	public function up()
	{
		
		Schema::create('players', function($table)
		{
			$table->increments('id');
			$table->string('rfid')->nullable();
			$table->string('name');
			$table->string('profile_picture');
			$table->string('music');
			$table->integer('games_played');
			$table->integer('games_won');
			$table->integer('games_lost');
		});
		
		
	}

	public function down()
	{
		Schema::dropIfExists('players');
	}

}

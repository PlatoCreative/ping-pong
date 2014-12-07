<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreakTable extends Migration {

	public function up()
	{

		Schema::create('game_streaks', function($table)
		{
			$table->increments('id');
			$table->integer('game_id')->unsigned();
			$table->foreign('game_id')->references('id')->on('games');
			$table->integer('team_id')->unsigned();
			$table->foreign('team_id')->references('id')->on('teams');
			$table->integer('streak_length')->default(0);
			$table->timestamps();
		});


	}

	public function down()
	{
		Schema::dropIfExists('game_streaks');
	}
}

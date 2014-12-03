<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamTable extends Migration {

	public function up()
	{
		
		Schema::create('teams', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('games_played');
			$table->integer('games_won');
			$table->integer('games_lost');
			$table->integer('player_one_id')->unsigned();
			$table->foreign('player_one_id')->references('id')->on('players');
			$table->integer('player_two_id')->unsigned();
			$table->foreign('player_two_id')->references('id')->on('players');
		});
		
		
	}
	
	public function down()
	{
		Schema::dropIfExists('teams');
	}

}

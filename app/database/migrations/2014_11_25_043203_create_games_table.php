<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration {

	public function up()
	{

		Schema::create('games', function($table)
		{
			$table->increments('id');
			$table->integer('team_one_score')->default(0);
			$table->integer('team_two_score')->default(0);
			$table->integer('team_one_id')->unsigned();
			$table->foreign('team_one_id')->references('id')->on('teams');
			$table->integer('team_two_id')->unsigned();
			$table->foreign('team_two_id')->references('id')->on('teams');
			$table->integer('winning_team_id')->unsigned();
			$table->foreign('winning_team_id')->references('id')->on('teams');
			$table->timestamps();
		});


	}

	public function down()
	{
		Schema::dropIfExists('games');
	}

}

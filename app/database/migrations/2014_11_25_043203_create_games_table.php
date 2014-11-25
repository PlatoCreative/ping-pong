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
			$table->integer('team_one')->unsigned();
			$table->foreign('team_one')->references('id')->on('teams');
			$table->integer('team_two')->unsigned();
			$table->foreign('team_two')->references('id')->on('teams');
			$table->timestamps();
		});
		
		
	}
	
	public function down()
	{
		Schema::dropIfExists('games');
	}

}

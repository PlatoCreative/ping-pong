<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlayerElo extends Migration {

	public function up()
	{
		Schema::table('teams', function($table)
		{
		    $table->integer('elo');
		});
	}

	public function down()
	{
		Schema::table('teams', function($table)
		{
		    $table->dropColumn('elo');
		});
	}

}

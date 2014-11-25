<?php

class Team extends Eloquent {

	public $timestamps = false;

	protected $table = 'teams';
	
	public function playerOne()
	{
		return $this->hasOne('Player', 'player_one');
	}
	
	public function playerTwo()
	{
		return $this->hasOne('Player', 'player_two');
	}
	
	public function game()
	{
		return $this->belongsTo('Game');
	}

}

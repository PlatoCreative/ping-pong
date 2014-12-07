<?php

class Team extends Eloquent {

	public $timestamps = false;

	protected $table = 'teams';
	
	public function playerOne()
	{
		return $this->belongsTo('Player', 'player_one_id');
	}
	
	public function playerTwo()
	{
		return $this->belongsTo('Player', 'player_two_id');
	}
	
	public function games()
	{
		return $this->hasMany('Game');
	}

	public function streaks(){
		return $this->hasMany('Streak');
	}

}

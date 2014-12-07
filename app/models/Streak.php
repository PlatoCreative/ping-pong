<?php

class Streak extends Eloquent {
	
	public $timestamps = true;
	
	protected $table = 'game_streaks';
	

	public function game()
	{
		return $this->belongsTo('Game', 'game_id');
	}


	public function team()
	{
		return $this->belongsTo('Team', 'team_id');
	}
	
}

<?php

class Game extends Eloquent {

	protected $table = 'games';
	
	public function teamOne()
	{
		return $this->belongsTo('Team', 'team_one_id');
	}
	
	public function teamTwo()
	{
		return $this->belongsTo('Team', 'team_two_id');
	}

}

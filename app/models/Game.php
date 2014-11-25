<?php

class Game extends Eloquent {

	protected $table = 'games';
	
	public function TeamOne()
	{
		return $this->hasOne('Team', 'team_one');
	}
	
	public function teamTwo()
	{
		return $this->hasOne('Team', 'team_two');
	}

}

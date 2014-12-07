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

	public function WinningTeam()
	{
		return $this->has_one('Team', 'winning_team_id');
	}

	public function streaks(){
		return $this->hasMany('Streak');
	}

}

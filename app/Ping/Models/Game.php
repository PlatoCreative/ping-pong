<?php namespace Ping\Models;

use Illuminate\Database\Eloquent;

class Game extends Eloquent {

	protected $table = 'games';

	public function teamOne()
	{
		return $this->belongsTo('Ping\Models\Team', 'team_one_id');
	}

	public function teamTwo()
	{
		return $this->belongsTo('Ping\Models\Team', 'team_two_id');
	}

	public function WinningTeam()
	{
		return $this->has_one('Ping\Models\Team', 'winning_team_id');
	}

	public function streaks(){
		return $this->hasMany('Ping\Models\Streak');
	}

}

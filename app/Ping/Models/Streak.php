<?php namespace Ping\Models;

use Illuminate\Database\Eloquent;

class Streak extends Eloquent {
	
	public $timestamps = true;
	
	protected $table = 'game_streaks';
	

	public function game()
	{
		return $this->belongsTo('Ping\Models\Game', 'game_id');
	}


	public function team()
	{
		return $this->belongsTo('Ping\Models\Team', 'team_id');
	}
	
}

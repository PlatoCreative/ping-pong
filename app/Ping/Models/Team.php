<?php namespace Ping\Models;

use Illuminate\Database\Eloquent;

class Team extends Eloquent {

	public $timestamps = false;

	protected $table = 'teams';
	
	public function playerOne()
	{
		return $this->belongsTo('Ping\Models\Player', 'player_one_id');
	}
	
	public function playerTwo()
	{
		return $this->belongsTo('Ping\Models\Player', 'player_two_id');
	}
	
	public function games()
	{
		return $this->hasMany('Ping\Models\Game');
	}

	public function streaks(){
		return $this->hasMany('Ping\Models\Streak');
	}
	
	public function scopehasoneplayer($query)
	{
		return $query->where('player_one_id', '=', DB::raw('player_two_id'));
	}
	
	public function scopehastwoplayers($query)
	{
		return $query->where('player_one_id', '!=', DB::raw('player_two_id'));
	}

}

<?php

class Player extends Eloquent {
	
	public $timestamps = false;
	
	protected $table = 'players';
	
	public function team()
	{
		return $this->belongsTo('Team');
	}
	
}

<?php

class Player extends Eloquent {
	
	public $timestamps = false;
	
	protected $table = 'players';
	
	public function teams()
	{
		return $this->hasMany('Team');
	}
	
}

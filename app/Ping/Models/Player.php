<?php namespace Ping\Models;

use Illuminate\Database\Eloquent;

class Player extends Eloquent {
	
	public $timestamps = false;
	
	protected $table = 'players';
	
	public function teams()
	{
		return $this->hasMany('Ping\Models\Team');
	}
	
}

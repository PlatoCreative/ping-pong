<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	$players = Player::all();
	
	return View::make('game.create')->with('players', $players);
});

// Start game
Route::post('game/create', array('as' => 'game/create', 'uses' => 'GameController@create'));


// Game Route
Route::get('game/{game}', array('as' => 'game', 'uses' => 'GameController@index'));

// Route for updating game scores
Route::get('game/{game}/score/{teamPos}', array('as' => 'game/score', 'uses' => 'GameController@updateGameScore'));


/*
Route::get('/', function()
{
	return View::make('hello');
});
*/
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
	return View::make('game.create')->with('players', $players)->with('winningTeam', Session::get('winningTeam'));
});

// Dashboard
Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'DashboardController@index'));

// Start game
Route::post('game/create', array('as' => 'game/create', 'uses' => 'GameController@create'));

// Game Route
Route::get('game/{game}', array('as' => 'game', 'uses' => 'GameController@index'));

// Route for updating game scores
Route::post('game/{game}/score/{teamPos}', array('as' => 'game/score', 'uses' => 'GameController@updateGameScore'));
Route::get('game/{game}/streak/{teamPos}/{length}', array('as' => 'game/streak', 'uses' => 'GameController@addScoreStreak'));


// Mark game as completed/finished
Route::get('game/end/{game}', array('as' => 'game/end', 'uses' => 'GameController@end'));


// Route for creating users
Route::get('players/create', array('as' => 'players/create', 'uses' => 'PlayerController@create'));
Route::post('players/store', array('as' => 'players/store', 'uses' => 'PlayerController@store'));


//webcam replays
Route::get('replay', array('as' => 'replay', 'uses' => 'ReplayController@replay'));
Route::get('replay/game/{game}', array('as' => 'replay/game', 'uses' => 'ReplayController@replayGame'));
Route::post('replay/save', array('as' => 'replay/save', 'uses' => 'ReplayController@save'));
<?php

Route::group(['namespace' => 'Web\Controllers'], function () {
    Route::get('/', function () {
        $players = Player::all();
        return View::make('Web::game.create')->with('players', $players);
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
});
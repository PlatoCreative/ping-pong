<?php

Route::group(['namespace' => 'Web\Controllers'], function () {
    Route::get('/', function () {
        $players = Player::all();
        return View::make('Web::game.create')->with('players', $players);
    });

    // Dashboard
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

    // Start game
    Route::post('game/create', ['as' => 'game/create', 'uses' => 'GameController@create']);

    // Game Route
    Route::get('game/{game}', ['as' => 'game', 'uses' => 'GameController@index']);

    // Route for updating game scores
    Route::post('game/{game}/score/{teamPos}', ['as' => 'game/score', 'uses' => 'GameController@updateGameScore']);
    Route::get('game/{game}/streak/{teamPos}/{length}', ['as' => 'game/streak', 'uses' => 'GameController@addScoreStreak']);


    // Mark game as completed/finished
    Route::get('game/end/{game}', ['as' => 'game/end', 'uses' => 'GameController@end']);


    // Route for creating users
    Route::resource('players','PlayersController',['only'=>['create','store']]);
});
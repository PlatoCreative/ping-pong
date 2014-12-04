<?php

class DashboardController extends BaseController {

  // basic dashboard
  function index(){

    $totalGames = Game::all()->count();
    $allGames = Game::all();

    $gameLength = array();
    $gameTime = 0;

    foreach($allGames as $game){
      $gameTime = strtotime($game->updated_at)-strtotime($game->created_at);
      array_push($gameLength, $gameTime);
    }

    $totalGameTime = array_sum($gameLength);
    $averageGameTime = $totalGameTime/$totalGames;


    return View::make('dashboard.index')
      ->with("totalGames", $totalGames)
      ->with("averageGameTime", gmdate("H:i:s", $averageGameTime));
  }

}

<?php

class DashboardController extends BaseController {

  // basic dashboard
  function index(){
    
    $topThreeTeams = DB::table('teams')->orderBy('games_won', 'desc')->take(5)->skip(0)->get();
    $biggestLoser = DB::table('teams')->orderBy('games_lost', 'desc')->take(1)->skip(0)->get();
    
    $totalGames = Game::all()->count();
    $allGames = Game::all();

    $gameLength = array();
    $gameTime = 0;
    $teamOneTotal = 0;
    $teamTwoTotal = 0;
    
    foreach($allGames as $game){
      
      if($game->team_one_score > $game->team_two_score){
        $teamOneTotal++;
      }else{
        $teamTwoTotal++;
      }
      
      $gameTime = strtotime($game->updated_at)-strtotime($game->created_at);
      array_push($gameLength, $gameTime);
    }

    $totalGameTime = array_sum($gameLength);
    $averageGameTime = $totalGameTime/$totalGames;
    
    if($teamOneTotal > $teamTwoTotal){
      $bestTableSide = "Kitchen side";
    }else{
      $bestTableSide = "Non kitchen side";
    }

    return View::make('dashboard.index')
      ->with("totalGames", $totalGames)
      ->with("averageGameTime", gmdate("H:i:s", $averageGameTime))
      ->with("topThreeTeams", $topThreeTeams)
      ->with("biggestLoser", $biggestLoser)
      ->with("bestTableSide", $bestTableSide);
  }

}

<?php

class DashboardController extends BaseController {

  // basic dashboard
  function index(){

    // TODO - change to win ratio
    $topThreeTeams = DB::table('teams')->orderBy('games_won', 'desc')->take(5)->skip(0)->get();
    //$topThreeTeams = DB::table('teams')->orderBy(DB::raw('games_won/games_played'), 'desc')->take(5)->get();


    // TODO - change to loss ratio
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

    //dd($this->gamesWonPerTeamPerDay(date("y-m-d")));

    return View::make('dashboard.index')
      ->with("totalGames", $totalGames)
      ->with("averageGameTime", gmdate("H:i:s", $averageGameTime))
      ->with("topThreeTeams", $topThreeTeams)
      ->with("biggestLoser", $biggestLoser)
      ->with("bestTableSide", $bestTableSide)
      ->with("gamesPerDay", $this->gamesPlayedPerDay(date("y-m-d")))
      ->with('gamesWonPerTeamPerDay', $this->gamesWonPerTeamPerDay(date("y-m-d")));


  }

  // get the total games played for the working week
  function gamesPlayedPerDay($week){

    $today = strtotime($week);

    $gamesMon = Game::where( DB::raw('DATE(updated_at)'), '=', date("Y-m-d", strtotime("monday this week", $today)))->count();
    $gamesTue = Game::where( DB::raw('DATE(updated_at)'), '=', date("Y-m-d", strtotime("tuesday this week", $today)))->count();
    $gamesWed = Game::where( DB::raw('DATE(updated_at)'), '=', date("Y-m-d", strtotime("wednesday this week", $today)))->count();
    $gamesThu = Game::where( DB::raw('DATE(updated_at)'), '=', date("Y-m-d", strtotime("thursday this week", $today)))->count();
    $gamesFri = Game::where( DB::raw('DATE(updated_at)'), '=', date("Y-m-d", strtotime("friday this week", $today)))->count();

    return array("Monday" => $gamesMon, "Tuesday" => $gamesTue, "Wednesday" => $gamesWed, "Thursday" => $gamesThu, "Friday" => $gamesFri);

  }


  // get the total wins for each team per day for this week
  function gamesWonPerTeamPerDay($week){

    $today = strtotime($week);
    $topThreeTeams = DB::table('teams')->orderBy('games_won', 'desc')->take(5)->skip(0)->get();

    $teams = array();

    foreach($topThreeTeams as $team){

      // how many wins for monday has this team got?
      $gamesMon = Game::where( DB::raw('DATE(updated_at)'), '=', date("Y-m-d", strtotime("monday this week", $today)))
        ->where('winning_team_id', '=', $team->id)->count();

      $gamesTue = Game::where( DB::raw('DATE(updated_at)'), '=', date("Y-m-d", strtotime("tuesday this week", $today)))
        ->where('winning_team_id', '=', $team->id)->count();

      $gamesWed = Game::where( DB::raw('DATE(updated_at)'), '=', date("Y-m-d", strtotime("wednesday this week", $today)))
        ->where('winning_team_id', '=', $team->id)->count();

      $gamesThu = Game::where( DB::raw('DATE(updated_at)'), '=', date("Y-m-d", strtotime("thursday this week", $today)))
        ->where('winning_team_id', '=', $team->id)->count();

      $gamesFri = Game::where( DB::raw('DATE(updated_at)'), '=', date("Y-m-d", strtotime("friday this week", $today)))
        ->where('winning_team_id', '=', $team->id)->count();

      $teams[$team->name] = array("Monday" => $gamesMon, "Tuesday" => $gamesTue, "Wednesday" => $gamesWed, "Thursday" => $gamesThu, "Friday" => $gamesFri);

    }

    return $teams;

  }


 


}

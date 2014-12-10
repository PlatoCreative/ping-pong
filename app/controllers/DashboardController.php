<?php

class DashboardController extends BaseController {

  // basic dashboard
  function index(){
        
    $topPlayersELO = Team::hasoneplayer()->orderBy('elo', 'desc')->take(5)->skip(0)->get();
    $topTeamsELO = Team::hastwoplayers()->orderBy('elo', 'desc')->take(5)->skip(0)->get();

    $teams = Team::hastwoplayers()->get();
    $players = Team::hasoneplayer()->get();

    $highestStreak = Streak::orderBy('streak_length', 'desc')->get()->first();
    $highestGameStoreTeamOne = Game::orderBy('team_one_score', 'desc')->get()->first();
    $highestGameStoreTeamTwo = Game::orderBy('team_two_score', 'desc')->get()->first();
    if($highestGameStoreTeamOne > $highestGameStoreTeamTwo){
      $highestGameStore = $highestGameStoreTeamOne->team_one_score;
    }else{
      $highestGameStore = $highestGameStoreTeamTwo->team_two_score;
    }

    // TODO - change to loss ratio
    $biggestLoser = DB::table('teams')->orderBy('games_lost', 'desc')->take(1)->get();

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
      if($gameTime < 3600){
        array_push($gameLength, $gameTime);
      }
      
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
      ->with("topTeams", $this->getBestTeams($teams,date("Y-m-d")))
      ->with("topPlayers", $this->getBestTeams($players, date("Y-m-d")))
      ->with("topTeamsELO", $topTeamsELO)
      ->with("topPlayersELO", $topPlayersELO)
      ->with("biggestLoser", $biggestLoser)
      ->with("bestTableSide", $bestTableSide)
      ->with("gamesPerDay", $this->gamesPlayedPerDay(date("y-m-d")))
      ->with('gamesWonPerTeamPerDay', $this->gamesWonPerTeamPerDay(date("y-m-d")))
      ->with('highestStreak', $highestStreak)
      ->with('highestGameStore', $highestGameStore)
      ->with('mostGodLikes', $this->getMostGodLikes())
      ->with('mostIntenseGame', $this->getMostIntenseGame());

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


  function getBestTeams($teams, $start){

    $end = new DateTime($start);
    $end->modify('-1 week');

    $topTeams = array();
    $winRatio = 0;
    foreach($teams as $team){
      $games = Game::where('team_one_id', '=', $team->id)->orWhere('team_two_id', '=', $team->id)->whereBetween('updated_at', array($end, $start))->count();
      $wins = Game::where('winning_team_id', '=', $team->id)->whereBetween('updated_at', array($start, $end))->count();
      if($games > 4 && $wins > 0){
        $winRatio = round(($wins / $games) * 100, 0);
        $loses = $games-$wins;
        array_push($topTeams, array("team_id" => $team->id, "name" => $team->name, "ratio" => $winRatio, "games_won" => $wins, "games_lost" => $loses, "total_games" => $games, "total_wins" => $wins));
      }
  
    }

    usort($topTeams, function($a, $b) { return $b["ratio"] - $a["ratio"]; } );
    $topTeams = array_slice($topTeams, 0, 5);

    return $topTeams;

  }
  
  function getMostIntenseGame(){
    
    // $game = DB::table('games')


    // foreach($result as $res){
    //   $team = Team::where('id', '=', $res->team_id)->first();
    //   $godlikes = $res->team_streak_count;
    // }
    
    return "";
    
  }


  function getMostGodLikes(){
    $result = DB::table('game_streaks')->select(DB::raw('*, COUNT(*) as team_streak_count'))->where('streak_length', '>', '8')->groupBy('team_id')->orderBy('team_streak_count')->take(1)->get(); 
    foreach($result as $res){
      $team = Team::where('id', '=', $res->team_id)->first();
      $godlikes = $res->team_streak_count;
    }
    
    return array("teamName" => $team->name, "team_streak_count" => $godlikes);
    
  }
  
  


}

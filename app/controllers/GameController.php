<?php

class GameController extends BaseController {

  // game view for playing a game
  function index($gameID){

    $game = Game::find($gameID);

    return View::make('game.index')->withGame($game);

  }

  // create a new game
  function create(){

    $teamOnePlayers = Input::get('team_one');
    $teamTwoPlayers = Input::get('team_two');

    // find exisitng teams OR create new
    $teamOne = App::make('TeamController')->getTeamFromPlayers($teamOnePlayers);
    $teamTwo = App::make('TeamController')->getTeamFromPlayers($teamTwoPlayers);

    // create the game!!!
    $game = new Game;
    $game->team_one_score = 0;
    $game->team_two_score = 0;
    $game->teamOne()->associate($teamOne);
    $game->teamTwo()->associate($teamTwo);
    $game->save();


    // store settings in sessions
    Session::put('game-score', Input::get("game-score"));
    Session::put('sound-pack', Input::get("sound-pack"));


    return Redirect::to('game/' . $game->id);

  }


  function addScoreStreak($gameID, $teamPos, $length){


    // find the current game
    $game = Game::find($gameID);

    if($teamPos == 1){
      $team = $game->teamOne;
    }else{
      $team = $game->teamTwo;
    }

    $streak = new Streak;
    $streak->streak_length = $length;
    $streak->game()->associate($game);
    $streak->team()->associate($team);

    $streak->save();

    return Response::json(array('saved' => true));
  }

  // update the game score
  function updateGameScore($gameID, $teamPos){

    // find the current game
    $game = Game::find($gameID);

    // add points to team
    if(isset($game)){
      if($teamPos == 1){
        $game->team_one_score++;
      }else{
        $game->team_two_score++;
      }

      $game->save();
    }

    return Response::json(array('saved' => true));
  }

  // mark the game as finished
  function end($gameID){

    $winnerName = "";

    // find the current game
    $game = Game::find($gameID);

    // update the teams stats
    $teamOne = Team::find($game->team_one_id);
    $teamTwo = Team::find($game->team_two_id);

    $teamOne->games_played = $teamOne->games_played+1;
    $teamTwo->games_played = $teamTwo->games_played+1;

    $teamOnePoints = 0;
    $teamTwoPoints = 0;

    // update wins and losses
    if($game->team_one_score > $game->team_two_score){
      $teamOne->games_won = $teamOne->games_won+1;
      $teamTwo->games_lost = $teamTwo->games_lost+1;
      $winnerName = $teamOne->name;
      $lossingName = $teamTwo->name;

      $game->winning_team_id = $teamOne->id;
      $gameResult = "*" . $game->team_one_score . "* - *" . $game->team_two_score. "*";

      $teamOnePoints = 1;

    }else{
      $teamOne->games_lost = $teamOne->games_lost+1;
      $teamTwo->games_won = $teamTwo->games_won+1;
      $winnerName = $teamTwo->name;
      $lossingName = $teamOne->name;

      $game->winning_team_id = $teamTwo->id;
      $gameResult = "*" . $game->team_two_score . "* - *" . $game->team_one_score. "*";

      $teamTwoPoints = 1;
    }

    // Post to Slack!
    Slack::send("*" . $winnerName . "* just played against *" . $lossingName . "* and won " . $gameResult);

    //update team ELO
    File::requireOnce(app_path() . '/includes/elo-rating/src/Rating/Rating.php');

    $rating = new Rating($teamOne->elo, $teamTwo->elo, $teamOnePoints, $teamTwoPoints);
    $ratingResults = $rating->getNewRatings();

    $teamOne->elo = $ratingResults['a'];
    $teamTwo->elo = $ratingResults['b'];

    $teamOne->save();
    $teamTwo->save();
    $game->save();


    return Redirect::to('/')->with("winningTeam", $winnerName);

  }

}

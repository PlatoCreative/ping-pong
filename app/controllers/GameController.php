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
  
  // get game/1/
  function updateGameScore($gameID, $teamPos){
    
    // find the current game
    $game = Game::find($gameID);
    
    // add points to team
    if($teamPos == 1){
      $game->team_one_score++;
    }else{
      $game->team_two_score++;
    }
    
    $game->save();
    
  }
  
}

<?php

class TeamController extends BaseController {

  // find existing teams if any exists OR if none exists create a new one with the passed players
  function getTeamFromPlayers($teamPlayers){

    if(count($teamPlayers) > 1){

      $team = Team::where('player_one_id', '=', $teamPlayers[0])->where('player_two_id', '=', $teamPlayers[1])->orWhere('player_one_id', '=', $teamPlayers[1])->where('player_two_id', '=', $teamPlayers[0])->first();

      // if no team found, create one
      if(!$team){

        $playerOne = Player::find($teamPlayers[0]);
        $playerTwo = Player::find($teamPlayers[1]);

        $team = new Team;
        $team->name = $playerOne->name . ' and ' . $playerTwo->name;
        $team->games_played = 0;
        $team->games_won = 0;
        $team->games_lost = 0;
        $team->elo = 1000;
        $team->playerOne()->associate($playerOne);
        $team->playerTwo()->associate($playerTwo);
        $team->save();

      }

    }else{

      $team = Team::where('player_one_id', '=', $teamPlayers[0])->where('player_two_id', '=', $teamPlayers[0])->first();

      // if no team found, create one
      if(!$team){

        $playerOne = Player::find($teamPlayers[0]);

        $team = new Team;
        $team->name = $playerOne->name;
        $team->games_played = 0;
        $team->games_won = 0;
        $team->games_lost = 0;
        $team->playerOne()->associate($playerOne);
        $team->playerTwo()->associate($playerOne);
        $team->save();

      }

    }

    return $team;

  }

}

<?php

class ReplayController extends BaseController {


  function replay(){

    $lastGames = Game::take(20)->orderBy('created_at', 'DESC')->get();
   
    return View::make('replay.index')->with('games', $lastGames);

  }

  function replayGame($gameID){

    $game = Game::find($gameID);
    $today = strtolower(date("D-M-d"));
    $teams = strtolower(str_replace(' ', '_', trim($game->teamOne->name) . '_' . trim($game->teamTwo->name)));


    //get videos generated for the game
    $gameDir = public_path() . '/videos/' . $today . '/' . $game->id . '-' . $teams;

    $videoFiles = File::files($gameDir);
    
    var_dump($videoFiles)
    for($i = 0; $i < count($videoFiles); $i++){
      $videoFiles[$i] = $this->path_to_link($videoFiles[$i]);
    }

    dd($videoFiles);
    
    return View::make('replay.game')->withGame($game)->withVideos($videoFiles)->with('gameDir', $gameDir);

  }

  function path_to_link($path){
    return  substr($path,strlen($_SERVER['DOCUMENT_ROOT'])); 
  }

  function save(){

    $video = Input::file('video-blob');

    $today = strtolower(date("D-M-d"));
    $teams = strtolower(str_replace(' ', '_', Input::get('teams')));
    $gameid = Input::get('gameid');
    $score = Input::get('score');


    //create folder for todays games
    if(!File::exists(public_path() . '/videos/' . $today)) {
        File::makeDirectory(public_path() . '/videos/' . $today);
    }

    $thisGameDirectory = public_path() . '/videos/' . $today . '/' . $gameid . '-' . $teams;
    //create folder for this game
    if(!File::exists($thisGameDirectory)) {
        File::makeDirectory($thisGameDirectory);
    }

    
    $uploadDirectory = $thisGameDirectory . '/' . $score . '.webm';
    
    move_uploaded_file($video, $uploadDirectory);

    //echo $uploadDirectory;
  
  }
}

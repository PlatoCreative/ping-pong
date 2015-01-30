<?php

class ReplayController extends BaseController {


  function replay(){

   
    return View::make('replay.index');

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

<?php namespace Web\Controllers;

class PlayerController extends BaseController {
  
  /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */
  public function create()
  {
    return View::make('Web::player.create');
  }
  
  
  /**
  * Store a newly created resource in storage.
  *
  * @return Response
  */
  public function store()
  {
    $playerName = Input::get('playerName');
    
    $player = new Player;
    $player->name = $playerName;

    //give default elo of 100
    $player->elo = 100;
    
    $player->save();
    
    return Redirect::to('players/create')->withErrors(['Player created', 'msg']);
    
  }
    
}

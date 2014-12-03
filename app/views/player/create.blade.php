<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Plato Pong</title>
  
  @section('styles')
  {{ HTML::style('css/app.css') }}
  {{ HTML::style('css/flipclock.css') }}
  @show
  
</head>
<body>
  
  <h1>Create Player <small>- create a new player</small><h1>
      
    <p><em>@if($errors->any()) {{$errors->first()}} @endif</em></p>  
      
    {{ Form::open(array('url' => 'players/store')) }}
      
    {{Form::label('playerName', 'Player Name:')}}
    {{Form::text('playerName')}}
    {{Form::submit('Create user')}}
    
    {{ Form::close() }}
    
    <br />
    <br />
    <a href="/">Back to Games</a>
      
    
    @section('scripts')
    {{ HTML::script('/js/jquery-2.1.1.min.js') }}
    {{ HTML::script('/js/velocity.min.js') }}
    {{ HTML::script('/js/velocity.ui.min.js') }}
    {{ HTML::script('/js/buzz.min.js') }}
    {{ HTML::script('/js/flipclock.min.js') }}
    
    
    {{ HTML::script('/js/libs/default.js') }}
    {{ HTML::script('/js/libs/unreal.js') }}
    {{ HTML::script('/js/libs/halo.js') }}
    
    {{ HTML::script('/js/game.js') }}
    @show
  </body>
  </html>
  
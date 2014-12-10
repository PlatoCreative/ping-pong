<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Plato Pong</title>

  @section('styles')
  {{ HTML::style('css/app.css') }}
  @show

</head>
<body>
  <div class="row">
    <div class="large-8 large-centered columns">
      <h1>Create a new player<h1>

      <p><em>@if($errors->any()) {{$errors->first()}} @endif</em></p>

      {{ Form::open(array('url' => 'players/store')) }}

      {{Form::label('playerName', 'Player Name:')}}
      {{Form::text('playerName')}}
      <input type="submit" value="Create" class="button expand" />

      {{ Form::close() }}

      <br />
      <br />
      <a href="/" class="button secondary small">Back to Games</a>

    </div>
  </div>
  
  <script>  
  var base_url = '{{$_ENV['APP_URL']}}';
  var deviceID = "{{$_ENV['API_SPARK_DEVICE']}}";
  var accessToken = "{{$_ENV['API_SPARK_ACCESS']}}";
  </script>

    @section('scripts')
    {{ HTML::script('/js/jquery-2.1.1.min.js') }}
    {{ HTML::script('/foundation/js/foundation.js') }}
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

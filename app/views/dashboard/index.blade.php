<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Plato Pong</title>

  @section('styles')
  {{ HTML::style('css/app.css') }}
  @show

</head>
<body class="non-game">

  <div class="row">

    <div class="large-12 columns">
      <h1>Plato Creative Ping Pong Dashboard</h1>
      <hr />
    </div>

    <div class="large-6 columns">

      <div class="alert-box radius">
        <h3><strong>Top 3 Teams:</strong><br />
          @foreach($topThreeTeams as $team)
          {{$team->name}} - {{$team->games_won}} wins & {{$team->games_lost}} loses<br />
          @endforeach
          </h3>
      </div>

    </div>

    <div class="large-6 columns">

      <div class="alert-box success radius">
        <h3>Total Games Played: <strong>{{$totalGames}}</strong></h3>
      </div>
      
      <div class="alert-box success radius">
        <h3>Average Game Time: <strong>{{$averageGameTime}}</strong></h3>
      </div>

    </div>


  </div>

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

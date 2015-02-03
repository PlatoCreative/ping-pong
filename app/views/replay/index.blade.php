<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Plato Pong - Replays</title>

  @section('styles')
  {{ HTML::style('css/app.css') }}
  @show

</head>
<body class="non-game dashboard">

  <div class="row">
    <div class="large-12 columns">
      <h1>Ping Pong Replays <small>Plato Creative</small></h1>
    </div>
    <div class="large-12 columns">
        <div class="row">
           @foreach($games as $game)
             <a href="/replay/game/{{ $game->id }}">
              <div class="large-3 columns">
                <div class="alert-box transparent radius">
                  <h3>Game {{ $game->id }}</h3>
                  <h3><span class="stat">{{$game->teamTwo->name}} v {{$game->teamOne->name}}</span></h3>
                </div>
              </div>
            </a>
          @endforeach
        </div>


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

  @show



</body>
</html>

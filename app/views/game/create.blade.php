<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Plato Pong</title>

  @section('styles')
  {{ HTML::style('css/app.css') }}
  @show

</head>
<body class="non-game dashboard">

  <form method="post" action="game/create">
  <div class="row text-left">

    <div class="large-5 players-list columns">
      <ul class="profiles large-block-grid-6">
        @foreach($players as $player)
        <li>
          <label for="right_{{ $player->name }}_{{ $player->id }}">
          <div class="text-center"><span class="profile-img"><img src="{{ $player->profile_picture }}"></span></div>
          <p class="text-center"><input type="checkbox" class="checkbox" name="team_two[]" id="right_{{ $player->name }}_{{ $player->id }}" value="{{ $player->id }}" />{{ $player->name }}</p>
          </label>
        </li>
        @endforeach
      </ul>
    </div>

    <div class="large-2 text-center columns">
      <br /><br /><br /><br /><br /><br /><br /><br />
      <h1>-VS-</h1>
    </div>

    <div class="large-5 players-list columns">
      <ul class="profiles large-block-grid-6">
        @foreach($players as $player)
        <li>
          <label for="left_{{ $player->name }}_{{ $player->id }}">
            <div class="text-center"><span class="profile-img"><img src="{{ $player->profile_picture }}"></span></div>
            <p class="text-center"><input type="checkbox" class="checkbox" name="team_one[]" id="left_{{ $player->name }}_{{ $player->id }}" value="{{ $player->id }}" />{{ $player->name }}</p>
          </label>
        </li>
        @endforeach
      </ul>
    </div>
  </div>

  <div class="row game-setting">
    <div class="large-12 columns">
      <hr />
    </div>

    <div class="large-6 columns">
        <label>Play to</label>
        <input type="radio" name="game-score" value="5" id="game-score1" checked="checked"><label for="game-score1">5</label>
        <input type="radio" name="game-score" value="11" id="game-score2"><label for="game-score2">11</label>
        <input type="radio" name="game-score" value="21" id="game-score3"><label for="game-score3">21</label>
    </div>

    <div class="large-6 columns">
        <label>Sounds Pack</label>
        <input type="radio" name="sound-pack" value="default" id="sound-pack1" checked="checked"><label for="sound-pack1">Default</label>
        <input type="radio" name="sound-pack" value="unreal" id="sound-pack2"><label for="sound-pack2">Unreal Tournament</label>
        <input type="radio" name="sound-pack" value="halo" id="sound-pack3"><label for="sound-pack3">Halo</label>
        <input type="radio" name="sound-pack" value="lol" id="sound-pack4"><label for="sound-pack4">League of Legends</label>
    </div>

    <div class="large-12 columns">
      <hr />
      <br />
    </div>

    <div class="large-12 text-center columns">
      <input id="startGame" type="submit"  class="button play expand" value="Begin Game" />
    </div>

  </div>

  </form>

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

  @if($winningTeam)
  <div id="winningModal" class="reveal-modal" data-reveal>
    <h1 id="congrats">Congratulations!</h1>
    <h3 class="lead"><strong>{{$winningTeam}}</strong> wins!</h3>
    <p class="text-center">
      <img src="./images/winner.png" width="280px" alt="Bitch Please!" />
    </p>
    <a class="close-reveal-modal">&#215;</a>
  </div>
  <script>
    $('#winningModal').foundation('reveal', 'open');
  </script>
  @endif

</body>
</html>

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
  
  <form method="post" action="game/create">
  <div class="row text-left">

    <div class="large-5 players-list columns">
      <h3>Team Two</h3>
      <ul class="profiles large-block-grid-5">
        @foreach($players as $player)
        <li>
          <label for="right_{{ $player->name }}_{{ $player->id }}">
          <div class="text-center"><span class="profile-img"><img src="../images/avatar.png"></span></div>
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
      <h3>Team One</h3>
      <ul class="profiles large-block-grid-5">
        @foreach($players as $player)
        <li>
          <label for="left_{{ $player->name }}_{{ $player->id }}">
            <div class="text-center"><span class="profile-img"><img src="../images/avatar.png"></span></div>
            <p class="text-center"><input type="checkbox" class="checkbox" name="team_one[]" id="left_{{ $player->name }}_{{ $player->id }}" value="{{ $player->id }}" />{{ $player->name }}</p>
          </label>
        </li>
        @endforeach
      </ul>
    </div>
  </div>

  <div class="row">
    <div class="large-12 columns">
      <hr />
    </div>

    <div class="large-6 columns">
      <p>
        <label for="game-score">Play to:
          <select name="game-score" id="game-score">
            <option value="5">5</option>
            <option value="11">11</option>
            <option value="21">21</option>
          </select>
        </label>
      </p>
    </div>

    <div class="large-6 columns">
      <p>
        <label for="sound-pack">Sound pack:
          <select name="sound-pack" id="sound-pack">
            <option value="default">default</option>
            <option value="unreal">Unreal Tournament</option>
            <option value="halo">Halo</option>
            <option value="lol">League of Legends</option>
          </select>
        </label>
      </p>
    </div>

    <div class="large-12 text-center columns">
      <input id="startGame" type="submit"  class="button expand" value="Begin Game" />
    </div>

  </div>

  </form>
  
  @if($errors->any())
  <div id="winningModal" class="reveal-modal" data-reveal>
    <h1>Congratulations!</h1>
    <h3 class="lead"><strong>{{$errors["winningTeam"]}}</strong> just destroyed <em>{{$errors["lossingTeam"]}}</em>.</h3>
    <!--<p>The score was <strong>21</strong> - <strong>18</strong> and it was 4:45 long.</p>-->
    <a class="close-reveal-modal">&#215;</a>
  </div>
  <script>
  $('#winningModal').foundation('reveal', 'open');
  </script>
  @endif


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

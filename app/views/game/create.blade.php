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

  <h1>Game Setup <small>- Organise your teams</small><h1>
  <form method="post" action="game/create">

    <div class="team-selection">
      <h3>Team Two</h3>
      <ul class="players-list">
        @foreach($players as $player)
        <li><input type="checkbox" class="checkbox" name="team_two[]" id="right_{{ $player->name }}_{{ $player->id }}" value="{{ $player->id }}" /> <label for="right_{{ $player->name }}_{{ $player->id }}">{{ $player->name }}</label></li>
        @endforeach
      </ul>
    </div>

    <div class="team-selection">
      <h3>Team One</h3>
      <ul class="players-list">
      @foreach($players as $player)
        <li><input type="checkbox" class="checkbox" name="team_one[]" id="left_{{ $player->name }}_{{ $player->id }}" value="{{ $player->id }}" /> <label for="left_{{ $player->name }}_{{ $player->id }}">{{ $player->name }}</label></li>
      @endforeach
      </ul>
    </div>

    <p>
      <label for="game-score">Game score:
        <select name="game-score" id="game-score">
          <option value="5">5</option>
          <option value="11">11</option>
          <option value="21">21</option>
        </select>
      </label>
    </p>

    <p>
      <label for="sound-pack">Sound pack:
        <select name="sound-pack" id="sound-pack">
          <option value="default">default</option>
          <option value="unreal">Unreal Tournament</option>
          <option value="halo">Halo</option>
        </select>
      </label>
    </p>


    <div class="clear"></div>
    <button type="submit">Start Game</button>
  </form>

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

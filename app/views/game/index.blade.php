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
<body id="pong-body" onLoad="start()" data-gameid="{{$game->id}}">
	<div class="table">

		<div class="left-top">

		</div>

		<div class="right-top">

		</div>


		<div class="left-bot">

		</div>

		<div class="right-bot">

		</div>

		<span id="team2" class="gg">{{$game->teamTwo->name}}</span>
		<div id="teamtwo-flip-holder">
			<div id="teamtwo"></div>
		</div>

		<span id="team1" class="gg">{{$game->teamOne->name}}</span>
		<div id="teamone-flip-holder">
			<div id="teamone"></div>
		</div>


	</div>

	<button id="but" onclick="start()">Connect</button>
	<!--<button id="reset" onclick="reset()">Reset Score</button>
	<button id="settings-button" onclick="settings()">Settings</button>-->
	<button id="fullscreen-button" onclick="fullscreen()">Fullscreen</button>
	<a href="/" ><button id="refresh-button"><strong>New Game</strong></button></a>


	<div id="settings">

		<div class="setting-option">
			<label for="game-score">Game score:
				<select name="game-score" id="game-score">
					<option value="5">5</option>
					<option value="11">11</option>
					<option value="21">21</option>
				</select>
			</label>
		</div>

		<div class="setting-option">
			<label for="sound-pack">Sound pack:
				<select name="sound-pack" id="sound-pack">
					<option value="default">default</option>
					<option value="unreal">Unreal Tournament</option>
					<option value="halo">Halo</option>
				</select>
			</label>
		</div>

		<div class="setting-option">
			<button id="save-settings-button">Save</button>
		</div>



	</div>

	@section('scripts')

		<script>
		var gameWinningScore = {{Session::get('game-score');}};
		var soundPack = "{{Session::get('sound-pack');}}";
		</script>

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

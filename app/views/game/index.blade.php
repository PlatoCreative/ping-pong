<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Plato Pong</title>

	@section('styles')
		{{ HTML::style('css/app.css') }}
	@show
</head>
<body id="pong-body" class="dashboard" onLoad="start()" data-gameid="{{$game->id}}">

	<div class="row">

		<div class="large-6 text-center columns">
			<h1><span id="team2" data-team-name="{{$game->teamTwo->name}}" class="gg">{{$game->teamTwo->name}} @if($game->teamTwo->elo > $game->teamOne->elo)<small><em>Favourite</em></small>@endif</span></h1>
			<div id="teamtwo-flip-holder">
				<div id="teamtwo"></div>
			</div>

		</div>
		<div class="large-6 text-center columns">
			<h1><span id="team1" data-team-name="{{$game->teamOne->name}}" class="gg">{{$game->teamOne->name}} @if($game->teamOne->elo > $game->teamTwo->elo)<small><em>Favourite</em></small>@endif</span></h1>
			<div id="teamone-flip-holder">
				<div id="teamone"></div>
			</div>

		</div>

	</div>

	<div class="row">
		<div class="large-12 columns">
			<ul class="button-group round even-6">
				<li><a href="javascript:;" id="but" onclick="start()" class="button transparent">Connect</a></li>
				<li><a href="javascript:;" id="but" onclick="instantReplay()" class="button transparent">Instant Replay</a></li>
				<li><a href="/game/end/{{$game->id}}" id="refresh-button" class="button transparent">End Game</a></li>
				<li><a href="javascript:;" id="fullscreen-button" onclick="fullscreen()" class="button transparent">Fullscreen</a></li>
			</ul>
		</div>
	</div>

	<div id="videoModal" class="reveal-modal xlarge" data-reveal>
		<video autoplay></video>

		<div class="row">
			<div class="large-12 columns">
				<ul class="button-group round even-6">
					<li><a href="javascript:;" id="but" onclick="replaySlower()" class="button transparent">Slower</a></li>
					<li><a href="javascript:;" id="but" onclick="replayFaster()" class="button transparent">Faster</a></li>
					<li><a href="javascript:;" id="but" onclick="replayAgain()" class="button transparent">Play Again</a></li>
				</ul>
				<p id="video-playback-speed">Playback speed: 1x</p>
			</div>
		</div>
	</div>

	@section('scripts')

		<script src="//cdn.WebRTC-Experiment.com/RecordRTC.js"></script>

		<script>
		var gameWinningScore = {{Session::get('game-score');}};
		var soundPack = "{{Session::get('sound-pack');}}";

		var base_url = '{{$_ENV['APP_URL']}}';
		var deviceID = "{{$_ENV['API_SPARK_DEVICE']}}";
		var accessToken = "{{$_ENV['API_SPARK_ACCESS']}}";
		</script>

		{{ HTML::script('/js/jquery-2.1.1.min.js') }}
		{{ HTML::script('/foundation/js/foundation.js') }}
		{{ HTML::script('/js/velocity.min.js') }}
		{{ HTML::script('/js/velocity.ui.min.js') }}
		{{ HTML::script('/js/buzz.min.js') }}
		{{ HTML::script('/js/flipclock.min.js') }}


		{{ HTML::script('/js/libs/default.js') }}
		{{ HTML::script('/js/libs/unreal.js') }}
		{{ HTML::script('/js/libs/halo.js') }}
		{{ HTML::script('/js/libs/lol.js') }}

		{{ HTML::script('/js/game.js') }}
		{{ HTML::script('/js/video-replay.js') }}
	@show
</body>
</html>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	
	@section('styles')
		{{ HTML::style('css/app.css') }}
		{{ HTML::style('css/flipclock.css') }}
	@show
</head>
<body onLoad="start()">
	
	<div class="table">
	
		<div class="left-top">
			
		</div>
		
		<div class="right-top">
			
		</div>
		
		
		<div class="left-bot">
			
		</div>
		
		<div class="right-bot">
			
		</div>

		<span id="team2" class="gg">TEAM 2</span>
		<div id="teamtwo-flip-holder">
			<div id="teamtwo"></div>
		</div>

		<span id="team1" class="gg">TEAM 1</span>
		<div id="teamone-flip-holder">
			<div id="teamone"></div>
		</div>

			
	</div>

	<button id="but" onclick="start()">Connect</button>
	<button id="reset" onclick="reset()">Reset Score</button>

	@section('scripts')
		{{ HTML::script('/js/jquery-2.1.1.min.js') }}
		{{ HTML::script('/js/velocity.ui.min.js') }}
		{{ HTML::script('/js/velocity.min.js') }}
		{{ HTML::script('/js/buzz.min.js') }}
		{{ HTML::script('/js/flipclock.min.js') }}


		{{ HTML::script('/js/libs/default.js') }}

		{{ HTML::script('/js/game.js') }}
	@show
</body>
</html>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	
	@section('styles')
		{{ HTML::style('css/app.css') }}
	@show
</head>
<body>
	
	<div class="table">
	
		<div class="left-top">
			
		</div>
		
		<div class="right-top">
			
		</div>
		
		
		<div class="left-bot">
			
		</div>
		
		<div class="right-bot">
			
		</div>
	
	</div>
	
	@section('scripts')
		{{ HTML::script('/js/jquery-2.1.1.min.js') }}
		{{ HTML::script('/js/velocity.ui.min.js') }}
		{{ HTML::script('/js/velocity.min.js') }}
	@show
</body>
</html>

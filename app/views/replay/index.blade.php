<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Plato Pong</title>

	@section('styles')
		{{ HTML::style('css/app.css') }}
	@show
</head>
<body >


	<video id="player" autoplay></video>
	<button id="stop-recording">Replay</button>

	@section('scripts')
		

		{{ HTML::script('/js/jquery-2.1.1.min.js') }}
		{{ HTML::script('/foundation/js/foundation.js') }}
		{{ HTML::script('/js/velocity.min.js') }}
		{{ HTML::script('/js/velocity.ui.min.js') }}

		<script src="//cdn.WebRTC-Experiment.com/RecordRTC.js"></script>

		<script>
		var base_url = '{{$_ENV['APP_URL']}}';
		var deviceID = "{{$_ENV['API_SPARK_DEVICE']}}";
		var accessToken = "{{$_ENV['API_SPARK_ACCESS']}}";


		

			

			

			

			
    		

    		
    		// = RecordRTC(mediaStream, options); 
    		//recordRTC.startRecording(); 
			//recordRTC.stopRecording(function(videoURL) { 
			    //mediaElement.src = videoURL; 
			//});


		})
			
		</script>

	@show
</body>
</html>

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
	      <div class="row">
          <h1>Game {{ $game->id }} - {{ $game->teamOne->name }} vs {{ $game->teamTwo->name}}</h1>
          <div class="large-2 columns">      	  

            <ul>
              @foreach($videos as $video)
              <li>
                <a class="video-link" data-video-src="{{ $video }}" href="javascript:;">{{ basename($video,'.webm') }}</a>
              </li>
              @endforeach
            </ul>  
          </div>

          <div class="large-12 columns">         

            <video id='video-player' autoplay controls>
              <source src="{{ $videos[0] }}" type="video/webm">
            </video>
          </div>

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

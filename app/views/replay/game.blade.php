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
          <div class="large-12 columns">
            <h1>Game {{ $game->id }} - <small>{{ $game->teamOne->name }} vs {{ $game->teamTwo->name}}</small></h1>
          </div>
          <div class="large-6 medium-6 small-12 column">
            <div class="row">

              @foreach($videos as $video)
              <div class="large-4 medium-4 small-12 column">
                <div class="alert-box transparent radius">
                  <span class="stat"><a class="video-link" data-video-src="{{ $video }}" href="javascript:;">{{ basename($video,'.webm') }}</a></span>
                </div>
              </div>
              @endforeach

            </div>

          </div>

          <div class="large-6 medium-6 small-12 column">
            <div class="alert-box transparent radius">
              <span class="stat">Instant Replay</span>
              <video id='video-player' src="{{ $videos[0] }}" autoplay controls>
              </video>
           </div>
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

  <script>

    $(document).ready(function(){
    $('.video-link').click(function(){

      console.log('new source = ' + $(this).attr('data-video-src'));
      $("#video-player").attr("src", $(this).attr('data-video-src'));
      return false;
    });
  });
  </script>

  @show



</body>
</html>

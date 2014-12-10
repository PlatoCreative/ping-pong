<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Plato Pong</title>

  {{ HTML::script('/js/modernizr.js') }}

  @section('styles')
  {{ HTML::style('css/app.css') }}
  @show

  <script src="//use.typekit.net/vwc1ddx.js"></script>
  <script>try{Typekit.load();}catch(e){}</script>

</head>
<body class="non-game dashboard">

  <a href="/" class="play" title="Play a game!"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
    width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
    <path id="video-play-3-icon" d="M256,92.481c44.433,0,86.18,17.068,117.553,48.064C404.794,171.411,422,212.413,422,255.999
    s-17.206,84.588-48.448,115.455c-31.372,30.994-73.12,48.064-117.552,48.064s-86.179-17.07-117.552-48.064
    C107.206,340.587,90,299.585,90,255.999s17.206-84.588,48.448-115.453C169.821,109.55,211.568,92.481,256,92.481 M256,52.481
    c-113.771,0-206,91.117-206,203.518c0,112.398,92.229,203.52,206,203.52c113.772,0,206-91.121,206-203.52
    C462,143.599,369.772,52.481,256,52.481L256,52.481z M206.544,357.161V159.833l160.919,98.666L206.544,357.161z"/>
  </svg></a>

  <div class="row">

    <div class="large-12 columns">
      <h1>Ping Pong Dashboard <small>Plato Creative</small></h1>
    </div>

    <div class="large-3 columns">

      <div class="alert-box transparent text-left radius">
        <h3>
          <span class="stat tool" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="Win/Game Ratio. Last 7 days.">Top 5 Teams:</span>
          @foreach($topTeams as $team)
          <span class="up">{{$team["ratio"]}}%</span> - <span class="up">{{$team["games_won"]}}</span> - <span class="down">{{$team["games_lost"]}}</span>&nbsp;&nbsp;&nbsp;{{$team["name"]}}<br />
          @endforeach
        </h3>
      </div>

      <div class="alert-box transparent text-left radius">
        <h3>
          <span class="stat tool" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="Win/Game Ratio. Last 7 days.">Top 5 Players:</span>
          @foreach($topPlayers as $player)
          <span class="up">{{$player["ratio"]}}%</span> - <span class="up">{{$player["games_won"]}}</span> - <span class="down">{{$player["games_lost"]}}</span>&nbsp;&nbsp;&nbsp;{{$player["name"]}}<br />
          @endforeach
        </h3>
      </div>

    </div>

    <div class="large-3 columns">

      <div class="alert-box transparent text-left radius">
        <h3>
          <span class="stat">Team Rankings:</span>
          @foreach($topTeamsELO as $teamELO)
          <span class="up">{{$teamELO->elo}}</span></span>&nbsp;&nbsp;&nbsp;{{$teamELO->name}}<br />
          @endforeach
        </h3>
      </div>

      <div class="alert-box transparent text-left radius">
        <h3>
          <span class="stat">Player Rankings:</span>
          @foreach($topPlayersELO as $playerELO)
          <span class="up">{{$playerELO->elo}}</span>&nbsp;&nbsp;&nbsp;{{$playerELO->name}}<br />
          @endforeach
        </h3>
      </div>

    </div>

    <div class="large-3 columns">

      <div class="alert-box transparent radius">
        <h3><span class="stat">Total Games Played</span> {{$totalGames}}</h3>
      </div>


      <div class="alert-box transparent radius">
        <h3><span class="stat">Average Game Time</span> {{$averageGameTime}}</h3>
      </div>

      <div class="alert-box transparent radius">
        <h3><span class="stat">Highest Game Streak</span> {{$highestStreak->streak_length}}</h3>
      </div>

      <div class="alert-box transparent radius">
        <h3><span class="stat">Team With Most <em>Godlikes</em></span> {{$mostGodLikes['teamName']}} with {{$mostGodLikes['team_streak_count']}}</h3></h3>
      </div>

    </div>

    <div class="large-3 columns">

      <div class="alert-box transparent radius">
        <h3><span class="stat">Best table side</span> {{$bestTableSide}}</h3>
      </div>
      <div class="alert-box transparent radius">
        <h3><span class="stat">Not Playing so well</span> @foreach($biggestLoser as $loser) {{$loser->name}} - {{$loser->games_lost}} loses  @endforeach</h3>
      </div>

      <div class="alert-box transparent radius">
        <h3><span class="stat">Highest Game Score</span> {{$highestGameStore}}</h3>
      </div>

      <div class="alert-box transparent radius">
        <h3><span class="stat">Most Intense Game</span><em>{{ $mostIntenseGame['game']->teamOne->name }} v {{ $mostIntenseGame['game']->teamTwo->name }} <br> ({{ round($mostIntenseGame['points_per_min'], 2) }} PPM)</em></h3>
      </div>

    </div>

  </div>

  <div class="row">

    <div class="large-6 text-center columns">
      <h2>Wins Per Team Per Day</h2>
      <div style="width:100%">
        <div>
          <canvas id="canvas" height="300" width="600"></canvas>
        </div>
        <div id="lineLegend"></div>

      </div>
    </div>


    <div class="large-6 text-center columns">
      <h2>Games Per Day</h2>
      <div style="width:100%">
        <div>
          <canvas id="canvas2" height="300" width="600"></canvas>
        </div>
      </div>
    </div>


  </div>

  @section('scripts')
  {{ HTML::script('/js/jquery-2.1.1.min.js') }}
  {{ HTML::script('/foundation/js/foundation.js') }}
  {{ HTML::script('/js/velocity.min.js') }}
  {{ HTML::script('/js/velocity.ui.min.js') }}
  {{ HTML::script('/js/Chart.min.js') }}
  {{ HTML::script('/js/randomColor.js') }}
  {{ HTML::script('/js/game.js') }}
  @show


  <script>
  var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
  var lineChartData = {
    labels : ["Monday","Tuesday","Wednesday","Thursday","Friday"],
    datasets : [
    @foreach($gamesWonPerTeamPerDay as $team => $days)
    {
      label: "{{$team}}",
      fillColor : "rgba(0,0,0,0.2)",
      strokeColor : randomColor({luminosity: 'light',hue: 'random'}),
      pointColor : randomColor({luminosity: 'light',hue: 'random'}),
      pointStrokeColor : "#fff",
      data : [
        @foreach($days as $day => $wins)
          {{$wins}},
        @endforeach
      ]
    },
    @endforeach
    ]
  }

  var barChartData = {
    labels : ["Monday","Tuesday","Wednesday","Thursday","Friday"],
    datasets : [
    {
      fillColor : "rgba(0,0,0,0.2)",
      strokeColor : "rgba(0,0,0,0.2)",
      highlightFill: "rgba(0,0,0,0.3)",
      highlightStroke: "rgba(0,0,0,0.4)",
      data : [@foreach($gamesPerDay as $dayOfGames => $gamesPerDay) {{$gamesPerDay}}, @endforeach]
    }
    ]
  }

  window.onload = function(){
    var ctxx = document.getElementById("canvas2").getContext("2d");
    var myBar = new Chart(ctxx).Bar(barChartData, {
      responsive : true,
      scaleFontColor: "rgba(255,255,255, 0.6)"
    });

    var ctx = document.getElementById("canvas").getContext("2d");
    var myLine = new Chart(ctx).Line(lineChartData, {
      responsive: true,
      scaleFontColor: "rgba(255,255,255, 0.6)",
      legendTemplate : "<ul class=\"large-block-grid-5 medium-block-grid-5 small-block-grid-2 line-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
    });

    $("#lineLegend").append(myLine.generateLegend());

  }


</script>

</body>
</html>

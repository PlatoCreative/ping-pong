$(document).foundation();

var base_url = 'http://pong.platocreative.co.nz';
//var base_url = 'http://ping-pong.app';

var gameID = $("body").data("gameid");

var soundLibrary;
var team1Score = 0;
var team2Score = 0;

var matchPointScore;
var matchPointColor = '#ae0d0d';
var gameWonColor = '#37f9ee';

var team1 = $("#teamone");
var team2 = $("#teamtwo");

var team1clock;
var team2clock;

var pointStreak = 0;
var streakTeam = -1;
var timeOfLastPoint = 0;

setInterval(onTick, 1000);
var rallyFired = false;


setInterval(playAudioQueue, 250);
var audioArray = [];
var isPlayingSound = false;

function reset(){
    team1clock.setTime(0);
    team2clock.setTime(0);
    team1Score = 0;
    team2Score = 0;

    soundLibrary.playSoundEvent('start');
}

function fullscreen(){
    var bd = document.getElementById("pong-body");
    console.log(bd);
    bd.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
}

function refreshPage(){
    location.reload();
}

function settings(){
    $('#settings').fadeIn(300);

    $('#save-settings-button').click(function(){
        $('#settings').fadeOut(300);

        gameWinningScore = $('#game-score').val();
        console.log(gameWinningScore);

        matchPointScore = gameWinningScore - 1;

        soundPack = $('#sound-pack').val();
        loadSoundLibarary(soundPack);

    });
}

function start() {

    team1Score = 0;
    team2Score = 0;

    document.getElementById("but").innerHTML = 'Disconnect';

    console.log('start');
    //start flipclock
    team1clock = $('#teamone').FlipClock(00, {
        clockFace: 'Counter',
        autoStart: false
    });

    team2clock = $('#teamtwo').FlipClock(00, {
        clockFace: 'Counter',
        autoStart: false
    });


    loadSoundLibarary(soundPack);
    matchPointScore = gameWinningScore - 1;

    soundLibrary.playSoundEvent('start');


    var deviceID = "53ff6a066667574811252067";
    var accessToken = "d42e7052ba5fa01bf62834495e34ab39369349ce";
    var eventSource = new EventSource("https://api.spark.io/v1/devices/" + deviceID + "/events/?access_token=" + accessToken);


    eventSource.addEventListener('open', function(e) {
        //console.log("Opened!");
    },false);

    eventSource.addEventListener('error', function(e) {
        console.log("Errored!");
    },false);


    eventSource.addEventListener('Team', function(e) {

        var parsedData = JSON.parse(e.data);

        console.log(parsedData.data);
        teamScore(parsedData.data, 1);



    }, false);
}


function teamScore(team, score){

    soundLibrary.playSoundEvent('score');

    if(team == 1){
        team1Score += score;

        // ajax request here to update score
        $.ajax({
          type: "POST",
          url : base_url+"/game/"+gameID+"/score/1",
          //data : dataString,
          success : function(data){
            console.log(data);
          }
        });

    }else if(team == 2){
        team2Score += score;

        // ajax request here to update score
        $.ajax({
          type: "POST",
          url : base_url+"/game/"+gameID+"/score/2",
          //data : dataString,
          success : function(data){
            console.log(data);
          }
        });

    }

    team1clock.setTime(team1Score);
    team2clock.setTime(team2Score);


    checkForSoundEvents(team, score);
    if(!checkForWinner()){
        checkForMatchPoint();
    }else{
        window.location = base_url+"/game/end/"+gameID;
    }


    var d = new Date();
    timeOfLastPoint = d.getTime();
    rallyFired = false;




}

function checkForSoundEvents(team, score){

    //check for shutdown
    if(team != streakTeam && pointStreak > 2){
        soundLibrary.playSoundEvent('shutdown');

        //game streak ended - post to server
        sendGameStreak(team, pointStreak);
    }


    //check for streaks
    if(team == streakTeam || streakTeam == -1){
        pointStreak += score;
        streakTeam = team;

        if(pointStreak == 2){
            soundLibrary.playSoundEvent('double');
        }else if(pointStreak == 3){
            soundLibrary.playSoundEvent('triple');
        }else if(pointStreak == 4){
            soundLibrary.playSoundEvent('quadra');
        }else if(pointStreak == 5){
            soundLibrary.playSoundEvent('penta');
        }else if(pointStreak == 6){
            soundLibrary.playSoundEvent('hexa');
        }else if(pointStreak == 7){
            soundLibrary.playSoundEvent('hepta');
        }else if(pointStreak == 8){
            soundLibrary.playSoundEvent('octa');
        }else if(pointStreak > 8){
            soundLibrary.playSoundEvent('ultra');
        }

    }else{
        pointStreak = 1;
        streakTeam = team;
    }


    if((team1Score == 1 && team2Score == 0) || (team1Score == 0 && team2Score == 1)){
        soundLibrary.playSoundEvent('firstpoint');
    }


     if((team1Score == matchPointScore && team2Score < matchPointScore) || (team2Score == matchPointScore && team1Score < matchPointScore)){
        soundLibrary.playSoundEvent('matchpoint');
    }




    if(team1Score >= matchPointScore && team1Score > team2Score && team == 2){
        soundLibrary.playSoundEvent('denied');
    }
    if(team2Score >= matchPointScore && team2Score > team1Score  && team == 1){
        soundLibrary.playSoundEvent('denied');
    }


    //need to do logic for a comeback if you come from more than 3 behind

    var d = new Date();
    var nowTime = d.getTime();
    if(nowTime - timeOfLastPoint < 3000){
        soundLibrary.playSoundEvent('ace');
    }


}

function onTick(){



    var d = new Date();
    var nowTime = d.getTime();

    if(nowTime - timeOfLastPoint > 20000 && nowTime - timeOfLastPoint < 1417495970 && !rallyFired){
        soundLibrary.playSoundEvent('rally');
        console.log('rally');
        rallyFired = true;
    }

}

function sendGameStreak(team_pos, length){

    $.ajax({
        type: "GET",
        url : base_url+"/game/"+gameID+"/streak/" + team_pos + "/" + length,
        //data : dataString,
        success : function(data){
            console.log(data);
        }
    });
}

function checkForMatchPoint(){



    $('#teamone .inn').velocity({color:'#ccc'}, {duration: 1000}).velocity("stop");
    $('#teamtwo .inn').velocity({color:'#ccc'}, {duration: 1000}).velocity("stop");

    if((team1Score == matchPointScore && team2Score < matchPointScore) || (team1Score > matchPointScore && team1Score > team2Score)){
        soundLibrary.playSoundEvent('matchpoint');
        $('#teamone .inn').velocity({color:matchPointColor}, {duration: 1000, loop: true});

    }

    if((team2Score == matchPointScore && team1Score < matchPointScore) || (team2Score > matchPointScore && team2Score > team1Score)){
        soundLibrary.playSoundEvent('matchpoint');
        $('#teamtwo .inn').velocity({color:matchPointColor}, {duration: 1000, loop: true});
    }
}

function checkForWinner(){


    if((team1Score == gameWinningScore && team2Score < gameWinningScore - 1) || (team1Score > gameWinningScore && team1Score > team2Score + 1)){
        console.log('game won');
        soundLibrary.playSoundEvent('gameover');

        $('#teamone .inn').velocity("stop");
        $('#teamone .inn').css('color', gameWonColor);

        return true;
    }

     if((team2Score == gameWinningScore && team1Score < gameWinningScore - 1) || (team2Score > gameWinningScore && team2Score > team1Score + 1)){
        soundLibrary.playSoundEvent('gameover');
        //$('#teamtwo .inn').velocity({color:gameWonColor}, {duration: 1000, loop: true});
        //VELOCITY SEEMS TO ERROR WHILE STOPING AND STARTING A NEW LOOP SO HAVE LEFT FOR NOW

        $('#teamtwo .inn').velocity("stop");
        $('#teamtwo .inn').css('color', gameWonColor);

        return true;
    }

    return false;

}

function loadSoundLibarary(type){

    if(type == 'default'){
        soundLibrary = new DefaultSound();
    }else if(type == 'unreal'){
        soundLibrary = new UnrealSound();
    }else if(type == 'halo'){
        soundLibrary = new HaloSound();
    }else if(type == 'lol'){
        soundLibrary = new LolSound();
    }
}

function playAudioQueue(){

    //if item in the queue and not already playing a sound
    if(audioArray.length > 0 && !isPlayingSound){

        //play audio and set flag
        audioArray[0].play();
        isPlayingSound = true;

        audioArray[0].bind("ended", function(e) {
            //reset flag after finish playing audio
            isPlayingSound = false;
        });

        audioArray.splice(0, 1);
    }

}


// some quick effects
$('.profiles input[type=checkbox]').change(function() {
  $(this).closest('label').toggleClass('selected', $(this).is(':checked'));
});

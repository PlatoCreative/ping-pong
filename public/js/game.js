var soundLibrary = new DefaultSound();

var team1Score = 0;
var team2Score = 0;

var gameWinningScore = 21;
var matchPointColor = '#ae0d0d';
var gameWonColor = '#37f9ee';

var team1 = $("#teamone");
var team2 = $("#teamtwo");

var team1clock;
var team2clock;
      
function reset(){
    team1clock.setTime(0);
    team2clock.setTime(0);
    team1Score = 0;
    team2Score = 0;
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

        
    var deviceID = "53ff6a066667574811252067";
    var accessToken = "d42e7052ba5fa01bf62834495e34ab39369349ce";
    var eventSource = new EventSource("https://api.spark.io/v1/devices/" + deviceID + "/events/?access_token=" + accessToken);
        
        
    eventSource.addEventListener('open', function(e) {
        console.log("Opened!"); 
    },false);
          
    eventSource.addEventListener('error', function(e) {
        console.log("Errored!"); 
    },false);

            
    eventSource.addEventListener('Team', function(e) {
          
        var parsedData = JSON.parse(e.data);
          
        console.log(parsedData.data);
        teamScore(parsedData.data, 1);        
          
        
          
          // if(team1Score == 20){
          //   document.getElementById("teamone").style.color = "red";
          //   team1.className = team1.className + " gamepoint";
          //   playFinish();
          // }else{
          //   team1.className = " ";
          // }
          
          // if(team2Score == 20){
          //   document.getElementById("teamtwo").style.color = "red";
          //   team2.className = team2.className + " gamepoint";
          //   playFinish();
          // }else{
          //   team2.className = " ";
          // }
          
          
          
    }, false);
}


function teamScore(team, score){   

    soundLibrary.playSoundEvent('score');

    if(team == 1){
        team1Score += score;
    }else if(team == 2){
        team2Score += score;
    }

    team1clock.setTime(team1Score);
    team2clock.setTime(team2Score);


    if(!checkForWinner()){
        checkForMatchPoint();
    }
    
    

}

function checkForMatchPoint(){

    var matchPointScore = gameWinningScore - 1;

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
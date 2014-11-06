(function(){

    var preload;
    var stage;
    var background;

    var logo;
    var intro;
    var menu;

    var gameMode = '';
    var numberPlayers = 0;
    var players = [
        {"id":1, "name":"ben"},
        {"id":2, "name":"dan"},
        {"id":3, "name":"tom"},
    ];

    var progressText;
    var stagewidth = 1920;
    var stageheight = 1080;




    this.init = function() {     

        stage = new createjs.Stage('pong-canvas');

        stage.enableMouseOver();

        var manifest = [   
            {src:"images/logo.png", id:"logo"},
        ];


        progressText = new createjs.Text("", "20px Arial", "#000000");
        progressText.x = stagewidth / 2 - progressText.getMeasuredWidth() / 2;
        progressText.y = 200;
        stage.addChild(progressText);


        preloader = new createjs.LoadQueue(true);
        preloader.on("progress", handleProgress);
        preloader.on("complete", handleComplete);
        preloader.on("fileload", handleFileLoad);
        preloader.loadManifest(manifest);

        

    }

    this.onTick = function(event){
        stage.update();
    }

    this.initGraphics = function(){

        background = new createjs.Shape();
        background.graphics.beginFill("#000").drawRect(0, 0, stagewidth, stageheight);
        stage.addChild(background);


        intro = new Intro(logo);     
        intro.on("introFinished", removeIntro);       
        stage.addChild(intro);            
    }

    this.startGame = function(gameType){

        if(gameType == 'Singles'){
            numberPlayers = 2;
        }else if(gameType == 'Doubles'){
            numberPlayers = 4;
        }else{
            numberPlayers = -1;
        }

        var playerLoader = new PlayerLoader(numberPlayers);
        stage.addChild(playerLoader);


    }

    this.getPlayer = function(playerID){

        for (i = 0; i < players.length; i++) {
            if(players[i].id == playerID){
                return players[i];
            }
        }


        return false;
    }

    this.removeIntro = function(e){
        stage.removeChild(intro);

        menu = new Menu();
        stage.addChild(menu);
        menu.on("menuEvent", menuSelected);
    }
   
    this.menuSelected = function(e){
        console.log(e.menuType);
        if(e.menuType == 'Settings'){
            //TODO: Show settings
        }else{
            startGame(e.menuType);
        }
    }

    this.handleProgress = function(event)
    {
        //use event.loaded to get the percentage of the loading
        progressText.text = (preloader.progress*100|0) + " % Loaded";
        stage.update();
    }

    this.handleComplete = function(event) {
        //triggered when all loading is complete
        console.log('complete');
        stage.removeChild(progressText);
        initGraphics();

        createjs.Ticker.addEventListener("tick", onTick);
    }

    this.handleFileLoad = function(event) {
        //triggered when an individual file completes loading
        console.log("A file has loaded of type: " + event.item.type);

        if(event.item.id == "logo"){
            console.log("Adding logo");
            logo = new createjs.Bitmap(event.result);
        }
    } 


    window.onload = init();
})();

$(document).ready(function(){

    $('#pong-canvas').click(function(){
        var canvasEl = document.getElementById("pong-canvas");
        if(!document.webkitFullscreenElement && canvasEl.webkitRequestFullscreen){
            canvasEl.webkitRequestFullscreen();            
        }
    });
});
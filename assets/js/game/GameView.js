(function (window) {
    function GameView(players, winning_score) {
        this.initialize(players, winning_score);
    }

    var _players;
    var _game_mode;
    var _winning_score;


    var team_1_graphic;
    var team_2_graphic;

    var team_1_score = 0;
    var team_2_score = 0;

    var team_1_score_graphic;
    var team_2_score_graphic;


    var team_1_name = "Pink Team";
    var team_2_name = "Blue Team";



    var game_time = 0;;
    var game_time_graphic;
    var game_time_interval;
    var update_score_interval;

    var logo_holder;
    var description;

    //Inheritance from Container
    var _game_view = GameView.prototype = new createjs.Container();
    _game_view.Container_initialize = _game_view.initialize;

    _game_view.initialize = function (players, winning_score) {
        //call to initialize() method from parent class
        this.Container_initialize();

       
        _players = players;
        _winning_score = winning_score;


        this.initGraphics();
        this.animate();
        console.log("GameView initialized");
    }

    _game_view.initGraphics = function(){

        var background = new createjs.Shape();
        background.graphics.beginFill("#fff").drawRect(0, 0, 1920, 1080)
        this.addChild(background);


        team_1_graphic = new createjs.Shape();
        team_1_graphic.graphics.beginFill("#f335c9").mt(-1000, 0).lt(1080, 0).lt(860, 1080).lt(-1000, 1080).lt(-1000, 0);
        team_1_graphic.y = -1080;
        team_1_graphic.x = -1080;
        this.addChild(team_1_graphic);


        team_2_graphic = new createjs.Shape();
        team_2_graphic.graphics.beginFill("#3578f3").mt(860, 0).lt(2980, 0).lt(2980, 1080).lt(860, 1080).lt(1080, 0);
        team_2_graphic.y = 1080;
        team_2_graphic.x = 1980;
        this.addChild(team_2_graphic);

        team_1_score_graphic = new createjs.Text("0", "500px sfsports", "#fff");
        team_1_score_graphic.x = 300;
        team_1_score_graphic.y = 250;
        team_1_score_graphic.alpha = 0;
        this.addChild(team_1_score_graphic);

        team_2_score_graphic = new createjs.Text("0", "500px sfsports", "#fff");
        team_2_score_graphic.x = 1250;
        team_2_score_graphic.y = 250;
        team_2_score_graphic.alpha = 0;
        this.addChild(team_2_score_graphic);


        team_1_name_graphic = new createjs.Text(team_1_name, "120px sfsports", "#fff");
        team_1_name_graphic.x = 150;
        team_1_name_graphic.y = 50;
        this.addChild(team_1_name_graphic);

        team_2_name_graphic = new createjs.Text(team_2_name, "120px sfsports", "#fff");
        team_2_name_graphic.x = 1150;
        team_2_name_graphic.y = 50;
        this.addChild(team_2_name_graphic);


        game_time_graphic = new createjs.Container();
        game_time_graphic.x = 800;
        game_time_graphic.y = 800;
        game_time_graphic.minutes = new createjs.Text("0", "100px sfsports", "#fff");
        game_time_graphic.addChild(game_time_graphic.minutes);
        game_time_graphic.seconds = new createjs.Text("00", "100px sfsports", "#fff");
        game_time_graphic.seconds.x = 160;
        game_time_graphic.addChild(game_time_graphic.seconds);


        this.addChild(game_time_graphic);


        var gamePass = this;
        game_time_interval = setInterval(function(){
            gamePass.timeGame();
        }, 1000, gamePass);

    }

    _game_view.animate = function(){

        createjs.Tween.get(team_1_graphic,{loop:false}).to({y:0, x:0}, 2000, createjs.Ease.bounceOut);
        createjs.Tween.get(team_2_graphic,{loop:false}).to({y:0, x:0}, 2000, createjs.Ease.bounceOut);

        createjs.Tween.get(team_1_score_graphic,{loop:false}).wait(2000).to({alpha:1}, 1000, createjs.Ease.bounceinOut);
        createjs.Tween.get(team_2_score_graphic,{loop:false}).wait(2000).to({alpha:1}, 1000, createjs.Ease.bounceinOut);


        var gamePass = this;
        update_score_interval = setInterval(function(){
            gamePass.updateScores();
        }, 750, gamePass);

    }

    _game_view.updateScores = function(){

        if(Math.random() > 0.5){
            team_1_score++;
        }else{
            team_2_score++;
        }

        
        if(team_1_score > 9){
            team_1_score_graphic.x = 200;
        }       
        if(team_2_score > 9){
            team_2_score_graphic.x = 1150;
        }

        team_1_score_graphic.text = team_1_score;
        team_2_score_graphic.text = team_2_score;


        if(team_1_score >= _winning_score){
            this.end_game(1);

        }else if(team_2_score >= _winning_score){
            this.end_game(2);
        }


    }

    _game_view.end_game = function(teamNumber){

        console.log(teamNumber);

        window.clearInterval(game_time_interval);
        window.clearInterval(update_score_interval);


        this.removeChild(team_1_score_graphic);
        this.removeChild(team_2_score_graphic);
        this.removeChild(team_1_name_graphic);
        this.removeChild(team_2_name_graphic);
        this.removeChild(game_time_graphic);

        createjs.Tween.get(team_1_graphic,{loop:false}).to({x:2000}, 5000, createjs.Ease.cubicOut);

        //this.setChildIndex(team_1_graphic, this.getNumChildren - 1);
    }

    _game_view.timeGame = function(){
        game_time++;

        game_time_graphic.seconds.text = this.padTime(game_time%60);
        game_time_graphic.minutes.text = this.padTime(parseInt(game_time/60)) + ":";

    }

    _game_view.padTime = function(val){
        var valString = val + "";
        
        if(valString.length < 2){
            return "0" + valString;
        }
        else{
            return valString;
        }
    }
   

    window.GameView = GameView;
} (window));





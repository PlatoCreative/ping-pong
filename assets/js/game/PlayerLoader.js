(function (window) {
    function PlayerLoader(numPlayers) {
        this.initialize(numPlayers);
    }

    var _num_players;
    var top_bar;
    var bottom_bar;
    var display_text;

    var player_queue = [];
    var can_add_player = false;
    var loaded_players = [];

    var current_animated_player;


    //Inheritance from Container
    var _player_loader = PlayerLoader.prototype = new createjs.Container();
    _player_loader.Container_initialize = _player_loader.initialize;

    _player_loader.initialize = function (numPlayers) {
        //call to initialize() method from parent class
        this.Container_initialize();

        _num_players = numPlayers;

        this.width = 1920;
        this.height = 1080;

        this.initGraphics();
        this.animate();
        console.log("PlayerLoader initialized");
    }

    _player_loader.initGraphics = function(){

        var background = new createjs.Shape();
        background.graphics.beginFill("#fff").drawRect(0, 0, 1920, 1080)
        this.addChild(background);

        top_bar = new createjs.Shape();
        top_bar.graphics.beginFill("#e04385").lt(1980, 0).lt(1920, 50).lt(0, 50).lt(0, 0);
        top_bar.x = -1980;
        this.addChild(top_bar);

        bottom_bar = new createjs.Shape();
        bottom_bar.graphics.beginFill("#e04385").lt(-60, 50).lt(1920, 50).lt(1920, 0).lt(0, 0);
        bottom_bar.x = 1920;
        bottom_bar.y = 1030;
        this.addChild(bottom_bar);

        display_text = new createjs.Text("Players swipe your cards", "100px sfsports", "#292929");
        display_text.y = 450;
        display_text.x = 200;
        display_text.alpha = 0;
        this.addChild(display_text);

        current_animated_player = new createjs.Container();
        this.addChild(current_animated_player);
       
    }

    _player_loader.animate = function(){
        createjs.Tween.get(top_bar,{loop:false}).to({x:0}, 1500, createjs.Ease.sineIn);
        createjs.Tween.get(bottom_bar,{loop:false}).to({x:0}, 1500, createjs.Ease.sineIn);
        createjs.Tween.get(display_text,{loop:false}).to({alpha:1}, 2000, createjs.Ease.sineIn).call(this.allowPlayers);

    }

    _player_loader.allowPlayers = function(){
        can_add_player = true;
        this.parent.addPlayer(1);
        this.parent.addPlayer(3);
        this.parent.addPlayer(2);
    }

    _player_loader.onTick = function(e){
        console.log("hey");
    }

    _player_loader.addPlayer = function(playerID){

        var player = window.getPlayer(playerID);
        player_queue.push(player);

        this.processPlayerQueue();

        //this.parent.dispatchEvent("introFinished");
    }

    _player_loader.processPlayerQueue = function(){
        
        if(player_queue.length && can_add_player){
            can_add_player = false;
            this.animatePlayer(player_queue[0]);
            loaded_players.push(player_queue[0]);
            player_queue.splice(0, 1);
        }


    }

    _player_loader.animatePlayer = function(player){
        if(display_text.alpha > 0){
            createjs.Tween.get(display_text,{loop:false}).to({alpha:0}, 100, createjs.Ease.sineIn);
        }

        var playerName = new createjs.Text(player.name, "150px sfsports", "#292929");
        playerName.x = 200;
        playerName.y = 150;
        playerName.alpha = 0;
        current_animated_player.addChild(playerName);

        var playerTagline = new createjs.Text("Spin Jedi", "100px sfsports", "#292929");
        playerTagline.x = 200;
        playerTagline.y = 270;
        playerTagline.alpha = 0;
        current_animated_player.addChild(playerTagline);


        var playerImage = new createjs.Bitmap('/images/players/' + player.name + '.jpg'); //TODO: change this to PNG
        playerImage.x = 1200;
        playerImage.y = 150;
        playerImage.alpha = 0;
        current_animated_player.addChild(playerImage);


        var playerWins = new createjs.Text("Wins: 57", "100px sfsports", "#292929");
        playerWins.x = 200;
        playerWins.y = 600;
        playerWins.alpha = 0;
        current_animated_player.addChild(playerWins);

        var playerLoses = new createjs.Text("Loses: 41", "100px sfsports", "#292929");
        playerLoses.x = 1000;
        playerLoses.y = 600;
        playerLoses.alpha = 0;
        current_animated_player.addChild(playerLoses);

        var playerBait = new createjs.Text("Bait: Tom", "100px sfsports", "#292929");
        playerBait.x = 200;
        playerBait.y = 750;
        playerBait.alpha = 0;
        current_animated_player.addChild(playerBait);

        var playerNemesis = new createjs.Text("Nemesis: Ben", "100px sfsports", "#292929");
        playerNemesis.x = 1000;
        playerNemesis.y = 750;
        playerNemesis.alpha = 0;
        current_animated_player.addChild(playerNemesis);


        createjs.Tween.get(playerName,{loop:false}).to({alpha:1}, 1000, createjs.Ease.sineIn);
        createjs.Tween.get(playerTagline,{loop:false}).to({alpha:1}, 1000, createjs.Ease.sineIn);
        createjs.Tween.get(playerImage,{loop:false}).to({alpha:1}, 1000, createjs.Ease.sineIn);

        createjs.Tween.get(playerWins,{loop:false}).wait(500).to({alpha:1}, 1000, createjs.Ease.sineIn);
        createjs.Tween.get(playerLoses,{loop:false}).wait(500).to({alpha:1}, 1000, createjs.Ease.sineIn);
        createjs.Tween.get(playerBait,{loop:false}).wait(500).to({alpha:1}, 1000, createjs.Ease.sineIn);
        createjs.Tween.get(playerNemesis,{loop:false}).wait(500).to({alpha:1}, 1000, createjs.Ease.sineIn).wait(1000).call(this.fadeOutPlayer, null, this);


    }

    _player_loader.fadeOutPlayer = function(){

        createjs.Tween.get(current_animated_player,{loop:false}).to({alpha:0}, 100, createjs.Ease.sineIn).call(this.clearPlayer, null, this);
    }

    _player_loader.clearPlayer = function(){
       

        if(loaded_players.length == _num_players){

            var playersAddedEvent = new createjs.Event("playersAdded");
            playersAddedEvent.players = loaded_players;
            this.dispatchEvent(playersAddedEvent);
        }
        current_animated_player.removeAllChildren();
        current_animated_player.alpha = 1;
        can_add_player = true;
        this.processPlayerQueue();

    }

    window.PlayerLoader = PlayerLoader;
} (window));





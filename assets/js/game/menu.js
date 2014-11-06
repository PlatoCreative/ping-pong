(function (window) {
    function Menu() {
        this.initialize();
    }


    //Inheritance from Container
    var _menu = Menu.prototype = new createjs.Container();
    _menu.Container_initialize = _menu.initialize;

    _menu.initialize = function () {
        //call to initialize() method from parent class
        this.Container_initialize();



        this.initGraphics();

    }

    _menu.initGraphics = function(){


        header = new createjs.Text("Select game mode", "70px sfsports", "#bbe0f8");
        header.x = 600;
        header.y = 100;
        this.addChild(header);


        this.addButton("Singles", 940, 300);
        this.addButton("Doubles", 935, 420);
        this.addButton("King of the table", 900, 540);
        this.addButton("Tournament", 920, 660);
        this.addButton("Settings", 935, 780);

    }

    _menu.addButton = function(name, x, y){

        var button = new createjs.Container();
        title = new createjs.Text(name, "70px sfsports", "#fff");
        title.textAlign = 'center';
        button.addChild(title);

        button.x = x;
        button.y = y;

        button.on("click", this.onButtonClick, button);
        button.on("mouseover", this.onButtonOver, button);
        button.on("mouseout", this.onButtonOut, button);

        this.addChild(button);

    }

    _menu.onButtonClick = function(e){
        e.target.color = '#e04385';
        var menuEvent = new createjs.Event("menuEvent");
        menuEvent.menuType = e.target.text;
        this.parent.dispatchEvent(menuEvent); 
    }

    _menu.onButtonOver = function(e){
        e.target.color = 'red';    
    }

     _menu.onButtonOut = function(e){
        e.target.color = '#fff';    
    }

    _menu.animate = function(){
        createjs.Tween.get(logo_holder,{loop:false}).to({x:500}, 2000, createjs.Ease.sineOut).wait(1000).to({alpha:0}, 1500);
        createjs.Tween.get(description,{loop:false}).to({x:500}, 2000, createjs.Ease.sineOut).wait(1000).to({alpha:0}, 1500).call(this.introComplete)
    }

    _menu.introComplete = function(){
        //parent needs to dispatch event as this is the tween text
        this.parent.dispatchEvent("introFinished");
    }

    window.Menu = Menu;
} (window));





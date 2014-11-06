(function (window) {
    function Intro(logo) {
        this.initialize(logo);
    }

    var _logo;
    var logo_holder;
    var description;

    //Inheritance from Container
    var _intro = Intro.prototype = new createjs.Container();
    _intro.Container_initialize = _intro.initialize;

    _intro.initialize = function (logo) {
        //call to initialize() method from parent class
        this.Container_initialize();

        _logo = logo;


        this.initGraphics();
        this.animate();
        console.log("Intro initialized");
    }

    _intro.initGraphics = function(){

        // _logo.scaleX = _logo.scaleY = 0.2;

        logo_holder = new createjs.MovieClip();
        logo_holder.addChild(_logo)

        logo_holder.x = -900;
        logo_holder.y = 400;
        this.addChild(logo_holder);


        description = new createjs.Text("PLATO PONG - v.001", "78px sfsports", "#fff");
        description.x = 2000;
        description.y = 470;
        this.addChild(description);

    }

    _intro.animate = function(){
        createjs.Tween.get(logo_holder,{loop:false}).to({x:500}, 2000, createjs.Ease.sineOut).wait(1000).to({alpha:0}, 1500);
        createjs.Tween.get(description,{loop:false}).to({x:500}, 2000, createjs.Ease.sineOut).wait(1000).to({alpha:0}, 1500).call(this.introComplete)
    }

    _intro.introComplete = function(){
        //parent needs to dispatch event as this is the tween text
        this.parent.dispatchEvent("introFinished");
    }

    window.Intro = Intro;
} (window));





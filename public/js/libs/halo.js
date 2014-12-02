(function (window) {
    function HaloSound() {
        this.initialize();
    }



    var score = new buzz.sound("sounds/score.mp3");




    var _sound_class = HaloSound.prototype;

    _sound_class.initialize = function (){
        console.log("Loaded sound class");

        
    }    



    _sound_class.playSoundEvent = function(eventName){

        switch(eventName) {
            case 'score':
                audioArray.push(score);
                break;            
            default:
                return;
        }

        
    }


    window.HaloSound = HaloSound;
} (window));
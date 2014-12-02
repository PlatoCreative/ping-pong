(function (window) {
    function HaloSound() {
        this.initialize();
    }



    var score = new buzz.sound("sounds/score.mp3");

    var doubleSound = new buzz.sound("sounds/halo/double.mp3");
    var tripleSound = new buzz.sound("sounds/halo/triple_kill.mp3");    
    var killamonjaroSound = new buzz.sound("sounds/halo/killamonjaro.mp3");
    var killingSpreeSound = new buzz.sound("sounds/halo/killing_spree.mp3");
    var killionaireSound = new buzz.sound("sounds/halo/killionaire.mp3");
    var killpocolpseSound = new buzz.sound("sounds/halo/killpocolpse.mp3");
    var killtacularSound = new buzz.sound("sounds/halo/killtacular.mp3");
    var killtrocitySound = new buzz.sound("sounds/halo/killtrocity.mp3");
    var runningRiotSound = new buzz.sound("sounds/halo/running_riot.mp3");
    var unbelivableSound = new buzz.sound("sounds/halo/unbelivable.mp3");

    var playBallSound = new buzz.sound("sounds/halo/play_ball.mp3");
    var kingOfTheHillSound = new buzz.sound("sounds/halo/king_of_the_hill.mp3");
    var gameOverSound = new buzz.sound("sounds/halo/game_over.mp3");


    var _sound_class = HaloSound.prototype;

    _sound_class.initialize = function (){
        console.log("Loaded sound class");

        
    }    



    _sound_class.playSoundEvent = function(eventName){

        switch(eventName) {
            case 'score':
                //score.play();
                break;
            case 'start':
                audioArray.push(playBallSound);
                break; 
            case 'ace':
                audioArray.push(runningRiotSound);
                break;            
            case 'rally':
                audioArray.push(unbelivableSound);
                break; 
            case 'double':
                audioArray.push(doubleSound);
                break;   
            case 'triple':
                audioArray.push(tripleSound);
                break;  
            case 'quadra':
                audioArray.push(killtacularSound);
                break;   
            case 'penta':
                audioArray.push(killtrocitySound);
                break;  
            case 'hexa':
                audioArray.push(killpocolpseSound);
                break;   
            case 'hepta':
                audioArray.push(killionaireSound);
                break;  
            case 'octa':
                audioArray.push(killamonjaroSound);
                break;  
            case 'ultra':
                audioArray.push(unbelivableSound);
                break;  
            case 'gameover':
                audioArray.push(gameOverSound);
                break;              
            default:
                return;
        }

        
    }


    window.HaloSound = HaloSound;
} (window));
(function (window) {
    function LolSound() {
        this.initialize();
    }



    var score = new buzz.sound("/sounds/score.mp3");

    var doubleSound = new buzz.sound("/sounds/lol/double.mp3");
    var tripleSound = new buzz.sound("/sounds/lol/triple.mp3");    
    var quadraSound = new buzz.sound("/sounds/lol/quadra.mp3");
    var pentaSound = new buzz.sound("/sounds/lol/penta.mp3");
    var rampageSound = new buzz.sound("/sounds/lol/rampage.mp3");
    var legendarySound = new buzz.sound("/sounds/lol/legendary.mp3");
    var godlikeSound = new buzz.sound("/sounds/lol/godlike.mp3");


    var welcomeSound = new buzz.sound("/sounds/lol/welcome.mp3");
    var acedSound = new buzz.sound("/sounds/lol/aced.mp3");
    var executedSound = new buzz.sound("/sounds/lol/executed.mp3");
    var gameOverSound = new buzz.sound("/sounds/lol/victory.mp3");

    var killingSpreeSound = new buzz.sound("/sounds/lol/killing_spree.mp3");
    var humiliationSound = new buzz.sound("/sounds/lol/humiliation.mp3");
    var shutdownSound = new buzz.sound("/sounds/lol/shutdown.mp3");
    var unstoppableSound = new buzz.sound("/sounds/lol/unstoppable.mp3");


    var _sound_class = LolSound.prototype;

    _sound_class.initialize = function (){
        console.log("Loaded sound class");

        
    }    



    _sound_class.playSoundEvent = function(eventName){

        switch(eventName) {
            case 'score':
                audioArray.push(score);
                break;
            case 'start':
                audioArray.push(welcomeSound);
                break; 
            case 'ace':
                audioArray.push(acedSound);
                break;            
            case 'rally':
                audioArray.push(unstoppableSound);
                break; 
            case 'double':
                audioArray.push(doubleSound);
                break;   
            case 'triple':
                audioArray.push(tripleSound);
                break;  
            case 'quadra':
                audioArray.push(quadraSound);
                break;   
            case 'penta':
                audioArray.push(pentaSound);
                break;  
            case 'hexa':
                audioArray.push(rampageSound);
                break;   
            case 'hepta':
                audioArray.push(legendarySound);
                break;  
            case 'octa':
                audioArray.push(godlikeSound);
                break;  
            case 'ultra':
                audioArray.push(humiliationSound);
                break;  
            case 'gameover':
                audioArray.push(gameOverSound);
                break;     
            case 'shutdown':
                audioArray.push(shutdownSound);
                break;            
            default:
                return;
        }

        
    }


    window.LolSound = LolSound;
} (window));
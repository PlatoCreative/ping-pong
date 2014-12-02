(function (window) {
    function UnrealSound() {
        this.initialize();
    }



    var score = new buzz.sound("sounds/air_horn.mp3");
    var doubleSound = new buzz.sound("sounds/unreal/double.mp3");
    var monsterSound = new buzz.sound("sounds/unreal/monster_kill.mp3");
    var megaSound = new buzz.sound("sounds/unreal/mega_kill.mp3");
    var multiSound = new buzz.sound("sounds/unreal/multi_kill.mp3");
    var ultraSound = new buzz.sound("sounds/unreal/ultra_kill.mp3");

    var unstoppableSound = new buzz.sound("sounds/unreal/unstoppable.mp3");
    var rampageSound = new buzz.sound("sounds/unreal/rampage.mp3");
    var godlikeSound = new buzz.sound("sounds/unreal/godlike.mp3");



    var firstBloodSound = new buzz.sound("sounds/unreal/first_blood.mp3");
    var headshotSound = new buzz.sound("sounds/unreal/headshot.mp3");
    var impressiveSound = new buzz.sound("sounds/unreal/impressive.mp3");

    var deniedSound = new buzz.sound("sounds/unreal/denied.mp3");
    var saveSound = new buzz.sound("sounds/unreal/last_second_save.mp3");

    var _sound_class = UnrealSound.prototype;

    _sound_class.initialize = function (){
        console.log("Loaded sound class");

        
    }    



    _sound_class.playSoundEvent = function(eventName){

        switch(eventName) {
            case 'score':
                score.play();
                break;
            case 'ace':
                audioArray.push(headshotSound);
                break; 
            case 'denied':
                if(Math.random() < 0.5){
                    audioArray.push(deniedSound);
                }else{
                    audioArray.push(saveSound);
                }
                break;
            case 'rally':
                audioArray.push(impressiveSound);
                break; 
            case 'double':
                audioArray.push(doubleSound);
                break;   
            case 'triple':
                audioArray.push(monsterSound);
                break;  
            case 'quadra':
                audioArray.push(multiSound);
                break;   
            case 'penta':
                audioArray.push(ultraSound);
                break;  
            case 'hexa':
                audioArray.push(megaSound);
                break;   
            case 'hepta':
                audioArray.push(rampageSound);
                break;  
            case 'octa':
                audioArray.push(unstoppableSound);
                break;  
            case 'ultra':
                audioArray.push(godlikeSound);
                break;  
            case 'firstpoint':
                audioArray.push(firstBloodSound);
                break;              
            default:
                return;
        }

        
    }


    window.UnrealSound = UnrealSound;
} (window));
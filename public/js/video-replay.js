// var hdConstraints = {
// 	video: {
// 	    mandatory: {
// 		    minWidth: 1280,
// 		    minHeight: 720
// 		}
// 	}
// };
// var videoOptions = {
// 	type: 'video',
// 	video: { width: 1280, height: 720 },
// 	canvas: { width: 1280, height: 720 }
// }; 

var hdConstraints = {
	video: {
	    mandatory: {
		    minWidth: 640,
		    minHeight: 360
		}
	}
};
var videoOptions = {
	type: 'video',
	video: { width: 640, height: 360 },
	canvas: { width: 640, height: 360 }
}; 


var recordRTC;
var videoPlayer;
var currentPlaybackRate = 1;

$(document).ready(function(){


	videoPlayer = document.querySelector('video');

	navigator.webkitGetUserMedia(hdConstraints, function (mediaStream) {
	    recordRTC = RecordRTC(mediaStream, videoOptions);
	    recordRTC.startRecording();
	}, function(){
		alert('error');
	});
	



});

function instantReplay(){

	$('#videoModal').foundation('reveal', 'open');

	recordRTC.stopRecording(function (videoURL) {
       	videoPlayer.src = videoURL;

       	var recordedBlob = recordRTC.getBlob();
       	recordRTC.getDataURL(function(dataURL) { });
       	saveVideo(recordedBlob);

    });

};

function restartAndDestroyRecording(){

	recordRTC.stopRecording(function (videoURL) {
       	videoPlayer.src = videoURL;

       	var recordedBlob = recordRTC.getBlob();
       	recordRTC.getDataURL(function(dataURL) { });
       	saveVideo(recordedBlob);

    });

    setTimeout(function(){
    	recordRTC.startRecording();
    }, 1000);
    
}

function saveVideo(videoBlob){

	var formData = new FormData();
	formData.append('teams', $("#team1").attr('data-team-name').trim() + '_' + $("#team2").attr('data-team-name').trim());
	formData.append('gameid', gameID);
	formData.append('score', team1Score + '-' + team2Score);
	formData.append('video-blob', videoBlob);

	var request = new XMLHttpRequest();
	request.open("POST", "/replay/save");
	request.send(formData);

}

function replaySlower(){
	currentPlaybackRate -= 0.25;
	videoPlayer.playbackRate = currentPlaybackRate;

	$('#video-playback-speed').html('Playback speed: ' + videoPlayer.playbackRate);
}

function replayFaster(){
	currentPlaybackRate += 0.25;
	videoPlayer.playbackRate = currentPlaybackRate;
	$('#video-playback-speed').html('Playback speed: ' + videoPlayer.playbackRate);
}

function replayAgain(){
	videoPlayer.currentTime = 0;
	videoPlayer.load();
	videoPlayer.playbackRate = currentPlaybackRate;
}
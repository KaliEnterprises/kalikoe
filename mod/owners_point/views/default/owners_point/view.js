define(function(require) {
    var elgg = require("elgg");
    var $ = require("jquery");

    var player, timer, timeSpent = [];
    display = document.getElementById('display');
    //console.log(display);
    var tag = document.createElement('script');
    tag.id = 'iframe-demo';
    tag.src = 'https://www.youtube.com/iframe_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);console.log("--------");
    

    var player;
	function onYouTubeIframeAPIReady() {
		//alert('check');
		player = new YT.Player('play61663', {
	        events: {
	          'onReady': onPlayerReady,
	          'onStateChange': onPlayerStateChange
	        }
	    });
		console.log(player);
	}

	function onPlayerStateChange(event) {
		if(event.data === 1) { // Started playing
	        if(!timeSpent.length){
	            for(var i=0, l=parseInt(player.getDuration()); i<l; i++) timeSpent.push(false);
	        }
		    timer = setInterval(record,100);
	    } else {
			clearInterval(timer);
		}
	}

	function record(){
		timeSpent[ parseInt(player.getCurrentTime()) ] = true;
		showPercentage();
	}

	function showPercentage(){
	    var percent = 0;
	    for(var i=0, l=timeSpent.length; i<l; i++){
	        if(timeSpent[i]) percent++;
	    }
	    percent = Math.round(percent / timeSpent.length * 100);
	    display.innerHTML = percent + "%";
	}
});
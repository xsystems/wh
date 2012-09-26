setTimeout("setup()",10);

function setup()
{
	var videoElements = document.getElementsByTagName("video");
	
	setupPlayer(0, videoElements);

}

function setupPlayer(videoElementIndex, videoElements)
{
	if(videoElementIndex < videoElements.length)
	{
		var player = _V_(videoElements[videoElementIndex].getAttribute("id"), {"controls": true, "preload": "auto"}, setupPlayer(videoElementIndex+1, videoElements));		
		player.options.flash.swf = "../../../lib/video-js/bin/video-js.swf";
	}
}


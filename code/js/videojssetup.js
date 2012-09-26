var videojsCSS = "../../../lib/video-js/css/video-js.css";		
var videojsJS = "../../../lib/video-js/js/video.js";
var videojsoptionsJS = "../../../lib/video-js/js/video_options.js";

function loadLink(url, media, callback)
{
	// adding the script tag to the head as suggested before
	var head = document.getElementsByTagName('head')[0];
	var link = document.createElement('link');
	link.rel="stylesheet";
	link.type = 'text/css';
	link.href = url;
	link.media = media;

	// then bind the event to the callback function 
	// there are several events for cross browser compatibility
	link.onreadystatechange = callback;
	link.onload = callback;

	// fire the loading
	head.appendChild(link);
}

function loadScript(url, callback)
{
	// adding the script tag to the head as suggested before
	var head = document.getElementsByTagName('head')[0];
	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = url;

	// then bind the event to the callback function 
	// there are several events for cross browser compatibility
	script.onreadystatechange = callback;
	script.onload = callback;

	// fire the loading
	head.appendChild(script);
}


window.onload = loadScript(videojsoptionsJS, loadScript(videojsJS, loadLink(videojsCSS, "screen", "")));


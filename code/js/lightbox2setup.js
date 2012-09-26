var lightboxCSS = "../../../lib/lightbox2/css/lightbox.css";		
var jqueryJS = "../../../lib/lightbox2/js/jquery-1.7.2.min.js";	
var jqueryUIJS = "../../../lib/lightbox2/js/jquery-ui-1.8.18.custom.min.js";		
var jqueryScrollJS = "../../../lib/lightbox2/js/jquery.smooth-scroll.min.js";		
var lightboxJS = "../../../lib/lightbox2/js/lightbox.js";

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

window.onload = loadScript(lightboxJS, loadScript(jqueryScrollJS, loadScript(jqueryUIJS, loadScript(jqueryJS, loadLink(lightboxCSS, "screen", "")))));


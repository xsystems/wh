//var videojsCSS = "../../../lib/video-js/css/tube.css";
var videojsCSS = "/lib/video-js/css/video-js.css";
var videojsJS = "/lib/video-js/js/video.js";
var videojsoptionsJS = "/code/js/video_options.js";

var linkRel = 'stylesheet';
var linkType = 'text/css';
var linkMedia = 'screen';

window.onload = loadScript(videojsoptionsJS,
                    loadScript(videojsJS,
                        loadLink(videojsCSS, linkRel, linkType, linkMedia, "")));


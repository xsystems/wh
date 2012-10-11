//var videojsCSS = "../../../lib/video-js/css/tube.css";
var videojsCSS = "/lib/video-js/css/video-js.css";
var videojsJS = "/lib/video-js/js/video.js";
var os = "/code/js/os.js";

var linkRel = 'stylesheet';
var linkType = 'text/css';
var linkMedia = 'screen';

var aspectRatio = 9/16; //aspect ratio
var flashPlayer = "/lib/video-js/bin/video-js.swf";
var options = {"controls": true, "preload": "metadata", "width": "100%"};

var timeout = 1000; //ms

/* Does not work yet ... */
function resizePlayer()
{
    console.log("Resize is called !!!!!!!");

    var player = this;

    // Get the parent element's actual width
    var width = document.getElementById(player.id).offsetWidth;
    console.log("The width is: %s", width);
    // Set width to fill parent element, Set height
    player.height( width * aspectRatio );
}

function playEvent()
{
    var os = new OS();
    
    if(os.isMobile())
    {
        console.log("mobile --> play");
        console.log("mobile --> video to fullscreen");
        //Is not allowed, only when the user performs a specific action.
        //this.requestFullScreen();
    }
}

function setupPlayer(player)
{
    player.height(document.getElementById(player.id).offsetWidth * aspectRatio);
    player.addEvent("play", playEvent);
    player.addEvent("resize", resizePlayer);
}

function initPlayer(videoElementIndex, videoElements)
{
    if(videoElementIndex < videoElements.length)
    {
        var id = videoElements[videoElementIndex].getAttribute("id");

        _V_(id , options, initPlayer(videoElementIndex+1, videoElements)).ready(
            function()
            {
                setupPlayer(this);
            }
        );
    }
}

function setup()
{
    var videoElements = document.getElementsByTagName("video");
    _V_.options.flash.swf = flashPlayer;
    _V_.options.flash.iFrameMode = true;
    
    initPlayer(0, videoElements);
}


var loader = new Loader();
window.onload = loader.loadScript(os,
                    loader.loadScript(videojsJS,
                        loader.loadLink(videojsCSS, linkRel, linkType, linkMedia, setTimeout(setup, timeout))));


var host = document.location.host;
var flashPlayer = "/lib/video-js/bin/video-js.swf";

var timeout = 100; //ms
var aspectRatio = 9/16; //aspect ratio
var options = {"controls": true, "preload": "metadata", "width": "100%"};


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
    console.log("Play Event !!!!!!!");
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

    initPlayer(0, videoElements);
}

setTimeout(setup, timeout);

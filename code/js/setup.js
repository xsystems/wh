var linkRel = 'stylesheet';
var linkType = 'text/css';
var linkMedia = 'screen';

var os = "/code/js/os.js";
var mobileCSS = "/style/mobile.css";
var notMobileCSS = "/style/not_mobile.css";

var loader = new Loader();

function setup()
{
    var os = new OS();

    if(os.isMobile())
    {
        loader.loadLink(mobileCSS, linkRel, linkType, linkMedia, "");
    }
    else
    {
        loader.loadLink(notMobileCSS, linkRel, linkType, linkMedia, "");
    }
}

window.onload = loader.loadScript(os, setup);

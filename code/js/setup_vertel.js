var oldSiteCSS = "/style/old-site.css";

var linkRel = 'stylesheet';
var linkType = 'text/css';
var linkMedia = 'screen';

//var proxyURL = "http://wh.xsystems.org/lib/proxy.php";
var proxyURL = "/lib/proxy.php";
var vertelURL = "http://www.windhappers.nl/vertel.php";

function extract(htmlString)
{
//    convertedHtmlString = decodeURIComponent(escape(htmlString));
    convertedHtmlString = htmlString;

    parser = new DOMParser();
    vertelDocument = parser.parseFromString(convertedHtmlString, "text/html");

//    console.log(vertelDocument.childNodes[1].getElementsByTagName("div")[0].innerHTML);

    document.getElementById("vertel").innerHTML= vertelDocument.childNodes[1].getElementsByTagName("div")[0].innerHTML;
}

function setup()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState===4 && xmlhttp.status===200)
        {
            extract(xmlhttp.responseText);
        }
    };
    
    xmlhttp.open("POST", proxyURL, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("path=" + vertelURL);
}

var loader = new Loader();
window.onload = loader.loadLink(oldSiteCSS, linkRel, linkType, linkMedia, setup());

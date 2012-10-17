var oldSiteCSS = "/style/old-site.css";

var linkRel = 'stylesheet';
var linkType = 'text/css';
var linkMedia = 'screen';

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

// Locate too own file:

/*
 * DOMParser HTML extension
 * 2012-02-02
 *
 * By Eli Grey, http://eligrey.com
 * Public domain.
 * NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK.
 */
 
/*! @source https://gist.github.com/1129031 */
/*global document, DOMParser*/
 
(function(DOMParser) {
    "use strict";
 
    var
      DOMParser_proto = DOMParser.prototype
    , real_parseFromString = DOMParser_proto.parseFromString
    ;
 
    // Firefox/Opera/IE throw errors on unsupported types
    try {
        // WebKit returns null on unsupported types
        if ((new DOMParser).parseFromString("", "text/html")) {
            // text/html parsing is natively supported
            return;
        }
    } catch (ex) {}
 
    DOMParser_proto.parseFromString = function(markup, type) {
        if (/^\s*text\/html\s*(?:;|$)/i.test(type)) {
            var
              doc = document.implementation.createHTMLDocument("")
            , doc_elt = doc.documentElement
            , first_elt
            ;
 
            doc_elt.innerHTML = markup;
            first_elt = doc_elt.firstElementChild;
 
            if ( // are we dealing with an entire document or a fragment?
                   doc_elt.childElementCount === 1
                && first_elt.localName.toLowerCase() === "html"
            ) {
                doc.replaceChild(first_elt, doc_elt);
            }
 
            return doc;
        } else {
            return real_parseFromString.apply(this, arguments);
        }
    };
}(DOMParser));

var lightboxCSS =   "/lib/js/lightbox/css/lightbox.css";
var jqueryJS =      "/lib/js/lightbox/js/jquery-1.10.2.min.js";
var lightboxJS =    "/lib/js/lightbox/js/lightbox-2.6.min.js";

var linkRel = 'stylesheet';
var linkType = 'text/css';
var linkMedia = 'screen';

var loader = new Loader();
window.onload = loader.loadScript(lightboxJS,
                    loader.loadScript(jqueryJS,
                        loader.loadLink(lightboxCSS, linkRel, linkType, linkMedia, "")));


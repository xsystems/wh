var lightboxCSS = "/lib/js/lightbox2/css/lightbox.css";
var jqueryJS = "/lib/js/lightbox2/js/jquery-1.7.2.min.js";
var jqueryUIJS = "/lib/js/lightbox2/js/jquery-ui-1.8.18.custom.min.js";
var jqueryScrollJS = "/lib/js/lightbox2/js/jquery.smooth-scroll.min.js";
var lightboxJS = "/lib/js/lightbox2/js/lightbox.js";

var linkRel = 'stylesheet';
var linkType = 'text/css';
var linkMedia = 'screen';

var loader = new Loader();
window.onload = loader.loadScript(lightboxJS,
                    loader.loadScript(jqueryScrollJS,
                        loader.loadScript(jqueryUIJS,
                            loader.loadScript(jqueryJS,
                                loader.loadLink(lightboxCSS, linkRel, linkType, linkMedia, "")))));

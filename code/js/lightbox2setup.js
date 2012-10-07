var lightboxCSS = "/lib/lightbox2/css/lightbox.css";
var jqueryJS = "/lib/lightbox2/js/jquery-1.7.2.min.js";
var jqueryUIJS = "/lib/lightbox2/js/jquery-ui-1.8.18.custom.min.js";
var jqueryScrollJS = "/lib/lightbox2/js/jquery.smooth-scroll.min.js";
var lightboxJS = "/lib/lightbox2/js/lightbox.js";

var linkRel = 'stylesheet';
var linkType = 'text/css';
var linkMedia = 'screen';

window.onload = loadScript(lightboxJS,
                    loadScript(jqueryScrollJS,
                        loadScript(jqueryUIJS,
                            loadScript(jqueryJS,
                                loadLink(lightboxCSS, linkRel, linkType, linkMedia, "")))));


<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/VideoGalleryElement.php");

class VideoGalleryView
{
    private static $rootElementClass = "";
    private static $galleryDir = "../../../media/videos/";
    private static $action = "gallery";
    private static $type = "video";
    private static $videosPerPage = -1;  
    private static $screenshortSecond = 5;
    
	public static function write($gallery)
	{
	    // Default gallery.
	    $videoDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST."/media/videos/2012-09-15_kanopolo_NK/";
        $videoDirPath = self::$galleryDir."/2012-09-15_kanopolo_NK/";
    
		$wh = new DeWindhappersTemplate();		
		
		if ( isset($gallery) && !empty($gallery) && $gallery != "")
		{
		    $videoDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST."/media/videos/".$gallery."/";
			$videoDirPath = self::$galleryDir.$gallery."/";
		}	

        $wh->add( new VideoGalleryElement(self::$rootElementClass, self::$galleryDir, self::$action, self::$type, self::$videosPerPage, self::$screenshortSecond, $videoDirURL, $videoDirPath) );

		$domDocument = $wh->create();

		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}

?>

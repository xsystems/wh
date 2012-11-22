<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/VideoGalleryElement.php");

class VideoGalleryView
{
    private static $rootElementClass = "contentarea";
    private static $galleryDir = "../../../media/videos/";
    private static $action = "gallery";
    private static $type = "video";
    private static $videosPerPage = -1;  
    private static $screenshortSecond = 5;
    private static $videoDirURL = null;
    private static $videoDirPath = null;
    
	public static function write($gallery)
	{
		$wh = new DeWindhappersTemplate();		
		
		if ( isset($gallery) && !empty($gallery) && $gallery != "")
		{
		    self::$videoDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST."/media/videos/".$gallery."/";
			self::$videoDirPath = self::$galleryDir.$gallery."/";
		}		

        $wh->add( new VideoGalleryElement(self::$rootElementClass, self::$galleryDir, self::$action, self::$type, self::$videosPerPage, self::$screenshortSecond, self::$videoDirURL, self::$videoDirPath) );

		$domDocument = $wh->create();

		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}

?>

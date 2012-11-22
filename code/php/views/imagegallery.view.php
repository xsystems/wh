<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/ImageGalleryElement.php");

class ImageGalleryView
{
    private static $rootElementClass = "contentarea";
    private static $galleryDir = "../../../media/images/";
    private static $action = "gallery";
    private static $type = "image";
    private static $imagesPerPage = -1;  
    private static $imageDirURL = null;
    private static $imageDirPath = null;

	public static function write($gallery)
	{
		$wh = new DeWindhappersTemplate();

		if ( isset($gallery) && !empty($gallery) && $gallery != "")
		{
    	    self::$imageDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST."/media/images/".$gallery."/"; 
	        self::$imageDirPath = self::$galleryDir.$gallery."/";		    
		}	

		$wh->add( new ImageGalleryElement(self::$rootElementClass, self::$galleryDir, self::$action, self::$type, self::$imagesPerPage, self::$imageDirURL, self::$imageDirPath) );
		
		$domDocument = $wh->create();

		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}
?>

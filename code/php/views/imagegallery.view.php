<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/ImageGalleryElement.php");

class ImageGalleryView
{
    private static $rootElementClass = "";
    private static $galleryDir = "../../../media/images/";
    private static $action = "gallery";
    private static $type = "image";
    private static $imagesPerPage = -1; 
   
	public static function write($gallery)
	{
	    //Default gallery. 
        $imageDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST."/media/images/2012-06-21 kanopolo juni 2012/";
        $imageDirPath = self::$galleryDir."/2012-06-21 kanopolo juni 2012/";
        
		$wh = new DeWindhappersTemplate("Foto's");

		if ( isset($gallery) && !empty($gallery) && $gallery != "")
		{
    	    $imageDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST."/media/images/".$gallery."/"; 
	        $imageDirPath = self::$galleryDir.$gallery."/";		    
		}

		$wh->add( new ImageGalleryElement(self::$rootElementClass, self::$galleryDir, self::$action, self::$type, self::$imagesPerPage, $imageDirURL, $imageDirPath) );
		
		$domDocument = $wh->create();

		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}
?>

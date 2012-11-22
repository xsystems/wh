<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/ClubMagazineGalleryElement.php");

class ClubMagazineGalleryView
{
    private static $rootElementClass = "contentarea";
    private static $galleryDir = "../../../media/clubmagazine/";
    private static $action = "gallery";
    private static $type = "clubmagazine";
    private static $imagesPerPage = -1;  
    private static $imageDirURL = null;
    private static $imageDirPath = null;

	public static function write($gallery)
	{
		$wh = new DeWindhappersTemplate();

		if ( isset($gallery) && !empty($gallery) && $gallery != "")
		{
    	    self::$imageDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST."/media/clubmagazine/".$gallery."/"; 
	        self::$imageDirPath = self::$galleryDir.$gallery."/";		    
		}	

		$wh->add( new ClubMagazineGalleryElement(self::$rootElementClass, self::$galleryDir, self::$action, self::$type, self::$imagesPerPage, self::$imageDirURL, self::$imageDirPath) );
		
		$domDocument = $wh->create();

		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}
?>

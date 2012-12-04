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

	public static function write($gallery)
	{
	    $imageDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST."/media/clubmagazine/De Windhapper 2012/";
        $imageDirPath = self::$galleryDir."/De Windhapper 2012/";
	
		$wh = new DeWindhappersTemplate();

		if ( isset($gallery) && !empty($gallery) && $gallery != "")
		{
    	    $imageDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST."/media/clubmagazine/".$gallery."/"; 
	        $imageDirPath = self::$galleryDir.$gallery."/";		    
		}	

		$wh->add( new ClubMagazineGalleryElement(self::$rootElementClass, self::$galleryDir, self::$action, self::$type, self::$imagesPerPage, $imageDirURL, $imageDirPath) );
		
		$domDocument = $wh->create();

		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}
?>

<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/VideoGalleryElement.php");
require_once("elements/GallerySelectElement.php");

class VideoGalleryView
{
	public static function write($gallery)
	{
		$wh = new DeWindhappersTemplate();
		$wh->init();
		
		$wh->add( new GallerySelectElement("nav contentarea", "../../../media/videos/", "video") );
		
		if ( isset($gallery) && !empty($gallery) )
		{
		    $videoDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST."/media/videos/".$gallery."/";
			$wh->add( new VideoGalleryElement("contentarea", -1, 5, $videoDirURL, "../../../media/videos/".$gallery."/") );
		}		

		$domDocument = $wh->create();

		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}

?>

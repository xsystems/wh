<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/ImageGalleryElement.php");
require_once("elements/GallerySelectElement.php");

class ImageGalleryView
{
	public static function write($gallery)
	{
		$wh = new DeWindhappersTemplate();
		$wh->init();
		
		$wh->add( new GallerySelectElement("nav contentarea", "../../../media/images/", "image") );

		if ( isset($gallery) && !empty($gallery) )
		{
			$wh->add( new ImageGalleryElement("contentarea", -1, "../../../media/images/".$gallery."/") );
		}
		
		$domDocument = $wh->create();

		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}
?>

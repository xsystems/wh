<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/HomeElement.php");

//if(!userController::hasAcces($_SESSION['pid'])){		
//	stdhttpheaders::showForbidden();		
//}

class HomeView
{
	public static function write()
	{	
		$wh = new DeWindhappersTemplate();
		$wh->init();
		//$wh->add( new HomeElement("contentarea") );
		
		// TEMP
		$wh->add( new GallerySelectElement("nav contentarea", "../../../media/images/", "image") );
#		if ( isset($gallery) && !empty($gallery) )
#		{
#    		$imageDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST."/media/images/".$gallery."/";
#			$wh->add( new ImageGalleryElement("contentarea", -1, $imageDirURL, "../../../media/images/".$gallery."/") );
#		}
		
		$wh->add( new GallerySelectElement("nav contentarea", "../../../media/videos/", "video") );
#	    if ( isset($gallery) && !empty($gallery) )
#		{
#		    $videoDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST."/media/videos/".$gallery."/";
#			$wh->add( new VideoGalleryElement("contentarea", -1, 5, $videoDirURL, "../../../media/videos/".$gallery."/") );
#		}		

		$wh->add( new CalendarElement("contentarea") );
		
		$wh->add( new VertelElement("contentarea") );						
		// TEMP
		
		$domDocument = $wh->create();

		echo $domDocument->saveXML();
	}
}			
?>

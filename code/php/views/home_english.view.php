<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/HomeEnglishElement.php");

//if(!userController::hasAcces($_SESSION['pid'])){		
//	stdhttpheaders::showForbidden();		
//}

class HomeEnglishView
{
	public static function write()
	{	
		$wh = new DeWindhappersTemplate("Home English");
		$wh->add( new HomeEnglishElement("") );
		
		$domDocument = $wh->create();

		echo $domDocument->saveXML();
	}
}			
?>

<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/HomeGermanElement.php");

//if(!userController::hasAcces($_SESSION['pid'])){		
//	stdhttpheaders::showForbidden();		
//}

class HomeGermanView
{
	public static function write()
	{	
		$wh = new DeWindhappersTemplate("Home Deutsch");
		$wh->add( new HomeGermanElement("") );
		
		$domDocument = $wh->create();

		echo $domDocument->saveXML();
	}
}			
?>

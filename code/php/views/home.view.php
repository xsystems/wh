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
		$wh->add( new HomeElement("contentarea") );
		
#		// <TEMP>
#		$wh->add( new CalendarElement("contentarea") );		
#		$wh->add( new VertelElement("contentarea") );						
#		// </TEMP>
		
		$domDocument = $wh->create();

		echo $domDocument->saveXML();
	}
}			
?>

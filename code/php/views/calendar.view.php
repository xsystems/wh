<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/CalendarElement.php");

class CalendarView
{
	public static function write()
	{	
		$wh = new DeWindhappersTemplate();
		$wh->init();
		$wh->add( new CalendarElement("contentarea") );
		$domDocument = $wh->create();
		
		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();			
	}
}			
?>

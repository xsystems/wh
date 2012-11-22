<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/LocationElement.php");

class LocationView
{
	public static function write()
	{	
		$wh = new DeWindhappersTemplate();
		$wh->add( new LocationElement("contentarea") );
		$domDocument = $wh->create();
		
		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}			
?>

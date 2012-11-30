<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/MeteorologyElement.php");

class MeteorologyView
{
	public static function write()
	{	
		$wh = new DeWindhappersTemplate();
		$wh->add( new MeteorologyElement("contentarea") );
		$domDocument = $wh->create();
		
		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();			
	}
}			
?>

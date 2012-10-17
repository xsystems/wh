<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/BoodschapElement.php");

class BoodschapView
{
	public static function write()
	{	
		$wh = new DeWindhappersTemplate();
		$wh->init();
		$wh->add( new BoodschapElement("contentarea") );
		$domDocument = $wh->create();
		
		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}			
?>

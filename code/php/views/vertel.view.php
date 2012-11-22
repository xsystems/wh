<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/VertelElement.php");

class VertelView
{
	public static function write()
	{	
		$wh = new DeWindhappersTemplate();
		$wh->add( new VertelElement("contentarea") );
		$domDocument = $wh->create();
		
		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}			
?>

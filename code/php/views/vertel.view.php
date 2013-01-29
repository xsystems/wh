<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/VertelElement.php");

class VertelView
{
	public static function write()
	{	
		$wh = new DeWindhappersTemplate("Berichten");
		$wh->add( new VertelElement("") );
		$domDocument = $wh->create();
		
		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}			
?>

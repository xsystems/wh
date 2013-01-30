<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/VertelElement.php");

class VertelView
{
	public static function write()
	{	
    	$filename = "../../../db/vertel.txt";
	
		$wh = new DeWindhappersTemplate("Berichten");
		$wh->add( new VertelElement("", $filename) );
		$domDocument = $wh->create();
		
		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}			
?>

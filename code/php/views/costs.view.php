<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/CostsElement.php");

class CostsView
{
	public static function write()
	{	
		$wh = new DeWindhappersTemplate();
		$wh->init();
		$wh->add( new CostsElement("contentarea") );
		$domDocument = $wh->create();
		
		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}			
?>

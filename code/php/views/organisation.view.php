<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/OrganisationElement.php");

class OrganisationView
{
	public static function write()
	{	
		$wh = new DeWindhappersTemplate("Organisatie");
		$wh->add( new OrganisationElement("contentarea") );
		$domDocument = $wh->create();
		
		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}			
?>

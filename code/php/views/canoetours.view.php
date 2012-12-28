<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/CanoetoursElement.php");

class CanoetoursView
{
	public static function write()
	{	
		$wh = new DeWindhappersTemplate("Kanoroutes");
		$wh->add( new CanoetoursElement("") );
		
		$domDocument = $wh->create();

		echo $domDocument->saveXML();
	}
}			
?>

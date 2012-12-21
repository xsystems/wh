<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/ObjectShowElement.php");

class ObjectShowView
{
    private static $rootElementClass = "";

	public static function write($url, $type, $title)
	{
		$wh = new DeWindhappersTemplate();
		$wh->add( new ObjectShowElement(self::$rootElementClass, $url, $type, $title) );
		
		$domDocument = $wh->create();
		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}
?>

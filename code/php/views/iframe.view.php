<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/IFrameViewElement.php");

class IFrameView
{
    private static $rootElementClass = "contentarea";

	public static function write($url)
	{
		$wh = new DeWindhappersTemplate();
		$wh->add( new IFrameViewElement(self::$rootElementClass, $url) );
		
		$domDocument = $wh->create();
		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		echo $domDocument->saveXML();
	}
}
?>

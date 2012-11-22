<?php

require_once("elements/XHTML5Template.php");
require_once("elements/DeWindhappersTemplate.php");
require_once("elements/HomeElement.php");

//$xhtml = new XHTML5Template("Title", "/wh/images/dewindhapperslogo.ico", "/wh/style/style.css");
//$domDocument = $xhtml->create();

$wh = new DeWindhappersTemplate();
$wh->add(new HomeElement("contentarea"));
$domDocument = $wh->create();

echo $domDocument->saveXML();

/*
echo "<br>";
echo $domDocument->lookupNamespaceURI( null );
*/

/*
echo "<br>";
if ($domDocument->schemaValidate(XHTML5Template::schemaURI))
{
	echo "This document is valid!\n";
}
else
{
	echo "This document is NOT valid!\n";
}
*/

?>

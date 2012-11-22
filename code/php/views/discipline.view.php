<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/DisciplineElement.php");

class DisciplineView
{
	public static function write($name)
	{
		$wh = new DeWindhappersTemplate();
		$wh->add(new DisciplineElement("contentarea", $name));
		$domDocument = $wh->create();

		//$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);

		/*
		$disciplineImport = new DisciplineElement("contentarea", $name);
		$discipline = $domDocument->importNode($disciplineImport->createTemplateElement(), true);
		$domDocument->validate();
		$domDocument->getElementById("main")->insertBefore($discipline, $domDocument->getElementById("footer"));
		*/

		echo $domDocument->saveXML();
	}
}
?>

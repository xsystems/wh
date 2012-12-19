<?php

require_once("elements/DeWindhappersTemplate.php");
require_once("elements/DisciplineElement.php");

class DisciplineView
{
	public static function write($name)
	{
	    $bannerImageURL;
	    switch ($name)
	    {
	        case 'zee varen': 
	            $bannerImageURL = "/content/banners/banner_seafarers_1.jpg";
	            break;
	        case 'kanopolo': 
	            $bannerImageURL = "/content/banners/banner_canoepolo.jpg";
	            break;
	        case 'toervaren': 
	            $bannerImageURL = "/content/banners/banner_cruising.jpg";
	            break;	       
	        case 'wildwatervaren': 
	            $bannerImageURL = "/content/banners/banner_whitewaterrafting.jpg";
	            break;	 	             
	        case 'freestyle': 
	            $bannerImageURL = "/content/banners/banner_freestyle.jpg";
	            break;		                
            default:
                $bannerImageURL = null;
                break;
	    }
	
	
		$wh = new DeWindhappersTemplate($bannerImageURL);
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

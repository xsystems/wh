<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");
require_once("../models/discipline.model.php");
require_once("../configuration/configuration.php");

class DisciplineElement implements ITemplateElement, ITemplateAttributes
{
	private $rootElementClass;
	private $name;
	
	public function __construct($rootElementClass, $name) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->name = $name;
	}

	public function createTemplateElement()
	{
		$discipline = Discipline::getByName($this->name);
		
		$search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
		$replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
		$description = str_replace($search, $replace, nl2br($discipline->description));
		$image_folder_location = $discipline->image_folder_location;
	
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$disciplineElement = $domDocument->createElementNS(self::namespaceURI, "div");		
		$content = $domDocument->createElementNS(self::namespaceURI, "div");		
		$h1 = $domDocument->createElementNS(self::namespaceURI, "h1");
		$p = $domDocument->createElementNS(self::namespaceURI, "p");
		
		$disciplineElement->setAttribute("class", $this->rootElementClass);
		$content->setAttribute("class", "content");		

		$descriptionFragment = $domDocument->createDocumentFragment();
		$descriptionFragment->appendXML("<span class='namespace_container' xmlns='http://www.w3.org/1999/xhtml'>$description</span>");
			
		$h1->appendChild($domDocument->createTextNode($discipline->name));
		$p->appendChild($descriptionFragment);
		$content->appendChild($h1);
		$content->appendChild($p);
		
		if($image_folder_location)
		{
			$images = scandir(Configuration::$ROOT.$image_folder_location);
		
			foreach ($images as $image)
			{
				if (!is_dir($image))
				{
					
					$imageDiv = $domDocument->createElementNS(self::namespaceURI, "div");
					$a = $domDocument->createElementNS(self::namespaceURI, "a");
					$img = $domDocument->createElementNS(self::namespaceURI, "img");
					
					$imageDiv->setAttribute("class", "img");
					$a->setAttribute("href", Configuration::$ROOT_FOLDER.$image_folder_location.$image);
					$img->setAttribute("src", Configuration::$ROOT_FOLDER.$image_folder_location.$image);
					$img->setAttribute("alt", $image);
					
					$imageDiv->appendChild($a);
					$a->appendChild($img);
					$content->appendChild($imageDiv);
				}
			}
		}
			
		$disciplineElement->appendChild($content);	
		
		return $disciplineElement;
	}
}
?>

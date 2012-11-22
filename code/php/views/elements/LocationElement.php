<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class LocationElement implements ITemplateElement, ITemplateAttributes
{	
    private $domElement;

	private $rootElementClass;

	public function __construct($rootElementClass) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->init();
	}
	
    public function init()
	{
        $domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$this->domElement = $domDocument->createElementNS(self::namespaceURI, "div");		
		$content = $domDocument->createElementNS(self::namespaceURI, "div");		
		$h1 = $domDocument->createElementNS(self::namespaceURI, "h1");
		$p = $domDocument->createElementNS(self::namespaceURI, "p");
		$h2 = $domDocument->createElementNS(self::namespaceURI, "h2");
		$map = $domDocument->createElementNS(self::namespaceURI, "div");
		$script = $domDocument->createElementNS(self::namespaceURI, "script");
		$addressFragment = $domDocument->createDocumentFragment();
		$title1 = $domDocument->createTextNode("Locatie");
		$p_text = $domDocument->createTextNode("De Windhappers is een Haagse kanovereniging die zich bevindt achter de bekende Haagse Kunstijsbaan \"De Uithof\". Ons botenhuis met stalling en kantine is herkenbaar aan ons logo. Het water waar het botenhuis aan ligt heet De Wennetjessloot.");
		$title2 = $domDocument->createTextNode("Adres");
		$script_text = $domDocument->createTextNode(" ");
		$address = nl2br("Nieuweweg 75 \n 2544NG Den Haag");
		
		$this->domElement->setAttribute("class", $this->rootElementClass);
		$content->setAttribute("class", "content");
		$map->setAttribute("id", "map_canvas");
		$map->setIdAttribute("id", true);
		$script->setAttribute("type", "text/javascript");
		$script->setAttribute("src", "/code/js/setup_map.js");
		
		$addressFragment->appendXML("<p class='namespace_container' xmlns='http://www.w3.org/1999/xhtml'>$address</p>");
		$h1->appendChild($title1);
		$p->appendChild($p_text);
		$h2->appendChild($title2);
		$script->appendChild($script_text);
		$content->appendChild($h1);
		$content->appendChild($p);
		$content->appendChild($h2);
		$content->appendChild($addressFragment);
		$this->domElement->appendChild($content);
		$this->domElement->appendChild($map);
		$this->domElement->appendChild($script);
	}
	
    public function add( $iTemplateElement )
    {
        // Stub
    }

	public function create()
	{
		return $this->domElement;
	}
}
?>

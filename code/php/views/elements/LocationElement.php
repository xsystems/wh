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
		$article = $domDocument->createElementNS(self::namespaceURI, "article");	
		$h1 = $domDocument->createElementNS(self::namespaceURI, "h1");
		$p = $domDocument->createElementNS(self::namespaceURI, "p");
		$h2 = $domDocument->createElementNS(self::namespaceURI, "h2");
		$p_route = $domDocument->createElementNS(self::namespaceURI, "p");
		$img_route = $domDocument->createElementNS(self::namespaceURI, "img");
		$strong = $domDocument->createElementNS(self::namespaceURI, "strong");		
		$map = $domDocument->createElementNS(self::namespaceURI, "div");
        $address = $domDocument->createElementNS(self::namespaceURI, "address");		
		$script = $domDocument->createElementNS(self::namespaceURI, "script");
		$title1 = $domDocument->createTextNode("");
		$p_text = $domDocument->createTextNode("De Windhappers is een Haagse kanovereniging die zich bevindt achter de bekende Haagse Kunstijsbaan \"De Uithof\". Ons botenhuis met stalling en kantine is herkenbaar aan ons logo. Het water waar het botenhuis aan ligt heet De Wennetjessloot.");
		$title2 = $domDocument->createTextNode("Adres");
		$route_text = $domDocument->createTextNode("Houd rekening met de volgende aanrijroute: Vanaf de Lozerlaan neem de afslag Uithof en Jaap Edenweg, deze weg afrijden tot het achterste deel van de parkeerplaats. Loop vanaf hier naar het verenigingsgebouw. Zie ook afbeelding hiernaast!");
		$address_text = $domDocument->createTextNode("Nieuweweg 75, 2544NG Den Haag");;
		$script_text = $domDocument->createTextNode(" ");
		
		$this->domElement->setAttribute("class", $this->rootElementClass);
		$content->setAttribute("class", "content location_content");
		$img_route->setAttribute("src", "/content/route_windhappers.jpg");
		$img_route->setAttribute("alt", "Aanrijroute");		
		$img_route->setAttribute("id", "route");		
		$img_route->setIdAttribute("id", true);
		$map->setAttribute("id", "map_canvas");
		$map->setIdAttribute("id", true);
		$script->setAttribute("type", "text/javascript");
		$script->setAttribute("src", "/code/js/setup_map.js");
		
		$h1->appendChild($title1);
		$p->appendChild($p_text);
		$h2->appendChild($title2);
		$address->appendChild($address_text);
		$strong->appendChild($route_text);
		$script->appendChild($script_text);
		$p_route->appendChild($strong);		
		$article->appendChild($h1);
		$article->appendChild($p);
		$article->appendChild($h2);
		$article->appendChild($address);
		$article->appendChild($p_route);
		$content->appendChild($article);
		$content->appendChild($img_route);
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

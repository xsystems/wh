<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");
require_once('../configuration/framework.php');

class BannerElement implements ITemplateElement, ITemplateAttributes
{	
	private $rootElementClass;
	private $bannerImageURL;
	private $bannerText = "Kanovereniging De Windhappers";
	private $bannerTextAlt = "De Windhappers";
	
	public function __construct($rootElementClass) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->bannerImageURL = Configuration::$ROOT_FOLDER."content/dewindhapperslogo.gif";
	}

	public function createTemplateElement()
	{
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$bannerElement = $domDocument->createElementNS(self::namespaceURI, "div");
		$img = $domDocument->createElementNS(self::namespaceURI, "img");
		$p = $domDocument->createElementNS(self::namespaceURI, "p");
		
		$bannerElement->setAttribute("id", "banner");
		$bannerElement->setIdAttribute("id", true);
		$bannerElement->setAttribute("class", $this->rootElementClass);		
		$img->setAttribute("src", $this->bannerImageURL);
		$img->setAttribute("alt", $this->bannerTextAlt);
		
		$p->appendChild($domDocument->createTextNode($this->bannerText));		
		$bannerElement->appendChild($img);
		$bannerElement->appendChild($p);
		
		return $bannerElement;
	}
}
?>

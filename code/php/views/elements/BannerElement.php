<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");
require_once('../configuration/framework.php');

class BannerElement implements ITemplateElement, ITemplateAttributes
{	
    private $domElement;

	private $rootElementClass;
	private $bannerImageURL;
	private $bannerText = "Kanovereniging De Windhappers";
	private $bannerTextAlt = "De Windhappers";
	
	public function __construct($rootElementClass) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->bannerImageURL = "/content/dewindhapperslogo.gif";
		$this->init();
	}
	
	public function init()
	{
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$this->domElement = $domDocument->createElementNS(self::namespaceURI, "div");
		$img = $domDocument->createElementNS(self::namespaceURI, "img");
		$p = $domDocument->createElementNS(self::namespaceURI, "p");
		
		$this->domElement->setAttribute("id", "banner");
		$this->domElement->setIdAttribute("id", true);
		$this->domElement->setAttribute("class", $this->rootElementClass);		
		$img->setAttribute("src", $this->bannerImageURL);
		$img->setAttribute("alt", $this->bannerTextAlt);
		
		$p->appendChild($domDocument->createTextNode($this->bannerText));		
		$this->domElement->appendChild($img);
		$this->domElement->appendChild($p);
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

<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");
require_once('../configuration/framework.php');

class BannerElement implements ITemplateElement, ITemplateAttributes
{	
    private $domElement;

	private $rootElementClass;
	private $bannerLogoURL;
	private $bannerImageURL;
	private $mediaLogos;
	private $bannerText = "Kanovereniging De Windhappers";
	private $bannerTextAlt = "De Windhappers";
	
	public function __construct($rootElementClass, $bannerLogoURL=null, $bannerImageURL=null, $mediaLogos=null) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->bannerLogoURL = $bannerLogoURL;		
		$this->bannerImageURL = $bannerImageURL;
		$this->mediaLogos = $mediaLogos;
		$this->init();
	}
	
	public function init()
	{
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$this->domElement = $domDocument->createElementNS(self::namespaceURI, "div");
		$p = $domDocument->createElementNS(self::namespaceURI, "p");
		
		$this->domElement->setAttribute("id", "banner");
		$this->domElement->setIdAttribute("id", true);
		$this->domElement->setAttribute("class", $this->rootElementClass);	
		
		if ( $this->bannerLogoURL != null )
		{
	  		$img = $domDocument->createElementNS(self::namespaceURI, "img");
			$img->setAttribute("src", $this->bannerLogoURL);
		    $img->setAttribute("alt", $this->bannerTextAlt);
    		$this->domElement->appendChild($img);
		}
		
		if ( $this->bannerImageURL !=  null )
		{
		    $this->domElement->setAttribute("style", "background-image:url(".$this->bannerImageURL.");  background-repeat:no-repeat; background-size:cover;");
		}
		
		$p->appendChild($domDocument->createTextNode($this->bannerText));
		$this->domElement->appendChild($p);		
		
		if ( $this->mediaLogos != null)
		{
			$mediaLogos = $domDocument->createElementNS(self::namespaceURI, "div");
		    $mediaLogos->setAttribute("class", "media_logos");
		    foreach ($this->mediaLogos as $mediaLogo)
		    {
                $a = $domDocument->createElementNS(self::namespaceURI, "a");
                $img = $domDocument->createElementNS(self::namespaceURI, "img");

                $a->setAttribute("href", $mediaLogo["url"]);
                $img->setAttribute("src", $mediaLogo["logo"]);

                $a->appendChild($img);
                $mediaLogos->appendChild($a);
		    }
		    $this->domElement->appendChild($mediaLogos);
		}
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

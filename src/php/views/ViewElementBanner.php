<?php	

require_once("IViewElement.php");

class ViewElementBanner implements IViewElement
{	
    private $domElement;

	private $rootElementClass;
	private $bannerLogoURL;
	private $bannerImageURL;
	private $mediaBarItems;
	private $bannerText;
	
	public function __construct($rootElementClass, $bannerLogoURL=null, $bannerImageURL=null, $mediaBarItems=null, $bannerText=null) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->bannerLogoURL = $bannerLogoURL;		
		$this->bannerImageURL = $bannerImageURL;
		$this->mediaBarItems = $mediaBarItems;
		$this->bannerText = $bannerText;
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
    		$a = $domDocument->createElementNS(self::namespaceURI, "a");
    		$a->setAttribute("class", "banner_logo");
    		$a->setAttribute("href", "/");
    		
	  		$img = $domDocument->createElementNS(self::namespaceURI, "img");
			$img->setAttribute("src", $this->bannerLogoURL);
		    $img->setAttribute("alt", $this->bannerText);
   		    $img->setAttribute("title", "Home");
   		    $a->appendChild($img);
    		$this->domElement->appendChild($a);
		}
		
		if ( $this->bannerImageURL !=  null )
		{
		    $this->domElement->setAttribute("style", "background-image:url(".$this->bannerImageURL.");  background-repeat:no-repeat; background-size:cover;");
		}
		
		$p->appendChild($domDocument->createTextNode($this->bannerText));
		$this->domElement->appendChild($p);		
		
		if ( $this->mediaBarItems != null)
		{
			$mediaBarItems = $domDocument->createElementNS(self::namespaceURI, "div");
		    $mediaBarItems->setAttribute("class", "media_items");
		    foreach ($this->mediaBarItems as $mediaLogo)
		    {
                $a = $domDocument->createElementNS(self::namespaceURI, "a");
                $img = $domDocument->createElementNS(self::namespaceURI, "img");

                $a->setAttribute("href", $mediaLogo["url"]);
                $a->setAttribute("class", $mediaLogo["class"]);
                $img->setAttribute("src", $mediaLogo["logo"]);
                $img->setAttribute("alt", $mediaLogo["title"]);               
                $img->setAttribute("title", $mediaLogo["title"]);

                $a->appendChild($img);
                $mediaBarItems->appendChild($a);
		    }
		    $this->domElement->appendChild($mediaBarItems);
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

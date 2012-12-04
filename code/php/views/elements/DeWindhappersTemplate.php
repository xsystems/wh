<?php

require_once("XHTML5Template.php");
require_once("BannerElement.php");
require_once("FooterElement.php");
require_once("MenuElement.php");

class DeWindhappersTemplate extends XHTML5Template
{
	private $title = "De Windhappers";
	private $iconURL = "/content/dewindhapperslogo.ico";
	private $stylesheetURLs = array("/style/style.css");
	private $scriptURLs = array("/code/js/inheritance.js", "/code/js/load.js", "/code/js/setup.js");
	private $bannerLogoURL = "/content/dewindhapperslogo.gif";
	private $bannerImageURL = "/content/banner.jpg";
	private $mediaLogos = array(    array("logo"=>"/content/f_logo.png", "url"=>"http://www.facebook.com/pages/Kanovereniging-De-Windhappers/546877148674699"),
                                    array("logo"=>"/content/twitter-bird-dark-bgs.png", "url"=>"https://twitter.com/DeWindhappers") );
    private $openGraphTags = array( array("name"=>"og:title", "value"=>"Kanovereniging De Windhappers"),
                                    array("name"=>"og:type", "value"=>"sport"),
                                    array("name"=>"og:url", "value"=>"http://wh.xsystems.org"),
                                    array("name"=>"og:image", "value"=>"http://wh.xsystems.org/content/dewindhapperslogo.gif"),
                                    array("name"=>"og:site_name", "value"=>"De Windhappers"),
                                    array("name"=>"fb:admins", "value"=>"100004774592111")
                                    array("name"=>"og:description", "value"=>"A canoe club."));
                                    

	public function __construct($bannerImageURL=null)
	{
	    if ($bannerImageURL != null)
	    {
	        $this->bannerImageURL = $bannerImageURL;
	    }
		parent::__construct($this->title, $this->iconURL, $this->stylesheetURLs, $this->scriptURLs);
	}
	
	public function init()
	{		
	    parent::init();
	    
	    foreach ($this->openGraphTags as $tag)
	    {
	        $domDocument = new DOMDocument("1.0", "utf-8");
		    $domDocument->validateOnParse = self::validateOnParse;
		
		    $meta = $domDocument->createElementNS(self::namespaceURI, "meta");
		    
		    $meta->setAttribute("content", $tag["value"]);		    
		    $meta->setAttribute("property", $tag["name"]);
		    
		    $this->add($meta, "head");
	    }
	    
		$this->add( new BannerElement("", $this->bannerLogoURL, $this->bannerImageURL, $this->mediaLogos) );
		$this->add( new MenuElement("nav") );
	}
	
	public function add( $newElement, $targetElement = "main" )
	{
		parent::add( $newElement, $targetElement);
	}

	public function create()
	{
		$this->add( new FooterElement("") );

		return parent::create();
	}
}

?>

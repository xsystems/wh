<?php

require_once("XHTML5Template.php");
require_once("BannerElement.php");
require_once("FooterElement.php");
require_once("MenuElement.php");

class DeWindhappersTemplate extends XHTML5Template
{
	private $title = "De Windhappers";
	private $iconURL = "/content/logos/dewindhapperslogo.ico";
	private $stylesheetURLs = array("/style/style.css");
	private $scriptURLs = array("/code/js/inheritance.js", "/code/js/load.js", "/code/js/setup.js");
    private $bannerText = "De Windhappers";	
	private $bannerLogoURL = "/content/logos/dewindhapperslogo.png";
	private $bannerImageURL = "/content/banners/banner_default.jpg";
	private $mediaBarItems = array( array("logo"=>"/content/logos/f_logo.png", "url"=>"http://www.facebook.com/pages/Kanovereniging-De-Windhappers/546877148674699", "title"=>"Facebook", "class"=>"media_item_social"),
                                    array("logo"=>"/content/logos/twitter-bird-dark-bgs.png", "url"=>"https://twitter.com/DeWindhappers", "title"=>"Twitter", "class"=>"media_item_social"),
                                    array("logo"=>"/content/icons/flags/flag-nl.png", "url"=>"../controllers/view.controller.php?action=home", "title"=>"Nederlands", "class"=>"media_item_language"),                                    
                                    array("logo"=>"/content/icons/flags/flag-gb.png", "url"=>"../controllers/view.controller.php?action=home_english", "title"=>"English", "class"=>"media_item_language"),
                                    array("logo"=>"/content/icons/flags/flag-de.png", "url"=>"../controllers/view.controller.php?action=home_german", "title"=>"Deutsch", "class"=>"media_item_language") );
    private $openGraphTags = array( array("name"=>"og:title", "value"=>"Kanovereniging De Windhappers"),
                                    array("name"=>"og:type", "value"=>"sport"),
                                    array("name"=>"og:url", "value"=>"http://wh.xsystems.org/code/php/controllers/view.controller.php?action=home"),
                                    array("name"=>"og:image", "value"=>"http://wh.xsystems.org/content/dewindhapperslogo.gif"),
                                    array("name"=>"og:site_name", "value"=>"De Windhappers"),
                                    array("name"=>"fb:admins", "value"=>"100004774592111"),
                                    array("name"=>"og:description", "value"=>"A canoe club."));
                                    

	public function __construct($bannerText=null, $bannerImageURL=null)
	{
	    if ($bannerText != null)
	    {
            $this->bannerText = $bannerText;
	    }
	
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
	    
		$this->add( new BannerElement("", $this->bannerLogoURL, $this->bannerImageURL, $this->mediaBarItems, $this->bannerText) );
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

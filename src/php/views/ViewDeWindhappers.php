<?php

require_once("ViewXHTML5.php");
require_once("ViewElementBanner.php");
require_once("ViewElementFooter.php");
require_once("ViewElementMenu.php");
require_once("lib/php/MobileDetect.php");

class ViewDeWindhappers extends ViewXHTML5
{
	private $title = "De Windhappers";
	private $iconURL = "/content/logos/dewindhapperslogo.ico";
	private $stylesheetMobile = "/style/mobile.css";
	private $stylesheetNotMobile = "/style/not_mobile.css";
	private $stylesheetURLs = array("/style/style.css");
	private $scriptURLs = array("/src/js/load.js");
    private $bannerText = "De Windhappers";	
	private $bannerLogoURL = "/content/logos/dewindhapperslogo.png";
	private $bannerImageURL = "/content/banners/banner_default.jpg";
	private $mediaBarItems = array( array("logo"=>"/content/logos/f_logo.png", "url"=>"http://www.facebook.com/pages/Kanovereniging-De-Windhappers/546877148674699", "title"=>"Facebook", "class"=>"media_item_social"),
                                    array("logo"=>"/content/logos/twitter-bird-dark-bgs.png", "url"=>"https://twitter.com/DeWindhappers", "title"=>"Twitter", "class"=>"media_item_social"),
                                    array("logo"=>"/content/icons/flags/flag-nl.png", "url"=>"", "title"=>"Nederlands", "class"=>"media_item_language"),                                    
                                    array("logo"=>"/content/icons/flags/flag-gb.png", "url"=>"?action=home_english", "title"=>"English", "class"=>"media_item_language"),
                                    array("logo"=>"/content/icons/flags/flag-de.png", "url"=>"?action=home_german", "title"=>"Deutsch", "class"=>"media_item_language") );
    private $openGraphTags = array( array("name"=>"og:title", "value"=>"Kanovereniging De Windhappers"),
                                    array("name"=>"og:type", "value"=>"sport"),
                                    array("name"=>"og:url", "value"=>"http://wh.xsystems.org?action=home"),
                                    array("name"=>"og:image", "value"=>"http://wh.xsystems.org/content/dewindhapperslogo.gif"),
                                    array("name"=>"og:site_name", "value"=>"De Windhappers"),
                                    array("name"=>"fb:admins", "value"=>"100004774592111"),
                                    array("name"=>"og:description", "value"=>"A canoe club."));
                                    

	public function __construct()
	{	    
	    $detect = new MobileDetect();
	    if ($detect->isMobile()) 
	    {
            $this->stylesheetURLs[] = $this->stylesheetMobile;
        }
        else
        {
            $this->stylesheetURLs[] = $this->stylesheetNotMobile;            
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
	    
		$this->add( new ViewElementBanner("", $this->bannerLogoURL, $this->bannerImageURL, $this->mediaBarItems, $this->bannerText) );
		$this->add( new ViewElementMenu("nav") );
	}
	
	public function setBannerText($bannerText)
	{	
        $this->bannerText = $bannerText;	
	}
	
	public function setBannerImageUrl($bannerImageURL)
	{
        $this->bannerImageURL = $bannerImageURL;	    
	}
	
	public function add( $newElement, $targetElement = "main" )
	{
		parent::add( $newElement, $targetElement);
	}

	public function create()
	{
		$this->add( new ViewElementFooter("") );

		return parent::create();
	}
}

?>

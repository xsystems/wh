<?php

require_once("ITemplate.php");
require_once("ITemplateAttributes.php");
require_once("XHTML5Template.php");
require_once("BannerElement.php");
require_once("FooterElement.php");
require_once("MenuElement.php");

class DeWindhappersTemplate extends XHTML5Template implements ITemplate, ITemplateAttributes
{
	private $title = "De Windhappers";
	private $iconURL = "/content/dewindhapperslogo.ico";
	private $stylesheetURLs = array("/style/style.css");
	private $scriptURLs = array("/code/js/inheritance.js", "/code/js/load.js", "/code/js/setup.js");
	private $bannerLogoURL = "/content/dewindhapperslogo.gif";
	private $bannerImageURL = "/content/banner.jpg";

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
		$this->add( new BannerElement("", $this->bannerLogoURL, $this->bannerImageURL) );
		$this->add( new MenuElement("nav") );
	}
	
	public function add( $iTemplateElement )
	{
		parent::add( $iTemplateElement );
	}

	public function create()
	{
		$this->add( new FooterElement("") );

		return parent::create();
	}
}

?>

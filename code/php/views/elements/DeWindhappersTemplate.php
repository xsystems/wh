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
	private $stylesheetURL = "/style/style.css";
	private $scriptURL = "/code/js/load.js";

	public function __construct()
	{
		parent::__construct($this->title, $this->iconURL, $this->stylesheetURL, $this->scriptURL);
	}
	
	public function init()
	{
		parent::init();
		
		$this->add( new BannerElement("contentarea") );
		$this->add( new MenuElement("nav contentarea") );
	}
	
	public function add( $iTemplateElement )
	{
		parent::add( $iTemplateElement );
	}

	public function create()
	{
		$this->add( new FooterElement("contentarea") );

		return parent::create();
	}
}

?>

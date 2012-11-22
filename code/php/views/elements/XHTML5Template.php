<?php

require_once("ITemplate.php");
require_once("ITemplateAttributes.php");

class XHTML5Template implements ITemplate, ITemplateAttributes
{
  	private $domDocument;
  	
	private $title;
	private $iconURL;
	private $stylesheetURLs;
	private $scriptURLs;
	
	public function __construct($title = null, $iconURL = null, $stylesheetURLs = null, $scriptURLs = null)
	{
		$this->title = $title;
		$this->iconURL = $iconURL;
		$this->stylesheetURLs = $stylesheetURLs;
		$this->scriptURLs = $scriptURLs;
		$this->init();
	}
	
	public function init()
	{
		$domImplementation = new DOMImplementation();

		$docType = $domImplementation->createDocumentType(self::qualifiedName, self::publicId, self::systemId);
		
		$this->domDocument = $domImplementation->createDocument(self::namespaceURI, "", $docType);
		$this->domDocument->encoding = self::encoding;
		$this->domDocument->formatOutput = self::formatOutput;
		$this->domDocument->preserveWhiteSpace = self::preserveWhiteSpace;
		$this->domDocument->validateOnParse = self::validateOnParse;

        $dummy_text = $this->domDocument->createTextNode(" ");
		$htmlElement = $this->domDocument->createElementNS(self::namespaceURI, "html");
		$headElement = $this->domDocument->createElementNS(self::namespaceURI, "head");
		$titleElement = $this->domDocument->createElementNS(self::namespaceURI,"title");
		$iconLinkElement = $this->domDocument->createElementNS(self::namespaceURI,"link");
		$bodyElement = $this->domDocument->createElementNS(self::namespaceURI,"body");
		$mainElement = $this->domDocument->createElementNS(self::namespaceURI,"div");
		$title = $this->domDocument->createTextNode($this->title);

		$mainElement->setAttribute("id", "main");
		$mainElement->setIdAttribute("id", true);
		$iconLinkElement->setAttribute("rel", "shortcut icon");
		$iconLinkElement->setAttribute("href", $this->iconURL);

		$titleElement->appendChild($title);


		$headElement->appendChild($iconLinkElement);
		$headElement->appendChild($titleElement);
	    $bodyElement->appendChild($mainElement);
	    $htmlElement->appendChild($headElement);
		$htmlElement->appendChild($bodyElement);
		$this->domDocument->appendChild($htmlElement);
		
		foreach($this->stylesheetURLs as $stylesheetURL)
		{
	        $cssLinkElement = $this->domDocument->createElementNS(self::namespaceURI,"link");
		    $cssLinkElement->setAttribute("rel", "stylesheet");
		    $cssLinkElement->setAttribute("type", "text/css");
		    $cssLinkElement->setAttribute("href", $stylesheetURL);
		    $headElement->appendChild($cssLinkElement);
		}
		
		foreach($this->scriptURLs as $scriptURL)
		{
			$scriptElement = $this->domDocument->createElementNS(self::namespaceURI, "script");
		    $scriptElement->setAttribute("type", "text/javascript");
		    $scriptElement->setAttribute("src", $scriptURL);
        	$scriptElement->appendChild($dummy_text->cloneNode());
        	$headElement->appendChild($scriptElement);
		}
	}
	
	public function add( $iTemplateElement )
	{
		$template = $this->domDocument->importNode($iTemplateElement->create(), true);
		$this->domDocument->getElementById("main")->appendChild($template);
	}

	public function create()
	{
		return $this->domDocument;
	}
}

?>

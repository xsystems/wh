<?php

require_once("ITemplate.php");
require_once("ITemplateAttributes.php");

class XHTML5Template implements ITemplate, ITemplateAttributes
{
	private $title;
	private $iconURL;
	private $stylesheetURL;
	
	private $domDocument;
	
	public function __construct($title = null, $iconURL = null, $stylesheetURL = null) 
	{
		$this->title = $title;
		$this->iconURL = $iconURL;
		$this->stylesheetURL = $stylesheetURL;
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

		$htmlElement = $this->domDocument->createElementNS(self::namespaceURI, "html");
		$headElement = $this->domDocument->createElementNS(self::namespaceURI, "head");
		$titleElement = $this->domDocument->createElementNS(self::namespaceURI,"title");
		$cssLinkElement = $this->domDocument->createElementNS(self::namespaceURI,"link");
		$iconLinkElement = $this->domDocument->createElementNS(self::namespaceURI,"link");
		$bodyElement = $this->domDocument->createElementNS(self::namespaceURI,"body");
		$mainElement = $this->domDocument->createElementNS(self::namespaceURI,"div");
		$title = $this->domDocument->createTextNode($this->title);

		$mainElement->setAttribute("id", "main");
		$mainElement->setIdAttribute("id", true);
		$cssLinkElement->setAttribute("rel", "stylesheet");
		$cssLinkElement->setAttribute("type", "text/css");
		$cssLinkElement->setAttribute("href", $this->stylesheetURL);
		$iconLinkElement->setAttribute("rel", "shortcut icon");
		$iconLinkElement->setAttribute("href", $this->iconURL);

		$titleElement->appendChild($title);
		$this->domDocument->appendChild($htmlElement);
		$htmlElement->appendChild($headElement);
		$headElement->appendChild($cssLinkElement);
		$headElement->appendChild($iconLinkElement);
		$headElement->appendChild($titleElement);
		$htmlElement->appendChild($bodyElement);
		$bodyElement->appendChild($mainElement);
	}
	
	public function add( $iTemplateElement )
	{
		$templateElement = $this->domDocument->importNode($iTemplateElement->createTemplateElement(), true);
		$this->domDocument->getElementById("main")->appendChild($templateElement);
	}

	public function create()
	{
		return $this->domDocument;
	}
}

?>

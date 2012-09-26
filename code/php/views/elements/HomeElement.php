<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class HomeElement implements ITemplateElement, ITemplateAttributes
{
	private $rootElementClass;

	public function __construct($rootElementClass) 
	{
		$this->rootElementClass = $rootElementClass;
	}

	public function createTemplateElement()
	{
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$homeElement = $domDocument->createElementNS(self::namespaceURI, "div");			
		$homeElement->setAttribute("class", $this->rootElementClass);

		$domDocumentFragment = $domDocument->createDocumentFragment();
		$domDocumentFragment->appendXML( "<div class='content namespace_container' xmlns='http://www.w3.org/1999/xhtml'>text</div><div class='content namespace_container' xmlns='http://www.w3.org/1999/xhtml'>text</div>" );	
								
		$homeElement->appendChild($domDocumentFragment);			
		
		return $homeElement;
	}
}
?>

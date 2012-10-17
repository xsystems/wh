<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class VertelElement implements ITemplateElement, ITemplateAttributes
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
		
		$vertelElement = $domDocument->createElementNS(self::namespaceURI, "div");		
		$content = $domDocument->createElementNS(self::namespaceURI, "div");			
		$script = $domDocument->createElementNS(self::namespaceURI, "script");
		$dummy_text = $domDocument->createTextNode(" ");		
		
		$vertelElement->setAttribute("class", $this->rootElementClass);
		$content->setAttribute("class", "content");
		$content->setAttribute("id", "vertel");		
		$content->setIdAttribute("id", true);
		$script->setAttribute("type", "text/javascript");
		$script->setAttribute("src", "/code/js/setup_vertel.js");		

		$script->appendChild($dummy_text);
		$vertelElement->appendChild($content);
		$vertelElement->appendChild($script);
		
		return $vertelElement;
	}
}
?>

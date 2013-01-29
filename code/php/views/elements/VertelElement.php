<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class VertelElement implements ITemplateElement, ITemplateAttributes
{	
    private $domElement;

	private $rootElementClass;

	public function __construct($rootElementClass) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->init();
	}
	
	public function init()
	{
        $domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$this->domElement = $domDocument->createElementNS(self::namespaceURI, "div");		
		$content = $domDocument->createElementNS(self::namespaceURI, "article");			
		$script = $domDocument->createElementNS(self::namespaceURI, "script");
		$dummy_text = $domDocument->createTextNode(" ");		
		
		$this->domElement->setAttribute("class", $this->rootElementClass);
		$content->setAttribute("class", "");
		$content->setAttribute("id", "vertel");		
		$content->setIdAttribute("id", true);
		$script->setAttribute("type", "text/javascript");
		$script->setAttribute("src", "/code/js/setup_vertel.js");		

		$script->appendChild($dummy_text);
		$this->domElement->appendChild($content);
		$this->domElement->appendChild($script);
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

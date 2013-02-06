<?php	

require_once("IViewElement.php");

class ViewElementShowIFrame implements IViewElement
{	
    private $domElement;

	private $rootElementClass;
    private $url;

	public function __construct($rootElementClass, $url) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->url = $url;
		$this->init();
	}
	
	public function init()
	{
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$dummy_text = $domDocument->createTextNode(" ");
		$dummy_element = $domDocument->createElementNS(self::namespaceURI, "span");
		
		$this->domElement = $domDocument->createElementNS(self::namespaceURI, "iframe");		
		$this->domElement->setAttribute("class", $this->rootElementClass);
		$this->domElement->setAttribute("src", $this->url);
#		$this->domElement->setAttribute("seamless", "seamless");		
#		$this->domElement->setAttribute("sandbox", "");
		
		$dummy_element->appendChild($dummy_text);
		$this->domElement->appendChild($dummy_element);
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

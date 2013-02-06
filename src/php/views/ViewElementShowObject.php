<?php	

require_once("IViewElement.php");

class ViewElementShowObject implements IViewElement
{	
    private $domElement;

	private $rootElementClass;
    private $url;
    private $type;
    private $title;

	public function __construct($rootElementClass, $url, $type, $title) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->url = $url;
		$this->type = $type;
		$this->title = $title;
		$this->init();
	}
	
	public function init()
	{
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$this->domElement = $domDocument->createElementNS(self::namespaceURI, "object");		
		$this->domElement->setAttribute("class", $this->rootElementClass);
		$this->domElement->setAttribute("data", $this->url);
		$this->domElement->setAttribute("type", $this->type);
		$this->domElement->setAttribute("title", $this->title);
		$title_span = $domDocument->createElementNS(self::namespaceURI, "span");
		$title_text = $domDocument->createTextNode($this->title);
		
		$title_span->appendChild($title_text);
		$this->domElement->appendChild($title_span);
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

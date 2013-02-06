<?php

abstract class AViewElement implements IViewElement
{
    protected $domDocument;
    protected $domElement;
    
    protected function __construct($class="")
    {
        $this->domDocument = new DOMDocument("1.0", "utf-8");
		$this->domDocument->validateOnParse = self::validateOnParse;
		
		$this->domElement = $this->domDocument->createElementNS(self::namespaceURI, "div");			
		$this->domElement->setAttribute("class", $class);		
    }

	public abstract function init();
    public abstract function create();    	
	public abstract function add( $iViewElement );
	
	public function addScript($src, $type)
	{
	    $script = $this->domDocument->createElementNS(self::namespaceURI, "script");	
	    $script->setAttribute("src", $src);
	    $script->setAttribute("type", $type);	
       	$script->appendChild($this->domDocument->createTextNode(" "));	    
	    $this->domElement->appendChild($script);       	
	}

	public function addFragment($fragment)
	{
	    $domDocumentFragment = $this->domDocument->createDocumentFragment();
		$domDocumentFragment->appendXML($fragment);	
        $this->domElement->appendChild($domDocumentFragment);		
	}
}



?>

<?php

require_once("IView.php");

abstract class AView implements IView
{
    protected $domDocument;
    private $data = array();
    
    protected function __construct()
    {        
		$domImplementation = new DOMImplementation();
		$docType = $domImplementation->createDocumentType(self::qualifiedName, self::publicId, self::systemId);
		
		$this->domDocument = $domImplementation->createDocument(self::namespaceURI, self::qualifiedName, $docType);
		$this->domDocument->encoding = self::xmlEncoding;
		$this->domDocument->substituteEntities = true;
		$this->domDocument->formatOutput = self::formatOutput;
		$this->domDocument->preserveWhiteSpace = self::preserveWhiteSpace;
		$this->domDocument->validateOnParse = self::validateOnParse;
    }
    
    public function __set($name, $value) 
    {
        $this->data[$name] = $value;
    }

    public function __get($name) 
    {
        return $this->data[$name];
    }	    
	
	public function load($template)
	{
	    $templateContent = $this->get_include_contents($template);
	    
	    if($templateContent){
	        $this->domDocument->loadXML($templateContent);
	    }
	}
	
	public function add($id, $templateFrament)
	{
	    $templateFragmentContent = $this->get_include_contents($templateFrament);
	
	    if($templateFragmentContent){
	        $domDocumentFragment = $this->domDocument->createDocumentFragment();
		    $domDocumentFragment->appendXML($templateFragmentContent);		
	        $this->domDocument->getElementById($id)->appendChild($domDocumentFragment);  
	        $this->validate(); 
        }	        
	}	
	
	public function save()
	{
	    return $this->domDocument->saveXML();
	}
	
	public function validate($suppressErrors = true)
	{
	    $isValid = false;
	    
	    if($suppressErrors){
	        $previousState = libxml_use_internal_errors(true);
	        $isValid = $this->domDocument->validate();
	        libxml_use_internal_errors($previousState);	        
	    }
	    else{
	        $isValid = $this->domDocument->validate();
	    }
	
        return $isValid;
	}
    
    private function get_include_contents($filename) 
    {
        if (is_file($filename)){
            ob_start();
            include $filename;
            return ob_get_clean();
        }
        return false;
    }    
}

?>

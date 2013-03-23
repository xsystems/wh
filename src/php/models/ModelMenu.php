<?php

class Menu
{      
    private $pathXML;
    private $pathXSLT;    
    private $domDocumentXML;
    private $domDocumentXSLT;
    private $xpathProcessor;
    private $xsltProcessor;

    public function __construct($pathXML, $pathXSLT)
    {
        $this->pathXML = $pathXML; 
        $this->pathXSLT = $pathXSLT;         
              
        $domImplementation = new DOMImplementation();	
		$this->domDocumentXML = $domImplementation->createDocument();       
		$this->domDocumentXML->load($pathXML);
		$this->domDocumentXSLT = $domImplementation->createDocument();       
		$this->domDocumentXSLT->load($pathXSLT);	
		
		$this->xpathProcessor = new DOMXPath($this->domDocumentXML);	
		
		$this->xsltProcessor = new XSLTProcessor();
		$this->xsltProcessor->importStyleSheet($this->domDocumentXSLT);
		
		$this->xsltProcessor->setParameter("", "tag", "menu");
    }
    
    public function getMenu()
    {
		$this->xsltProcessor->setParameter("", "action", "menu");
        return $this->xsltProcessor->transformToXML($this->domDocumentXML);		
    }
}	
	
?>




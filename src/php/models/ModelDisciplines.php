<?php

class Disciplines
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
		
		$this->xsltProcessor->setParameter("", "tag", "disciplines");
    }
    
    public function getNames()
    {
        $query = "/dewindhappers/disciplines/discipline/name/text()";
        
        $names = array();
        foreach($this->xpathProcessor->evaluate($query) as $domTextNode){
            $names[] = trim($domTextNode->wholeText);
        }
        
        return $names;
    }
    
    public function getByName($name)
    {
		$this->xsltProcessor->setParameter("", "action", "disciplineByName");
		$this->xsltProcessor->setParameter("", "name", $name);		 
        return $this->xsltProcessor->transformToXML($this->domDocumentXML);		   
    }
}	
	
?>




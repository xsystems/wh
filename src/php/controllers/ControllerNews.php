<?php

class ControllerNews
{      
    private $pathXML;
    private $pathXSLT;    
    private $domDocumentXML;
    private $domDocumentXSLT;
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
		
		$this->xsltProcessor = new XSLTProcessor();
		$this->xsltProcessor->importStyleSheet($this->domDocumentXSLT);
		
		$this->xsltProcessor->setParameter("", "tag", "news");
    }
	
	public function getAllArticles()
	{
	    $this->xsltProcessor->setParameter("", "action", "all");	
	    return $this->xsltProcessor->transformToXML($this->domDocumentXML);
    }
    
	public function countArticles()
	{
	    $this->xsltProcessor->setParameter("", "action", "count");
	    return $this->xsltProcessor->transformToXML($this->domDocumentXML);
    }    
    
    public function getRangeOfArticles($positionStart, $positionEnd)
	{
	    $this->xsltProcessor->setParameter("", "action", "articlesRange");	
	    $this->xsltProcessor->setParameter("", "positionStart", $positionStart);	
	    $this->xsltProcessor->setParameter("", "positionEnd", $positionEnd);		    	    
	    return $this->xsltProcessor->transformToXML($this->domDocumentXML);
    }
    
    public function getRangeOfArticleAbstracts($positionStart, $positionEnd)
	{
	    $this->xsltProcessor->setParameter("", "action", "articlesRangeAbstract");	
	    $this->xsltProcessor->setParameter("", "positionStart", $positionStart);	
	    $this->xsltProcessor->setParameter("", "positionEnd", $positionEnd);		    	    
	    return $this->xsltProcessor->transformToXML($this->domDocumentXML);
    }
}	
	
?>




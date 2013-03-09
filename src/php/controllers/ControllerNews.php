<?php

class ControllerNews
{      
    private $filePath;
    private $domDocument;

    public function __construct($filePath)
    {
        $filePath->path = $filePath;        
        $domImplementation = new DOMImplementation();	
		$this->domDocument = $domImplementation->createDocument();       
		$this->domDocument->load($filePath);
    }
	
	public function getAllArticles()
	{
	    
	    return null;
    }
    
    public function getLatestArticles($numberOfAticles)
	{
	    return null;
    }
}	
	
?>




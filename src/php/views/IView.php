<?php

interface IView
{
    const qualifiedName = "html";
	const publicId = "-//W3C//DTD XHTML 1.0 Transitional//EN";
	const systemId = "dtd/xhtml1-transitional.dtd";	
#	const systemId = "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd";	    
	const namespaceURI = "http://www.w3.org/1999/xhtml";
#	const schemaURI = "http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd";
#	const schemaURI = "http://www.w3.org/2002/08/xhtml/xhtml1-transitional.xsd"; // Because of: iframe, video.	
	
	const xmlVersion = "1.0";
	const xmlEncoding = "utf-8";
	const formatOutput = true;
	const preserveWhiteSpace = false;
	const validateOnParse = true;    
    
    public function __set($name, $value);
    public function __get($name);     
    public function load($template);     
    public function add($id, $templateFrament);  
    public function save();      
}

?>

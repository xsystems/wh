<?php

interface ITemplateAttributes
{
    const qualifiedName = "html";
	const namespaceURI = "http://www.w3.org/1999/xhtml";
	//const schemaURI = "http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd";
	const schemaURI = "http://www.w3.org/2002/08/xhtml/xhtml1-transitional.xsd"; // Because of: iframe, video.
	const publicId = "";
	const systemId = "";
	
	const encoding = "utf-8";
	const formatOutput = true;
	const preserveWhiteSpace = false;
	const validateOnParse = true;

	// Old XHTML id's.	
	//const publicId = "-//W3C//DTD XHTML 1.0 Transitional//EN";
	//const systemId = "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd";
}

?>

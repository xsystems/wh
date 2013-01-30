<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class VertelElement implements ITemplateElement, ITemplateAttributes
{	
    private $domElement;

	private $rootElementClass;
	private $filename;

	public function __construct($rootElementClass, $filename) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->filename = $filename;
		$this->init();
	}
	
	public function init()
	{
        $domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$this->domElement = $domDocument->createElementNS(self::namespaceURI, "div");		
		$this->domElement->setAttribute("class", $this->rootElementClass);
		
		$messages = "";		
		if(filesize($this->filename) > 0)
		{
            $file = fopen($this->filename, 'r');
            $messages = fread($file, filesize($this->filename));         
            fclose($file);	
            
            $domDocumentFragmentMessages = $domDocument->createDocumentFragment();
		    $domDocumentFragmentMessages->appendXML( "<article id='vertel'>$messages</article>" );     		    
		    $this->domElement->appendChild($domDocumentFragmentMessages);		      	
		}
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

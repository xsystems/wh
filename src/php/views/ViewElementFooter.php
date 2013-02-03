<?php	

require_once("IViewElement.php");
require_once("IViewAttributes.php");

class ViewElementFooter implements IViewElement, IViewAttributes
{	
    private $domElement;

	private $rootElementClass;
	private $cssIcon = "<a href='http://jigsaw.w3.org/css-validator/check/referer'> <img src='http://jigsaw.w3.org/css-validator/images/vcss' alt='Valid CSS!' /> </a>";
	private $xhtmlIcon = "<a href='http://validator.w3.org/check?uri=referer'> <img src='http://www.w3.org/Icons/valid-xhtml10' alt='Valid XHTML 1.0 Transitional' /> </a>";
	private $html5Icon = "<a href='http://www.w3.org/html/logo/'> <img src='http://www.w3.org/html/logo/badge/html5-badge-h-css3-multimedia-semantics.png' alt='HTML5 Powered with CSS3 / Styling, Multimedia, and Semantics' title='HTML5 Powered with CSS3 / Styling, Multimedia, and Semantics' /> </a>";
    private $ccLicenseIcon = "<a rel='license' href='http://creativecommons.org/licenses/by/3.0/deed.en_US'> <img alt='Creative Commons License' style='border-width:0' src='http://i.creativecommons.org/l/by/3.0/88x31.png' /> </a>";

	public function __construct($rootElementClass) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->init();
	}
	
	public function init()
	{
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$this->domElement = $domDocument->createElementNS(self::namespaceURI, "div");		
		$this->domElement->setAttribute("id", "footer");		
		$this->domElement->setIdAttribute("id", true);
		$this->domElement->setAttribute("class", $this->rootElementClass);
		
		$domDocumentFragment = $domDocument->createDocumentFragment();	
		$domDocumentFragment->appendXML( "<div class='namespace_container' xmlns='http://www.w3.org/1999/xhtml'> {$this->cssIcon} {$this->xhtmlIcon} {$this->html5Icon}  {$this->ccLicenseIcon} </div>" );		
		$this->domElement->appendChild($domDocumentFragment);
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

<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class HomeElement implements ITemplateElement, ITemplateAttributes
{
    private $domElement;

	private $rootElementClass;

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
		$this->domElement->setAttribute("class", $this->rootElementClass);
		
	    $homeContent = $domDocument->createElementNS(self::namespaceURI, "div");			
		$homeContent->setAttribute("class", "content home_content");
		
        $h1 = $domDocument->createElementNS(self::namespaceURI, "h1");			
		$h1->appendChild($domDocument->createTextNode("De Windhappers"));
		
	    $p = $domDocument->createElementNS(self::namespaceURI, "p");			
		$p->appendChild($domDocument->createTextNode("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ipsum erat, congue porttitor iaculis in, volutpat nec neque. Integer sapien libero, ultrices quis pharetra ultricies, facilisis eu nibh. Donec interdum fermentum pulvinar. Phasellus semper, eros tristique tristique egestas, nunc dolor ullamcorper lectus, eget tincidunt lorem urna a quam. Vestibulum gravida urna a sem semper et scelerisque mauris commodo. Praesent hendrerit, ligula a laoreet blandit, eros libero sollicitudin lacus, ac faucibus nisl justo vitae leo. Fusce nisl lacus, tincidunt at rutrum at, aliquet sed risus. Praesent elit diam, sagittis varius porta eget, viverra commodo orci. Quisque blandit, tortor non venenatis eleifend, dui nibh ultrices erat, et dapibus mi sem ultrices sapien. Nullam eget ante dolor. Proin id odio nunc, vitae lacinia libero. Donec tincidunt, ante eu imperdiet fringilla, purus sapien consequat orci, non fermentum mi magna eget mauris. Suspendisse nisi libero, pharetra et venenatis ut, tincidunt vitae justo."));
		

		//$domDocumentFragment = $domDocument->createDocumentFragment();
		//$domDocumentFragment->appendXML( "<div class='content namespace_container' xmlns='http://www.w3.org/1999/xhtml'>text</div><div class='content namespace_container' xmlns='http://www.w3.org/1999/xhtml'>text</div>" );	
		
		$likeButtonIframe = $domDocument->createElementNS(self::namespaceURI, "iframe");
		$likeButtonIframe->setAttribute("class", "like_button_iframe");
		$likeButtonIframe->setAttribute("src", "//www.facebook.com/plugins/like.php?href=http://wh.xsystems.org&send=false&layout=standard&show_faces=true&font=tahoma&colorscheme=dark&action=like");
		$likeButtonIframe->setAttribute("scrolling", "no;");
        $likeButtonIframe->setAttribute("frameborder", "0");
        $likeButtonIframe->setAttribute("allowTransparency", "true");
    		    						
#<iframe src='' scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:450px; height:21px;' allowTransparency='true'></iframe>								
							
	    $likeButtonIframe->appendChild($domDocument->createTextNode(" "));
		$homeContent->appendChild($h1);
		$homeContent->appendChild($p);
		$this->domElement->appendChild($homeContent);
		$this->domElement->appendChild($likeButtonIframe);
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

<?php	

require_once("ViewElement.php");

class ViewElementHome extends ViewElement
{
	public function init()
	{	
		//$domDocumentFragment = $domDocument->createDocumentFragment();
		//$domDocumentFragment->appendXML( "<div class='content namespace_container' xmlns='http://www.w3.org/1999/xhtml'>text</div><div class='content namespace_container' xmlns='http://www.w3.org/1999/xhtml'>text</div>" );	
		
		$likeButtonIframe = $this->domDocument->createElementNS(self::namespaceURI, "iframe");
		$likeButtonIframe->setAttribute("class", "like_button_iframe");
		$likeButtonIframe->setAttribute("src", "//www.facebook.com/plugins/like.php?href=http://wh.xsystems.org&send=false&layout=standard&show_faces=true&font=tahoma&colorscheme=dark&action=like");
		$likeButtonIframe->setAttribute("scrolling", "no;");
        $likeButtonIframe->setAttribute("frameborder", "0");
        $likeButtonIframe->setAttribute("allowTransparency", "true");
    		    						
        #<iframe src='' scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:450px; height:21px;' allowTransparency='true'></iframe>								
							
	    $likeButtonIframe->appendChild($this->domDocument->createTextNode(" "));
		//$this->domElement->appendChild($likeButtonIframe);
	}
}
?>

<?php	

require_once("IViewElement.php");
require_once("IViewAttributes.php");

class ViewElementHomeEnglish implements IViewElement, IViewAttributes
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
		
        $script = $domDocument->createElementNS(self::namespaceURI, "script");	
	    $script->setAttribute("type", "text/javascript");
	    $script->setAttribute("src", "/src/js/setup_lightbox2.js");	
	    $dummy_text = $domDocument->createTextNode(" ");
		
	    $domDocumentFragment = $domDocument->createDocumentFragment();
		$domDocumentFragment->appendXML( "  <article class='article_home'>

                                            <header> </header>

                                            <section>
                                            <h1>The Windhappers</h1>                                          

                                            <section class='section_home_h2 justify-all-lines'>
                                            <h2>Who are we</h2>
                                            <div class='section_home_text'>                                            
                                            <p>
                                            'The Windhappers' is a kayak and canoe club situated near the artificial ice-rink 'De Uithof' which is on the Jaap Edenlaan, not far from the Lozerlaan in the south west of The Hague. Take a look at the local map on this homepage of that part of The Hague.
                                            </p>
                                            We have many activities:                                      
                                            <ul>
                                            <li>Day touring trips on flat water (channals and lakes).</li>
                                            <li>Weekend touring trips with camping.</li>
                                            <li>Sea kayak touring of the North Sea or on the channels of the estuary in the south west of the Netherlands.</li>
                                            <li>We also play canoe-polo using polo kayaks on the canal next to our boathouse.</li>
                                            </ul>
                                            
                                            <br/>
                                            
                                            <p>
                                            In the winter season we have monthly full moon evening trips (if the water is not frozen, but then we skate, of course), and every now and then we show slides of movies in our canteen in the upper part of our boathouse.

                                            Every Wednesday evening 7.30-10.30 pm we meet each other in our canteen. It is our official Club evening.

                                            If you are staying for some time in The Hague or in the neighbourhood, come along and meet us, we are a friendly bunch of people. You might even consider becoming a member.

                                            We hope to see you at our club meetings on a Wednesday evening. Be our Guest then. 
                                            </p>
                                            </div>
                                            
                                            <div class='section_home_images'>
                                            <a href='/content/images/home/banner_freestyle.original.jpg' rel='lightbox[home]' title='Verenigingsgebouw'>
                                                <img src='/content/images/home/banner_freestyle.jpg' alt='Verenigingsgebouw' title='Verenigingsgebouw'> </img>
                                            </a>
                                            <a href='/content/images/home/kanopolo juni 2012 010.original.JPG' rel='lightbox[home]' title='Kanopolo'>
                                                <img src='/content/images/home/kanopolo juni 2012 010.JPG' alt='Kanopolo' title='Kanopolo'> </img>
                                            </a>   
                                            <a href='/content/images/home/ww-2.jpg' rel='lightbox[home]' title='Wildwatervaren'>
                                                <img src='/content/images/home/ww-2.jpg' alt='Wildwatervaren' title='Wildwatervaren'> </img>
                                            </a>    
                                            <a href='/content/images/home/banner_building.original.jpg' rel='lightbox[home]' title='Verenigingsgebouw'>
                                                <img src='/content/images/home/banner_building.jpg' alt='Verenigingsgebouw' title='Verenigingsgebouw'> </img>
                                            </a>    
                                            <a href='/content/images/home/eskimoteer 13-02-09 026.original.JPG' rel='lightbox[home]' title='Verenigingsgebouw'>
                                                <img src='/content/images/home/eskimoteer 13-02-09 026.JPG' alt='Verenigingsgebouw' title='Verenigingsgebouw'> </img>
                                            </a>                                                                                                                                    
                                            </div>                                 
                                            </section>
                                            
                                            </section>
                                            
                                            <footer></footer>

                                            </article> " );		

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
		$homeContent->appendChild($domDocumentFragment);
		$this->domElement->appendChild($homeContent);
		//$this->domElement->appendChild($likeButtonIframe);
       	$script->appendChild($dummy_text);
	    $this->domElement->appendChild($script);
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

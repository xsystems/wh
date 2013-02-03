<?php	

require_once("IViewElement.php");
require_once("IViewAttributes.php");

class ViewElementCanoetours implements IViewElement, IViewAttributes
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
		
	    $article = $domDocument->createElementNS(self::namespaceURI, "article");			
		$article->setAttribute("class", "article_canoetours justify-all-lines");
		
        $script = $domDocument->createElementNS(self::namespaceURI, "script");	
	    $script->setAttribute("type", "text/javascript");
	    $script->setAttribute("src", "/src/js/setup_lightbox2.js");	
	    $dummy_text = $domDocument->createTextNode(" ");		
		
	    $domDocumentFragment = $domDocument->createDocumentFragment();
		$domDocumentFragment->appendXML( "  <section>
                                            <h1>Kanoroutes in het Westland + GPS</h1>
                                            </section>

                                            <section class='section_canoetour'>
                                            <h2>Kanoroutes in het Westland</h2>
                                            <a href='/media/canoetours/kanoroute_0_overzicht.jpg' rel='lightbox[canoetours]' title='Kanoroutes in het Westland'>
                                                <img src='/media/canoetours/kanoroute_0_overzicht_thumbnail.jpg' alt='Kano routes in het Westland' title='Klik met de rechter muisknop om te downloaden.'> </img>
                                            </a>
                                            <a href='/media/canoetours/kanoroute_0_overzicht.jpg'>kanoroute_overzicht.jpg</a>
                                            </section>

                                            <section class='section_canoetour'>
                                            <h2>De Lier</h2>
                                            <a href='/media/canoetours/kanoroute_de_lier.jpg' rel='lightbox[canoetours]' title='Kano route De Lier'>
                                                <img src='/media/canoetours/kanoroute_de_lier_thumbnail.jpg' alt='Kano route De Lier' title='Klik met de rechter muisknop om te downloaden.'> </img>
                                            </a>
                                            <a href='/media/canoetours/kanoroute_de_lier.gpx' type='application/gpx+xml'>kanoroute_de_lier.gpx</a>
                                            </section>
                                            
                                            <section class='section_canoetour'>
                                            <h2>Honselersdijk</h2>
                                            <a href='/media/canoetours/kanoroute_honselersdijk.jpg' rel='lightbox[canoetours]' title='Kano route Honselersdijk'>
                                                <img src='/media/canoetours/kanoroute_honselersdijk_thumbnail.jpg' alt='Kano route Honselersdijk' title='Klik met de rechter muisknop om te downloaden.'> </img>
                                            </a>
                                            <a href='/media/canoetours/kanoroute_honselersdijk.gpx' type='application/gpx+xml'>kanoroute_honselersdijk.gpx</a>
                                            </section>
                                            
                                            <section class='section_canoetour'>
                                            <h2>Naaldwijk</h2>
                                            <a href='/media/canoetours/kanoroute_naaldwijk.jpg' rel='lightbox[canoetours]' title='Kano route Naaldwijk'>
                                                <img src='/media/canoetours/kanoroute_naaldwijk_thumbnail.jpg' alt='Kano route Naaldwijk' title='Klik met de rechter muisknop om te downloaden.'> </img>
                                            </a>
                                            <a href='/media/canoetours/kanoroute_naaldwijk.gpx' type='application/gpx+xml'>kanoroute_naaldwijk.gpx</a>
                                            </section>
                                            
                                            <section class='section_canoetour'>
                                            <h2>Oranjesluis</h2>
                                            <a href='/media/canoetours/kanoroute_oranjesluis.jpg' rel='lightbox[canoetours]' title='Kano route Oranjesluis'>
                                                <img src='/media/canoetours/kanoroute_oranjesluis_thumbnail.jpg' alt='Kano route Oranjesluis' title='Klik met de rechter muisknop om te downloaden.'> </img>
                                            </a>
                                            <a href='/media/canoetours/kanoroute_oranjesluis.gpx' type='application/gpx+xml'>kanoroute_oranjesluis.gpx</a>
                                            </section>
                                            
                                            <section class='section_canoetour'>
                                            <h2>Schipluiden</h2>
                                            <a href='/media/canoetours/kanoroute_schipluiden.jpg' rel='lightbox[canoetours]' title='Kano route Schipluiden'>
                                                <img src='/media/canoetours/kanoroute_schipluiden_thumbnail.jpg' alt='Kano route Schipluiden' title='Klik met de rechter muisknop om te downloaden.'> </img>
                                            </a>
                                            <a href='/media/canoetours/kanoroute_schipluiden.gpx' type='application/gpx+xml'>kanoroute_schipluiden.gpx</a>
                                            </section>" );		

		$article->appendChild($domDocumentFragment);
		$this->domElement->appendChild($article);
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

<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class CanoetoursElement implements ITemplateElement, ITemplateAttributes
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
	    $script->setAttribute("src", "/code/js/setup_lightbox2.js");	
	    $dummy_text = $domDocument->createTextNode(" ");		
		
	    $domDocumentFragment = $domDocument->createDocumentFragment();
		$domDocumentFragment->appendXML( "  <section>
                                            <h1>Kanoroutes in het Westland + GPS</h1>
                                            </section>

                                            <section class='section_canoetour'>
                                            <h2>Kanoroutes in het Westland</h2>
                                            <a href='/media/canoetours/canoetour_0_overzicht.jpg' rel='lightbox[canoetours]' title='Kanoroutes in het Westland'>
                                                <img src='/media/canoetours/canoetour_0_overzicht_thumbnail.jpg' alt='Kano routes in het Westland' title='Klik met de rechter muisknop om te downloaden.'> </img>
                                            </a>
                                            <a href='/media/canoetours/canoetour_0_overzicht.jpg'>canoetour_overzicht.jpg</a>
                                            </section>

                                            <section class='section_canoetour'>
                                            <h2>De Lier</h2>
                                            <a href='/media/canoetours/canoetour_de_lier.jpg' rel='lightbox[canoetours]' title='Kano route De Lier'>
                                                <img src='/media/canoetours/canoetour_de_lier_thumbnail.jpg' alt='Kano route De Lier' title='Klik met de rechter muisknop om te downloaden.'> </img>
                                            </a>
                                            <a href='/media/canoetours/canoetour_de_lier.gpx' type='application/gpx+xml'>canoetour_de_lier.gpx</a>
                                            </section>
                                            
                                            <section class='section_canoetour'>
                                            <h2>Honselersdijk</h2>
                                            <a href='/media/canoetours/canoetour_honselersdijk.jpg' rel='lightbox[canoetours]' title='Kano route Honselersdijk'>
                                                <img src='/media/canoetours/canoetour_honselersdijk_thumbnail.jpg' alt='Kano route Honselersdijk' title='Klik met de rechter muisknop om te downloaden.'> </img>
                                            </a>
                                            <a href='/media/canoetours/canoetour_honselersdijk.gpx' type='application/gpx+xml'>canoetour_honselersdijk.gpx</a>
                                            </section>
                                            
                                            <section class='section_canoetour'>
                                            <h2>Naaldwijk</h2>
                                            <a href='/media/canoetours/canoetour_naaldwijk.jpg' rel='lightbox[canoetours]' title='Kano route Naaldwijk'>
                                                <img src='/media/canoetours/canoetour_naaldwijk_thumbnail.jpg' alt='Kano route Naaldwijk' title='Klik met de rechter muisknop om te downloaden.'> </img>
                                            </a>
                                            <a href='/media/canoetours/canoetour_naaldwijk.gpx' type='application/gpx+xml'>canoetour_naaldwijk.gpx</a>
                                            </section>
                                            
                                            <section class='section_canoetour'>
                                            <h2>Oranjesluis</h2>
                                            <a href='/media/canoetours/canoetour_oranjesluis.jpg' rel='lightbox[canoetours]' title='Kano route Oranjesluis'>
                                                <img src='/media/canoetours/canoetour_oranjesluis_thumbnail.jpg' alt='Kano route Oranjesluis' title='Klik met de rechter muisknop om te downloaden.'> </img>
                                            </a>
                                            <a href='/media/canoetours/canoetour_oranjesluis.gpx' type='application/gpx+xml'>canoetour_oranjesluis.gpx</a>
                                            </section>
                                            
                                            <section class='section_canoetour'>
                                            <h2>Schipluiden</h2>
                                            <a href='/media/canoetours/canoetour_schipluiden.jpg' rel='lightbox[canoetours]' title='Kano route Schipluiden'>
                                                <img src='/media/canoetours/canoetour_schipluiden_thumbnail.jpg' alt='Kano route Schipluiden' title='Klik met de rechter muisknop om te downloaden.'> </img>
                                            </a>
                                            <a href='/media/canoetours/canoetour_schipluiden.gpx' type='application/gpx+xml'>canoetour_schipluiden.gpx</a>
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

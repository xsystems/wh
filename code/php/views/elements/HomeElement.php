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
		
        $script = $domDocument->createElementNS(self::namespaceURI, "script");	
	    $script->setAttribute("type", "text/javascript");
	    $script->setAttribute("src", "/code/js/setup_lightbox2.js");	
	    $dummy_text = $domDocument->createTextNode(" ");
		
	    $domDocumentFragment = $domDocument->createDocumentFragment();
		$domDocumentFragment->appendXML( "  <article class='article_home'>

                                            <header> </header>

                                            <section>
                                            <h1>De Windhappers</h1>

                                            <em>Welkom op de website van Kanovereniging De Windhappers. Op deze site vind je alles wat je wilt weten over kajak- of kanovaren in de regio Den Haag/Westland.</em>

                                            <section class='section_home_h2 justify-all-lines'>
                                            <h2>Wie zijn wij</h2>
                                            <p>
                                            Kanovereniging De Windhappers is een Haagse kano<wbr> </wbr>vereniging die is opgericht in februari 1958. De vereniging is in 1967 bij Koninklijk Besluit koninklijk goedgekeurd. 
                                            Wij zijn een enthousiaste, actieve kanoclub met ongeveer 200 leden. Onze leden doen mee aan alle vormen van kanosport, zoals: kanopolo in competitievorm (naam?); varen in open kano’s (de z.g. Canadese kano);  varen met een groep in onze eigen C-10-kano; toertochten in vlakwaterkano's; zeevaren en brandingvaren met zeekano's; varen in wildwaterkayaks, snowkayak en freestyle kanoën. 
                                            Kortom op kanogebied is er voor elk wat wils en voor elke leeftijd wat te doen. 
                                            De club staat open voor beginnende en geoefende kanoërs van alle leeftijden. Elke woensdagavond is onze clubavond, kom gerust eens langs voor informatie of maak een afspraak voor een eerste gratis vaartocht met een clubboot. Onze leden helpen u graag op weg. [Naam en telefoonnummer contactpersoon?]
                                            </p>
                                            <a href='/content/images/home/banner_freestyle.original.jpg' rel='lightbox[home]' title='Verenigingsgebouw'>
                                                <img src='/content/images/home/banner_freestyle.jpg' alt='Verenigingsgebouw' title='Verenigingsgebouw'> </img>
                                            </a>
                                            </section>

                                            <section class='section_home_h2 justify-all-lines'>
                                            <h2>Wilt u iets aan uw conditie doen</h2>
                                            <a href='/content/images/home/kanopolo juni 2012 010.original.JPG' rel='lightbox[home]' title='Kanopolo'>
                                                <img src='/content/images/home/kanopolo juni 2012 010.JPG' alt='Kanopolo' title='Kanopolo'> </img>
                                            </a>
                                            <p>
                                            Denk dan eens aan de kanosport in plaats van aan de sportschool.  Kanovaren is niet aan leeftijd gebonden en u bent lekker in de buitenlucht. Bij de Windhappers hebben we leden van 8 tot 80 jaar. Dus kom woensdagavond eens langs op onze clubavond.
                                            Heeft u geen ervaring met kanovaren? Of heeft u geen eigen kano? Geen probleem. Wij beschikken over een aantal clubboten: vlakwaterkano's, zeekano's, wildwaterkano's en open kano’s (Canadese), in diverse types. Deze boten zijn beschikbaar voor leden die (nog) geen eigen boot bezitten. Uw eigen boot mag u stallen in de botenloods.
                                            Heeft u wel een boot maar geen eigen vervoer voor uw kano? De club is in het bezit van een botentrailer voor het vervoer van de kano’s bij de regelmatig georganiseerde toertochten naar bijvoorbeeld: de Nieuwkoopse plassen. Zie hiervoor de agenda.
                                            </p>
                                            </section>

                                            <section class='section_home_h2 justify-all-lines'>
                                            <h2>Waar kunt u ons vinden</h2>
                                            <p>
                                            Ons <a href='../controllers/view.controller.php?action=location' title='Adresgegevens'>verenigingsgebouw met botenloods</a> ligt aan de Wennetjes<wbr> </wbr>sloot aan de rand van het Recreatiepark “De Uithof”. 
                                            Ons goed onderhouden gebouw heeft een gezellige kantine met bar en is voorzien van kleedruimtes, warme douches en toiletten. In de botenloods is plaats voor ongeveer 200? kajaks en open kano’s.
                                            Door de ligging aan een uitgebreid netwerk van kanovaarwegen, op de grens van Den Haag en het Westland, kun je vanuit het clubhuis langere of kortere vaartochten maken door, onder meer, de grachten van Den Haag of in de mooie natuur van het Westland en Midden-Delfland. 
                                            </p>
                                            <a href='/content/images/home/ww-2.jpg' rel='lightbox[home]' title='Wildwatervaren'>
                                                <img src='/content/images/home/ww-2.jpg' alt='Wildwatervaren' title='Wildwatervaren'> </img>
                                            </a>
                                            </section>

                                            <section class='section_home_h2 justify-all-lines'>
                                            <h2>Welke activiteiten zijn er</h2>
                                            <a href='/content/images/home/banner_building.original.jpg' rel='lightbox[home]' title='Verenigingsgebouw'>
                                                <img src='/content/images/home/banner_building.jpg' alt='Verenigingsgebouw' title='Verenigingsgebouw'> </img>
                                            </a>
                                            <p>
                                            Elk jaar aan het begin van het vaarseizoen wordt een basiscursus georganiseerd voor beginners. Hierbij worden de grondbeginselen van het kanovaren aangeleerd. Elk nieuw lid volgt deze basiscursus waar, naast zaken als <strong>techniek en veiligheid, ook materiaalkennis, keuze van kano of kajak</strong> aan bod komen. 
                                            Tevens kan er, op aanvraag, les worden gegeven in het varen in open kano’s.
                                            Daarnaast wordt regelmatig een cursus gegeven in eskimoteren in een verwarmd zwembad. Eskimoteren is de kunst van het in de kano zittend overeind komen als men is omgeslagen.
                                            </p>
                                            </section>
                                            </section>

                                            <footer>Joke de Jongh</footer>

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

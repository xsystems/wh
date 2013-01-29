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
                                            <div class='section_home_text'>
                                            <p>
                                            Kanovereniging De Windhappers is een Haagse kano<wbr> </wbr>vereniging die is opgericht in februari 1958 en is aangesloten bij het Watersportverbond. We zijn er trots op dat de vereniging in 1967 bij Koninklijk Besluit koninklijk is goedgekeurd.
                                            <br/>
                                            Wij zijn een enthousiaste en actieve kanoclub met ongeveer 200 leden. Onze leden doen mee aan alle vormen van kano<wbr> </wbr>sport, zoals: kanopolo, zowel recreatief als in competitievorm; toervaren in kajaks en in Canadese kano’s (open kano's); varen met een groep in onze eigen C-10-kano; toertochten en kampeerweekends door heel Nederland; zee- en brandingvaren; varen op wildwater en Freestyle kanoën. 
                                            <br/>
                                            Kortom op kanogebied is er voor elk wat wils en voor elke leeftijd wat te doen. 
                                            <br/>
                                            Elke woensdagavond is onze clubavond, kom gerust eens langs voor informatie of maak een afspraak voor een eerste gratis begeleide kanotocht met een clubboot. Onze leden helpen u graag op weg (zie verder contacten).
                                            <br/>
                                            Wil je iets aan je conditie doen? Denk dan eens aan de kanosport in plaats van aan de sportschool. Kanovaren is niet aan leeftijd gebonden en je bent lekker in de buitenlucht. Bij de Windhappers hebben we leden van 8 tot 80 jaar. Dus kom woensdagavond eens langs op onze clubavond.
                                            <br/>
                                            Heb je geen eigen kano? Geen probleem! Wij beschikken over een aantal clubboten zoals vlakwater- , zee- en wildwater<wbr> </wbr>kajaks en de Canadese kano’s. Deze boten zijn beschikbaar voor leden die (nog) geen eigen boot bezitten. Voor leden met een eigen boot zijn er stallingplaatsen beschikbaar in de botenloods.
                                            <br/>
                                            Bij toertochten is er een botentrailer beschikbaar voor het vervoer van de kajaks. 
                                            </p>
                                            </div>
                                            <div class='section_home_images'>
                                            <a href='/content/images/home/banner_freestyle.original.jpg' rel='lightbox[home]' title='Verenigingsgebouw'>
                                                <img src='/content/images/home/banner_freestyle.jpg' alt='Verenigingsgebouw' title='Verenigingsgebouw'> </img>
                                            </a>
                                            <a href='/content/images/home/kanopolo juni 2012 010.original.JPG' rel='lightbox[home]' title='Kanopolo'>
                                                <img src='/content/images/home/kanopolo juni 2012 010.JPG' alt='Kanopolo' title='Kanopolo'> </img>
                                            </a>           
                                            </div>                                 
                                            </section>

                                            <section class='section_home_h2 justify-all-lines'>
                                            <h2>Waar kunt u ons vinden</h2>
                                            <div class='section_home_images'>
                                            <a href='/content/images/home/ww-2.jpg' rel='lightbox[home]' title='Wildwatervaren'>
                                                <img src='/content/images/home/ww-2.jpg' alt='Wildwatervaren' title='Wildwatervaren'> </img>
                                            </a>
                                            </div>  
                                            <div class='section_home_text'>                                                                                      
                                            <p>                          
                                            <em>Ons adres is Nieuweweg 60 in Den Haag.</em>
                                            <br/><br/>
                                            Het verenigingsgebouw met botenloods ligt aan de Wennetjes<wbr> </wbr>sloot achter het laatste parkeerterrein van schaatscentrum de Uithof. Je kunt dit bereiken via de Jaap Edenweg (<a href='../controllers/view.controller.php?action=location' title='Adresgegevens'>zie platte<wbr> </wbr>grond</a>).
                                            <br/>
                                            Ons goed onderhouden gebouw heeft een gezellige kantine met bar en is voorzien van kleedruimtes, warme douches en toiletten. In de botenloods is plaats voor kajaks en Canadese kano’s.
                                            <br/>
                                            Door de ligging aan een uitgebreid netwerk van kano<wbr> </wbr>vaarwegen, kan je vanuit het clubhuis langere of kortere kanotochten maken door de grachten van Den Haag of dwalen tussen de kassen van het Westland en Delfland (zie varen in het Westland).
                                            </p>
                                            </div>
                                            </section>

                                            <section class='section_home_h2 justify-all-lines'>
                                            <h2>Welke activiteiten zijn er</h2>
                                            <div class='section_home_text'>                                            
                                            <p>
                                            Naast de toertochten organiseren we ieder jaar een open dag (in april of mei); het windhapperweekend, waarbij vanuit een camping ergens in Nederland tochten worden gevaren; kanopolotoernooien; winteractiviteiten met lezingen over uiteenlopende onderwerpen. Er worden wandeltochten georganiseerd. Daarnaast is er maandelijks een nordic walkingtocht om de conditie op peil te houden.
                                            </p> 
                                            </div>                                           
                                            <div class='section_home_images'>
                                            <a href='/content/images/home/banner_building.original.jpg' rel='lightbox[home]' title='Verenigingsgebouw'>
                                                <img src='/content/images/home/banner_building.jpg' alt='Verenigingsgebouw' title='Verenigingsgebouw'> </img>
                                            </a>
                                            </div>
                                            </section>
                                                                                        
                                            <section class='section_home_h2 justify-all-lines'>
                                            <h2>Cursussen</h2>
                                            <div class='section_home_images'>
                                            <a href='/content/images/home/eskimoteer 13-02-09 026.original.JPG' rel='lightbox[home]' title='Verenigingsgebouw'>
                                                <img src='/content/images/home/eskimoteer 13-02-09 026.JPG' alt='Verenigingsgebouw' title='Verenigingsgebouw'> </img>
                                            </a>
                                            </div>  
                                            <div class='section_home_text'>                                          
                                            <p>                          
                                            Elk jaar worden regelmatig basiscursussen voor nieuwe leden georganiseerd. Hierbij worden de grondbeginselen van het kanovaren aangeleerd. Elk nieuw lid volgt deze basiscursus waar, naast zaken als <strong>techniek en veiligheid, ook materiaal<wbr> </wbr>kennis, keuze van kano of kajak</strong> aan bod komen. 
                                            <br/>
                                            Tevens kan er op aanvraag ook les worden gegeven in het varen in Canadese kano’s.
                                            <br/>
                                            In de wintermaanden wordt een cursus gegeven in eski<wbr> </wbr>moteren in een verwarmd zwembad. Eskimoteren is de kunst van het, zonder uit te stappen, overeind komen als je bent omgeslagen.
                                            <br/>
                                            Bij voldoende belangstelling worden ook andere cursussen aangeboden zoals een beginnerscursus zeevaren.
                                            </p>
                                            </div>
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

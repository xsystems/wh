<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class HomeGermanElement implements ITemplateElement, ITemplateAttributes
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
                                            <h1>Kanuverein 'De Windhappers' aus Den Haag – Niederlanden.</h1>                                          

                                            <section class='section_home_h2 justify-all-lines'>
                                            <h2>Öffnungszeiten</h2>
                                            <div class='section_home_text'>                                            
                                            <p>
                                            Mittwochs abends ist unser fester Vereinsabend. Jeden Mittwochabend ab 19:00 Uhr ist das Clubgebäude zur Besichtigung geoeffnet und kann man sich als Mitglied einschreiben und an der Bar gemütlich Kaffee und andere Getränke trinken. Der Mitgliedschaftsbeitrag beinhaltet die Mitgliedschaft beim Nationalen Kanubund (NKB).
                                            </p>
                                            </div>                                            
                                            <div class='section_home_images'>
                                            <a href='/content/images/home/banner_freestyle.original.jpg' rel='lightbox[home]' title='Verenigingsgebouw'>
                                                <img src='/content/images/home/banner_freestyle.jpg' alt='Verenigingsgebouw' title='Verenigingsgebouw'> </img>
                                            </a>                                                                                                                                   
                                            </div>                                 
                                            </section>
                                            
                                            <section class='section_home_h2 justify-all-lines'>
                                            <h2>Allgemeines</h2>
                                            <div class='section_home_images'>
                                            <a href='/content/images/home/kanopolo juni 2012 010.original.JPG' rel='lightbox[home]' title='Kanopolo'>
                                                <img src='/content/images/home/kanopolo juni 2012 010.JPG' alt='Kanopolo' title='Kanopolo'> </img>
                                            </a>                                                                                                                                   
                                            </div>                                              
                                            <div class='section_home_text'>                                            
                                            <p>
                                            Der Kanuverein ist nach 2 weiteren Vereinen der größte Verein in den Niederlanden mit mehr als 200 Mitgliedern. Der Verein ist angeschlossen beim Niederländischen KanuBund, besser bekannt als NKB. Das Vereinsgebäude liegt hinter das Sportcentrum “De Uithof” mit einem großen Parkplatz und direktem zugang zum Wasser. Der Umgebung das Gebäudes kennt ein ausgezeichnetes Wassernetzwerk und 2 Flüsse. Vom Clubgebäude und Bootshaus kann man kürzere und längere Kanutouren unternehmen. Meistens ohne übertragungen. Das Vereinsgebäude beinhaltet das mehr als 250 Kanus und Kayaks umfassende Bootshaus, einen sehr größen Clubraum mit Bar, Tischtennis, Snooker, Umkleideräumen für Damen und Herren, Duschen und modernen sanitäre Einrichtungen. Der Hafen vor dem Vereinsgebäude dient als Spielfeld für Kanupolowettkämpfe mit Toren und abendlicher Beleuchtung und als trainungsplatz für anfänger in alle bereichen des Fahren.
                                            </p>
                                            </div>                                                                     
                                            </section>  
                                            
                                            <section class='section_home_h2 justify-all-lines'>
                                            <h2>Aktivitäten</h2>
                                            <div class='section_home_images'>
                                            <a href='/content/images/home/ww-2.jpg' rel='lightbox[home]' title='Wildwatervaren'>
                                                <img src='/content/images/home/ww-2.jpg' alt='Wildwatervaren' title='Wildwatervaren'> </img>
                                            </a>                                                                                                                                 
                                            </div>                                              
                                            <div class='section_home_text'>                                            
                                            <p>
                                            Während der Fahrsaison organisieren wir tages und wochenendetouren.Vom Frühling bis zum Herbst versorgen wir Anfängerkurse mit denen Bootstechnik erklärt und trainiert werden. Im Winter organisieren wir unter anderem Eskimotierkurse (Kenterkurse) in einem wärme Hallenbad. Zur Teilnahme sind Anfänger bevorrechtigt.Während der dunklen Jahreszeit haben Thema-Abende einen festen Platz, wie z.B. Reparaturen, Erste Hilfe, Rettung und Sicherheit. Weiterhin werden Diabende (mit Beamer oder PC) und Filmabende organisiert von Kayak- und Kanu-abenteuern in spektakulären Landschaften in In- und Ausland.
                                            </p>
                                            </div>   
                                            </section> 
                                            
                                            <section class='section_home_h2 justify-all-lines'>
                                            <h2>Einrichtungen</h2>
                                            <div class='section_home_text'>                                            
                                            <p>
                                            Zur Information der Mitglieder wird das Vereinsblatt “De Windhapper” 6 mal pro Jahr herausgegeben. Das Vereinsblatt informiert über Clubneuigkeiten, Aktivitäten und Fahrten werden angekündigt und vieles mehr was das Vereinsleben angeht. Schnelle und modern gepflegte Information kann über das Internet unter www.windhappers.nl gefunden werden. Im Gebäude können Boote untergebracht werden. Man erhält einen festen Platz und einen Schlüssel gegen eine Kaution. Das Gebäude kann Tag und Nacht erreicht und geöffnet werden. So kann jederzeit (auch Nachts oder frühmorgens) das Boot geholt werden. Neue Mitglieder und Anfänger lernen mit Vereinsbooten ihre Technik. Man braucht also nicht sofort ein Boot zu kaufen. 
                                            </p>
                                            </div>                                            
                                            <div class='section_home_images'>
                                            <a href='/content/images/home/banner_building.original.jpg' rel='lightbox[home]' title='Verenigingsgebouw'>
                                                <img src='/content/images/home/banner_building.jpg' alt='Verenigingsgebouw' title='Verenigingsgebouw'> </img>
                                            </a>                                                                                                                                 
                                            </div>                                 
                                            </section>    
                                            
                                            <section class='section_home_h2 justify-all-lines'>
                                            <h2>Diziplinen</h2>
                                            <div class='section_home_images'>
                                            <a href='/content/images/home/eskimoteer 13-02-09 026.original.JPG' rel='lightbox[home]' title='Verenigingsgebouw'>
                                                <img src='/content/images/home/eskimoteer 13-02-09 026.JPG' alt='Verenigingsgebouw' title='Verenigingsgebouw'> </img>
                                            </a>                                                                                                                                  
                                            </div>                                             
                                            <div class='section_home_text'>     
                                            <h3>Touren</h3>
                                            <p>
                                            Mittwochs abends wird durch 2 verschiedene Gruppen Kanu gefahren: Wir gebrauchen hier den Begriff Kanu als Sammelbegriff für Kayaks und Kanadier. Tempo fahren, Abstand (mehr Kilometer) und Anfängerkurse. Um jedem seinen/ihren Platz zu ermöglichen ist diese Einteilung nützlich. Zweimal monatlich wird Sonntags eine Tour organisiert. Das Tempo wird so angepaßt, daß  jeder mitkommen kann, sowohl Kayaks als auch Kanadier. Fahrtengruppen werden organisiert um die Boote zum Startplatz zu bringen. Dies spart Kosten und ist effizient für die Umwelt.
                                            </p>
                                            <h3>Kanadier</h3>
                                            <p>
                                            Kanadier paddelt man mit Stechpaddeln und haben eine ganz andere Paddeltechnik, sind durchgehend größer und breiter und dadurch meist etwas langsamer. Ein guter Fahrer kann aber locker mitkommen. Doch hat diese Disziplin seine treuen Anhänger aus diversen Gründen. Fuer Anfänger wird auch auf Solo geradeaus paddeln trainiert. Natürlich kommen auch die anderen besonderen Paddeltechniken unter Obhut. Der Club ist auch z.Zt. stolzer Besitzer eines C10 Wettkampfkanadiers, mit 10 Sitzen.
                                            </p>     
                                            <h3>Seefahrten</h3>
                                            <p>
                                            Die Niederlande ist ein Wasserland, dadurch wird außer auf See auch auf den Binnenseen in Friesland, dem Ijsselmeer, der Oosterschelde und im Watt gepaddelt. Es sind durchgehend längere Touren mit ca. 5 km / Std. zu paddeln. Anfänger können beim TKBN (Touristische KanuBund Niederlanden) an Kursen teilnehmen. Zur Auswahl stehen Tagestouren, Wochenendtouren mit Übernachtung und selbst Ferienwochen. Am schönsten sind natürlich die Zelttouren in In- und Ausland. Das Watt, Wales, Schottland, das Deutsche Watt und Dänemark sind die Favorieten bei erfahrenen Seekayakfahrer(innen). Die Zeltausrüstung und Mahlzeiten für mehrere Tage verschwinden im Seekayak und los gehts, von Insel zu Insel oder auch entlang der Küste.
                                            </p>   
                                            <h3>Kanupolo</h3>
                                            <p>
                                            Kanupolo ist eine spektakuläre und energische Ballsportart, eine Mischung aus Basketball, Handball, nur auf dem Wasser mit speziellen Booten und zwei hoch aufgehängten Toren. Die Trainingsbande und Wettkämpfe sind äußerst populär bei der Jugend. Manche spielen auf nationalem Niveau. Sowohl im Sommer als auch im Winter trainieren die Kanupoloers zweimal in der Woche um in Form zu bleiben. Abendliche Flutlichtbeleuchtung ermöglicht das Spiel im Dunkeln und im Winter. Bei Frost wird drinnen trainiert. Unsere Spieler(innen) sind mit mehreren Teams auf nationalem und internationalem Turnieren vertreten und selbstverständlich auch in der Niederländischen KanuPolo-Liga. Jährlich werden mehrere Turniere gespielt und ist unser Spielfeld Schauplatz von einem oder zwei KanuPolo-Liga Wettkämpfen mit Spieler(innen) aus allen  niederländischen Provinzen.
                                            </p>   
                                            <h3>Wildwasser/Brandungvaren</h3>
                                            <p>
                                            Wildwasserfahren ist das Befahren von schnellströmenden jungen Fluessen in meist gebirgigen Gebieten. Diese takt von sportart wird mit kleinere booten (meistens bis einen lengte von maximal 2.50 meter) gevaren, umdas die sneller kunnen Drehen und Wenden. Hierdurch kan men auch sehr gut hindernisse entweichen. Viele Techniken aus dem Kanopolo werden auch im Wildwasser und Brandungsurfen angewandt. Beispiel Eskimotieren. Diese sport ist bei uns sehr im Aufmars. Sowohl beim Jung und Alt und wir sind zeitlich eine sehr größe Gruppe. Der meisten von uns gehne ofteres im jahr Wildwasserfahren im België, Luxemburg oder Deutschland. Ab letstes Jahre, haben wir im 20 minuten autofahrt der Wildwasserbahn von “Dutch Water Dreams” im Zoetermeer  www.dutchwaterdreams.nl im unsere nähe der wir naturlich auch schon Ausprobiert haben. Brandungsurfen ist ein besonderer Küstengewässersport. Unser Clubgebäude liegt etwa 10 minuten Autoreise von der Kuste entfernt und when er Wellen aufs meer sind, sind wir an der Kuste um sich ber Wind, Tide, und Seegang (Wellenhöhe) zu fahren oder es zu lassen.
                                            </p>   
                                            <h3>Freestyle/ Rodeokayakfahren</h3>
                                            <p>
                                            Freestyle und Rodeokayakfahren ist die jüngste und explosiefste Kunst des Kayakfahrens. Man fährt in einem winzigen und sehr wendbarem Kayak auf Wellen oder im Wildwasser mit viele Spielplätzen (nicht geeichnet für Flusse mit fiel folume). Durch Kunststücke wird je nach Perfektion und Schwierigkeit ein Punktewettkampf vollzogen. Bestimmte definierte Bewegungen (sog. moves) haben spezielle Namen (z.b. Airmove). Man kann hier an surfen, Dreh- und Kippbewegungen denken oder sehr komplizierte moves wobei Kayak und Fahrer komplett in der Luft drehen und wieder landen. Eskimotieren (Rettungsrolle), also das Aufrollen des Kayaks und Wildwassertechnik ist natürlich erforderlich beim Freestylekayakken. Bei den Windhappers sind eine größere Anzahl Mitglieder Anhänger dieses Sports. Zu jeder Jahreszeit (auch im Winter) verabredet man sich an einem Fluß oder an der nahegelegenen Nordsee (5 Min. Autofahrt) und einige nehmen auch an internationalen Wettkämpfen teil. Wildwasser oder Brandungsurfen sieht nicht nur spektakulär aus, es macht auch viel Spass! Willst Du auch eine große Welle zu fassen bekommen um einen move aus zu führen? Dann ist Freestyle kayakfahren etwas für Dich!
                                            </p> 
                                            <h3>Jugend</h3>
                                            <p>
                                            Mittwoch abends erhält der jugendlich Nachwuchs Training in Basistechnik, Touren, Kanadiertechnik und Kanupolo. Mit Jugendstimulierungsprogrammen arbeiten wir mit Schulen zusammen und organisieren wir Instruktionskurse.
                                            </p>                                                                                                                                                                                                                                                                      
                                            </div>  
                                            </section>                                                                                                                                                                                 
                                            
                                            </section>
                                            
                                            <footer></footer>

                                            </article>" );		

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

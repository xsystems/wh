<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class MenuElement implements ITemplateElement, ITemplateAttributes
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
		
		// Menu
		$this->domElement = $domDocument->createElementNS(self::namespaceURI, "ul");		
		$this->domElement->setAttribute("id", "menu");
		$this->domElement->setAttribute("class", $this->rootElementClass);
		$this->domElement->setIdAttribute("id", true);
		
		// Home menuitem
		$homeMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$homeLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$homeLink->setAttribute("href", "../controllers/view.controller.php?action=home");
		$homeLink->appendChild($domDocument->createTextNode("Home"));
		$homeMenuItem->appendChild($homeLink);
		
		$this->domElement->appendChild($homeMenuItem);
		
		// Calendar menuitem
		$calendarMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$calendarLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$calendarLink->setAttribute("href", "../controllers/view.controller.php?action=calendar");
		$calendarLink->appendChild($domDocument->createTextNode("Activiteiten"));
		$calendarMenuItem->appendChild($calendarLink);
		
		$this->domElement->appendChild($calendarMenuItem);
		
		// Discipline menuitem
		$disciplineMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$disciplineLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$disciplineLink->setAttribute("href", "#");
		$disciplineLink->appendChild($domDocument->createTextNode("Disciplines"));
		
		// Discipline submenu
		$disciplineSubMenu = $domDocument->createElementNS(self::namespaceURI, "ul");
		
		foreach (Discipline::getNames() as $name)
		{
			$urlEncodedName = urlencode($name['name']);
			$url = "../controllers/view.controller.php?action=discipline&name={$urlEncodedName}";
			
			// Discipline submenuitem
			$disciplineSubMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
			$disciplineSubLink = $domDocument->createElementNS(self::namespaceURI, "a");
			$disciplineSubLink->setAttribute("href", $url);
			$disciplineSubLink->appendChild($domDocument->createTextNode($name['name']));
			$disciplineSubMenuItem->appendChild($disciplineSubLink);
			$disciplineSubMenu->appendChild($disciplineSubMenuItem);
	    	}	
	    		
		$disciplineMenuItem->appendChild($disciplineLink);
		$disciplineMenuItem->appendChild($disciplineSubMenu);
		
		$this->domElement->appendChild($disciplineMenuItem);
		
		// Media menuitem
		$mediaMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$mediaLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$mediaLink->setAttribute("href", "#");
		$mediaLink->appendChild($domDocument->createTextNode("Media"));
		
		// Media submenu
		$mediaSubMenu = $domDocument->createElementNS(self::namespaceURI, "ul");
		
	    // Clubmagazine submenuitem
		$clubmagazineSubMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$clubmagazineLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$clubmagazineLink->setAttribute("href", "../controllers/view.controller.php?action=gallery&type=clubmagazine");
		$clubmagazineLink->appendChild($domDocument->createTextNode("Clubblad"));
		$clubmagazineSubMenuItem->appendChild($clubmagazineLink);	
		
		// Images submenuitem
		$imagesSubMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$imagesLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$imagesLink->setAttribute("href", "../controllers/view.controller.php?action=gallery&type=image");
		$imagesLink->appendChild($domDocument->createTextNode("Foto's"));
		$imagesSubMenuItem->appendChild($imagesLink);
		
		// Videos submenuitem
		$videosSubMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$videosLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$videosLink->setAttribute("href", "../controllers/view.controller.php?action=gallery&type=video");
		$videosLink->appendChild($domDocument->createTextNode("Video's"));
		$videosSubMenuItem->appendChild($videosLink);
		
		$mediaSubMenu->appendChild($clubmagazineSubMenuItem);			
		$mediaSubMenu->appendChild($imagesSubMenuItem);
		$mediaSubMenu->appendChild($videosSubMenuItem);	
			
		$mediaMenuItem->appendChild($mediaLink);
		$mediaMenuItem->appendChild($mediaSubMenu);
		
		$this->domElement->appendChild($mediaMenuItem);
		
	    // Vertel menuitem
		$vertelMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$vertelLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$vertelLink->setAttribute("href", "#");
		$vertelLink->appendChild($domDocument->createTextNode("Berichten"));
		
		// Vertel submenu
		$vertelSubMenu = $domDocument->createElementNS(self::namespaceURI, "ul");
		
		// Read submenuitem
		$readSubMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$readLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$readLink->setAttribute("href", "../controllers/view.controller.php?action=vertel");
		$readLink->appendChild($domDocument->createTextNode("Lees Berichten"));
		$readSubMenuItem->appendChild($readLink);
		
		// Write submenuitem
		$writeSubMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$writeLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$writeLink->setAttribute("href", "../controllers/view.controller.php?action=boodschap");
		$writeLink->appendChild($domDocument->createTextNode("Schrijf Berichten"));
		$writeSubMenuItem->appendChild($writeLink);	
			
		$vertelSubMenu->appendChild($readSubMenuItem);
		$vertelSubMenu->appendChild($writeSubMenuItem);	
			
		$vertelMenuItem->appendChild($vertelLink);
		$vertelMenuItem->appendChild($vertelSubMenu);
		
		$this->domElement->appendChild($vertelMenuItem);
		
		// Right menu items below here, in reversed order.
		
		// Login menuitem
		$loginMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$loginMenuItem->setAttribute("class", "rightitem");
		$loginLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$loginLink->setAttribute("href", "#");
		$loginLink->appendChild($domDocument->createTextNode("Login"));
		$loginMenuItem->appendChild($loginLink);
		
		//$this->domElement->appendChild($loginMenuItem);
		
		// Contact menuitem
		$contactMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$contactMenuItem->setAttribute("class", "rightitem");		
		$contactLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$contactLink->setAttribute("href", "#");
		$contactLink->appendChild($domDocument->createTextNode("Contact"));
		
		// Contact submenu
		$contactSubMenu = $domDocument->createElementNS(self::namespaceURI, "ul");
		
		// Organisation submenuitem
		$organisationSubMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$organisationLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$organisationLink->setAttribute("href", "../controllers/view.controller.php?action=organisation");
		$organisationLink->appendChild($domDocument->createTextNode("Organisatie"));
		$organisationSubMenuItem->appendChild($organisationLink);
		
		// Location submenuitem
		$locationSubMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$locationLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$locationLink->setAttribute("href", "../controllers/view.controller.php?action=location");
		$locationLink->appendChild($domDocument->createTextNode("Locatie"));
		$locationSubMenuItem->appendChild($locationLink);
		
		// Costs submenuitem
		$costsSubMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$costsLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$costsLink->setAttribute("href", "../controllers/view.controller.php?action=costs");
		$costsLink->appendChild($domDocument->createTextNode("Kosten"));
		$costsSubMenuItem->appendChild($costsLink);
		
		// Links submenuitem
		$linksSubMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$linksLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$linksLink->setAttribute("href", "#");
		$linksLink->appendChild($domDocument->createTextNode("Links"));
		$linksSubMenuItem->appendChild($linksLink);
		
		$contactSubMenu->appendChild($organisationSubMenuItem);
		$contactSubMenu->appendChild($locationSubMenuItem);	
		$contactSubMenu->appendChild($costsSubMenuItem);
		$contactSubMenu->appendChild($linksSubMenuItem);
				
		$contactMenuItem->appendChild($contactLink);
		$contactMenuItem->appendChild($contactSubMenu);
		
		$this->domElement->appendChild($contactMenuItem);
		
	    // Meteorology menuitem
		$meteorologyMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$meteorologyMenuItem->setAttribute("class", "rightitem");
		$meteorologyLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$meteorologyLink->setAttribute("href", "../controllers/view.controller.php?action=meteorology");
		$meteorologyLink->appendChild($domDocument->createTextNode("Meteorologie"));
		$meteorologyMenuItem->appendChild($meteorologyLink);
		
		$this->domElement->appendChild($meteorologyMenuItem);
		
	    // Canoetours menuitem
		$canoetoursMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$canoetoursMenuItem->setAttribute("class", "rightitem");
		$canoetoursLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$canoetoursLink->setAttribute("href", "../controllers/view.controller.php?action=canoetours");
		$canoetoursLink->appendChild($domDocument->createTextNode("Kanoroutes"));
		$canoetoursMenuItem->appendChild($canoetoursLink);
		
		$this->domElement->appendChild($canoetoursMenuItem);		
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

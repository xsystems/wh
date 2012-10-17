<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class MenuElement implements ITemplateElement, ITemplateAttributes
{
	private $rootElementClass;

	public function __construct($rootElementClass) 
	{
		$this->rootElementClass = $rootElementClass;
	}

	public function createTemplateElement()
	{
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		// Menu
		$menu = $domDocument->createElementNS(self::namespaceURI, "ul");		
		$menu->setAttribute("id", "menu");
		$menu->setAttribute("class", $this->rootElementClass);
		$menu->setIdAttribute("id", true);
		
		// Home menuitem
		$homeMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$homeLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$homeLink->setAttribute("href", "../controllers/view.controller.php?action=home");
		$homeLink->appendChild($domDocument->createTextNode("Home"));
		$homeMenuItem->appendChild($homeLink);
		
		$menu->appendChild($homeMenuItem);
		
		// Calendar menuitem
		$calendarMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$calendarLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$calendarLink->setAttribute("href", "../controllers/view.controller.php?action=calendar");
		$calendarLink->appendChild($domDocument->createTextNode("Kalender"));
		$calendarMenuItem->appendChild($calendarLink);
		
		$menu->appendChild($calendarMenuItem);
		
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
		
		$menu->appendChild($disciplineMenuItem);
		
		// Media menuitem
		$mediaMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$mediaLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$mediaLink->setAttribute("href", "#");
		$mediaLink->appendChild($domDocument->createTextNode("Media"));
		
		// Media submenu
		$mediaSubMenu = $domDocument->createElementNS(self::namespaceURI, "ul");
		
		// Images submenuitem
		$imagesSubMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$imagesLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$imagesLink->setAttribute("href", "../controllers/view.controller.php?action=image");
		$imagesLink->appendChild($domDocument->createTextNode("Foto's"));
		$imagesSubMenuItem->appendChild($imagesLink);
		
		// Videos submenuitem
		$videosSubMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$videosLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$videosLink->setAttribute("href", "../controllers/view.controller.php?action=video");
		$videosLink->appendChild($domDocument->createTextNode("Video's"));
		$videosSubMenuItem->appendChild($videosLink);	
			
		$mediaSubMenu->appendChild($imagesSubMenuItem);
		$mediaSubMenu->appendChild($videosSubMenuItem);	
			
		$mediaMenuItem->appendChild($mediaLink);
		$mediaMenuItem->appendChild($mediaSubMenu);
		
		$menu->appendChild($mediaMenuItem);
		
	    // Vertel menuitem
		$vertelMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$vertelLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$vertelLink->setAttribute("href", "#");
		$vertelLink->appendChild($domDocument->createTextNode("Vertel"));
		
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
		
		$menu->appendChild($vertelMenuItem);
		
		// Right menu items below here, in reversed order.
		
		// Login menuitem
		$loginMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$loginMenuItem->setAttribute("class", "rightitem");
		$loginLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$loginLink->setAttribute("href", "#");
		$loginLink->appendChild($domDocument->createTextNode("Login"));
		$loginMenuItem->appendChild($loginLink);
		
		//$menu->appendChild($loginMenuItem);
		
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
		
		$menu->appendChild($contactMenuItem);
				
		return $menu;
	}
}
?>

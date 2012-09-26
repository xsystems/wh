<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");
require_once("../configuration/configuration.php");

class GallerySelectElement implements ITemplateElement, ITemplateAttributes
{
	private $rootElementClass;
	private $galleryDir;
	private $action;
	
	public function __construct($rootElementClass, $galleryDir, $action) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->galleryDir = $galleryDir;
		$this->action = $action;
	}

	public function createTemplateElement()
	{	
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;

		// Menu
		$menu = $domDocument->createElementNS(self::namespaceURI, "ul");		
		$menu->setAttribute("id", "gallery_select");
		$menu->setAttribute("class", $this->rootElementClass);
		$menu->setIdAttribute("id", true);
		
		// Gallery menuitem
		$galleryMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
		$galleryLink = $domDocument->createElementNS(self::namespaceURI, "a");
		$galleryLink->setAttribute("href", "#");
		$galleryLink->appendChild($domDocument->createTextNode("Select a gallery"));
		
		// Gallery submenu
		$gallerySubMenu = $domDocument->createElementNS(self::namespaceURI, "ul");		
		
		$galleries = $this->scandir_for_dirs($this->galleryDir); 
		foreach ($galleries as $gallery)
		{
			$urlEncodedGallery = urlencode($gallery);
			$urlEncodedAction = urlencode($this->action);
			$url = "../controllers/view.controller.php?action=$urlEncodedAction&gallery=$urlEncodedGallery";
			
			// Gallery submenuitem
			$gallerySubMenuItem = $domDocument->createElementNS(self::namespaceURI, "li");
			$disciplineSubLink = $domDocument->createElementNS(self::namespaceURI, "a");
			$disciplineSubLink->setAttribute("href", $url);
			$disciplineSubLink->appendChild($domDocument->createTextNode($gallery));
			$gallerySubMenuItem->appendChild($disciplineSubLink);
			$gallerySubMenu->appendChild($gallerySubMenuItem);
	    	}	
	    		
		$galleryMenuItem->appendChild($galleryLink);
		$galleryMenuItem->appendChild($gallerySubMenu);
		
		$menu->appendChild($galleryMenuItem);
				
		return $menu;
	}
	
	private function scandir_for_dirs($dir)
	{
		$dirs = array();
		$filesAndDirs = scandir($dir);
		foreach ($filesAndDirs as $fileOrDir)
		{
			if( is_dir($dir.$fileOrDir)  && $fileOrDir[0] != "." )
			{
				$dirs[] = $fileOrDir;
			}
		}
		
		return $dirs;
	}
}
?>

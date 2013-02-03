<?php	

require_once("IViewElement.php");
require_once("IViewAttributes.php");

class ViewElementDiscipline implements IViewElement, IViewAttributes
{
    private $domElement;

	private $rootElementClass;
	private $name;
	
	public function __construct($rootElementClass, $name) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->name = $name;
		$this->init();
	}

	public function init()
	{
		$discipline = Discipline::getByName($this->name);
		
		$search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
		$replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
		$description = str_replace($search, $replace, $discipline->description);
		$image_folder_location = $discipline->image_folder_location;
	
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$this->domElement = $domDocument->createElementNS(self::namespaceURI, "div");		
		$h1 = $domDocument->createElementNS(self::namespaceURI, "h1");
		
		$this->domElement->setAttribute("class", $this->rootElementClass);

		$descriptionFragment = $domDocument->createDocumentFragment();
		$descriptionFragment->appendXML("<div class='namespace_container' xmlns='http://www.w3.org/1999/xhtml'>$description</div>");
			
		$h1->appendChild($domDocument->createTextNode($discipline->name));
		$this->domElement->appendChild($h1);
		$this->domElement->appendChild($descriptionFragment);
		
        $script = $domDocument->createElementNS(self::namespaceURI, "script");	
	    $script->setAttribute("type", "text/javascript");
	    $script->setAttribute("src", "/src/js/setup_lightbox2.js");	
	    $dummy_text = $domDocument->createTextNode(" ");		
		
		if($image_folder_location)
		{
            $imgboxDiv = $domDocument->createElementNS(self::namespaceURI, "div");
            $imgboxDiv->setAttribute("class", "discipline_images justify-all-lines");
			$images = scandir(Configuration::$DOCUMENT_ROOT.$image_folder_location);
		
			foreach ($images as $image)
			{
				if (!is_dir($image))
				{
					
					$imageDiv = $domDocument->createElementNS(self::namespaceURI, "div");
					$a = $domDocument->createElementNS(self::namespaceURI, "a");
					$img = $domDocument->createElementNS(self::namespaceURI, "img");
					
					$imageDiv->setAttribute("class", "discipline_image");
					$a->setAttribute("href", $image_folder_location."/".$image);
            		$a->setAttribute("rel", "lightbox[discipline]");
            		$a->setAttribute("title", $image);					
					$img->setAttribute("src", $image_folder_location."/".$image);
					$img->setAttribute("alt", $image);
					
					$imageDiv->appendChild($a);
					$a->appendChild($img);
					$imgboxDiv->appendChild($imageDiv);
				}
			}
			
		    $this->domElement->appendChild($imgboxDiv);
		}
			
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

<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");

class GalleryElement implements ITemplateElement, ITemplateAttributes
{    
    protected $galleryPageId = "gallery_page";    
    private $formID = "gallery_form";
    private $selectID = "gallery_select";
    private $inputSubmitID = "gallery_input_submit";
    private $inputActionID = "gallery_input_action";    
    private $inputTypeID = "gallery_input_type";     

    protected $domDocument;
    protected $domElement;
	private $rootElementClass;	
	private $galleryDir;
	private $action;
	private $type;
	
	public function __construct($rootElementClass, $galleryDir, $action, $type)
	{
		$this->rootElementClass = $rootElementClass;		
		$this->galleryDir = $galleryDir;
		$this->action = $action;
		$this->type = $type;

		$this->init();
	}
	
	public function init()
	{
		$this->domDocument = new DOMDocument("1.0", "utf-8");
		$this->domDocument->validateOnParse = self::validateOnParse;
		
		$this->domElement = $this->domDocument->createElementNS(self::namespaceURI, "div");
		$page = $this->domDocument->createElementNS(self::namespaceURI, "div");
		$form = $this->domDocument->createElementNS(self::namespaceURI, "form");
		$select = $this->domDocument->createElementNS(self::namespaceURI, "select");
		$input_submit = $this->domDocument->createElementNS(self::namespaceURI, "input");
    	$input_action = $this->domDocument->createElementNS(self::namespaceURI, "input");
    	$input_type = $this->domDocument->createElementNS(self::namespaceURI, "input");    	

		$this->domElement->setAttribute("class", $this->rootElementClass);
		$page->setAttribute("class", "justify-all-lines");	
		$page->setAttribute("id", $this->galleryPageId);		
		$page->setIdAttribute("id", true);		
		$form->setAttribute("action", "../controllers/view.controller.php");
		$form->setAttribute("method", "get");
		$form->setAttribute("id", $this->formID);
		$form->setIdAttribute("id", true);
		$select->setAttribute("id", $this->selectID);
		$select->setIdAttribute("id", true);
		$select->setAttribute("name", "gallery");
		$select->setAttribute("form", $this->formID);
		$input_submit->setAttribute("type", "submit");
		$input_submit->setAttribute("value", "Submit");
		$input_submit->setAttribute("id", $this->inputSubmitID);		
		$input_submit->setIdAttribute("id", true);
		$input_submit->setAttribute("form", $this->formID);
		$input_action->setAttribute("type", "hidden");
		$input_action->setAttribute("name", "action");
		$input_action->setAttribute("value", $this->action);
		$input_action->setAttribute("id", $this->inputActionID);		
		$input_action->setIdAttribute("id", true);
		$input_action->setAttribute("form", $this->formID);	
		$input_type->setAttribute("type", "hidden");
		$input_type->setAttribute("name", "type");
		$input_type->setAttribute("value", $this->type);
		$input_type->setAttribute("id", $this->inputTypeID);		
		$input_type->setIdAttribute("id", true);
		$input_type->setAttribute("form", $this->formID);	
		
		$galleries = $this->scandir_for_dirs($this->galleryDir); 
		foreach ($galleries as $gallery)
		{			
			$option = $this->domDocument->createElementNS(self::namespaceURI, "option");
			$option->setAttribute("value", $gallery);
			$option->appendChild($this->domDocument->createTextNode($gallery));
			
			$select->appendChild($option);
	    }	
	    
	    $form->appendChild($input_action);
   	    $form->appendChild($input_type);	
   	    $form->appendChild($select);	    	    	    
	    $form->appendChild($input_submit);
		
		$this->domElement->appendChild($form);	
		$this->domElement->appendChild($page);
	}
	
    public function add( $iTemplateElement )
    {
		$template = $this->domDocument->importNode($iTemplateElement->create(), true);
		$this->domDocument->getElementById($galleryPageId)->appendChild($template);
    }

	public function create()
	{			
		return $this->domElement;
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
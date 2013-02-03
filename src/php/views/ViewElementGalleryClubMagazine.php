<?php	

require_once("ViewElementGallery.php");
require_once("src/php/models/ModelSimpleGalleryPDF.php");

class ViewElementGalleryClubMagazine extends ViewElementGallery
{
	private $rootElementClass;
	private $clubmagazinesPerPage;
	private $clubmagazineDirURL;
	private $clubmagazineDirPath;
	private $thumbnailDirURL;
	private $thumbnailDirPath;
	
	public function __construct($rootElementClass, $galleryDir, $action, $type, $clubmagazinesPerPage, $clubmagazineDirURL, $clubmagazineDirPath, $thumbnailDirURL=null, $thumbnailDirPath=null)
	{	
		$this->rootElementClass = $rootElementClass;
		$this->clubmagazinesPerPage = $clubmagazinesPerPage;
		$this->clubmagazineDirURL = $clubmagazineDirURL;
		$this->clubmagazineDirPath = $clubmagazineDirPath;
		$this->thumbnailDirURL = $thumbnailDirURL;
		$this->thumbnailDirPath = $thumbnailDirPath;
		
	    parent::__construct($rootElementClass, $galleryDir, $action, $type);
	}
	
	public function init()
	{
        parent::init();

        if($this->clubmagazineDirURL != null)
        {
		    $script = $this->domDocument->createElementNS(self::namespaceURI, "script");	
					
		    $pageNumber = 0;
		    $sg = new SimpleGalleryPDF($this->clubmagazinesPerPage, $this->clubmagazineDirURL, $this->clubmagazineDirPath, $this->thumbnailDirURL, $this->thumbnailDirPath);    	
        	foreach ($sg->generatePage($pageNumber) as $pageItem)
        	{
        		$clubmagazineInfo = pathinfo($pageItem["media"]);
        	
        		$a = $this->domDocument->createElementNS(self::namespaceURI, "a");
        		$img = $this->domDocument->createElementNS(self::namespaceURI, "img");	    		
        	
        	    $urlMagazine = str_replace(" ", "%20", $pageItem["media"]);
#       	        $url = "../controllers/view.controller.php?action=iframe&url=".$urlMagazine;        	    
#                $url = "../controllers/view.controller.php?action=object&url=".$urlMagazine."&type=application/pdf&title=".$clubmagazineInfo["filename"];
                $url = $urlMagazine;
        	
        		$a->setAttribute("href", $url);
        		$a->setAttribute("target", "_blank");
        		$a->setAttribute("type", "application/pdf");
        		$a->setAttribute("title", $clubmagazineInfo["filename"]);
        		$a->setAttribute("class", "galleryPageItem");
        		$img->setAttribute("src", str_replace(" ", "%20", $pageItem["thumbnail"]));
        		$img->setAttribute("alt", $clubmagazineInfo["filename"]);
        		$img->setAttribute("class", "galleryThumb");
        	
        		$a->appendChild($img);
        		$this->domDocument->getElementById($this->galleryPageId)->appendChild($a);
        	}	
		}	
	}
	
    public function add( $iTemplateElement )
    {
        parent::add($iTemplateElement);
    }

	public function create()
	{	
		return $this->domElement;
	}
}
?>

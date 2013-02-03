<?php	

require_once("ViewElementGallery.php");
require_once("src/php/models/ModelSimpleGalleryImage.php");

class ViewElementGalleryImage extends ViewElementGallery
{
	private $rootElementClass;
	private $imagesPerPage;
	private $imageDirURL;
	private $imageDirPath;
	private $thumbnailDirURL;
	private $thumbnailDirPath;
	
	public function __construct($rootElementClass, $galleryDir, $action, $type, $imagesPerPage, $imageDirURL, $imageDirPath, $thumbnailDirURL=null, $thumbnailDirPath=null)
	{
		$this->rootElementClass = $rootElementClass;
		$this->imagesPerPage = $imagesPerPage;
		$this->imageDirURL = $imageDirURL;
		$this->imageDirPath = $imageDirPath;
		$this->thumbnailDirURL = $thumbnailDirURL;
		$this->thumbnailDirPath = $thumbnailDirPath;
		
	    parent::__construct($rootElementClass, $galleryDir, $action, $type);
	}
	
	public function init()
	{
        parent::init();

        if($this->imageDirURL != null)
        {
		    $script = $this->domDocument->createElementNS(self::namespaceURI, "script");	
		    $dummy_text = $this->domDocument->createTextNode(" ");
				
		    $script->setAttribute("type", "text/javascript");
		    $script->setAttribute("src", "/src/js/setup_lightbox2.js");	
		
		    $pageNumber = 0;
		    $sg = new SimpleGalleryImage($this->imagesPerPage, $this->imageDirURL, $this->imageDirPath, $this->thumbnailDirURL, $this->thumbnailDirPath);    	
        	foreach ($sg->generatePage($pageNumber) as $pageItem)
        	{
        		$imageInfo = pathinfo($pageItem["media"]);
        	
        		$a = $this->domDocument->createElementNS(self::namespaceURI, "a");
        		$img = $this->domDocument->createElementNS(self::namespaceURI, "img");	    		
        	
        		$a->setAttribute("href", str_replace(" ", "%20", $pageItem["media"]));
        		$a->setAttribute("rel", "lightbox[page".$pageNumber."]");
        		$a->setAttribute("title", $imageInfo["filename"]);
        		$a->setAttribute("class", "galleryPageItem");
        		$img->setAttribute("src", str_replace(" ", "%20", $pageItem["thumbnail"]));
        		$img->setAttribute("alt", $imageInfo["filename"]);
        		$img->setAttribute("class", "galleryThumb");
        	
        		$a->appendChild($img);
        		$this->domDocument->getElementById($this->galleryPageId)->appendChild($a);
        	}	
        	
        	$script->appendChild($dummy_text);
			
		    $this->domElement->appendChild($script);
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

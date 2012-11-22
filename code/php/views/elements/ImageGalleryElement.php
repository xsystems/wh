<?php	

require_once("GalleryElement.php");
require_once("../lib/SimpleImageGallery.php");

class ImageGalleryElement extends GalleryElement
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
		    $dummy_element = $this->domDocument->createElementNS(self::namespaceURI, "span");
				
		    $script->setAttribute("type", "text/javascript");
		    $script->setAttribute("src", "/code/js/setup_lightbox2.js");	
		
		    $pageNumber = 0;
		    $sg = new SimpleImageGallery($this->imagesPerPage, $this->imageDirURL, $this->imageDirPath, $this->thumbnailDirURL, $this->thumbnailDirPath);    	
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

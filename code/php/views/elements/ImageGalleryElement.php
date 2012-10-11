<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");
require_once("../lib/SimpleImageGallery.php");
require_once("../configuration/configuration.php");

class ImageGalleryElement implements ITemplateElement, ITemplateAttributes
{
	private $rootElementClass;
	private $imagesPerPage;
	private $imageDirPath;
	private $thumbnailDirPath;
	
	public function __construct($rootElementClass, $imagesPerPage, $imageDirPath, $thumbnailDirPath=null)
	{
		$this->rootElementClass = $rootElementClass;
		$this->imagesPerPage = $imagesPerPage;
		$this->imageDirPath = $imageDirPath;
		$this->thumbnailDirPath = $thumbnailDirPath;
	}

	public function createTemplateElement()
	{	
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$imageGalleryElement = $domDocument->createElementNS(self::namespaceURI, "div");		
		$content = $domDocument->createElementNS(self::namespaceURI, "div");	
		$page = $domDocument->createElementNS(self::namespaceURI, "div");
		$script = $domDocument->createElementNS(self::namespaceURI, "script");	
		$dummy_text = $domDocument->createTextNode(" ");
		$dummy_element = $domDocument->createElementNS(self::namespaceURI, "span");
				
		$imageGalleryElement->setAttribute("class", $this->rootElementClass);
		$content->setAttribute("class", "content");
		$page->setAttribute("class", "galleryPage justify-all-lines");	
		$script->setAttribute("type", "text/javascript");
		$script->setAttribute("src", Configuration::$ROOT_FOLDER."code/js/setup_lightbox2.js");	
		
		$pageNumber = 0;
		$sg = new SimpleImageGallery($this->imagesPerPage, $this->imageDirPath);    	
	    	foreach ($sg->generatePage($pageNumber) as $pageItem)
	    	{
	    		$imageInfo = pathinfo($pageItem["media"]);
	    	
	    		$a = $domDocument->createElementNS(self::namespaceURI, "a");
	    		$img = $domDocument->createElementNS(self::namespaceURI, "img");	    		
	    	
	    		$a->setAttribute("href", str_replace(" ", "%20", $pageItem["media"]));
	    		$a->setAttribute("rel", "lightbox[page".$pageNumber."]");
	    		$a->setAttribute("title", $imageInfo["filename"]);
	    		$a->setAttribute("class", "galleryPageItem");
	    		$img->setAttribute("src", str_replace(" ", "%20", $pageItem["thumbnail"]));
	    		$img->setAttribute("alt", $imageInfo["filename"]);
	    		$img->setAttribute("class", "galleryThumb");
	    	
	    		$a->appendChild($img);
	    		$page->appendChild($a);
	    	}	
	    	
	    	$dummy_element->appendChild($dummy_text);
	    	$content->appendChild($dummy_element);
	    	$script->appendChild($dummy_text->cloneNode());
			
		$imageGalleryElement->appendChild($content);	
		$imageGalleryElement->appendChild($page);
		$imageGalleryElement->appendChild($script);	
		
		return $imageGalleryElement;
	}
}
?>

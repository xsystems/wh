<?php	

require_once("ITemplateElement.php");
require_once("ITemplateAttributes.php");
require_once("../lib/SimpleVideoGallery.php");

class VideoGalleryElement implements ITemplateElement, ITemplateAttributes
{
	private $rootElementClass;
	private $itemsPerPage;
	private $screenshortSecond;
	private $videoDirURL;
	private $videoDirPath;
	private $thumbnailDirPath;
	
	public function __construct($rootElementClass, $itemsPerPage, $screenshortSecond, $videoDirURL, $videoDirPath, $thumbnailDirPath=null) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->itemsPerPage = $itemsPerPage;
		$this->screenshortSecond = $screenshortSecond;
		$this->videoDirURL = $videoDirURL;
		$this->videoDirPath = $videoDirPath;
		$this->thumbnailDirPath = $thumbnailDirPath;
	}

	public function createTemplateElement()
	{	
		$domDocument = new DOMDocument("1.0", "utf-8");
		$domDocument->validateOnParse = self::validateOnParse;
		
		$videoGalleryElement = $domDocument->createElementNS(self::namespaceURI, "div");		
		$content = $domDocument->createElementNS(self::namespaceURI, "div");	
		$page = $domDocument->createElementNS(self::namespaceURI, "div");
		$script = $domDocument->createElementNS(self::namespaceURI, "script");	
		$dummy_text = $domDocument->createTextNode(" ");
		$dummy_element = $domDocument->createElementNS(self::namespaceURI, "span");
		
		$videoGalleryElement->setAttribute("class", $this->rootElementClass);
		$content->setAttribute("class", "content");
		$page->setAttribute("class", "galleryPage justify-all-lines");	
		$script->setAttribute("type", "text/javascript");
		$script->setAttribute("src", "/code/js/setup_videojs.js");	
		
		$pageNumber = 0;
		$videoID = 0;
		$sg = new SimpleVideoGallery($this->itemsPerPage, $this->screenshortSecond, $this->videoDirURL, $this->videoDirPath);    	
	    	foreach ($sg->generatePage($pageNumber) as $pageItem)
	    	{
	    		$path_info = pathinfo($pageItem["media"]);
	    	
	    		$videoContainer = $domDocument->createElementNS(self::namespaceURI, "div");
	    		$video = $domDocument->createElementNS(self::namespaceURI, "video");
	    		$source = $domDocument->createElementNS(self::namespaceURI, "source");
	    		
	    		$videoContainer->setAttribute("class", "video_container galleryPageItem");
	    		$video->setAttribute("id", "video".$videoID);
	    		$video->setAttribute("class", "video-js vjs-default-skin");
//	    		$video->setAttribute("class", "video-js tubecss");
	    		$video->setAttribute("poster", str_replace(" ", "%20", $pageItem["thumbnail"]));
	    		
	    		$source->setAttribute("src", str_replace(" ", "%20", $pageItem["media"]));
	    		$source->setAttribute("type", "video/".$path_info["extension"]);
	    		
	    		$video->appendChild($source);
	    		$videoContainer->appendChild($video);
	    		$page->appendChild($videoContainer);
	    		
	    		$videoID++;
	    	}	
	    	
	    	$dummy_element->appendChild($dummy_text);	    	
	    	$content->appendChild($dummy_element);
	    	$script->appendChild($dummy_text->cloneNode());
			
		$videoGalleryElement->appendChild($content);	
		$videoGalleryElement->appendChild($page);
		$videoGalleryElement->appendChild($script);	
		
		return $videoGalleryElement;
	}
}
?>

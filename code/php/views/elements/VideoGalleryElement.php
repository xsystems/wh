<?php	

require_once("GalleryElement.php");
require_once("../lib/SimpleVideoGallery.php");

class VideoGalleryElement extends GalleryElement
{
	private $rootElementClass;
	private $itemsPerPage;
	private $screenshortSecond;
	private $videoDirURL;
	private $videoDirPath;
	private $thumbnailDirPath;
	
	public function __construct($rootElementClass, $galleryDir, $action, $type, $itemsPerPage, $screenshortSecond, $videoDirURL, $videoDirPath, $thumbnailDirPath=null) 
	{
		$this->rootElementClass = $rootElementClass;
		$this->itemsPerPage = $itemsPerPage;
		$this->screenshortSecond = $screenshortSecond;
		$this->videoDirURL = $videoDirURL;
		$this->videoDirPath = $videoDirPath;
		$this->thumbnailDirPath = $thumbnailDirPath;
		
        parent::__construct($rootElementClass, $galleryDir, $action, $type);
	}
	
	public function init()
	{		
	    parent::init();
	        
		$script = $this->domDocument->createElementNS(self::namespaceURI, "script");	
		$dummy_text = $this->domDocument->createTextNode(" ");
		$dummy_element = $this->domDocument->createElementNS(self::namespaceURI, "span");
		
		$script->setAttribute("type", "text/javascript");
		$script->setAttribute("src", "/code/js/setup_videojs.js");	
		
		$pageNumber = 0;
		$videoID = 0;
		$sg = new SimpleVideoGallery($this->itemsPerPage, $this->screenshortSecond, $this->videoDirURL, $this->videoDirPath);    	
    	foreach ($sg->generatePage($pageNumber) as $pageItem)
    	{
    		$path_info = pathinfo($pageItem["media"]);
    	
    		$videoContainer = $this->domDocument->createElementNS(self::namespaceURI, "div");
    		$video = $this->domDocument->createElementNS(self::namespaceURI, "video");
    		$source = $this->domDocument->createElementNS(self::namespaceURI, "source");
    		
    		$videoContainer->setAttribute("class", "video_container galleryPageItem");
    		$video->setAttribute("id", "video".$videoID);
    		$video->setAttribute("class", "video-js vjs-default-skin");
#	    	$video->setAttribute("class", "video-js tubecss");
    		$video->setAttribute("poster", str_replace(" ", "%20", $pageItem["thumbnail"]));
    		
    		$source->setAttribute("src", str_replace(" ", "%20", $pageItem["media"]));
    		$source->setAttribute("type", "video/".$path_info["extension"]);
    		
    		$video->appendChild($source);
    		$videoContainer->appendChild($video);
    		$this->domDocument->getElementById($this->galleryPageId)->appendChild($videoContainer);
    		
    		$videoID++;
    	}	
	    	
    	$script->appendChild($dummy_text);
			
		$this->domElement->appendChild($script);	
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

<?php

# Views
require_once("src/php/views/ViewDeWindhappers.php");
require_once("src/php/views/ViewElement.php");
require_once("src/php/views/ViewElementHome.php");
require_once("src/php/views/ViewElementDiscipline.php");
require_once("src/php/views/ViewElementGalleryClubMagazine.php");
require_once("src/php/views/ViewElementGalleryImage.php");
require_once("src/php/views/ViewElementGalleryVideo.php");
require_once("src/php/views/ViewElementVertel.php");
require_once("src/php/views/ViewElementBoodschap.php");
# Not used.
#require_once($this->configuration->documentRoot."/src/php/views/ViewElementShowIFrame.php");
#require_once($this->configuration->documentRoot."/src/php/views/ViewElementShowObject.php");

class ControllerView
{
    private $view;   
    
    private $configuration;
    
    private $gallery_items_per_page = null;
    private $gallery_screenshot_second = null;     
    private $gallery_path_clubmagazine = null;
    private $gallery_path_images = null;    
    private $gallery_path_videos = null;
    private $gallery_default_clubmagazine = null;   
    private $gallery_default_images = null;    
    private $gallery_default_videos = null;    

    public function __construct($configuration)
	{
	    $this->configuration = $configuration;
	
	    $this->gallery_items_per_page = $this->configuration->get("gallery", "gallery_items_per_page"); 	
	    $this->gallery_screenshot_second = $this->configuration->get("gallery", "gallery_screenshot_second"); 		    
	    $this->gallery_path_clubmagazine = $this->configuration->get("gallery", "gallery_path_clubmagazine"); 
        $this->gallery_path_images = $this->configuration->get("gallery", "gallery_path_images");	   
        $this->gallery_path_videos = $this->configuration->get("gallery", "gallery_path_videos");	    
        $this->gallery_default_clubmagazine = $this->configuration->get("gallery", "gallery_default_clubmagazine");	         
        $this->gallery_default_images = $this->configuration->get("gallery", "gallery_default_images");	         
        $this->gallery_default_videos = $this->configuration->get("gallery", "gallery_default_videos");	 
	
	    $this->view = new ViewDeWindhappers($this->configuration->getDatabase());
	}
	
	public function getView($action, $queryString)
	{
        switch($action){
		    case 'calendar':
	            $aViewElement = new ViewElement();
	            $aViewElement->addFragment(file_get_contents("content/fragments/fragment_calendar.htm"));
		    
			    $this->view->setBannerText("Activiteiten");	
        	    $this->view->init();			    	    
			    $this->view->add($aViewElement);			    		  
			    break;
		    case 'discipline':						    
	            $bannerImageURL = null;
	            switch ($queryString['name'])
	            {
	                case 'zee varen': 
	                    $bannerImageURL = "/content/banners/banner_seafarers_1.jpg";
	                    break;
	                case 'kanopolo': 
	                    $bannerImageURL = "/content/banners/banner_canoepolo.jpg";
	                    break;
	                case 'toervaren': 
	                    $bannerImageURL = "/content/banners/banner_cruising.jpg";
	                    break;	       
	                case 'wildwatervaren': 
	                    $bannerImageURL = "/content/banners/banner_whitewaterrafting.jpg";
	                    break;	 	             
	                case 'freestyle': 
	                    $bannerImageURL = "/content/banners/banner_freestyle.jpg";
	                    break;		                
                    default:
                        $bannerImageURL = "/content/banners/banner_default.jpg";;
                        break;
	            }
	            
			    $this->view->setBannerText("Discipline");
			    $this->view->setBannerImageUrl($bannerImageURL);
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementDiscipline($this->configuration->getDatabase(), $queryString['name'], "content discipline") );			    
			    break;
		    case 'gallery':
		        $protocolHttpHost =  $this->configuration->get("system", "system_protocol").$this->configuration->get("system", "system_http_host");
		        switch($queryString['type']){
		            case 'clubmagazine':	
        			    $this->view->setBannerText("Clubblad");                        
                        $this->view->init();        			    

                        $absoluteGalleryDir = $this->configuration->get("system", "system_document_root").$this->gallery_path_clubmagazine;

	                    //Default gallery. 		            		            
	                    $imageDirURL = $protocolHttpHost.$this->gallery_path_clubmagazine."/".$this->gallery_default_clubmagazine."/";
                        $imageDirPath = $absoluteGalleryDir."/".$this->gallery_default_clubmagazine."/";
		                if ( isset($queryString['gallery']) && !empty($queryString['gallery']) && $queryString['gallery'] != "")
		                {
                    	    $imageDirURL = $protocolHttpHost.$this->gallery_path_clubmagazine."/".$queryString['gallery']."/"; 
	                        $imageDirPath = $absoluteGalleryDir."/".$queryString['gallery']."/";		    
		                }	

		                $this->view->add( new ViewElementGalleryClubMagazine("", $absoluteGalleryDir, "gallery", "clubmagazine", $this->gallery_items_per_page, $imageDirURL, $imageDirPath) );			            
		                break;		        
		            case 'image':                        
        			    $this->view->setBannerText("Foto's");                        
                        $this->view->init(); 

                        $absoluteGalleryDir = $this->configuration->get("system", "system_document_root").$this->gallery_path_images;

	                    //Default gallery. 
                        $imageDirURL = $protocolHttpHost.$this->gallery_path_images."/".$this->gallery_default_images."/";
                        $imageDirPath = $absoluteGalleryDir."/".$this->gallery_default_images."/";
		                if ( isset($queryString['gallery']) && !empty($queryString['gallery']) && $queryString['gallery'] != "")
		                {
                    	    $imageDirURL = $protocolHttpHost.$this->gallery_path_images."/".$queryString['gallery']."/"; 
	                        $imageDirPath = $absoluteGalleryDir."/".$queryString['gallery']."/";		    
		                }

		                $this->view->add( new ViewElementGalleryImage("", $absoluteGalleryDir, "gallery", "image", $this->gallery_items_per_page, $imageDirURL, $imageDirPath) ); 			            
		                break;
		            case 'video':                  
        			    $this->view->setBannerText("Video's");                        
                        $this->view->init(); 
		
                        $absoluteGalleryDir = $this->configuration->get("system", "system_document_root").$this->gallery_path_videos;		
		
	                    // Default gallery.
	                    $videoDirURL = $protocolHttpHost.$this->gallery_path_videos."/".$this->gallery_default_videos."/";
                        $videoDirPath = $absoluteGalleryDir."/".$this->gallery_default_videos."/";		
		                if ( isset($queryString['gallery']) && !empty($queryString['gallery']) && $queryString['gallery'] != "")
		                {
		                    $videoDirURL = $protocolHttpHost.$this->gallery_path_videos."/".$queryString['gallery']."/";
			                $videoDirPath = $absoluteGalleryDir."/".$queryString['gallery']."/";
		                }	

                        $this->view->add( new ViewElementGalleryVideo("", $absoluteGalleryDir, "gallery", "video", $this->gallery_items_per_page, $this->gallery_screenshot_second, $videoDirURL, $videoDirPath) );
		                break;
		            default:
		                HomeView::write();
		                break;		      
		        }
			    break;
		    case 'vertel':
                $filename = "db/vertel.txt";		    
			    $this->view->setBannerText("Berichten");	
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementVertel("", $filename) );	
			    break;
		    case 'boodschap':
			    $this->view->setBannerText("Berichten");	
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementBoodschap("") );		    
			    break;
		    case 'bdsch_cntrl':
		        #TODO: Reimplement.
			    require_once("src/php/lib/bdsch-cntrl.php");
			    return;
			    break;			  
		    case 'bdsch_opsl':
		        #TODO: Reimplement.		    
			    require_once("src/php/lib/bdsch-opsl.php");
			    return;
			    break;	
		    case 'meteorology':
	            $aViewElement = new ViewElement();
	            $aViewElement->addFragment(file_get_contents("content/fragments/fragment_meteorology.htm"));
		    
			    $this->view->setBannerText("Meteorologie");	
        	    $this->view->init();			    	    
			    $this->view->add($aViewElement);
			    break;				    			      
		    case 'organisation':
	            $aViewElement = new ViewElement();
	            $aViewElement->addFragment(file_get_contents("content/fragments/fragment_organisation.htm"));
		    
			    $this->view->setBannerText("Organisatie");	
        	    $this->view->init();			    	    
			    $this->view->add($aViewElement);
			    break;	
		    case 'location':
	            $aViewElement = new ViewElement();
	            $aViewElement->addScript("/src/js/setup_map.js", "text/javascript");
	            $aViewElement->addFragment(file_get_contents("content/fragments/fragment_location.htm"));
		    
			    $this->view->setBannerText("Locatie");	
        	    $this->view->init();			    	    
			    $this->view->add($aViewElement);			    		  
			    break;	
		    case 'costs':
	            $aViewElement = new ViewElement();
	            $aViewElement->addFragment(file_get_contents("content/fragments/fragment_costs.htm"));
		    
			    $this->view->setBannerText("Kosten");	
        	    $this->view->init();			    	    
			    $this->view->add($aViewElement);
			    break;				    		    				
		    case 'canoetours':
	            $aViewElement = new ViewElement();
	            $aViewElement->addScript("/src/js/setup_lightbox2.js", "text/javascript");
	            $aViewElement->addFragment(file_get_contents("content/fragments/fragment_canoetours.htm"));
		    
			    $this->view->setBannerText("Kanoroutes");	
        	    $this->view->init();			    	    
			    $this->view->add($aViewElement);
			    break;	
		    case 'home_english':			    
	            $aViewElement = new ViewElementHome();
	            $aViewElement->addScript("/src/js/setup_lightbox2.js", "text/javascript");
	            $aViewElement->addFragment(file_get_contents("content/fragments/fragment_home_english.htm"));
		    
			    $this->view->setBannerText("Home English");	
        	    $this->view->init();			    	    
			    $this->view->add($aViewElement);			    
			    break;	
		    case 'home_german':			    
	            $aViewElement = new ViewElementHome();
	            $aViewElement->addScript("/src/js/setup_lightbox2.js", "text/javascript");
	            $aViewElement->addFragment(file_get_contents("content/fragments/fragment_home_german.htm"));
		    
			    $this->view->setBannerText("Home Deutsch");	
        	    $this->view->init();			    	    
			    $this->view->add($aViewElement);			    
			    break;
	        case 'iframe':
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementShowIFrame("iframe_pdf", $queryString['url']) );			    
			    break;
	        case 'object': 
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementShowObject("", $queryString['url'], $queryString['type'], $queryString['title']) );			    
			    break;				    														
		    default:
	            $aViewElement = new ViewElementHome();
	            $aViewElement->addScript("/src/js/setup_lightbox2.js", "text/javascript");
	            $aViewElement->addFragment(file_get_contents("content/fragments/fragment_home_dutch.htm"));
		    
			    $this->view->setBannerText("Home");	
        	    $this->view->init();			    	    
			    $this->view->add($aViewElement);
			    break;
	    }	
	    
	    if ( $this->view->isInitialized() )
	    {
            $domDocument = $this->view->create();
            //$domDocument->schemaValidate(DeWindhappersTemplate::schemaURI);  
                  
       		return $domDocument->saveXML();
	    }
	}	

	private function reload_page() {
	    header("Location: index.php");
	}
}	
	
//if(!userController::hasAcces($_SESSION['pid'])){		
//	stdhttpheaders::showForbidden();		
//}
	
/*
case 'login':
	$user_description = $_POST["user_description"];
	$user_password = $_POST["user_password"];

	if($_POST["button"] == "back"){		
		header('Location: http:/dewindhappers/views/home.view.php');		
	}elseif(empty($user_description)){
		header('Location: http:/dewindhappers/views/login.view.php');		
	}else{		
		$user = userController::getUserByDescription($user_description);
		if($user == false or $user->password != hash("sha256", $user_password)){
			header('Location: http:/dewindhappers/views/login.view.php');			
		}else{
			$_SESSION['pid'] = $user->id;									
			header("Location: /dewindhappers/views/home.view.php");					
		}
	}

	break;
case 'logout':
	$_SESSION['pid'] = NULL;
	reload_page();
	break;
*/
?>




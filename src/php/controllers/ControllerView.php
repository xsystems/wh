<?php

require('src/php/framework.php');	

class ControllerView
{
    private $view;   
    
    private $gallery_items_per_page = null;
    private $gallery_screenshot_second = null;     
    private $gallery_path_clubmagazine = null;
    private $gallery_path_images = null;    
    private $gallery_path_videos = null;
    private $gallery_default_clubmagazine = null;   
    private $gallery_default_images = null;    
    private $gallery_default_videos = null;    

    public function __construct()
	{
	    $this->gallery_items_per_page = Configuration::$CONFIG_SETTINGS["gallery"]["gallery_items_per_page"]; 	
	    $this->gallery_screenshot_second = Configuration::$CONFIG_SETTINGS["gallery"]["gallery_screenshot_second"]; 		    
	    $this->gallery_path_clubmagazine = Configuration::$CONFIG_SETTINGS["gallery"]["gallery_path_clubmagazine"]; 
        $this->gallery_path_images = Configuration::$CONFIG_SETTINGS["gallery"]["gallery_path_images"];	   
        $this->gallery_path_videos = Configuration::$CONFIG_SETTINGS["gallery"]["gallery_path_videos"];	    
        $this->gallery_default_clubmagazine = Configuration::$CONFIG_SETTINGS["gallery"]["gallery_default_clubmagazine"];	         
        $this->gallery_default_images = Configuration::$CONFIG_SETTINGS["gallery"]["gallery_default_images"];	         
        $this->gallery_default_videos = Configuration::$CONFIG_SETTINGS["gallery"]["gallery_default_videos"];	 
	
	    $this->view = new ViewDeWindhappers();
	}
	
	public function getView($action, $queryString)
	{
        switch($action){
		    case 'calendar':
			    $this->view->setBannerText("Activiteiten");	
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementCalendar("contentarea") );
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
			    $this->view->add( new ViewElementDiscipline("content discipline", $queryString['name']) );			    
			    break;
		    case 'gallery':
		        switch($queryString['type']){
		            case 'clubmagazine':	
        			    $this->view->setBannerText("Clubblad");                        
                        $this->view->init();        			    

                        $absoluteGalleryDir = Configuration::$DOCUMENT_ROOT.$this->gallery_path_clubmagazine;

	                    //Default gallery. 		            		            
	                    $imageDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST.$this->gallery_path_clubmagazine."/".$this->gallery_default_clubmagazine."/";
                        $imageDirPath = $absoluteGalleryDir."/".$this->gallery_default_clubmagazine."/";
		                if ( isset($queryString['gallery']) && !empty($queryString['gallery']) && $queryString['gallery'] != "")
		                {
                    	    $imageDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST.$this->gallery_path_clubmagazine."/".$queryString['gallery']."/"; 
	                        $imageDirPath = $absoluteGalleryDir."/".$queryString['gallery']."/";		    
		                }	

		                $this->view->add( new ViewElementGalleryClubMagazine("", $absoluteGalleryDir, "gallery", "clubmagazine", $this->gallery_items_per_page, $imageDirURL, $imageDirPath) );			            
		                break;		        
		            case 'image':                        
        			    $this->view->setBannerText("Foto's");                        
                        $this->view->init(); 

                        $absoluteGalleryDir = Configuration::$DOCUMENT_ROOT.$this->gallery_path_images;

	                    //Default gallery. 
                        $imageDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST.$this->gallery_path_images."/".$this->gallery_default_images."/";
                        $imageDirPath = $absoluteGalleryDir."/".$this->gallery_default_images."/";
		                if ( isset($queryString['gallery']) && !empty($queryString['gallery']) && $queryString['gallery'] != "")
		                {
                    	    $imageDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST.$this->gallery_path_images."/".$queryString['gallery']."/"; 
	                        $imageDirPath = $absoluteGalleryDir."/".$queryString['gallery']."/";		    
		                }

		                $this->view->add( new ViewElementGalleryImage("", $absoluteGalleryDir, "gallery", "image", $this->gallery_items_per_page, $imageDirURL, $imageDirPath) ); 			            
		                break;
		            case 'video':                  
        			    $this->view->setBannerText("Video's");                        
                        $this->view->init(); 
		
                        $absoluteGalleryDir = Configuration::$DOCUMENT_ROOT.$this->gallery_path_videos;		
		
	                    // Default gallery.
	                    $videoDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST.$this->gallery_path_videos."/".$this->gallery_default_videos."/";
                        $videoDirPath = $absoluteGalleryDir."/".$this->gallery_default_videos."/";		
		                if ( isset($queryString['gallery']) && !empty($queryString['gallery']) && $queryString['gallery'] != "")
		                {
		                    $videoDirURL = Configuration::$PROTOCOL.Configuration::$HTTP_HOST.$this->gallery_path_videos."/".$queryString['gallery']."/";
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
			    $this->view->add( new ViewElementBoodschap("contentarea") );		    
			    break;
		    case 'bdsch_cntrl':
			    require_once("src/php/lib/bdsch-cntrl.php");
			    return;
			    break;			  
		    case 'bdsch_opsl':
			    require_once("src/php/lib/bdsch-opsl.php");
			    return;
			    break;	
		    case 'meteorology':
			    $this->view->setBannerText("Meteorologie");	
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementMeteorology("contentarea") );
			    break;				    			      
		    case 'organisation':
			    $this->view->setBannerText("Organisatie");	
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementOrganisation("contentarea") );
			    break;	
		    case 'location':
			    $this->view->setBannerText("Locatie");	
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementLocation("contentarea") );
			    break;	
		    case 'costs':
			    $this->view->setBannerText("Kosten");	
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementCosts("") );
			    break;				    		    				
		    case 'canoetours':
			    $this->view->setBannerText("Kanoroutes");	
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementCanoetours("") );
			    break;	
		    case 'home_english':
			    $this->view->setBannerText("Home English");	
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementHomeEnglish("") );
			    break;	
		    case 'home_german':
			    $this->view->setBannerText("Home Deutsch");	
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementHomeGerman("") );
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
			    $this->view->setBannerText("Home");	
        	    $this->view->init();			    	    
			    $this->view->add( new ViewElementHome("") );
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




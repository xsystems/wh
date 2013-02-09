<?php
// Libs
require_once("lib/php/MobileDetect.php");

// Models
require_once("src/php/models/ModelDiscipline.php");
require_once("src/php/models/ModelSimpleGalleryPDF.php");
require_once("src/php/models/ModelSimpleGalleryImage.php");
require_once("src/php/models/ModelSimpleGalleryVideo.php");

// Views
require_once("src/php/views/View.php");


class ControllerView
{
    private $view;      
    private $configuration;
      
    public function __construct($configuration)
	{
	    $this->configuration = $configuration;
	}
	
	public function getView($action, $queryString)
	{
       // XHTML5 template.
        $view = new View();
        $view->title = "De Windhappers";
        $view->icon = "/content/logos/dewindhapperslogo.ico";
        $view->qualifiedName = View::qualifiedName;
        $view->publicId = View::publicId;
        $view->systemId = View::systemId;
        $view->namespaceURI = View::namespaceURI;
        
        $scriptURLs = array("/src/js/load.js");          
        $stylesheetURLs = array("/style/style.css");
	    $detect = new MobileDetect();
	    if ($detect->isMobile()){
            $stylesheetURLs[] = "/style/mobile.css";
        }
        else{
            $stylesheetURLs[] = "/style/not_mobile.css";            
        }
        $view->stylesheetURLs = $stylesheetURLs;
                
        // Opengraph tags template fragment.
        // TODO: Move data to configuration file.
        $view->openGraphTags = array(   array("name"=>"og:title", "value"=>"Kanovereniging De Windhappers"),
                                        array("name"=>"og:type", "value"=>"sport"),
                                        array("name"=>"og:url", "value"=>"http://wh.xsystems.org?action=home"),
                                        array("name"=>"og:image", "value"=>"http://wh.xsystems.org/content/dewindhapperslogo.gif"),
                                        array("name"=>"og:site_name", "value"=>"De Windhappers"),
                                        array("name"=>"fb:admins", "value"=>"100004774592111"),
                                        array("name"=>"og:description", "value"=>"A canoe club."));
        
        // Banner template fragment.
        $bannerText = $this->configuration->get("banner", "banner_default_text");        
        $bannerImageURL = $this->configuration->get("banner", "banner_default_background_image");
        $view->bannerLogoImageURL = $this->configuration->get("banner", "banner_logo_image");
        $view->bannerLogoText = $this->configuration->get("banner", "banner_logo_title");
        $view->bannerLogoURL = $this->configuration->get("banner", "banner_logo_url");
                
        // Mediabar template fragment.
        // TODO: Move data to configuration file.
        $view->mediaBarItems = array(   array("logo"=>"/content/logos/f_logo.png", "url"=>"http://www.facebook.com/pages/Kanovereniging-De-Windhappers/546877148674699", "title"=>"Facebook", "class"=>"media_item_social"),
                                        array("logo"=>"/content/logos/twitter-bird-dark-bgs.png", "url"=>"https://twitter.com/DeWindhappers", "title"=>"Twitter", "class"=>"media_item_social"),
                                        array("logo"=>"/content/icons/flags/flag-nl.png", "url"=>"?action=home", "title"=>"Nederlands", "class"=>"media_item_language"),                                    
                                        array("logo"=>"/content/icons/flags/flag-gb.png", "url"=>"?action=home_english", "title"=>"English", "class"=>"media_item_language"),
                                        array("logo"=>"/content/icons/flags/flag-de.png", "url"=>"?action=home_german", "title"=>"Deutsch", "class"=>"media_item_language") );
        
        // Menu template fragment.    
        $menuItemsSub = $this->configuration->get("menu", "menu_items_sub");
        $menuItemsUrl = $this->configuration->get("menu", "menu_items_url"); 
        $menuItemsSubDiscipline = "";
		foreach (Discipline::getNames($this->configuration->getDatabase()) as $name){
		    // Why is $name an array ?
		    $menuItemsSubDiscipline .= $name["name"].";";
			$menuItemsUrl[$name["name"]] = "?action=discipline&name=".urlencode($name["name"]);
    	}    
    	$menuItemsSub["Disciplines"] = $menuItemsSubDiscipline;
        $view->menuItemsSub = $menuItemsSub;
        $view->menuItemsUrl = $menuItemsUrl;
        $view->menuItems = $this->configuration->get("menu", "menu_items");
        $view->menuItemsClass = $this->configuration->get("menu", "menu_items_class");     
        	
        switch($action){
		    case 'calendar':			    
		        $bannerText = "Activiteiten";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_calendar.xhm");			    		    		  
			    break;
		    case 'discipline':	
                $scriptURLs[] = "/src/js/setup_lightbox2.js";
                // TODO: Move data to configuration file.
	            switch ($queryString['name']){
	                case 'zee varen': 
	                    $bannerImageURL = "/content/banners/banner_seafarers_1.jpg";
	                    $bannerText = "Zee Varen";	
	                    break;
	                case 'kanopolo': 
	                    $bannerImageURL = "/content/banners/banner_canoepolo.jpg";
	                    $bannerText = "Kanopolo";	
	                    break;
	                case 'toervaren': 
	                    $bannerImageURL = "/content/banners/banner_cruising.jpg";
	                    $bannerText = "Toervaren";	
	                    break;	       
	                case 'wildwatervaren': 
	                    $bannerImageURL = "/content/banners/banner_whitewaterrafting.jpg";
	                    $bannerText = "Wildwater varen";	
	                    break;	 	             
	                case 'freestyle': 
	                    $bannerImageURL = "/content/banners/banner_freestyle.jpg";
	                    $bannerText = "Freestyle";	
	                    break;	
	                case 'brandingvaren':
	                    $bannerText = "Brandingvaren";
	                    break;
                    default:
                        $bannerImageURL = "/content/banners/banner_default.jpg";
                        $bannerText = "Discipline";	
                        break;
	            }
	            
		        $discipline = Discipline::getByName($this->configuration->getDatabase(), $queryString['name']);		        
		        $imageFolder = $discipline->image_folder_location;	    		        
		        $disciplineImagesURL = array();
        		if($imageFolder){
			        $images = scandir($imageFolder);	
			        foreach ($images as $image){
				        if (!is_dir($image)){		
				            $disciplineImagesURL[] = array("name"=>$image, "url"=>$imageFolder."/".$image);
				        }
			        }
		        }
		        
                $view->disciplineName = $discipline->name;
		        $view->disciplineDescription = $this->replaceSpecialCharacters($discipline->description);
		        $view->disciplineImagesURL = $disciplineImagesURL;

                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_discipline.pxh");   
			    break;
		    case 'gallery':
		        $protocolHttpHost =  $this->configuration->get("system", "system_protocol").$this->configuration->get("system", "system_http_host");
		        $galleries_path = "";
		        $galleries_default = "";
		        $galleries_items_per_page = $this->configuration->get("galleries", "galleries_items_per_page");
		        $galleries_screenshot_second = $this->configuration->get("galleries", "galleries_screenshot_second");
		        
	            switch($queryString["type"]){
	                case 'clubmagazine':
	                    $galleries_path = $this->configuration->get("galleries", "galleries_path_clubmagazine");
	                    $galleries_default = $this->configuration->get("galleries", "galleries_default_clubmagazine");
	                    break;
	                case 'image':
	                    $scriptURLs[] = "/src/js/setup_lightbox2.js";
	                    $galleries_path = $this->configuration->get("galleries", "galleries_path_images");
	                    $galleries_default = $this->configuration->get("galleries", "galleries_default_images");
	                    break;
	                case 'video': 
	                    $scriptURLs[] = "/src/js/setup_videojs.js";
	                    $galleries_path = $this->configuration->get("galleries", "galleries_path_videos");
	                    $galleries_default = $this->configuration->get("galleries", "galleries_default_videos");
	                    break;
	                default:
	                    // TODO: Do something smart.
	                    break;
	            }
		        
		        $galleries_path_absolute = $this->configuration->get("system", "system_document_root").$galleries_path;
		        
                //Default gallery. 		    
                $bannerText = $galleries_default;        		            
                $gallery_url = $protocolHttpHost.$galleries_path."/".$galleries_default."/";
                $gallery_path_absolute = $galleries_path_absolute."/".$galleries_default."/";
                if ( isset($queryString['gallery']) && !empty($queryString['gallery']) && $queryString['gallery'] != ""){
                    $bannerText = $queryString['gallery'];
                    $gallery_url = $protocolHttpHost.$galleries_path."/".$queryString['gallery']."/"; 
                    $gallery_path_absolute = $galleries_path_absolute."/".$queryString['gallery']."/";		    
                }		        
                
		        $view->galleryAction = $action;
		        $view->galleryType = $queryString["type"];
                $view->galleryNames = $this->scandir_for_dirs($galleries_path_absolute); 		        
		        $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_gallery.pxh");
		        
                switch($queryString["type"]){
		            case 'clubmagazine':
    		            $pageNumber = 0;
		                $sg = new SimpleGalleryPDF($galleries_items_per_page, $gallery_url, $gallery_path_absolute, null, null); 	
                    	$view->galleryPageClubMagazine = $sg->generatePage($pageNumber);
                    	$actionTemplateFragments[] = array("gallery_page", "src/php/templates/template_fragment_gallery_clubmagazine.pxh");
                    	break;
                	case 'image': 
    		            $pageNumber = 0;
		                $sg = new SimpleGalleryImage($galleries_items_per_page, $gallery_url, $gallery_path_absolute, null, null); 	
                    	$view->galleryPageImage = $sg->generatePage($pageNumber);
                    	$actionTemplateFragments[] = array("gallery_page", "src/php/templates/template_fragment_gallery_image.pxh");                	
                	    break;
                	case 'video':
    		            $pageNumber = 0;
		                $sg = new SimpleGalleryVideo($galleries_items_per_page, $galleries_screenshot_second, $gallery_url, $gallery_path_absolute); 	
                    	$view->galleryPageVideo = $sg->generatePage($pageNumber);
                    	$actionTemplateFragments[] = array("gallery_page", "src/php/templates/template_fragment_gallery_video.pxh");                 	
                	    break;
                    default:
                        // TODO: Do something smart.
                    	break;
        	    }
			    break;
		    case 'vertel':	
		        // TODO: Reimplement.		    
                $filename = "db/vertel.txt";		    			    
                $messages = "";		
		        if(filesize($filename) > 0){
                    $file = fopen($filename, 'r');
                    $messages = fread($file, filesize($filename));         
                    fclose($file);      	
		        }			    
			    
                $bannerText = "Berichten";
                $view->messages = $messages;
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_messages_read.pxh");				    
			    break;
		    case 'boodschap':
                $messagesName = "";
                $messagesEmail = "";
                $messagesTelf = "";
                $messagesOnderw = "";
                $messagesVerhaal = " ";
                if( isset($_POST['naam']) ){
                    $messagesName = $_POST['naam'];
                    $messagesEmail = $_POST['email'];
                    $messagesTelf = $_POST['telf'];
                    $messagesOnderw = $_POST['onderw'];
                    $messagesVerhaal = $_POST['verhaal'];
                }		    

                $view->messagesName = $messagesName;
                $view->messagesEmail = $messagesEmail;
                $view->messagesTelf = $messagesTelf;
                $view->messagesOnderw = $messagesOnderw;
                $view->messagesVerhaal = $messagesVerhaal;
                $bannerText = "Berichten";                
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_messages_write.pxh");
			    break;
		    case 'bdsch_cntrl':
		        // TODO: Reimplement.
			    require_once("src/php/lib/bdsch-cntrl.php");
			    return;
			    break;			  
		    case 'bdsch_opsl':
		        // TODO: Reimplement.		    
			    require_once("src/php/lib/bdsch-opsl.php");
			    return;
			    break;	
		    case 'meteorology':			    
		        $bannerText = "Meteorologie";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_meteorology.xhm");				    
			    break;				    			      
		    case 'organisation':
		        $bannerText = "Organisatie";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_organisation.xhm");			    
			    break;	
		    case 'location':			    
		        $scriptURLs[] = "/src/js/setup_map.js";
		        $bannerText = "Locatie";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_location.xhm");				    		    		  
			    break;	
		    case 'costs':
		        $bannerText = "Kosten";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_costs.xhm");			    
			    break;				    		    				
		    case 'canoetours':
		        $scriptURLs[] = "/src/js/setup_lightbox2.js";
		        $bannerText = "Kanoroutes";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_canoetours.xhm");
			    break;	
		    case 'home_english':			    
		        $scriptURLs[] = "/src/js/setup_lightbox2.js";
		        $bannerText = "Home English";
		        $bannerImageURL = "/content/banners/banner_home.jpg";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_home_english.xhm");
			    break;	
		    case 'home_german':			    
		        $scriptURLs[] = "/src/js/setup_lightbox2.js";
		        $bannerText = "Home Deutsch";
		        $bannerImageURL = "/content/banners/banner_home.jpg";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_home_german.xhm");
			    break;		    														
		    default:
		        $scriptURLs[] = "/src/js/setup_lightbox2.js";
		        $bannerText = "Home";
		        $bannerImageURL = "/content/banners/banner_home.jpg";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_home_dutch.xhm");
			    break;
	    }

        $view->scriptURLs = $scriptURLs;
        $view->bannerText = $bannerText;
        $view->bannerImageURL = $bannerImageURL; 
        
        $view->load("src/php/templates/template_xhtml5.pxh");  
        $view->add("head", "src/php/templates/template_fragment_opengraph_tags.pxh");   
        $view->add("main", "src/php/templates/template_fragment_banner.pxh");   
        $view->add("banner", "src/php/templates/template_fragment_mediabar.pxh");  
        $view->add("main", "src/php/templates/template_fragment_menu.pxh");        
        if(count($actionTemplateFragments) > 0){
            foreach($actionTemplateFragments as $actionTemplateFragment){
                $view->add($actionTemplateFragment[0], $actionTemplateFragment[1]); 
            }       
        }
        $view->add("main", "src/php/templates/template_fragment_footer.xhm");                          

        return $view->save();
	}	
	
	private function scandir_for_dirs($dir)
	{	
		$dirs = array();
		$filesAndDirs = scandir($dir);
		
		foreach ($filesAndDirs as $fileOrDir){
			if( is_dir($dir."/".$fileOrDir)  && $fileOrDir[0] != "." ){
				$dirs[] = $fileOrDir;
			}
		}	
		
		return $dirs;
	}
	
	private function replaceSpecialCharacters($str)
	{
        $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
        $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
        return str_replace($search, $replace, $str);
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




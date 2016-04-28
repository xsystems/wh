<?php
// Libs
require_once("lib/php/MobileDetect.php");

// Models
require_once("src/php/models/ModelMenu.php");
require_once("src/php/models/ModelDisciplines.php");
require_once("src/php/models/ModelSimpleGalleryPDF.php");
require_once("src/php/models/ModelSimpleGalleryImage.php");
require_once("src/php/models/ModelSimpleGalleryVideo.php");

// Views
require_once("src/php/views/View.php");

// Controllers
require_once("src/php/controllers/ControllerNews.php");


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
        $stylesheetURLs = array("/css/style.css");
        $importURLs = array();
	    $detect = new MobileDetect();
	    if ($detect->isMobile()){
            $stylesheetURLs[] = "/css/mobile.css";
        }
        else{
            $stylesheetURLs[] = "/css/not_mobile.css";            
        }
                
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
        $menu = new Menu("data/dewindhappers.xml", "xsl/dewindhappers.xsl");        
        $view->menu = $menu->getMenu();
        
        $disciplines = new Disciplines("data/dewindhappers.xml", "xsl/dewindhappers.xsl");
        $view->disciplineMenu = $disciplines->getMenu();     
        
        $controllerNews = new ControllerNews("data/dewindhappers.xml", "xsl/dewindhappers.xsl");        
        	
        // Choose template correspinding to the action.	
        switch($action){
		    case 'calendar':			    
		        $bannerText = "Kalender";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_calendar.xhm");			    		    		  
			    break;
		    case 'discipline':	
                $scriptURLs[] = "/lib/js/lightbox/js/jquery-1.10.2.min.js";
                $scriptURLs[] = "/lib/js/lightbox/js/lightbox-2.6.min.js";
                $stylesheetURLs[] = "/lib/js/lightbox/css/lightbox.css";
                // TODO: Move data to configuration file.
	            switch ($queryString['name']){
	                case 'Zeevaren': 
	                    $bannerImageURL = "/content/banners/banner_seafarers_1.jpg";
	                    $bannerText = "Zeevaren";	
	                    break;
	                case 'Kanopolo': 
	                    $bannerImageURL = "/content/banners/banner_canoepolo.jpg";
	                    $bannerText = "Kanopolo";	
	                    break;
	                case 'Toervaren': 
	                    $bannerImageURL = "/content/banners/banner_cruising.jpg";
	                    $bannerText = "Toervaren";	
	                    break;	       
	                case 'Wildwatervaren': 
	                    $bannerImageURL = "/content/banners/banner_whitewaterrafting.jpg";
	                    $bannerText = "Wildwatervaren";	
	                    break;	 	             
	                case 'Freestyle': 
	                    $bannerImageURL = "/content/banners/banner_freestyle.jpg";
	                    $bannerText = "Freestyle";	
	                    break;	
	                case 'Brandingvaren':
	                    $bannerImageURL = "/content/banners/banner_brandingvaren.jpg";	                
	                    $bannerText = "Brandingvaren";
	                    break;
                    default:
                        $bannerImageURL = "/content/banners/banner_default.jpg";
                        $bannerText = "Discipline";	
                        break;
	            }    	          

                $view->discipline = $discipline = $disciplines->getByName($queryString['name']);

                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_discipline.pxh");   
			    break;
		    case 'gallery':
		        $protocolHttpHost =  $this->configuration->get("system", "system_protocol").$this->configuration->get("system", "system_http_host");
		        $galleries_path = "";
		        $galleries_default = "";
		        $galleries_items_per_page = $this->configuration->get("galleries", "galleries_items_per_page");
		        $galleries_screenshot_second = $this->configuration->get("galleries", "galleries_screenshot_second");
		        
	            switch($queryString["type"]){
#	                case 'clubmagazine':
#	                    $galleries_path = $this->configuration->get("galleries", "galleries_path_clubmagazine");
#	                    break;
	                case 'image':
	                    $scriptURLs[] = "/lib/js/lightbox/js/jquery-1.10.2.min.js";
	                    $scriptURLs[] = "/lib/js/lightbox/js/lightbox-2.6.min.js";
                        $stylesheetURLs[] = "/lib/js/lightbox/css/lightbox.css";
	                    $galleries_path = $this->configuration->get("galleries", "galleries_path_images");
	                    break;
	                case 'video': 
	                    $scriptURLs[] = "/src/js/setup_videojs.js";
	                    $galleries_path = $this->configuration->get("galleries", "galleries_path_videos");
	                    break;
	                default:
	                    // TODO: Do something smart.
	                    break;
	            }
		        
		        $galleries_path_absolute = $this->configuration->get("system", "system_document_root").$galleries_path;
		        $galleryNames = array_reverse($this->scandir_for_dirs($galleries_path_absolute));
                $galleries_default =  reset($galleryNames);

                //Default gallery. 		    
                $gallery_name = $galleries_default;
                $gallery_url = $protocolHttpHost.$galleries_path."/".$galleries_default."/";
                $gallery_path_absolute = $galleries_path_absolute."/".$galleries_default."/";
                if ( isset($queryString['gallery']) && !empty($queryString['gallery']) && $queryString['gallery'] != ""){
                    $gallery_name = $queryString['gallery'];
                    $gallery_url = $protocolHttpHost.$galleries_path."/".$queryString['gallery']."/"; 
                    $gallery_path_absolute = $galleries_path_absolute."/".$queryString['gallery']."/";		    
                }		        

                $gallery_name_split = preg_split("/ /", $gallery_name, 2);
                $bannerText = $gallery_name_split[1];
                
		        $view->galleryAction = $action;
		        $view->galleryType = $queryString["type"];
                $view->galleryNames = $galleryNames;
		        $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_gallery.pxh");
		        
                switch($queryString["type"]){
		            case 'clubmagazine':
                        $bannerImageURL = "/content/banners/banner_clubmagazine.jpg";		            
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
                        $actionTemplateFragments[] = array("gallery_alerts", "src/php/templates/template_fragment_gallery_image_alerts.xhm");
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
                $filename = "data/vertel.txt";		    			    
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
		    case 'prospect':
	            //TODO: This needs to be moved.		        		    
		        if(isset($_GET["register"]) && $_GET["register"] == "true")
		        {
		            $headers  = "From: " . $_POST["email"] . "\r\n";
                    $headers  = "Reply-To: " . $_POST["email"] . "\r\n";
                    $headers .= "X-Mailer: PHP/" . phpversion();
                    
                    $message  = "[Windhappers lidmaatschap aanvraag]" . "\r\n";  
                    $message .= "\r\n";                                                             
                    $message .= "Voornaam: " . $_POST["firstname"] . "\r\n";
                    $message .= "Achternaam: " . $_POST["lastname"] . "\r\n";
                    $message .= "Telefoonnummer: " . $_POST["phone"] . "\r\n";
                    $message .= "Email: " . $_POST["email"] . "\r\n";
                    $message .= "\r\n";     
                    $message .= $_POST["text"];              
      
                    $message = wordwrap($message, 70, "\r\n");
                    
		            mail("windhapperledenadministratie@ziggo.nl", "[Windhappers] Lidmaatschap aanvraag",  $message, $headers );
		        }
		        		    
		        $bannerText = "Nieuwe Leden";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_prospect.xhm");			    
			    break;				    				    			      
		    case 'organisation':
	            //TODO: This needs to be moved.		        		    
		        if(isset($_GET["contact"]) && $_GET["contact"] == "true")
		        {
		            $headers  = "From: " . $_POST["email"] . "\r\n";
                    $headers  = "Reply-To: " . $_POST["email"] . "\r\n";
                    $headers .= "X-Mailer: PHP/" . phpversion();
                    
                    $message  = "[Windhappers website contact bericht]" . "\r\n";
                    $message .= "\r\n";         
                    $message .= "Onderwerp: " . $_POST["subject"] . "\r\n";    
                    $message .= "\r\n";                                                             
                    $message .= "Voornaam: " . $_POST["firstname"] . "\r\n";
                    $message .= "Achternaam: " . $_POST["lastname"] . "\r\n";
                    $message .= "Telefoonnummer: " . $_POST["phone"] . "\r\n";
                    $message .= "Email: " . $_POST["email"] . "\r\n";                    
                    $message .= "\r\n";     
                    $message .= $_POST["text"];

                    $message = wordwrap($message, 70, "\r\n");
                    
		            mail($_POST["to"], "[Windhappers] " . $_POST["subject"],  $message, $headers );
		        }
		        
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
		    case 'sponsors':
		        $bannerText = "Sponsoren";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_sponsors.xhm");			    
			    break;				    		    		    				
		    case 'canoetours':
                $scriptURLs[] = "/lib/js/lightbox/js/jquery-1.10.2.min.js";
                $scriptURLs[] = "/lib/js/lightbox/js/lightbox-2.6.min.js";
                $stylesheetURLs[] = "/lib/js/lightbox/css/lightbox.css";		        
		        $bannerText = "Kanoroutes";
                $bannerImageURL = "/content/banners/banner_canoetours.jpg";		            		        
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_canoetours.xhm");
			    break;	
		    case 'home_english':			    
                $scriptURLs[] = "/lib/js/lightbox/js/jquery-1.10.2.min.js";
                $scriptURLs[] = "/lib/js/lightbox/js/lightbox-2.6.min.js";
                $stylesheetURLs[] = "/lib/js/lightbox/css/lightbox.css";
		        $bannerText = "Home English";
		        $bannerImageURL = "/content/banners/banner_home.jpg";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_home_english.xhm");
			    break;	
		    case 'home_german':			    
                $scriptURLs[] = "/lib/js/lightbox/js/jquery-1.10.2.min.js";
                $scriptURLs[] = "/lib/js/lightbox/js/lightbox-2.6.min.js";
                $stylesheetURLs[] = "/lib/js/lightbox/css/lightbox.css";
		        $bannerText = "Home Deutsch";
		        $bannerImageURL = "/content/banners/banner_home.jpg";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_home_german.xhm");
			    break;	
		    case 'news':	
                $scriptURLs[] = "/lib/js/lightbox/js/jquery-1.10.2.min.js";
                $scriptURLs[] = "/lib/js/lightbox/js/lightbox-2.6.min.js";
                $stylesheetURLs[] = "/lib/js/lightbox/css/lightbox.css";		    		    
		        $bannerText = "Nieuws";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_news.pxh");

                $view->news = $controllerNews->getAllArticles();
			    break;				    	    														
		    default:
                $scriptURLs[] = "/lib/js/lightbox/js/jquery-1.10.2.min.js";
                $scriptURLs[] = "/lib/js/lightbox/js/lightbox-2.6.min.js";
                $scriptURLs[] = "bower_components/webcomponentsjs/webcomponents-lite.js";
                $stylesheetURLs[] = "/lib/js/lightbox/css/lightbox.css";
                $importURLs[] = "elements/elements.html";
		        $bannerText = "Home";
		        $bannerImageURL = "/content/banners/banner_home.jpg";
                $actionTemplateFragments[] = array("main", "src/php/templates/template_fragment_home_dutch.pxh");
                
                $positionEnd = $controllerNews->countArticles();
                if($positionEnd > 3){
                    $positionEnd = 3;
                }
                
                $view->newsAbstracts = $controllerNews->getRangeOfArticleAbstracts(0,$positionEnd);                
			    break;
	    }
	    
	    // If the bannerText is larger then it will go to a new line.
	    if(strlen($bannerText) > 20){
	        $bannerText = substr($bannerText, 0, 20);
	    }

        $view->stylesheetURLs = $stylesheetURLs;
        $view->scriptURLs = $scriptURLs;
        $view->importURLs = $importURLs;
        $view->bannerText = $bannerText;
        $view->bannerImageURL = $bannerImageURL; 
        
        $view->load("src/php/templates/template_xhtml5.pxh");  
        $view->add("head", "src/php/templates/template_fragment_opengraph_tags.pxh");   
        $view->add("main", "src/php/templates/template_fragment_banner.pxh");   
        $view->add("banner", "src/php/templates/template_fragment_mediabar.pxh");  
        $view->add("main", "src/php/templates/template_fragment_menu.pxh");  
        $view->add("disciplineMenu", "src/php/templates/template_fragment_menu_discipline.pxh");                      
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




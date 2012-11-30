<?php
	require('../configuration/framework.php');	

	switch($_GET['action']){
		case 'home':
			HomeView::write();
			break;
		case 'calendar':
			CalendarView::write();
			break;
		case 'discipline':			
			DisciplineView::write($_GET['name']);
			break;
		case 'location':
			LocationView::write();
			break;
		case 'gallery':
		    switch($_GET['type']){
		        case 'image':
        			if (isset($_GET['gallery']))
			        {
				        ImageGalleryView::write($_GET['gallery']);
			        }
			        else
			        {
				        ImageGalleryView::write("");
			        }
		            break;
		        case 'video':
        			if (isset($_GET['gallery']))
			        {
				        VideoGalleryView::write($_GET['gallery']);
			        }
			        else
			        {
				        VideoGalleryView::write("");
			        }
		            break;
		        case 'clubmagazine':
        			if (isset($_GET['gallery']))
			        {
				        ClubMagazineGalleryView::write($_GET['gallery']);
			        }
			        else
			        {
				        ClubMagazineGalleryView::write("");
			        }
		            break;
		        default:
		            HomeView::write();
		            break;		      
		    }
			break;
		case 'vertel':
			VertelView::write();
			break;
		case 'boodschap':
			BoodschapView::write();
			break;
		case 'costs':
			CostsView::write();
			break;	
		case 'organisation':
			OrganisationView::write();
			break;		
	    case 'iframe':
			IFrameView::write($_GET['url']);
			break;
		case 'meteorology':
			MeteorologyView::write();
			break;							
		default:
			HomeView::write();
			break;
	}

	function reload_page() {
		header("Location: view.controller.php");
	}
	
	
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




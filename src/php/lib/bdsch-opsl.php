<?php
    include_once('src/php/lib/wh-functies.inc.php');

    $filename = "data/vertel.txt"; 

    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $telf = $_POST['telf'];
    $onderw = $_POST['onderw'];
    $verhaal = $_POST['verhaal'];

    $contact = $telf;
    if(strlen($telf) > 0 && strlen($email) > 0)
    {
        $contact .= " - ";
    }   
    
    if(strlen($email) > 0)
    {
        $contact .= "<a href='mailto:$email'>$email</a>";	
    }     

    $date = date('Y-m-d');

    $inhoud  = "<section>";
    $inhoud .= "<h2>$onderw</h2>";
    $inhoud .= "<em><time datetime='$date'>$date</time></em> <br/> <br/>";
    $inhoud .= "<p>$verhaal</p> <br/>";
    $inhoud .= "<em>$naam</em> <br/>";
    
    if(strlen($contact) > 0)
    {
        $inhoud .= "<em>$contact</em> <br/>";
    }
    
    $inhoud .= "</section>";
    $inhoud .= urldecode("%0A");

	if(filesize($filename) > 0)
	{
        $file = fopen($filename, 'r');
        $inhoud_old = fread($file, filesize($filename));         
        fclose($file);	
        $inhoud = $inhoud.$inhoud_old;	
	}  
	    
    $file = fopen($filename, 'r+');
    fwrite($file, $inhoud);
    fclose($file);
    
    header("Location: ?action=vertel");
?>


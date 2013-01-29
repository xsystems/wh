<?php 
// +----------------------------------------+
// | Deze functie controleert of een string |
// | de vorm van een een e-mailadres heeft. |
// +----------------------------------------+
function is_email($emailadres)
{
    // Eerst een snelle controle uitvoeren: 
    // een e-mailadres moet uit minimaal 7 tekens bestaan:
    if (strlen($emailadres) < 7) {
        return false;
    }
    // Daarna een controle met een reguliere expressie uitvoeren:
    if (ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})$", $emailadres)) {
        return true;
    } else {
        return false;
    }
}
//	+-----------------------------------------------+
//	| Deze functie zuivert een string van elementen |
//  | die de pagina kunnen misvormen                |
//	+-----------------------------------------------+
function zuiver($tekst){
	$voor = '"' ;
	$na = "&quot;";
	$tekst = str_replace($voor, $na, $tekst);
	$voor = "'" ;
	$na = "`";
	$tekst = str_replace($voor, $na, $tekst);
	$tekst = strip_tags($tekst);
	$tekst = stripslashes($tekst);
	$tekst = htmlentities($tekst);
	return $tekst;
	}

//	+-----------------------------------------------+
//	| Deze functie schrijft een "INSERT" comando    |
//  | naar bestand vertel.txt                       |
//	+-----------------------------------------------+
function reg_bezoek($naam, $contact, $onderw, $verhaal)
{ 
$bestandsnaam = "vertel.txt"; 

$inhoud  = "<p>";
$inhoud .= date ('d m Y');
$inhoud .= "   ";
$inhoud .= $naam;
$inhoud .= "<br>";
$inhoud .= $onderw;
$inhoud .= "<br>";
$inhoud .= $verhaal;
$inhoud .= "<br>";
$inhoud .= $contact;
$inhoud .= "<br></p>";


if (is_writable($bestandsnaam)) { 
   if (!$open = fopen($bestandsnaam, 'r+')) { 
         echo "Kan het bestand niet openen"; 
         exit; 
   } 
   if (!fwrite($open, $inhoud)) 
  { 
       echo "Er is iets misgegaan met het schrijven"; 
       exit; 
   } 
   fclose($open);                
} 
else 
{ 
   $open = fopen($bestandsnaam, 'r+');
   $logold = file_get_contents($bestandsnaam );
   $lognew = $inhoud;
   $lognew .= $logold;
   fwrite($open, $lognew);
   fclose($open);
} 
}


//	+------------------------------------------+
//	| Deze functie geeft het aantal cyfers     |
//  | in een string.                           |
//	+------------------------------------------+	
function tel_cyf($telstr)
{
$tel = 0;  
$i = 0; 
$len = strlen($telstr);
while($i < $len)
	{
	$kr = substr($telstr, $i, 1); 
    if(is_numeric($kr)) 
		{ 
		$tel ++; 
		} 
	$i ++;
	}
return $tel;
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
include_once('wh-functies.inc.php');

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
$contact .= "<a href='mailto:$email'>$email</a>";	

$date = date('Y-m-d');

$bestandsnaam = "../../../db/vertel.txt"; 

$inhoud  = "<section>";
$inhoud .= "<h2>$onderw</h2>";
$inhoud .= "<em>$date</em> <br/> <br/>";
$inhoud .= "<p>$verhaal</p> <br/>";
$inhoud .= "<em>$naam</em> <br/>";
$inhoud .= "<em>$contact</em> <br/>";
$inhoud .= "</section>";
$inhoud .= urldecode("%0A");

$open = fopen($bestandsnaam, 'r');
$logold = "";
while (!feof ($open)) { 
    $logold .= fgets($open); 
}
fclose($open);
$lognew = $inhoud.$logold;
$open = fopen($bestandsnaam, 'r+');
fwrite($open, $lognew);
fclose($open);

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
}
-->
</style>
</head>

<body>


<form action="/code/php/controllers/view.controller.php?action=vertel" method="post">
<input name="naam" type="hidden" value="<?php echo $naam; ?>" />
<input name="email" type="hidden" value="<?php echo $email; ?>" />
<input name="telf" type="hidden" value="<?php echo $telf; ?>" />    
<input name="onderw" type="hidden" value="<?php echo $onderw; ?>">
<input name="verhaal" type="hidden" value="<?php echo $verhaal; ?>">
</form>
<?php echo "<script type=\"text/javascript\" language=\"JavaScript\">
	javascript:document.forms[0].submit()
	</script>;" ?> 
</body>
</html>

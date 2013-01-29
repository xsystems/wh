<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
include_once('wh-functies.inc.php');

$naam = $_POST['naam'];
$email = $_POST['email'];
$telf = $_POST['telf'];
$onderw = $_POST['onderw'];
	$onderw = zuiver($onderw);
$verhaal = $_POST['verhaal'];
	$verhaal = zuiver($verhaal);
	
$verh_len = strlen($verhaal);
$verh_max = 1000;
$verh_prc = ($verh_len / $verh_max * 100) - 100;

$rap = "";
	if (strlen($naam) < 2){$rap .= "Vul je naam in.<br>";};
	if ((is_email($email) == false) AND (strlen($email) > 0)){$rap .= "Het E-mail adres heeft een verkeerde structuur. <br>";};
	if ((strlen($telf) < 1) AND (strlen($email) < 1)){$rap .= "Vul je E-mail adres of telefoonnummer in <br>";};
	if ((tel_cyf($telf) < 10) AND (strlen($telf) > 0)){$rap .= "Telefoonnummer minder dan 10 cijfers <br>";};
	if (strlen($onderw) < 2){$rap .= "Vul je onderwerp in.<br>";};
	if ($verh_len < 5){$rap .= "Je verhaal is te kort.<br>";};
	if ($verh_len > $verh_max){$rap .= "Je verhaal is " . $verh_prc . " procent te lang.<br>";};
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
<h3>
<?php
IF (strlen($rap) > 3)
	{$ga_naar = "/code/php/lib/boodschap.php";
	 echo "Er zijn fouten gevonden!<br><br>";
	 echo $rap;
	 }
ELSE
	{$ga_naar = "/code/php/lib/bdsch-opsl.php";
	echo "Geen fouten gevonden. <br>";
}
?>
</h3>

<form action="<?php echo $ga_naar; ?>" method="post">
<input name="naam" type="hidden" value="<?php echo $naam; ?>" />
<input name="email" type="hidden" value="<?php echo $email; ?>" />
<input name="telf" type="hidden" value="<?php echo $telf; ?>" />    
<input name="onderw" type="hidden" value="<?php echo $onderw; ?>">
<input name="verhaal" type="hidden" value="<?php echo $verhaal; ?>">
<input name="submit" type="submit" value="Ga door">
</form>
</body>
</html>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<?php

$naam = "";
$email = "";
$telf = "";
$onderw = "";
$verhaal = "";

if (isset($_POST['naam']))
{
$naam = $_POST['naam'];
$email = $_POST['email'];
$telf = $_POST['telf'];
$onderw = $_POST['onderw'];
$verhaal = $_POST['verhaal'];
}
?>
<style type="text/css">
<!--
.style1 {font-size: 9px}
-->
</style>
</head>

<body>
<form action="/code/php/lib/bdsch-cntrl.php" method="post">
<table width="400" border="0">
  <tr>
  	<td>Naam</td>
    <td><input name="naam" type="text" size="40" maxlength="50" value="<?php echo $naam; ?>"></td>
  </tr>
  <tr>
  	<td>E-mail adres</td>
    <td><input name="email" type="text" size="60" maxlength="60" value="<?php echo $email; ?>"></td>
  </tr>
  <tr>
  	<td>of telefoon</td>
    <td><input name="telf" type="text" size="15" maxlength="20" value="<?php echo $telf; ?>"></td>
  </tr>
  <tr>
  	<td>Onderwerp</td>
    <td><input name="onderw" type="text" size="80" maxlength="80" value="<?php echo $onderw; ?>"></td>
  </tr>
  <tr>
  	<td valign="top">Verhaal<br>
  	  <span class="style1">(max 1000 tekens.)</span> </td>
    <td><textarea name="verhaal" cols="80" rows="6" ><?php echo $verhaal; ?></textarea></td>
  </tr>
  <tr>
    <td><input name="submit" type="submit" value="toevoegen"></td>
    <td><input name="reset" type="reset" value="leegmaken"></td>
  </tr>
</table>

</form>
</body>
</html>

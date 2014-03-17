<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Boodschap Controle</title>
    
    <?php
        include_once('wh-functies.inc.php');
        require_once('lib/php/recaptcha-php-1.11/recaptchalib.php');
        $privatekey = "6Lc_vu8SAAAAABx6tdRIzRuKT0WUOoI2Ikp-zrQb";
        
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
                
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        $rap = "";
        
        // What happens when the CAPTCHA was entered incorrectly
        if (!$resp->is_valid) {$rap .= "De CAPTCHA is incorrect ingevuld. <br/>";};
        if (strlen($naam) < 2){ $rap .= "Vul je naam in. <br>"; };
        if ((strlen($email) > 0) && (is_email($email) == false)){ $rap .= "Het E-mail adres heeft een verkeerde structuur. <br/>"; };
    #	if ((strlen($telf) < 1) && (strlen($email) < 1)){ $rap .= "Vul je E-mail adres of telefoonnummer in. <br/>"; };
        if ((strlen($telf) > 0) && (tel_cyf($telf) < 10)){ $rap .= "Het telefoonnummer heeft minder dan 10 cijfers. <br/>"; };
        if (strlen($onderw) < 2){ $rap .= "Vul je onderwerp in. <br/>"; };
        if ($verh_len < 5){ $rap .= "Je verhaal is te kort. <br/>"; };
        if ($verh_len > $verh_max){ $rap .= "Je verhaal is " . $verh_prc . " procent te lang. <br/>"; };
    ?>


</head>

<body>
<h3>
    <?php
    if (strlen($rap) > 3)
    {
        $ga_naar = "?action=boodschap";
        echo "Er zijn fouten gevonden!<br><br>";
        echo $rap;
    }
    else
    {
        $ga_naar = "?action=bdsch_opsl";
        echo "Geen fouten gevonden. <br>";
    }
    ?>
</h3>

<form action="<?php echo $ga_naar; ?>" method="post">
    <input name="naam" type="hidden" value="<?php echo $naam; ?>" />
    <input name="email" type="hidden" value="<?php echo $email; ?>" />
    <input name="telf" type="hidden" value="<?php echo $telf; ?>" />    
    <input name="onderw" type="hidden" value="<?php echo $onderw; ?>"/>
    <input name="verhaal" type="hidden" value="<?php echo $verhaal; ?>"/>
    <input name="submit" type="submit" value="Ga door"/>
</form>

</body>
</html>

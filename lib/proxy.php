<?php
// PHP Proxy for Web services. 
// Responds to both HTTP GET and POST requests

//Stripping slasses from quotes
if (get_magic_quotes_gpc()) 
{
        function stripslashes_deep($value) 
        {
            $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
            return $value;
        }

        $_POST = array_map('stripslashes_deep', $_POST);
        $_GET = array_map('stripslashes_deep', $_GET);
        $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
        $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}

// Get the REST call path from the AJAX application
// Is it a POST or a GET?
$url = ($_POST['path']) ? $_POST['path'] : $_GET['path'];

// Open the Curl session
$session = curl_init();
curl_setopt($session, CURLOPT_URL, $url);

// If it's a POST, put the POST data in the body
if ($_POST['path']) 
{
	$postvars = '';
	while ($element = current($_POST)) {
		$postvars .= urlencode(key($_POST)).'='.urlencode($element).'&';
		next($_POST);
	}
	curl_setopt ($session, CURLOPT_POST, true);
	curl_setopt ($session, CURLOPT_POSTFIELDS, $postvars);
}

// Don't return HTTP headers. Do return the contents of the call
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// Make the call
$html = curl_exec($session);

// The web service returns HTML. Set the Content-Type appropriately
header("Content-Type: text/html");

echo utf8_encode( $html );
curl_close($session);

?>

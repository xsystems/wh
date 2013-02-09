<?php
# Front Controller
# The Front Controller Pattern is a software design pattern.
# It provides a centralized entry point for handling requests.

session_start();
$sessionID = session_id();

# Error and Exception handling.
require_once("src/php/models/ModelException.php");
#ModelException::getInstance("log/error.log", "Oeps, something went wrong. Sorry.");
 
# Configuration
require_once("src/php/models/ModelConfiguration.php");

# Controllers
require_once("src/php/controllers/ControllerView.php");  
    
    
$get = null;
$action = "none";
if (filter_has_var(INPUT_GET, "action"))
{
    $get = filter_input_array(INPUT_GET);
    $action = array_shift($get);
}

$controllerView = new ControllerView( Configuration::getInstance("config.ini") );
echo $controllerView->getView($action, $get);        

?>

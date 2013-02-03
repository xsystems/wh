<?php
    # Front Controller
    # The Front Controller Pattern is a software design pattern.
    # It provides a centralized entry point for handling requests.

    require_once("src/php/controllers/ControllerView.php");
    
    $action = array_shift($_GET);
    $controllerView = new ControllerView();
    echo $controllerView->getView($action, $_GET);
?>

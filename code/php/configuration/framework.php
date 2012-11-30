<?php
/**
 * This file includes all code files
 */

require_once("../configuration/configuration.php");
Configuration::getInstance();

require_once(Configuration::$DOCUMENT_ROOT."/code/php/models/database.model.php");
require_once(Configuration::$DOCUMENT_ROOT."/code/php/models/discipline.model.php");

require_once(Configuration::$DOCUMENT_ROOT."/code/php/views/home.view.php");
require_once(Configuration::$DOCUMENT_ROOT."/code/php/views/discipline.view.php");
require_once(Configuration::$DOCUMENT_ROOT."/code/php/views/location.view.php");
require_once(Configuration::$DOCUMENT_ROOT."/code/php/views/calendar.view.php");
require_once(Configuration::$DOCUMENT_ROOT."/code/php/views/imagegallery.view.php");
require_once(Configuration::$DOCUMENT_ROOT."/code/php/views/videogallery.view.php");
require_once(Configuration::$DOCUMENT_ROOT."/code/php/views/clubmagazinegallery.view.php");
require_once(Configuration::$DOCUMENT_ROOT."/code/php/views/vertel.view.php");
require_once(Configuration::$DOCUMENT_ROOT."/code/php/views/boodschap.view.php");
require_once(Configuration::$DOCUMENT_ROOT."/code/php/views/costs.view.php");
require_once(Configuration::$DOCUMENT_ROOT."/code/php/views/organisation.view.php");
require_once(Configuration::$DOCUMENT_ROOT."/code/php/views/iframe.view.php");
require_once(Configuration::$DOCUMENT_ROOT."/code/php/views/meteorology.view.php");

/** Setup database connection **/
try
{
	Database::getInstance(Configuration::$DB_PATH, Configuration::$DB, Configuration::$DB_ERRMODE);
}
catch(PDOException $e) 
{  
	echo "ERROR: unable to setup database.";  
	file_put_contents(Configuration::$LOG_PATH.Configuration::$LOG_PDO, $e->getMessage()."\n", FILE_APPEND);  
}  

?>

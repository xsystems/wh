<?php

require_once("src/php/models/ModelDatabase.php");

// This is implemented according to the Singleton Pattern
final class Configuration 
{	
	private static $instance = null;

	public static $CONFIG_SETTINGS	= null;
	private static $CONFIG_FIlE = "config.ini";

	public static $DOCUMENT_ROOT = null;	
	public static $HTTP_HOST = null;
	public static $PROTOCOL = null;
	
	public static $LOG_PATH = null;
	
	public static $DB = null;
	public static $DB_PATH = null;	
	public static $DB_FILE = null;
	public static $DB_LOG = null;			
	public static $DB_ERRMODE = PDO::ERRMODE_EXCEPTION;


	
	// We don't permit an explicit call of the constructor! (like $v = new Singleton()).
	private function __construct()
	{
		session_start();
		
		self::$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
		self::$HTTP_HOST = $_SERVER["HTTP_HOST"];
		self::$PROTOCOL = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

		/** Setup global session objects **/
		//$_SESSION["root"] = self::$DOCUMENT_ROOT."/";
		$_SESSION["pid"] = NULL;
		
        self::$CONFIG_SETTINGS = parse_ini_file(self::$CONFIG_FIlE, true);	
        self::$LOG_PATH = self::$CONFIG_SETTINGS["log"]["log_path"];
        self::$DB_PATH = self::$CONFIG_SETTINGS["database"]["database_path"];
        self::$DB_FILE = self::$CONFIG_SETTINGS["database"]["database_file"];
        self::$DB_LOG = self::$CONFIG_SETTINGS["database"]["database_log"];        
		
        /** Setup database connection **/
        try
        {
	        self::$DB = Database::getInstance(self::$DOCUMENT_ROOT.Configuration::$DB_PATH, Configuration::$DB_FILE, Configuration::$DB_ERRMODE);
        }
        catch(PDOException $e) 
        {  
	        echo "ERROR: unable to setup database.";  
	        file_put_contents(self::$DOCUMENT_ROOT.Configuration::$LOG_PATH."/".Configuration::$DB_LOG, $e->getMessage()."\n", FILE_APPEND);  
        }  		
	}
	
	// We don't permit cloning the singleton (like $x = clone $v).
 	private function __clone(){ } 

	public static function getInstance()
	{
		if (!self::$instance) 
		{
			self::$instance = new self();
		}
		
		return self::$instance;
	}
}
?>

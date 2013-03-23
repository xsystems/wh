<?php

#require_once("ModelDatabase.php");

# This is implemented according to the Singleton Pattern
final class Configuration 
{	
	private static $instance = null;

	private $configFile = null;
#	private $databaseErrMode = PDO::ERRMODE_EXCEPTION;		
	private $configSettings	= null;		
#	private $database = null;
	
	# We don't permit an explicit call of the constructor! (like $v = new Singleton()).
	private function __construct($configFile = null)
	{
        $this->load($configFile);

		/** Setup global session objects **/
		#$_SESSION["root"] = $this->documentRoot."/";
		#$_SESSION["pid"] = NULL;		
	}
	
	# We don't permit cloning the singleton (like $x = clone $v).
 	private function __clone(){ } 

	public static function getInstance($configFile)
	{
		if (!self::$instance) 
		{
			self::$instance = new self($configFile);
		}
		
		return self::$instance;
	}
	
	public function load($configFile = null)
	{
	    if($configFile == null)
	    {
	        $configFile = $this->configFile;
	    }
	
	    if($configFile != null)
	    {
		    $this->configFile = $configFile;	
            $this->configSettings = parse_ini_file($configFile, true);	
		    $system["system_document_root"] = $_SERVER["DOCUMENT_ROOT"];
		    $system["system_http_host"] = $_SERVER["HTTP_HOST"];
		    $system["system_protocol"] = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $this->configSettings["system"] = $system; 	    
	    }
	}
	
	public function get($section, $key)
	{
	    return $this->configSettings[$section][$key];
	}
	
#	public function getDatabase()
#	{	    
#        # Setup database only once.
#        if($this->database == null)
#        {
#            #TODO check if settings are present.
#            try
#            {
#	            $this->database = Database::getInstance($this->get("system", "system_document_root").$this->get("database", "database_path")."/", $this->get("database", "database_file"), $this->databaseErrMode);
#            }
#            catch(PDOException $e) 
#            {  
#	            echo "ERROR: unable to setup database.";  
#	            file_put_contents($this->get("system", "system_document_root").$this->get("log", "log_path")."/".$this->get("database", "database_log"), $e->getMessage()."\n", FILE_APPEND);  
#            } 
#        }	        
#        return $this->database;
#	}
}
?>

<?php

// This is coded according to the Singleton Pattern
final class Configuration 
{	
	private static $instance = null;

	public static $ROOT_FOLDER = "/";
	public static $ROOT=null;
	
	public static $DB = 'dewindhappers.sqlite';
	public static $DB_FOLDER = "db/";
	public static $DB_PATH = null;
	public static $DB_HOST = null;
	public static $DB_NAME = null;
	public static $DB_PASSWORD = null;
	public static $DB_ERRMODE = PDO::ERRMODE_EXCEPTION;
	
	public static $LOG_FOLDER = "log/";
	public static $LOG_PATH = null;
	public static $LOG_PDO = 'pdolog';
	
	// We don't permit an explicit call of the constructor! (like $v = new Singleton()).
	private function __construct()
	{
		session_start();
		
		self::$ROOT = realpath($_SERVER["DOCUMENT_ROOT"]).self::$ROOT_FOLDER;
		self::$DB_PATH = self::$ROOT.self::$DB_FOLDER;
		self::$LOG_PATH = self::$ROOT.self::$LOG_FOLDER;
		
		/** Setup global session objects **/
		$_SESSION['root'] = self::$ROOT;
		$_SESSION['pid'] = NULL;
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

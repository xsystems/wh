<?php

// This is coded according to the Singleton Pattern
final class Configuration 
{	
	private static $instance = null;

	public static $DOCUMENT_ROOT = null;	
	public static $HTTP_HOST = null;
	public static $PROTOCOL = null;
	
	public static $DB = "/dewindhappers.sqlite";
	public static $DB_FOLDER = "/db";
	public static $DB_PATH = null;
	public static $DB_HOST = null;
	public static $DB_NAME = null;
	public static $DB_PASSWORD = null;
	public static $DB_ERRMODE = PDO::ERRMODE_EXCEPTION;
	
	public static $LOG_FOLDER = "/log";
	public static $LOG_PATH = null;
	public static $LOG_PDO = "/pdolog";
	
	// We don't permit an explicit call of the constructor! (like $v = new Singleton()).
	private function __construct()
	{
		session_start();
		
		self::$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
		self::$HTTP_HOST = $_SERVER["HTTP_HOST"];
		self::$PROTOCOL = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

		self::$DB_PATH = self::$DOCUMENT_ROOT.self::$DB_FOLDER;
		self::$LOG_PATH = self::$DOCUMENT_ROOT.self::$LOG_FOLDER;

		/** Setup global session objects **/
		//$_SESSION["root"] = self::$DOCUMENT_ROOT."/";
		$_SESSION["pid"] = NULL;
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

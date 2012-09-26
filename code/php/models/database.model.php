<?php

// This is coded according to the Singleton Pattern
final class Database 
{
	private static $instance = null;
	private static $dbh = null;
	
	// We don't permit an explicit call of the constructor! (like $v = new Singleton()).
	private function __construct($db_path, $db, $errmode)
	{
		/*** connect to SQLite database ***/
		self::$dbh = new PDO("sqlite:".$db_path.$db);
		self::$dbh->setAttribute( PDO::ATTR_ERRMODE, $errmode );
	}

	// We don't permit cloning the singleton (like $x = clone $v).
 	private function __clone(){ } 

	public static function getInstance($db_path, $db, $errmode)
	{
		if (!self::$instance) 
		{
			self::$instance = new self($db_path, $db, $errmode);
		}
		
		return self::$instance;
	}
	
	public static function getDBH()
	{
		return self::$dbh;
	}
}

?>

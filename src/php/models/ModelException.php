<?php

class ModelException
{
	private static $instance = null;
	
    private static $log;
    private static $message;

    private function __construct($log, $message)
	{
	    self::$log = $log;
	    self::$message = $message;
	    
        set_exception_handler("ModelException::exception_handler");
        set_error_handler("ModelException::error_handler");	
        register_shutdown_function( "ModelException::fatal_handler" );            
	}
	
    public function __destruct()
    {
        restore_error_handler();
        restore_exception_handler();
    }	
	
	// We don't permit cloning the singleton (like $x = clone $v).
 	private function __clone(){ } 	
	
	public static function getInstance($log, $message = "")
	{
		if (!self::$instance) 
		{
			self::$instance = new self($log, $message);
		}
		
		return self::$instance;
	}
	
    public static function fatal_handler()
    {
        $error = error_get_last();     

        if( $error != null) 
        {
            ModelException::error_handler($error["type"], $error["message"], $error["file"], $error["line"]);
        }
  
    } 	
	
    public static function error_handler($errno, $errstr, $errfile, $errline, $errcontext = null) 
    {
        throw new ErrorException($errstr, $errno, $severity=0, $errfile, $errline, $previous=null);
    }	
	
	public static function exception_handler( $exception )
    {
        try
        {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            echo self::$message;       
            file_put_contents(self::$log, self::exceptionToSrting($exception), FILE_APPEND | LOCK_EX);
        }    
        catch ( Exception $e )
        {
            echo "EXCEPTION IN EXCEPTION HANDLER !!!!";
        }
        exit;
    }   

    private static function exceptionToSrting( $exception )
    {
        $str = "";
        do 
        {    
            $exception_path_parts = pathinfo($exception->getFile());
            $str .= "[".date("Y-m-d")."T".date("H:i:s")."]"."\n";
            $str .= "ERROR:\n";        
            $str .=sprintf("%-25s%-6s%-20s%-15s%-25s\n", "FILE", "LINE", "EXCEPTION", "CODE", "MESSAGE");     
            $str .= sprintf("%-25s%-6d%-20s%-15d%-25s\n\n", $exception_path_parts["basename"], $exception->getLine(), get_class($exception), $exception->getCode(), $exception->getMessage());
            $str .= "Trace:\n";
            $str .= sprintf("%-25s%-6s%-20s%-15s%-25s%-25s\n", "FILE", "LINE", "CLASS", "TYPE", "FUNCTION", "ARGS");   
            foreach ( $exception->getTrace() as $trace)
            {
                // $trace["args"] NOT LOGGED.
                $path_parts = pathinfo($trace["file"]);
                $str .= sprintf("%-25s%-6d%-20s%-15s%-25s\n", $path_parts["basename"], $trace["line"], $trace["class"], $trace["type"], $trace["function"]);
            }      
            $str .= "\n\n";
        } 
        while( $exception = $exception->getPrevious() ); 
       
        return $str;
    }
}
?>

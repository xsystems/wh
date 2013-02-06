<?php	

require_once("AViewElement.php");

class ViewElement extends AViewElement
{
	public function __construct($class="") 
	{
        parent::__construct($class);
		$this->init();
	}

	public function init()
	{	
        // Stub
	}
	
    public function add( $iViewElement )
    {
        // Stub
    }

	public function create()
	{
		return $this->domElement;
	}
}
?>

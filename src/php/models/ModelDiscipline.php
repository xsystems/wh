<?php 

class Discipline 
{
	private $name, $description, $images;	
			
	public function __construct($name, $description, $images) 
	{
		$this->name = $name;
		$this->description = $description;
	    $this->images = $images;
	}	

    public function name()
    {
        return $this->name;
    }
    
    public function description()
    {
        return $this->description;
    }
    
    public function images()
    {
        return $this->images;
    }       
    
	public function toString()
	{
		$output  = "discipline: ";
		$output .= $this->name." - ";
		$output .= $this->description." - ";
		$output .= "[ ";
		foreach($images as $image){
		    $output .= $this->image->toString().", ";		
		}

		$output .= " ]";	
		return $output;
	}    	
}
?>

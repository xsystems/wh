<?php
	require('../configuration/framework.php');	
	
	//$discipline = new Discipline(1);	
	//echo $discipline->toString()."<br>";
	
	/*
	$discipline->name = "freestyle";
	$discipline->update();
	echo $discipline->toString()."<br>";	
	
	$discipline1 = new Discipline();	
	$discipline1->name = "sea kayaking";
	$discipline1->description = "another cool sport";
	$discipline1->update();
	echo $discipline1->toString()."<br>";
	
	$discipline2 = new Discipline(4);
	$discipline2->delete();	
	
	
	
	foreach (Discipline::getAll() as $d)
	{
    		echo $d->toString()."<br>";
    	}    	
       	 	
    	foreach (Discipline::getNames() as $dn)
	{
    		echo Discipline::getByName($dn['name'])->toString()."<br>";
    	}
    	*/
    	
    	//SimpleGallery::createThumbnailDir("../../../images/galleries/2009-09-28 rally veluwe 2009/");
    	
    	$sg = new SimpleGallery(4, "../../../images/galleries/2009-09-28 rally veluwe 2009/");
    	$page = $sg->generatePage(0);
    	
    	foreach ($page as $pageItem)
    	{
    		print_r($pageItem["image"]);
    		print_r("<br>");
    		print_r($pageItem["thumbnail"]);
    		print_r("<br>");
    		print_r("<br>");
    	}

?>

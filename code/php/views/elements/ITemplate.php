<?php

interface ITemplate
{
	public function init();
	public function add( $newElement, $targetElement = "main" );
    public function create();
}

?>

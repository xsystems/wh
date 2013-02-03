<?php

interface IView
{
	public function init();
	public function isInitialized();
	public function add( $newElement, $targetElement = "main" );
    public function create();
}

?>

<?php

interface IViewElement
{
	public function init();
	public function add( $iTemplateElement );
    public function create();
}

?>

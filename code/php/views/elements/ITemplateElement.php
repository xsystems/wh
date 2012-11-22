<?php

interface ITemplateElement
{
	public function init();
	public function add( $iTemplateElement );
    public function create();
}

?>

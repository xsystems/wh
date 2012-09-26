<?php

require_once("ASimpleGallery.php");
require_once("SimpleImage.php");
 
/*
* File: SimpleGallery.php
* Author: Koen Boes
* Copyright: 2012 Koen Boes
* Date: 2012-04-24
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details:
* http://www.gnu.org/licenses/gpl.html
*
*/
 
class SimpleImageGallery extends ASimpleGallery
{	
	public function __construct($imagesPerPage, $imageDirPath, $thumbnailDirPath=null) 
	{ 
		parent::__construct($imagesPerPage, $imageDirPath, $thumbnailDirPath);
	}
	
	public function createThumbnail($file, $thumbnailDirPath)
	{
		if( !is_dir($file) && is_dir($thumbnailDirPath))
		{
			$path_parts = pathinfo($file);
		
			$image = new SimpleImage($file);
			$image->resize(300,200);
			$image->save($thumbnailDirPath.$path_parts["basename"]);
		}		
	}
}
?>

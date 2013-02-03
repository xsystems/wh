<?php

require_once("AModelSimpleGallery.php");

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

class SimpleGalleryVideo extends ASimpleGallery
{	
	private $screenshortSecond;

	public function __construct($videosPerPage, $screenshortSecond, $videoDirURL, $videoDirPath, $thumbnailDirURL=null, $thumbnailDirPath=null)
	{
		$this->screenshortSecond = $screenshortSecond;
		parent::__construct($videosPerPage, $videoDirURL, $videoDirPath, $thumbnailDirURL, $thumbnailDirPath);
	}
	
	public function createThumbnail($file, $thumbnailDirPath)
	{
		if( !is_dir($file) && is_dir($thumbnailDirPath))
		{
			$path_parts = pathinfo($file);
		
			$ffmpeg_cmd = sprintf("ffmpeg -i %s -s 480x270 -y -ss %02d -f image2 %s > /dev/null 2>&1", escapeshellarg($file), $this->screenshortSecond, escapeshellarg($thumbnailDirPath.$path_parts["filename"].".jpg"));
			system($ffmpeg_cmd);			
		}		
	}
}
?>

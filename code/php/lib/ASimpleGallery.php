<?php
 
/*
* File: ASimpleGallery.php
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
 
abstract class ASimpleGallery
{
	private $itemsPerPage;
	private $mediaDirPath;
	private $thumbnailDirPath;
	
	public function __construct($itemsPerPage, $mediaDirPath, $thumbnailDirPath=null) 
	{ 
		$this->itemsPerPage = $itemsPerPage;				
		
		if( is_dir($mediaDirPath) )
		{
			if($thumbnailDirPath == null)
			{
				$thumbnailDirPath = $mediaDirPath.".thumbnails/";
			}
		
			$this->mediaDirPath = $mediaDirPath;
			$this->thumbnailDirPath = $thumbnailDirPath;
			
			if( !file_exists($this->thumbnailDirPath) )
			{
				mkdir($this->thumbnailDirPath);
			}		
			
			$this->synchronizeThumbnailDir($this->mediaDirPath, $this->thumbnailDirPath);
		}
	}
	
	private function scandir_for_files($dir, $nametype="basename")
	{
		$files = array();
		$filesAndDirs = scandir($dir);
		
		foreach ($filesAndDirs as $fileOrDir)
		{
			if( !is_dir($fileOrDir)  && $fileOrDir[0] != "." )
			{
				$path_parts = pathinfo($fileOrDir);
				$files[] = $path_parts[$nametype];
			}
		}
		
		return $files;
	}
	
	private function thumbnailsToMake($mediaDirPath, $thumbnailDirPath)
	{
		$contentImageDir = $this->scandir_for_files($mediaDirPath, "filename");
		$contentThumbnailDir = $this->scandir_for_files($thumbnailDirPath, "filename");
		
		$filenamesOfThumnailsToMake = array_diff($contentImageDir, $contentThumbnailDir);
		
		$basenamesOfThumbnailsToMake = array();
		foreach ($this->scandir_for_files($mediaDirPath, "basename") as $mediaItem)
		{
			$path_parts = pathinfo($mediaItem);
			if ( in_array($path_parts["filename"], $filenamesOfThumnailsToMake) )
			{
				$basenamesOfThumbnailsToMake[] = $mediaItem;
			}
		}
				
		return $basenamesOfThumbnailsToMake;
	}
	
	private function thumbnailsToRemove($mediaDirPath, $thumbnailDirPath)
	{
		$contentImageDir = $this->scandir_for_files($mediaDirPath, "filename");
		$contentThumbnailDir = $this->scandir_for_files($thumbnailDirPath, "filename");
		
		$filenamesOfThumnailsToRemove = array_diff($contentThumbnailDir, $contentImageDir);
		
		$basenamesOfThumbnailsToRemove = array();
		foreach ($this->scandir_for_files($thumbnailDirPath, "basename") as $thumbnail)
		{
			$path_parts = pathinfo($thumbnail);
			if ( in_array($path_parts["filename"], $filenamesOfThumnailsToRemove) )
			{
				$basenamesOfThumbnailsToRemove[] = $thumbnail;
			}
		}
		
		return $basenamesOfThumbnailsToRemove;
	}	
	
	private function synchronizeThumbnailDir($mediaDirPath, $thumbnailDirPath)
	{
		$thumbnailsToRemove = $this->thumbnailsToRemove($mediaDirPath, $thumbnailDirPath);
		foreach ($thumbnailsToRemove as $thumbnailToRemove)
		{
			unlink($thumbnailDirPath.$thumbnailToRemove);
		}		
		
		$thumbnailsToMake = $this->thumbnailsToMake($mediaDirPath, $thumbnailDirPath);	
		foreach ($thumbnailsToMake as $thumbnailToMake)
		{
			$this->createThumbnail($mediaDirPath.$thumbnailToMake, $thumbnailDirPath);
		}			
	}
	
	public abstract function createThumbnail($file, $thumbnailDirPath);
	
	public function createThumbnailDir($mediaDirPath, $thumbnailDirPath)
	{
		if( is_dir($mediaDirPath) && is_dir($thumbnailDirPath))
		{
			$children = scandir_for_files($mediaDirPath, "basename");
			
			foreach ($children as $child)
			{				
				$this->createThumbnail($mediaDirPath.$child, $thumbnailDirPath);	
			}
		}
	}
	
	public function generatePage($pageNumber)
	{
		$page = array();
		if( is_dir($this->mediaDirPath) && is_dir($this->thumbnailDirPath))
		{		
			$thumbnails = $this->scandir_for_files($this->thumbnailDirPath, "basename");
			$media = $this->scandir_for_files($this->mediaDirPath, "basename");
			$numberOfThumbnails = count($thumbnails);
			$numberOfMedia = count($media);
		
			$numberOfItems = null;
			if ($numberOfThumbnails < $numberOfMedia)
			{
				$numberOfItems = $numberOfThumbnails;
			}	
			else
			{
				$numberOfItems = $numberOfMedia;
			}
		
			if($pageNumber < 1)
			{
				$pageNumber = 1;
			}
		
			if ($this->itemsPerPage < 0)
			{
				$startIndex = 0;
				$endIndex = ($numberOfItems - 1);
			}
			else
			{
				$startIndex = ($pageNumber - 1) * $this->itemsPerPage;
				$endIndex = $startIndex + ($this->itemsPerPage - 1);
			
				if ($endIndex >= $numberOfItems)
				{
					$endIndex = ($numberOfItems - 1);
				}
		
				if ($startIndex > $endIndex )
				{
					$startIndex = $endIndex - ($endIndex % $this->itemsPerPage);
				}	
				
				if ($startIndex < 0 )
				{
					$startIndex = 0;
				}
			}		
				
			for($i=$startIndex; $i<=$endIndex; $i++)
			{				
				$page[] = array("media" => $this->mediaDirPath.$media[$i], "thumbnail" => $this->thumbnailDirPath.$thumbnails[$i]);
			}
		}
		
		return $page;
	}
}
?>

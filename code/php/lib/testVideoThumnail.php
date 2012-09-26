<?php

function GetThumbnailFileName($FileName, $ScreenshotSecond = 15) 
{
	$Thumbnail_FileName  = sprintf("%s_%02ds.jpg", $FileName, $ScreenshotSecond);

	if (!file_exists($Thumbnail_FileName)) 
	{
		$FFMPEG_Command = sprintf("ffmpeg -i %s -s 150x100 -y -ss %02d -f image2 \"%s\" > /dev/null 2>&1", $FileName, $ScreenshotSecond, $Thumbnail_FileName);
		system($FFMPEG_Command);
	}

	if (!file_exists($Thumbnail_FileName))
	{
		return null;
	}

	return $Thumbnail_FileName;
}
 
$FileName  = "test.avi";
$Thumbnail = GetThumbnailFileName($FileName);
if ($Thumbnail != null)
{
	echo "Thumbnail file is: \"$Thumbnail\"\n";
}
else 
{
	echo "Fail creating a Thumbnail of \"$FileName\".";
}
 
?>

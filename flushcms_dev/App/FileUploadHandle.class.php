<?php
/*
   +----------------------------------------------------------------------+
   | FlushPHP                                                             |
   +----------------------------------------------------------------------+
   | Copyright (c) 2005-2006 The FlushPHP Group                           |
   +----------------------------------------------------------------------+
   | This library is free software; you can redistribute it and/or        |
   | modify it under the terms of the GNU Lesser General Public           |
   | License as published by the Free Software Foundation; either         |
   | version 2.1 of the License, or (at your option) any later version.   |
   +----------------------------------------------------------------------+
   | Author: John.meng(цот╤РШ)  2006-1-7 12:51:41                        
   +----------------------------------------------------------------------+
 */

/* $Id: FileUploadHandle.class.php,v 1.3 2006/01/16 01:43:00 arzen Exp $ */
include_once(UTIL_DIR.'FileUploader.class.php');
class FileUploadHandle
{

	function FileUploadHandle()
	{
	}
	/**
	 * Upload media file ,like: image/flash
	 *
	 * @author  John.meng (цот╤РШ)
	 * @since   version - 2006-1-7 12:56:23
	 * @param   string  
	 *
	 */
	function uploadMedia ($CurrentUserPathImages,$oldPic="",$PicType="Pic",$newWidth="",$newHeight="",$CreateIco=false,$IcoWidth="",$IcoHeight="") 
	{
		$allowed_mimetypes = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png','application/x-shockwave-flash');
		$maxfilesize = 10000000;
		$FileUploaderObj = new FileUploader($CurrentUserPathImages, $allowed_mimetypes, $maxfilesize);
		$FileUploaderObj->newWidth=$newWidth;
		$FileUploaderObj->newHeight=$newHeight;
		if($CreateIco && $IcoWidth && $IcoHeight) 
		{
			$FileUploaderObj->CreateIco=$CreateIco;
			$FileUploaderObj->IcoWidth=$IcoWidth;
			$FileUploaderObj->IcoHeight=$IcoHeight;
		}
		if($_FILES[$PicType]['name'] != "") 
		{
			if($FileUploaderObj->fetchMedia($PicType)) 
			{
				$FileUploaderObj->setPrefix($PicType."_");
				if(!$FileUploaderObj->upload()) 
				{
					echo $FileUploaderObj->getErrors();
				}
				else 
				{
					$StrPic = $FileUploaderObj->getSavedFileName();
					if($oldPic) 
					{
						@unlink($CurrentUserPathImages."/".$oldPic);
					}
				}
			}
		}
		else 
		{
			$StrPic = $oldPic;
		}
		return $StrPic;
	}
	
}
?>
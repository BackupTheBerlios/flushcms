<?php

/**
 *
 * FileHelper.class.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: FileHelper.class.php,v 1.2 2006/10/30 03:26:55 arzen Exp $
 */

class FileHelper
{

	function createCategoryDir($BaseDir,$Category)
	{
		$CategoryDir = $BaseDir.$Category."/";
		$DateDir = $Category."/".date("Ymd")."/";
		$FullCategoryDir = $CategoryDir.date("Ymd")."/";
		if (!file_exists($CategoryDir)) 
		{
			mkdir($CategoryDir,0777);
		}
		if (!file_exists($FullCategoryDir)) 
		{
			mkdir($FullCategoryDir,0777);
		}
		return $DateDir;
	}
	
	function uploadFile ($TagName,$CategoryDir) 
	{
		
		global $ClassDir,$UploadDir,$AllowUploadFilesType;
		require_once 'HTTP/Upload.php';
		require_once ($ClassDir."FileHelper.class.php");
		if (!file_exists($UploadDir)) 
		{
			mkdir($UploadDir,0755);
		}
		$upload = new http_upload();
		$file = $upload->getFiles($TagName);
		$file->setValidExtensions($AllowUploadFilesType,'accept');
		$allow_upload_file = TRUE;
		if (PEAR::isError($file)) 
		{
			$allow_upload_file = FALSE;
			$upload_error_msg = $file->getMessage();
		}
		if ($file->isValid()) 
		{
			$file->setName('uniq');
			$current_date = FileHelper::createCategoryDir($UploadDir,$CategoryDir);
			$date_image_dir = $UploadDir.$current_date;
			$dest_name = $file->moveTo($date_image_dir);
			if (PEAR::isError($dest_name)) 
			{
				$allow_upload_file = FALSE;
				$upload_error_msg = $dest_name->getMessage();
			}
			else 
			{
				$real = $file->getProp('real');
				$new_name = $current_date.$dest_name;
			}
		} 
		elseif ($file->isError()) 
		{
			$allow_upload_file = FALSE;
			$upload_error_msg = $file->errorMsg();
		}			
		$data["upload_state"] = $allow_upload_file;
		$data["upload_msg"] = $allow_upload_file?$new_name:$upload_error_msg;
		return $data;
		
	}
		
}
?>
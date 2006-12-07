<?php

/**
 *
 * FileHelper.class.php class.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: FileHelper.class.php,v 1.8 2006/12/07 10:34:24 arzen Exp $
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
	
	function uploadFile ($CategoryDir) 
	{
		
		global $ClassDir,$UploadDir,$AllowUploadFilesType,$MaxFileSize;
		require_once 'HTTP/Upload.php';
		require_once ($ClassDir."FileHelper.class.php");
		if (!file_exists($UploadDir)) 
		{
			mkdir($UploadDir,0755);
		}
		$upload = new http_upload();
//		$file = $upload->getFiles($TagName);
		$files = $upload->getFiles();
		$new_name=array();
		foreach($files as $file)
		{
			$file->setValidExtensions($AllowUploadFilesType,'accept');
			$allow_upload_file = TRUE;
			if (PEAR::isError($file)) 
			{
				$allow_upload_file = FALSE;
				$upload_error_msg = $file->getMessage();
			}
			if ($file->getProp("size") > $MaxFileSize) 
			{
				$allow_upload_file = FALSE;
				$upload_error_msg = "Upload file too large";
			}
			else
			{
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
						$new_name[$file->getProp('form_name')] = $current_date.$dest_name;
					}
				} 
				elseif ($file->isError()) 
				{
					$allow_upload_file = FALSE;
					$upload_error_msg = $file->errorMsg();
				}			
			}
			
		}
		$data["upload_state"] = $allow_upload_file;
		$data["upload_msg"] = $allow_upload_file?$new_name:$upload_error_msg;
		return $data;
		
	}
	
	function uploadDocumentFile ($UploadDir) 
	{
		global $ClassDir,$AllowUploadDocumentFilesType,$DocumentMaxFileSize;
		require_once 'HTTP/Upload.php';
		require_once ($ClassDir."FileHelper.class.php");
		if (!file_exists($UploadDir)) 
		{
			mkdir($UploadDir,0755);
		}
		$upload = new http_upload();
		$files = $upload->getFiles();
		$new_name=array();
		foreach($files as $file)
		{
			$file->setValidExtensions($AllowUploadDocumentFilesType,'accept');
			$allow_upload_file = TRUE;
			if (PEAR::isError($file)) 
			{
				$allow_upload_file = FALSE;
				$upload_error_msg = $file->getMessage();
			}
			if ($file->getProp("size") > $DocumentMaxFileSize) 
			{
				$allow_upload_file = FALSE;
				$upload_error_msg = "Upload file too large";
			}
			else
			{
				if ($file->isValid()) 
				{
					$file->setName('real');
					$date_image_dir = $UploadDir;
					$dest_name = $file->moveTo($date_image_dir);
					if (PEAR::isError($dest_name)) 
					{
						$allow_upload_file = FALSE;
						$upload_error_msg = $dest_name->getMessage();
					}
					else 
					{
						$real = $file->getProp('real');
						$new_name[$file->getProp('form_name')] = $dest_name;
						$new_name['source_file_name'] = $dest_name;
						$new_name['file_size'] = $file->getProp('size');
						$new_name['exten_name'] = $file->getProp('ext');
					}
				} 
				elseif ($file->isError()) 
				{
					$allow_upload_file = FALSE;
					$upload_error_msg = $file->errorMsg();
				}			
			}
			
		}
		$data["upload_state"] = $allow_upload_file;
		$data["upload_msg"] = $allow_upload_file?$new_name:$upload_error_msg;
		return $data;
	}

	function deleteDir($dir)
	{
	   if (substr($dir, strlen($dir)-1, 1) != '/')
	       $dir .= '/';
	
	   if ($handle = opendir($dir))
	   {
	       while ($obj = readdir($handle))
	       {
	           if ($obj != '.' && $obj != '..')
	           {
	               if (is_dir($dir.$obj))
	               {
	                   if (!FileHelper::deleteDir($dir.$obj))
	                       return false;
	               }
	               elseif (is_file($dir.$obj))
	               {
	                   if (!unlink($dir.$obj))
	                       return false;
	               }
	           }
	       }
	
	       closedir($handle);
	
	       if (!@rmdir($dir))
	           return false;
	       return true;
	   }
	   return false;
	}
		
}
?>
<?php

/**
 *
 * FileHelper.class.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: FileHelper.class.php,v 1.1 2006/09/25 05:06:05 arzen Exp $
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
}
?>
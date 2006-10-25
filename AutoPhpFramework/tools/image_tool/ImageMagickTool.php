<?php
/**
 *
 *  ImageMagickTool.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: ImageMagickTool.php,v 1.4 2006/10/25 14:22:38 arzen Exp $
 */
set_time_limit(0);
define('APF_ROOT_DIR', realpath(dirname(__FILE__) . '/../..'));
require_once (APF_ROOT_DIR . DIRECTORY_SEPARATOR . 'init.php');
require_once 'File/Find.php';
require_once $ClassDir.'ImageMagickUtility.class.php';

//$source_name = 'C:/Documents and Settings/All Users/Documents/My Pictures/Sample Pictures/Water lilies.jpg';
//$string = "testing";
//$save_name = "D:/www/tools/Water lilies.jpg";
//ImageMagickUtility::addText($source_name,$string,$save_name);
//ImageMagickUtility::resize($source_name,0,120);

$dir = 'D:/Í¼Æ¬/ÄÏÀ¥É½Æ¯Á÷2006-8-15/';
list($directories, $files) = File_Find::maptree($dir);

$x=0;
foreach($files as $image_file)
{
	if(eregi("(.*)jpg|gif$",$image_file))
	{
		$source_name = $image_file;
		
		$file_arr = pathinfo($source_name);
		$dir_name = $file_arr["dirname"];
		$exten_name = $file_arr["extension"];
		$base_name = basename($file_arr["basename"],".".$exten_name);
		
		$save_name = $dir_name."/resize_".$base_name.".".$exten_name;
		ImageMagickUtility::resize($source_name,0,120,$save_name);
		echo $x." $save_name [OK] \n";
		$x++;
	}
}

?>

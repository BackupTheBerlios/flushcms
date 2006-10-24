<?php
set_time_limit(0);
include_once 'Image/Canvas.php';
include_once 'class.Thumbnail.php';

if(!file_exists("tn_sample.jpg"))
{
	$tn_image = new Thumbnail("./img/P9170013.jpg", 0, 0, 25);
	$tn_image->save("tn_sample.jpg");
}


/*
$Canvas =& Image_Canvas::factory((isset($_GET['canvas']) ? $_GET['canvas'] : 'jpg'), array('width' => 400, 'height' => 300));

$Canvas->image(array('x' => 398, 'y' => 298, 'filename' => 'tn_sample.jpg', 'alignment' => array('horizontal' => 'right', 'vertical' => 'bottom')));

$Canvas->setFont(array('name' => 'Courier New', 'size' => 14,'color'=>'#FF0033'));
$Canvas->addText(array('x' => 200, 'y' => 200, 'text' => 'copyright arzen', 'alignment' => array('horizontal' => 'center', 'vertical' => 'bottom')));

$Canvas->show();
*/
require_once 'File/Find.php';
include_once 'Var_Dump.php';
Var_Dump::displayInit(array('display_mode' => 'HTML4_Table'));
$dir = "C:/Documents and Settings/root/桌面/百合图片/";
$save_dir = "C:/Documents and Settings/root/桌面/水印图片/";
list($directories, $files) = File_Find::maptree($dir);

array_shift($directories);
foreach($directories as $dir_name)
{
//	echo $dir_name."=>".basename($dir_name)."\n";
	handleDirFiles($dir_name,$save_dir);
}

function handleDirFiles($dir_name,$save_dir)
{
	list($directories, $files) = File_Find::maptree($dir_name);
	$new_dir = $save_dir.basename($dir_name);
	if(!file_exists($new_dir))
	{
		mkdir($new_dir,0777);
	}
	foreach($files as $image_file)
	{
		if(ereg("(.*)jpg$",$image_file))
		{
			$new_filename = $new_dir."/".basename($image_file,".jpg")."_resize.jpg";
			echo $new_filename."\n";
			$tn_image = new Thumbnail($image_file, 340);
			$tn_image->save($new_filename);
			$Canvas =& Image_Canvas::factory((isset($_GET['canvas']) ? $_GET['canvas'] : 'jpg'), array('width' => 340, 'height' => 340));

			$Canvas->image(array('x' => 340, 'y' => 340, 'filename' => $new_filename, 'alignment' => array('horizontal' => 'right', 'vertical' => 'bottom')));

			$Canvas->setFont(array('name' => 'Courier New', 'size' => 16,'color'=>'#FF66FF'));//#FF0033
			$Canvas->addText(array('x' => 165, 'y' => 200, 'text' => 'arzen1013', 'alignment' => array('horizontal' => 'center', 'vertical' => 'bottom')));
			$Canvas->setFont(array('name' => 'Courier New', 'size' => 10,'color'=>'#000000'));//#FF0033
			$Canvas->addText(array('x' => 165, 'y' => 320, 'text' => 'http://shop33691629.taobao.com/', 'alignment' => array('horizontal' => 'center', 'vertical' => 'bottom')));

			$Canvas->save(array('filename' =>$new_filename));
		}
	}
}
/*
foreach($files as $image_file)
{
	if(ereg("(.*)jpg$",$image_file))
	{
		$new_filename = "C:/Documents and Settings/root/桌面/水印图片/最新银图片/".basename($image_file,".jpg")."_resize.jpg";
		echo $new_filename."\n";
		$tn_image = new Thumbnail($image_file, 340);
		$tn_image->save($new_filename);
		$Canvas =& Image_Canvas::factory((isset($_GET['canvas']) ? $_GET['canvas'] : 'jpg'), array('width' => 340, 'height' => 340));

		$Canvas->image(array('x' => 340, 'y' => 340, 'filename' => $new_filename, 'alignment' => array('horizontal' => 'right', 'vertical' => 'bottom')));

		$Canvas->setFont(array('name' => 'Courier New', 'size' => 16,'color'=>'#FF66FF'));//#FF0033
		$Canvas->addText(array('x' => 165, 'y' => 200, 'text' => 'arzen1013', 'alignment' => array('horizontal' => 'center', 'vertical' => 'bottom')));
		$Canvas->setFont(array('name' => 'Courier New', 'size' => 10,'color'=>'#000000'));//#FF0033
		$Canvas->addText(array('x' => 165, 'y' => 320, 'text' => 'http://shop33691629.taobao.com/', 'alignment' => array('horizontal' => 'center', 'vertical' => 'bottom')));

		$Canvas->save(array('filename' =>$new_filename));
	}
}
*/

?>
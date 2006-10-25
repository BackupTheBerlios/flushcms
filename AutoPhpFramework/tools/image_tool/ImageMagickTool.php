<?php
/**
 *
 *  ImageMagickTool.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: ImageMagickTool.php,v 1.1 2006/10/25 10:33:23 arzen Exp $
 */
set_time_limit(0);
define('APF_ROOT_DIR', realpath(dirname(__FILE__) . '/../..'));
require_once (APF_ROOT_DIR . DIRECTORY_SEPARATOR . 'init.php');
require_once 'File/Find.php';
require_once $ClassDir.'ImageMagickUtility.class.php';

$source_name = 'C:/Documents and Settings/All Users/Documents/My Pictures/Sample Pictures/Water lilies.jpg';
$string = "testing";
$save_name = "D:/www/tools/Water lilies.jpg";
ImageMagickUtility::addText($source_name,$string,$save_name);

?>

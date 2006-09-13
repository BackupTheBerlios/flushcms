<?php
/**
 *
 * init.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: init.php,v 1.4 2006/09/13 05:08:33 arzen Exp $
 */

$RootDir = APF_ROOT_DIR.DIRECTORY_SEPARATOR; 
$ConfigDir = $RootDir."config".DIRECTORY_SEPARATOR;
$IncludeDir = $RootDir."includes".DIRECTORY_SEPARATOR;

ini_set('include_path', ".".PATH_SEPARATOR.$IncludeDir."pear");

include_once($ConfigDir."Config.php");
include_once("PEAR.php");
include_once("DB.php");
include_once("DB/DataObject.php");

$dsn = "{$DB_Type}://{$DB_UserName}:{$DB_PassWord}@{$DB_Host}/{$DB_Name}";
$conn =& DB::connect ($dsn);
if (DB::isError ($conn))
     die ("Cannot connect: " . $conn->getMessage () . "\n");

$opts = &PEAR::getStaticProperty('DB_DataObject','options');
$opts = array(
	'database'=>$dsn,
    'class_location'  => $IncludeDir.'DAO/',
    'class_prefix'    => 'Dao',
    'extends_location'=>'',
	'template_location'=>$RootDir.'/template/',
	'actions_location'=>$RootDir,
	'modules_location'=>$RootDir.'module/Footage/',
	'modules_name_location'=>'Footage',
	'require_prefix'=>'dataobjects/',
	'class_prefix'=>'Dao',
	'extends'=>'DB_DataObject',
	'generate_setters'=>'1',
	'generate_getters'=>'1',
	'artist_fields_list'=>'artistid,artistcode,artistname,artistname_eng,gender,lang,initial,status',
	'artist_except_fields'=>'artistid,create_time,last_updated,imageurl,imagex,imagey,thumburl,thumbx,thumby,status,popularity,image_status',
	'profile_items_fields_list'=>'artistid,ordr,item_name,item_value',
	'profile_items_except_fields'=>'artistid,ordr,itemid,create_time,last_updated',
	
	'footage_fields_list'=>'footageid,artistid,image,question,video_url,video_length,answer,pollid,create_time',
	'footage_except_fields'=>'footageid,imageurl,imagex,imagey,thumburl,thumbx,thumby,status,create_time,last_updated',
	
	'generator_add_validate_stubs'=>'video_url:empty,video_length:empty',
	'generator_include_regex'=>'/artist/',
	'generator_no_ini'=>'1',
);
?>
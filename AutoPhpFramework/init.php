<?php
/**
 *
 * init.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: init.php,v 1.9 2006/09/18 14:41:33 arzen Exp $
 */

$RootDir = APF_ROOT_DIR.DIRECTORY_SEPARATOR; 
$ConfigDir = $RootDir."config".DIRECTORY_SEPARATOR;
$IncludeDir = $RootDir."includes".DIRECTORY_SEPARATOR;
$ClassDir = $RootDir."class".DIRECTORY_SEPARATOR;
$ModuleDir = $RootDir."module".DIRECTORY_SEPARATOR;
$ControllerDir = $RootDir."controller".DIRECTORY_SEPARATOR;
$TemplateDir = $RootDir."web/template/default/";
$WebTemplateDir = "template/default/";
$WebBaseDir = getenv("SCRIPT_NAME");

ini_set('include_path', ".".PATH_SEPARATOR.$IncludeDir."pear");

include_once($ConfigDir."config.php");
include_once($ConfigDir."db_config.php");
include_once("PEAR.php");
include_once("DB.php");
include_once("DB/DataObject.php");
include_once("DB/DataObject/Cast.php");
include_once($ControllerDir."Controller.class.php");
include_once("HTML/Template/PHPLIB.php");

$dsn = "{$DB_Type}://{$DB_UserName}:{$DB_PassWord}@{$DB_Host}/{$DB_Name}";
$conn =& DB::connect ($dsn);
if (DB::isError ($conn))
     die ("Cannot connect: " . $conn->getMessage () . "\n");

$opts = &PEAR::getStaticProperty('DB_DataObject','options');
$opts = array(
	'database'=>$dsn,
    'class_location'  => $RootDir.'/dao/',
    'class_prefix'    => 'Dao',
    'extends_location'=>'',
	'template_location'=>$TemplateDir,
	'actions_location'=>$RootDir,
	'modules_location'=>$RootDir.'/module/users/',
	'modules_name_location'=>'artist',
	'require_prefix'=>'dataobjects/',
	'class_prefix'=>'Dao',
	'extends'=>'DB_DataObject',
	'generate_setters'=>'1',
	'generate_getters'=>'1',
	'artist_fields_list'=>'artistid,artistcode,artistname,artistname_eng,gender,lang,initial,status',
	'artist_except_fields'=>'artistid,create_time,last_updated,imageurl,imagex,imagey,thumburl,thumbx,thumby,status,popularity,image_status',
	
	'generator_add_validate_stubs'=>'video_url:empty,video_length:empty',
	'generator_include_regex'=>'/'.$users_table.'/',
	'generator_no_ini'=>'1',
);

$controller = new Controller();

$template = new Template_PHPLIB($TemplateDir);
$template->setFile(array(
     "LAOUT" => "laout.html",
     "TAB" => "tab.html",
     "FOOT" => "foot.html",
 ));
 
$template->setBlock("LAOUT", "laout");
$template->setBlock("TAB", "tab");
 
$template->setVar(array (
	"TEMPLATEDIR" => dirname(getenv("SCRIPT_NAME"))."/".$WebTemplateDir,
	"WEBBASEDIR" => $WebBaseDir,
));

?>
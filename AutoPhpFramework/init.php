<?php
/**
 *
 * init.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: init.php,v 1.10 2006/09/19 14:03:16 arzen Exp $
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
	'modules_location'=>$RootDir.'/module/news/',
	'modules_name_location'=>'news',
	'require_prefix'=>'dataobjects/',
	'class_prefix'=>'Dao',
	'extends'=>'DB_DataObject',
	'generate_setters'=>'1',
	'generate_getters'=>'1',
	$news_category_table.'_fields_list'=>'id,category_name,active',
	$news_category_table.'_except_fields'=>'id,add_ip,created_at,update_at',
	
	'generator_add_validate_stubs'=>'category_name:empty',
	'generator_include_regex'=>'/'.$news_category_table.'/',
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
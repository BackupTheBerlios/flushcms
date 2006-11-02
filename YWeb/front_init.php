<?php
/**
 *
 * front_init.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: front_init.php,v 1.1 2006/11/02 23:51:15 arzen Exp $
 */
$RootDir = APF_ROOT_DIR . DIRECTORY_SEPARATOR;
$ConfigDir = $RootDir . "config" . DIRECTORY_SEPARATOR;
if (!file_exists("D:/workspace/APF/")) 
{
	$tempRootDir = "D:/www/AutoPhpFramework/";
}
else
{
	$tempRootDir = "D:/workspace/APF/";
}
$IncludeDir = $tempRootDir."includes" . DIRECTORY_SEPARATOR;//$RootDir . "includes" . DIRECTORY_SEPARATOR;
$ClassDir = $tempRootDir. "class" . DIRECTORY_SEPARATOR;//$RootDir . "class" . DIRECTORY_SEPARATOR;
$ModuleDir = $RootDir . "module" . DIRECTORY_SEPARATOR;
$ControllerDir = $RootDir . "controller" . DIRECTORY_SEPARATOR;
$TemplateDir = $RootDir . "web/template/default/";
$WebTemplateDir = "template/network/";
$WebBaseDir = getenv("SCRIPT_NAME");
$WebTemplateFullPath = dirname(getenv("SCRIPT_NAME")) . "/" . $WebTemplateDir;
$domain = 'general';
$dir = $RootDir . 'lang/';
$LogDir = $RootDir."log/";
if (!file_exists($LogDir)) 
{
	mkdir($LogDir,0600);
}
$LogDir = $LogDir.date("Ym")."/";
if (!file_exists($LogDir)) 
{
	mkdir($LogDir,0600);
}

ini_set('include_path', "." . PATH_SEPARATOR . $IncludeDir . "pear");

include_once ($ConfigDir . "config.php");
include_once ($ConfigDir . "db_config.php");
include_once($ClassDir."FormObject.php");
include_once ("PEAR.php");
include_once ("DB.php");
include_once ("DB/DataObject.php");
include_once ("DB/DataObject/Cast.php");
include_once ($ControllerDir . "Controller.class.php");
include_once ("HTML/Template/PHPLIB.php");
include_once ($ClassDir . "Actions.class.php");
require_once 'Log.php';
require_once 'LiveUser.php';
require_once 'I18N/Messages/File.php';
$i18n = new I18N_Messages_File($lang, $domain, $dir);
include_once ($ConfigDir . "common.php");
require_once($ClassDir."SendEmail.php");

$log_conf = array('mode' => 0777, 'timeFormat' => '%X %x');
$logger = &Log::singleton('file', $LogDir.date("Y_m_d").'.log', '\t', $log_conf);

if (defined('APF_DEBUG') && (APF_DEBUG == true))
{
	include_once 'Benchmark/Timer.php';
	include_once 'Var_Dump.php';
	Var_Dump :: displayInit(array (
		'display_mode' => 'HTML4_Table'
	));
	$timer = & new Benchmark_Timer();
	$timer->start();
}

$UploadDir = $RootDir."web/".$Upload_Dir;
$WebUploadDir = dirname(getenv("SCRIPT_NAME")) . "/" . $Upload_Dir;
$dsn = "{$DB_Type}://{$DB_UserName}:{$DB_PassWord}@{$DB_Host}/{$DB_Name}";
$conn = & DB :: connect($dsn);
if (DB :: isError($conn))
{
	$subject = "Error:cannot connect database";
	$error_msg = "Cannot connect database: " . $conn->getMessage() . "\n";
	errorMailToMaster ($Tech_Mail,$subject,$error_msg); 
	$logger->log($error_msg);
	die($error_msg);
}

$opts = & PEAR :: getStaticProperty('DB_DataObject', 'options');
$opts = array (
	'database' => $dsn,
	'class_location' => $RootDir . '/dao/',
	'class_prefix' => 'Dao',
	'extends_location' => '',
	'template_location' => $TemplateDir,
	'actions_location' => $RootDir,
	'modules_location' => $RootDir . '/module/users/',
	'require_prefix' => 'dataobjects/',
	'class_prefix' => 'Dao',
	'extends' => 'DB_DataObject',
	'generate_setters' => '1',
	'generate_getters' => '1',

	'generator_include_regex' => '/^' . $news_category_table . '$/',
	'generator_no_ini' => '1',
	
);

$controller = new Controller();

$template = new Template_PHPLIB($TemplateDir);
$template->setFile(array (
	"HEADER" => "header.html",
	"MENU" => "menu.html",
	"FOOT" => "footer.html",
	"FRONT_LAOUT" => "front_laout.html",
));

$template->setBlock("FRONT_LAOUT", "front_laout");

?>

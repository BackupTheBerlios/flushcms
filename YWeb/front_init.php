<?php
/**
 *
 * front_init.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: front_init.php,v 1.5 2006/11/26 23:39:58 arzen Exp $
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
$TemplateDir = $RootDir . "web/template/network/";
$CacheDir = $RootDir . "cache_data/";
$WebTemplateDir = "template/network/";
$WebBaseDir = getenv("SCRIPT_NAME");
$WebBaseDirName = dirname(getenv("SCRIPT_NAME")). "/"  ;
$WebTemplateFullPath = dirname(getenv("SCRIPT_NAME")) . "/" . $WebTemplateDir;
$domain = 'general';
$dir = $RootDir . 'lang/';
$LogDir = $RootDir."log/";
if (!file_exists($LogDir)) 
{
	mkdir($LogDir,0755);
}
$LogDir = $LogDir.date("Ym")."/";
if (!file_exists($LogDir)) 
{
	mkdir($LogDir,0755);
}
if (!file_exists($CacheDir)) 
{
	mkdir($CacheDir,0777);
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
$template = new Template_PHPLIB($TemplateDir);
$path_arr = pathinfo($WebBaseDir);
$web_base_name = $path_arr['basename'];
if ($web_base_name=="front_en.php") 
{
	$lang="en";
	$template->setFile(array (
		"LAOUT" => "front_laout.html",
		"HEADER" => "header.html",
		"MENU" => "menu.html",
		"FOOT" => "footer_en.html",
	));
} 
else 
{
	$lang="zh";
	$template->setFile(array (
		"LAOUT" => "front_laout.html",
		"HEADER" => "header.html",
		"MENU" => "menu.html",
		"FOOT" => "footer.html",
	));
}

$i18n = new I18N_Messages_File($lang, $domain, $dir);
include_once ($ConfigDir . "common.php");
require_once($ClassDir."SendEmail.php");

require_once "Cache/Lite.php";


$cache_options = array(
    'cacheDir' => $CacheDir,
    'lifeTime' => 7200,
    'pearErrorMode' => CACHE_LITE_ERROR_DIE
);
$cache = new Cache_Lite($cache_options);


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

$controller = new Controller();


$template->setBlock("FOOT", "foot");
$template->setBlock("LAOUT", "front_laout");
$template->setBlock("MENU", "menu");
include_once($ClassDir."URLHelper.class.php");
$template->setVar(array (
	"WEBDIR" => $WebBaseDir,
	"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,

));

?>

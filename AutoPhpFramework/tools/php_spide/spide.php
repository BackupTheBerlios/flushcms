<?php
/**
 *
 * spide.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: spide.php,v 1.2 2006/10/18 10:25:55 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/../..'));
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'init.php');
require_once('Config.php');
require_once 'Config/Container.php';
require_once 'XML/Util.php';
require_once 'ConfigFile.php';
require_once 'ContentParse.php';
require_once 'Log.php';

$PattenConfigDir = "config/";
if (!file_exists($PattenConfigDir)) 
{
	mkdir($PattenConfigDir,0777);
	
}

$PattenLogDir = "log/";
if (!file_exists($PattenLogDir)) 
{
	mkdir($PattenLogDir,0777);
	
}

//http://www.sznet.com.cn/company_contact.php?userid=683
$site="www.sznet.com.cn";
$url="http://www.sznet.com.cn/company_contact.php?userid=683";
$file_type = "GenericConf";

$conf = array('mode' => 0777, 'timeFormat' => '%X %x');
$logger = &Log::singleton('file', $PattenLogDir.$site.'.log', 'ident', $conf);

//createConfigFile($site,$file_type);
 
$data = readConfigFile($site,$file_type); 
$content = getContent($url); 
var_dump($content);


?>

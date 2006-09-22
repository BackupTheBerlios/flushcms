<?php

/**
 *
 * init.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: init.php,v 1.19 2006/09/22 05:40:05 arzen Exp $
 */

$RootDir = APF_ROOT_DIR . DIRECTORY_SEPARATOR;
$ConfigDir = $RootDir . "config" . DIRECTORY_SEPARATOR;
$IncludeDir = $RootDir . "includes" . DIRECTORY_SEPARATOR;
$ClassDir = $RootDir . "class" . DIRECTORY_SEPARATOR;
$ModuleDir = $RootDir . "module" . DIRECTORY_SEPARATOR;
$ControllerDir = $RootDir . "controller" . DIRECTORY_SEPARATOR;
$TemplateDir = $RootDir . "web/template/default/";
$WebTemplateDir = "template/default/";
$WebBaseDir = getenv("SCRIPT_NAME");
$domain = 'general';
$dir = $RootDir . 'lang/';

ini_set('include_path', "." . PATH_SEPARATOR . $IncludeDir . "pear");

include_once ($ConfigDir . "config.php");
include_once ($ConfigDir . "db_config.php");
include_once ("PEAR.php");
include_once ("DB.php");
include_once ("DB/DataObject.php");
include_once ("DB/DataObject/Cast.php");
include_once ($ControllerDir . "Controller.class.php");
include_once ("HTML/Template/PHPLIB.php");
include_once ($ClassDir . "Actions.class.php");
require_once 'LiveUser.php';
require_once 'I18N/Messages/File.php';
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

$dsn = "{$DB_Type}://{$DB_UserName}:{$DB_PassWord}@{$DB_Host}/{$DB_Name}";
$conn = & DB :: connect($dsn);
if (DB :: isError($conn))
	die("Cannot connect: " . $conn->getMessage() . "\n");

$opts = & PEAR :: getStaticProperty('DB_DataObject', 'options');
$opts = array (
	'database' => $dsn,
	'class_location' => $RootDir . '/dao/',
	'class_prefix' => 'Dao',
	'extends_location' => '',
	'template_location' => $TemplateDir,
	'actions_location' => $RootDir,
	'modules_location' => $RootDir . '/module/users/',
	'modules_name_location' => 'users',
	'require_prefix' => 'dataobjects/',
	'class_prefix' => 'Dao',
	'extends' => 'DB_DataObject',
	'generate_setters' => '1',
	'generate_getters' => '1',
	$news_category_table . '_fields_list' => 'id,category_name,active',
	$news_category_table . '_except_fields' => 'id,add_ip,created_at,update_at',

	$users_table . '_fields_list' => 'id,user_name,user_pwd,gender,phone,role_id,active',
	$users_table . '_except_fields' => 'id,add_ip,created_at,update_at',

	'generator_add_validate_stubs' => 'user_name:empty',
	'generator_include_regex' => '/' . $users_table . '/',
	'generator_no_ini' => '1',
	
);

$liveuserConfig = array (
	'session' => array (
		'name' => 'PHPSESSID',
		'varname' => 'loginInfo'
	),
	'logout' => array (
		'destroy' => true
	),
	'cookie' => array (
		'name' => 'loginInfo',
		'path' => null,
		'domain' => null,
		'secure' => false,
		'lifetime' => 30,
		'secret' => 'mysecretkey',
		'savedir' => '.',
		
	),
	'authContainers' => array (
		'DB' => array (
			'type' => 'DB',
			'expireTime' => 5,
			'idleTime' => 5,
			'prefix' => '',
			'passwordEncryptionMode' => 'plain',
			'storage' => array (
				'dsn' => $dsn,
				'alias' => array (
					'users' => $users_table,
					'auth_user_id' => 'id',
					'handle' => 'user_name',
					'passwd' => 'user_pwd',
					'lastlogin' => 'update_at',
					'is_active' => 'active',
					
				),
				'fields' => array (
					'lastlogin' => 'timestamp',
					'is_active' => 'boolean',
					
				),
				
			)
		)
	),
	
);

$i18n = new I18N_Messages_File($lang, $domain, $dir);

$controller = new Controller();

$template = new Template_PHPLIB($TemplateDir);
$template->setFile(array (
	"LAOUT" => "laout.html",
	"TAB" => "tab.html",
	"FOOT" => "foot.html",
	
));

$template->setBlock("LAOUT", "laout");
$template->setBlock("TAB", "tab");

$template->setVar(array (
	"TEMPLATEDIR" => dirname(getenv("SCRIPT_NAME"
)) . "/" . $WebTemplateDir, "WEBBASEDIR" => $WebBaseDir, "SITETITLE" => $i18n->_('site_title'), "CHARSET" => $i18n->getCharset(),));

$LU =& LiveUser::factory($liveuserConfig);

if (!$LU->init()) {
    var_dump($LU->getErrors());
    die();
}

$handle = (array_key_exists('handle', $_REQUEST)) ? $_REQUEST['handle'] : null;
$passwd = (array_key_exists('passwd', $_REQUEST)) ? $_REQUEST['passwd'] : null;
$logout = (array_key_exists('logout', $_REQUEST)) ? $_REQUEST['logout'] : false;
if ($logout) {
    $LU->logout(true);
} elseif(!$LU->isLoggedIn() || ($handle && $LU->getProperty('handle') != $handle)) {
    if (!$handle) {
        $LU->login(null, null, true);
    } else {
        $LU->login($handle, $passwd, $remember);
    }
}

require_once 'LiveUser/Admin.php';

$luadmin =& LiveUser_Admin::factory($liveuserConfig);
$luadmin->init();

if (!$LU->isLoggedIn()) 
{
	$template->setFile(array (
		"MAIN" => "login_screen.html"
	));
	$template->parse("OUT", array (
		"MAIN",
	));
	$template->p("OUT");
	exit();
}

?>
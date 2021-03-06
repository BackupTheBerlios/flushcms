<?php

/**
 *
 * init.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: init.php,v 1.55 2006/12/09 14:31:35 arzen Exp $
 */
define('CREATE', 3);

$RootDir = APF_ROOT_DIR . DIRECTORY_SEPARATOR;
$ConfigDir = $RootDir . "config" . DIRECTORY_SEPARATOR;
$IncludeDir = $RootDir . "includes" . DIRECTORY_SEPARATOR;
$ClassDir = $RootDir . "class" . DIRECTORY_SEPARATOR;
$ModuleDir = $RootDir . "module" . DIRECTORY_SEPARATOR;
$ControllerDir = $RootDir . "controller" . DIRECTORY_SEPARATOR;
$TemplateDir = $RootDir . "web/template/default/";
$WebTemplateDir = "template/default/";
$WebBaseDir = getenv("SCRIPT_NAME");
$WebTemplateFullPath = dirname(getenv("SCRIPT_NAME")) . "/" . $WebTemplateDir;
$WebJSToolkitPath = dirname(getenv("SCRIPT_NAME")) . "/jstoolkit/";
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
$language_string = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
$language_arr = explode(",",$language_string);
$this_language = $language_arr[0];
switch ($this_language) {
	case "zh":
	case "zh-cn":
		$lang='zh';
		break;
	case "zh-tw":
	case "zh-hk":
		$lang='big5';
		break;
	default:
		$lang="en";
		break;
}

$global_arr = array();
$i18n = new I18N_Messages_File($lang, $domain, $dir);
include_once ($ConfigDir . "common.php");
require_once($ClassDir."SendEmail.php");

$log_conf = array('mode' => 0777, 'timeFormat' => '%X %x');
$logger = &Log::singleton('file', $LogDir.date("Y_m_d").'.log', 'apf', $log_conf);

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
$DocumentDir = $UploadDir.$Document_Dir;
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

include_once ($ConfigDir . "dao_option.php");

$controller = new Controller();

$template = new Template_PHPLIB($TemplateDir);
$template->setFile(array (
	"LAOUT" => "laout.html",
//	"LEFT" => "left.html",
	"FOOT" => "foot.html",
	
));

$template->setBlock("LAOUT", "laout");
//$template->setBlock("LEFT", "left");
if (defined('APF_LOGIN_ACCESS') && (APF_LOGIN_ACCESS == "Y") ) 
{
	
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
			'lifetime' => 120,
			'secret' => 'mysecretkey',
			'savedir' => $RootDir.'cookies',
			
		),
		'authContainers' => array (
			'DB' => array (
				'type' => 'DB',
				'expireTime' => 60*60*5,
				'idleTime' => 60*60*5,
				'prefix' => 'apf_',
				'passwordEncryptionMode' => 'md5',
				'storage' => array (
					'prefix' => '',
					'dsn' => $dsn,
                    'tables' => array(
                        'users' => array(
                            'fields' => array(
                                'email' => false,
                                'lastlogin' => false,
								'is_active' => false,
                            ),
                        ),
                    ),
					'alias' => array (
						'users' => $users_table,
						'auth_user_id' => 'id',
						'handle' => 'user_name',
						'passwd' => 'user_pwd',
						'lastlogin' => 'update_at',
						'is_active' => 'active',
                        'email' => 'email',
					),
					'fields' => array (
						'lastlogin' => 'timestamp',
						'is_active' => 'text',
                        'email' => 'text',
					),
					
				)
			)
		),
	
	    'permContainer' => array(
	        'type' => 'Medium',
	        'storage' => array(
	            'DB' => array(              // storage container name
	                'dsn' => $dsn,
	                'prefix' => 'apf_',  // table prefix
	                'tables' => array(        // contains additional tables
	                                          // or fields in existing tables
	                    'groups' => array(
	                        'fields' => array(
	                            'owner_user_id'  => false,
	                            'owner_group_id' => false,
	                            'is_active'      => false
	                        )
	                    )
	                ),
	                'fields' => array(        // contains any additional
	                                          // or non-default field types
	                    'owner_user_id'  => 'integer',
	                    'owner_group_id' => 'integer',
	                    'is_active'      => 'boolean'
	                ),
	                'alias'  => array(        // contains any additional
	                                          // or non-default field alias
	                    'owner_user_id'  => 'owner_user_id',
	                    'owner_group_id' => 'owner_group_id',
	                    'is_active'      => 'is_active'
	                )
	            )
	        )
	    )
	    	
	);
	
	$LU =& LiveUser::factory($liveuserConfig);
	
	if (!$LU->init()) {
	    var_dump($LU->getErrors());
	    die();
	}
	
	$handle = (array_key_exists('handle', $_REQUEST)) ? $_REQUEST['handle'] : null;
	$passwd = (array_key_exists('passwd', $_REQUEST)) ? $_REQUEST['passwd'] : null;
	$logout = (array_key_exists('logout', $_REQUEST)) ? $_REQUEST['logout'] : false;
	$remember = (array_key_exists('remember', $_REQUEST)) ? $_REQUEST['remember'] : false;
	if ($logout) 
	{
	     $LU->logout(true);
	     header("location:".getenv("SCRIPT_NAME"));
	} 
	elseif(!$LU->isLoggedIn() || ($handle && $LU->getProperty('handle') != $handle) ) 
	{
	    if (!$handle) {
	        $LU->login(null, null, true);
	    } else {
	        $LU->login($handle, $passwd, $remember);
	    }
	}
	
	require_once 'LiveUser/Admin.php';
	
	$luadmin =& LiveUser_Admin::factory($liveuserConfig);
	$luadmin->init();
	//Var_Dump::display($LU->readRememberCookie());
	if (!$LU->isLoggedIn() || ($LU->getProperty('is_active') == "deleted" )) 
	{
		$template->setFile(array (
			"MAIN" => "login_screen.html"
		));
		$controller->parseTemplateLang();
		$template->parse("OUT", array (
			"MAIN",
		));
		$template->p("OUT");
		exit();
	}
	$user_name=$LU->getProperty("handle");
	$userid=$LU->getProperty("auth_user_id");
	$group_arr=$LU->getProperty('group_ids','perm');
	$group_ids=is_array($group_arr)?implode(",",$group_arr):$group_arr;
	
	require_once $ClassDir."ClientEnv.class.php";
	$AddIP=ClientEnv::getTrueIP();
	
//	$LU->getProperty("auth_user_id")
//	Var_Dump::display($LU->getProperty('group_ids','perm'));
}

?>
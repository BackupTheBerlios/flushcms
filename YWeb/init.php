<?php

/**
 *
 * init.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: init.php,v 1.6 2006/11/30 05:07:13 arzen Exp $
 */
define('CREATE', 3);

$RootDir = APF_ROOT_DIR . DIRECTORY_SEPARATOR;
$ConfigDir = $RootDir . "config" . DIRECTORY_SEPARATOR;
if (!file_exists("D:/workspace/APF/")) 
{
	$tempRootDir = "D:/www/AutoPhpFramework/";
}
else
{
	$tempRootDir = $RootDir;
}
$IncludeDir = $tempRootDir."includes" . DIRECTORY_SEPARATOR;//$RootDir . "includes" . DIRECTORY_SEPARATOR;
$ClassDir = $tempRootDir. "class" . DIRECTORY_SEPARATOR;//$RootDir . "class" . DIRECTORY_SEPARATOR;
$ModuleDir = $RootDir . "module" . DIRECTORY_SEPARATOR;
$ControllerDir = $RootDir . "controller" . DIRECTORY_SEPARATOR;
$TemplateDir = $RootDir . "web/template/default/";
$PhpbbDir = $RootDir .'bbs/';
$WebTemplateDir = "template/default/";
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
	
	$users_table.'_modules_location' => $RootDir . '/module/users/',
	$users_table.'_modules_name_location' => 'users',
	$users_table . '_fields_list' => 'id,user_name,user_pwd,gender,phone,role_id,active',
	$users_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$users_table.'_generator_add_validate_stubs' => 'user_name:empty',

	$groups_table.'_modules_location' => $RootDir . '/module/users/',
	$groups_table.'_modules_name_location' => 'users',
	$groups_table . '_fields_list' => 'group_id,group_type,group_define_name,is_active,owner_user_id,owner_group_id',
	$groups_table . '_except_fields' => '',
	$groups_table.'_generator_add_validate_stubs' => 'group_define_name:empty',

	$rights_table.'_modules_location' => $RootDir . '/module/users/',
	$rights_table.'_modules_name_location' => 'users',
	$rights_table . '_fields_list' => 'right_id,right_define_name',
	$rights_table . '_except_fields' => 'area_id,has_implied',
	$rights_table.'_generator_add_validate_stubs' => 'right_define_name:empty',
	
	$news_category_table.'_modules_location' => $RootDir . '/module/news/',
	$news_category_table.'_modules_name_location' => 'news',
	$news_category_table . '_fields_list' => 'id,category_name,active',
	$news_category_table . '_except_fields' => 'id,add_ip,created_at,update_at,orderid',
	$news_category_table.'_generator_add_validate_stubs' => 'category_name:empty',

	$news_table.'_modules_location' => $RootDir . '/module/news/',
	$news_table.'_modules_name_location' => 'news',
	$news_table . '_fields_list' => 'id,title,category_id,active',
	$news_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$news_table.'_generator_add_validate_stubs' => 'title:empty',

	$product_category_table.'_modules_location' => $RootDir . '/module/product/',
	$product_category_table.'_modules_name_location' => 'product',
	$product_category_table . '_fields_list' => 'id,category_name,active',
	$product_category_table . '_except_fields' => 'id,add_ip,created_at,update_at,orderid',
	$product_category_table.'_generator_add_validate_stubs' => 'category_name:empty',

	$product_table.'_modules_location' => $RootDir . '/module/product/',
	$product_table.'_modules_name_location' => 'product',
	$product_table . '_fields_list' => 'id,category,company_id,name,price,photo,active',
	$product_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$product_table.'_generator_add_validate_stubs' => 'name:empty',


	$product_price_table.'_modules_location' => $RootDir . '/module/product/',
	$product_price_table.'_modules_name_location' => 'product',
	$product_price_table . '_fields_list' => 'id,company_id,product_id,price,created_at',
	$product_price_table . '_except_fields' => 'id,add_ip,company_id,product_id,created_at,update_at',
	$product_price_table.'_generator_add_validate_stubs' => 'price:empty',

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
	"LAOUT" => "laout.html",
	"FOOT" => "foot.html",
	
));

$template->setBlock("LAOUT", "laout");
//&& (APF_LOGIN_ACCESS == "Y")
if (defined('APF_LOGIN_ACCESS')  ) 
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
			'lifetime' => 30,
			'secret' => 'mysecretkey',
			'savedir' => $RootDir.'cookies',
			
		),
		'authContainers' => array (
			'DB' => array (
				'type' => 'DB',
				'expireTime' => 60*60,
				'idleTime' => 60*60,
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
//	Var_Dump::display($LU->isLoggedIn());
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
//	$LU->getProperty("auth_user_id")
//	Var_Dump::display($LU->getProperty("is_active"));
}

?>
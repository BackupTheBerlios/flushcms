<?php
/**
 *
 * connect.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: connect.php,v 1.1 2006/11/06 14:05:27 arzen Exp $
 */
global $logger,$DB_Type,$DB_UserName,$DB_PassWord,$DB_Host,$DB_Name,$opts,$RootDir,$TemplateDir;
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


?>

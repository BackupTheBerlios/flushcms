<?php
/**
 *
 * config.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: config.php,v 1.10 2006/10/12 23:41:15 arzen Exp $
 */
 
$DB_Type = "mysql";
$DB_Host = "localhost";
$DB_UserName = "root";
$DB_PassWord = "test1234";
$DB_Name = "dev_apf";

$DefaultModule = "users";
$DefaultPage = "apf_users";

$DbPrefix = "apf_";
$lang   = 'zh';

$CurrencyFormat = "zh_CN";

$AllowUploadFilesType = array('jpg','gif','png','xls');
$Upload_Dir = "uploads/";

// Send SMS SIP num
define("SMS_SMSC","8613800755500");

?>

<?php
/**
 *
 * config.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: config.php,v 1.11 2006/10/24 10:33:30 arzen Exp $
 */
 
$DB_Type = "mysql";
$DB_Host = "localhost";
$DB_UserName = "root";
$DB_PassWord = "test1234";
$DB_Name = "dev_apf";

$SMTP_Host = "mailsz.achievo.com";
$SMTP_UserName = "john.meng";
$SMTP_PassWord = "test1234";
$SMTP_Auth = TRUE;

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

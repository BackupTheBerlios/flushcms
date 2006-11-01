<?php
/**
 *
 * config.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: config.php,v 1.3 2006/11/01 15:13:15 arzen Exp $
 */
 
$DB_Type = "mysql";
$DB_Host = "localhost";
$DB_UserName = "dev";
$DB_PassWord = "dev6543";
$DB_Name = "dev_yweb";

$SMTP_Host = "mailsz.achievo.com";
$SMTP_UserName = "john.meng";
$SMTP_PassWord = "test123456";
$SMTP_Auth = TRUE;

$Tech_Mail = "arzen1013@gmail.com";

$DefaultModule = "users";
$DefaultPage = "apf_users";

$DbPrefix = "apf_";
$lang   = 'en';

$CurrencyFormat = "zh_CN";

$AllowUploadFilesType = array('jpg','gif','png','xls');
$Upload_Dir = "uploads/";

// Send SMS SIP num
define("SMS_SMSC","8613800755500");

?>

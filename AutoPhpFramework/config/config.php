<?php
/**
 *
 * config.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: config.php,v 1.16 2006/11/02 02:22:09 arzen Exp $
 */
 
$DB_Type = "mysql";
$DB_Host = "localhost";
$DB_UserName = "dev";
$DB_PassWord = "dev6543";
$DB_Name = "dev_apf";

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
$MaxFileSize = 2097152;//2M 2097152

// Send SMS SIP num
define("SMS_SMSC","8613800755500");

?>

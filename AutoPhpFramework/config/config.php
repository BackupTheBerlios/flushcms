<?php
/**
 *
 * config.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: config.php,v 1.21 2006/12/06 05:35:24 arzen Exp $
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
$lang   = 'big5';

$CurrencyFormat = "zh_CN";

$AllowUploadFilesType = array('jpg','gif','png','xls');
$MaxFileSize = 2097152;//2M 2097152
$Upload_Dir = "uploads/";

$Document_Dir = "documents/";
$AllowUploadDocumentFilesType = array('jpg','gif','png','xls','zip','doc','rar','ppt','html','htm');
$DocumentMaxFileSize = 2097152;//2M 2097152

// Send SMS SIP num
define("SMS_SMSC","8613800755500");
define("SHOW_SMS",false);

?>

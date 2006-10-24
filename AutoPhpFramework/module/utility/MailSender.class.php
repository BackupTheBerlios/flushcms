<?php

/**
 *
 * MailSender.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: MailSender.class.php,v 1.4 2006/10/24 10:33:31 arzen Exp $
 */

class MailSender
{

	function executeWriteMail()
	{
		global $template,$WebBaseDir,$controller,$i18n,$ActiveOption;
		$template->setFile(array (
			"MAIN" => "apf_mail_write.html"
		));
		$template->setBlock("MAIN", "edit_block");
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"TEXTAREACONTENT" => textareaTag ("content","",true),
			"DOACTION" => "sendsubmit"
		));
	
	}
	
	function executeSendsubmit () 
	{
		global $template,$WebBaseDir,$ClassDir,$controller,$i18n,$ActiveOption;

		require_once($ClassDir."SendEmail.php");
		
		$arr = sendEmail (trim($_POST['to']),'arzen1013@163.com','arzen1013','arzen1013@163.com',trim($_POST['title']),trim($_POST['content']),trim($_POST['content']));

		$template->setFile(array (
			"MAIN" => "apf_mail_write.html"
		));
		$template->setBlock("MAIN", "edit_block");
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"SENT_MSG" => "<h2>".$arr["msg"]."</h2>",
			"SUCCESS_CLASS" => "save-ok",
			"TEXTAREACONTENT" => textareaTag ("content","",true),
			"DOACTION" => "sendsubmit"
		));

	}
	
}
?>
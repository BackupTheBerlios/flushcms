<?php

/**
 *
 * MailSender.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: MailSender.class.php,v 1.1 2006/10/24 02:06:32 arzen Exp $
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
			"DOACTION" => "addsubmit"
		));
	
	}
	
}
?>
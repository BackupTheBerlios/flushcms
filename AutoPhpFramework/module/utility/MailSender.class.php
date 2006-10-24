<?php

/**
 *
 * MailSender.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: MailSender.class.php,v 1.3 2006/10/24 06:33:33 arzen Exp $
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
		global $template,$WebBaseDir,$controller,$i18n,$ActiveOption;

		require_once("phpmailer/class.phpmailer.php");

		echo $recipients = trim($_POST['to']);
		$headers['From']    = 'john.meng@achievo.com';
		$headers['To']      = trim($_POST['to']);
		$headers['Subject'] = trim($_POST['title']);
		$body = trim($_POST['content']);
		
		$text = 'Text version of email';
		$html = <<<EOD
<html><head>
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"></head>
<body>		
{$body}
</body>
</html>
EOD;
		$mail = new PHPMailer();
		
		$mail->IsSMTP();                                      // set mailer to use SMTP
		$mail->Host = "mailsz.achievo.com";  // specify main and backup server
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = "john.meng";  // SMTP username
		$mail->Password = "test123456"; // SMTP password
		
		$mail->CharSet = "gb2312";
		$mail->Encoding = "base64";
		$mail->From = $headers['From'];
		$mail->FromName = "AutoPHPFrameworkMailer";
		$mail->AddAddress($headers['To']);
		$mail->AddReplyTo($headers['From']);
		
		$mail->WordWrap = 50;                                 // set word wrap to 50 characters
//		$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//		$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
		$mail->IsHTML(true);                                  // set email format to HTML
		
		$mail->Subject = $headers['Subject'];
		$mail->Body    = $html;
		$mail->AltBody = $text;
		
		if(!$error = $mail->Send())
		{
		   echo "Message could not be sent. <p>";
		   echo "Mailer Error: " . $mail->ErrorInfo;
		   exit;
		}
		var_dump($error);
		echo "Message has been sent";
	}
	
}
?>
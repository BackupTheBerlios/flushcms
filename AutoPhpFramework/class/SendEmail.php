<?php
/**
 *
 * SendEmail.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     孟远螓
 * @author     QQ:3440895
 * @version    CVS: $Id: SendEmail.php,v 1.2 2006/10/25 23:49:52 arzen Exp $
 */
function sendEmail ($recipients,$from,$from_name,$reply,$subject,$text,$html_body,$attach="") 
{
		global $SMTP_Host,$SMTP_UserName,$SMTP_PassWord,$SMTP_Auth,$i18n;
		require_once("phpmailer/class.phpmailer.php");

		
		$charset = $i18n->getCharset();
		$html = <<<EOD
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset={$charset}"></head>
<body>		
{$html_body}
</body>
</html>
EOD;
		$mail = new PHPMailer();
		
		$mail->IsSMTP();                                      // set mailer to use SMTP
		$mail->Host = $SMTP_Host;  // specify main and backup server
		$mail->SMTPAuth = $SMTP_Auth;     // turn on SMTP authentication
		$mail->Username = $SMTP_UserName;  // SMTP username
		$mail->Password = $SMTP_PassWord; // SMTP password
		
		$mail->CharSet = $charset;
		$mail->Encoding = "base64";
		$mail->From = $from;
		$mail->FromName = $from_name?$from_name:$from;
		
		if (is_array($recipients)) 
		{
			foreach($recipients as $key=>$value)
			{
				$mail->AddAddress($value);
			}
		}
		else
		{
			$mail->AddAddress($recipients);
		}
		$mail->AddReplyTo($reply?$reply:$from);
		
		$mail->WordWrap = 50;                                 // set word wrap to 50 characters
//		$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//		$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
		$mail->IsHTML(true);                                  // set email format to HTML
		
		$mail->Subject = $subject;
		$mail->Body    = $html;
		$mail->AltBody = $text;
		$data = array();
		if(!$mail->Send())
		{
			$data['flag']=true;	
			$data['msg']=$i18n->_("Message could not be sent.").$mail->ErrorInfo;
			return $data;	
		   	exit;
		}
		$data['flag']=true;	
		$data['msg']=$i18n->_("Message has been sent");
		return $data;	
}

function errorMailToMaster ($email,$Title,$Content) 
{
		
		$from = "arzen1013@163.com";
		$from_name = "webmaster";
		$message.="Error title: " .$_SERVER["HTTP_HOST"].$Title. "\n\n";
		$message.="Error content: " .$Content. "\n\n";
		$message.="出错日期: ".date("Y-m-d H:i:s ")."\n";
		$message.="出错页面: " . getenv("REQUEST_URI") . "\n";
		$message.="进入页面: ".getenv("HTTP_REFERER")."\n\n";
		$message.="Thank you,\n";
		$message.="AutoPHPFramework\n";
		
		sendEmail ($email,$from,$from_name,$from,$Title,$message,$message);
	
}
?>

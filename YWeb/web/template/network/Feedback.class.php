<?php


/**
 *
 * Feedback.class.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     孟远螓
 * @author     QQ:3440895
 * @version    CVS: $Id: Feedback.class.php,v 1.1 2006/11/11 04:28:49 arzen Exp $
 */
require_once 'HTML/AJAX/Action.php';

// Error messages
define('ERR_USERNAME_EMPTY', mb_convert_encoding('请输入您的姓名', "UTF-8", "GB2312"));
define('ERR_TITLE_EMPTY', mb_convert_encoding('请输入您反馈的主题', "UTF-8", "GB2312"));
define('ERR_CONTENT_EMPTY', mb_convert_encoding('请输入您反馈的内容', "UTF-8", "GB2312"));
define('ERR_EMAIL_EMPTY', mb_convert_encoding('请输入您的Email', "UTF-8", "GB2312"));
define('ERR_EMAIL_INVALID', mb_convert_encoding('您的Email地址格式不对，要输入如：xxxxx@xxx.xxx', "UTF-8", "GB2312"));

class Feedback
{

	/**
	* Checks the proper syntax
	*/
	function _checkEmail($strEmail)
	{
		return (preg_match('/^[A-Z0-9._-]+@[A-Z0-9][A-Z0-9.-]{0,61}[A-Z0-9]\.[A-Z.]{2,6}$/i', $strEmail));
	}

	/**
	 * Checks if the passed values are correct.
	 *
	 * @param array the form object
	 */
	function validate($arrayForm)
	{
		//--------------------------------------------------
		// Initialize function
		//--------------------------------------------------
		// Array to hold the messages
		$arrMessages = array ();

		// Set all form values that they validated. Could be improved by analyzing
		// the values passed in $objForm and setting values accordingly.
		$arrValidated = array ();
		$arrValidated['value_550'] = true;
		$arrValidated['value_552'] = true;
		$arrValidated['mail_from'] = true;
		$arrValidated['value_553'] = true;

		// Never trust the values passed by users :)
		$objForm = new stdClass();
		$objForm->value_550 = trim($arrayForm['value_550']);
		$objForm->value_552 = trim($arrayForm['value_552']);
		$objForm->value_553 = trim($arrayForm['value_553']);
		$objForm->mail_from = trim($arrayForm['mail_from']);

		//--------------------------------------------------
		// Check values
		//--------------------------------------------------
		// Check mail_from
		if ($objForm->mail_from == '')
		{
			$arrMessages[] = ERR_EMAIL_EMPTY;
			$arrValidated['mail_from'] = false;
		}
		else
			if ($this->_checkEmail($objForm->mail_from) == false)
			{
				$arrMessages[] = ERR_EMAIL_INVALID;
				$arrValidated['mail_from'] = false;
			}

		// Check value_550
		if ($objForm->value_550 == '')
		{
			$arrMessages[] = ERR_USERNAME_EMPTY;
			$arrValidated['value_550'] = false;
		}
		// Check value_552
		if ($objForm->value_552 == '')
		{
			$arrMessages[] = ERR_TITLE_EMPTY;
			$arrValidated['value_552'] = false;
		}
		// Check value_553
		if ($objForm->value_553 == '')
		{
			$arrMessages[] = ERR_CONTENT_EMPTY;
			$arrValidated['value_553'] = false;
		}

		//--------------------------------------------------
		// Finalize function
		//--------------------------------------------------
		// Create the message list
		$strMessages = '';
		if (count($arrMessages) > 0)
		{
			$strMessages = '<ul>';
			foreach ($arrMessages as $strTemp)
			{
				$strMessages .= '<li>' . $strTemp . '</li>';
			}
			$strMessages .= '</ul>';
		}

		// Create a response object
		$objResponse = new HTML_AJAX_Action();

		// Assign the messages
		$objResponse->assignAttr('messages', 'innerHTML', $strMessages);
		$objResponse->insertScript("toggleElement('messages', " . (($strMessages != '') ? 1 : 0) . ");");

		// Generate the scripts to update the form elements' label and input element
		foreach ($arrValidated as $strKey => $blnValue)
		{
			$objResponse->insertScript("setElement('" . $strKey . "', " . (($blnValue) ? '1' : '0') . ");");
		}

		// Test for no messages
		if ($strMessages == "")
		{
			@extract($arrayForm);
			$MailBody ="";
			for ($i=550; $i<600; $i++) 
			{
				$MailKey = "key_".$i;
				$MailValue = "value_".$i;
				if ($$MailKey || $$MailValue) 
				{
					$MailBody .="\r\n".$$MailKey." : ".$$MailValue."\r\n";
				}
			}
			
			$MailBody = mb_convert_encoding($MailBody,"GB2312","UTF-8");
			$dates = date("Y/m/d H:i:s");
			$subject = "一封从您网站反馈过来的信息";
			$from_name = "网站反馈信使";
			$Message = "
			 尊敬管理员 ，您好：
			
			 一封从您网站反馈过来的信息如下:
			
			 $MailBody
			
			 
			
			 日期 :$dates
			
			 非常感谢，
			-----------------------------------------------------------------------
								您的网站反馈信使
					";
			
			$return_data = sendEmail ($mail_to,$mail_from,$from_name,$mail_from,$subject,$Message,nl2br($Message));
			$objResponse->insertAlert(mb_convert_encoding("您的消息已经发送成功，感谢您的反馈！", "UTF-8", "GB2312").$MailBody.implode(",",$arrayForm).implode(",",$return_data));
		}

		// And ready! :)
		return $objResponse;
	}

}
?>
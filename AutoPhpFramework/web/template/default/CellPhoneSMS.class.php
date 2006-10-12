<?php
/**
 *
 * CellPhoneSMS.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     √œ‘∂Ú˚
 * @author     QQ:3440895
 * @version    CVS: $Id: CellPhoneSMS.class.php,v 1.4 2006/10/12 23:41:15 arzen Exp $
 */
include_once($ClassDir."CellPhone.class.php");
include_once($ClassDir."URLHelper.class.php");
class CellPhoneSMS
{
	var $cellphone="";
	
	
	function callPhone($phone_num)
	{
		global $WebTemplateDir;
		CellPhone::openSerialPort();
		CellPhone::callPhone($phone_num);
		CellPhone::closeSerialPort();
		$msg = 'Calling '.$phone_num.'...<INPUT TYPE="image" SRC="'.URLHelper::getWebBaseURL ().'images/hangup.gif" BORDER="0" >';
		$data=array("phone_num"=>$phone_num,"msg"=>$msg);
		return $data;
	}
	
	function hangUp () 
	{
		CellPhone::openSerialPort();
		CellPhone::callHangUp();
		CellPhone::closeSerialPort();
		return "";
	}
	
	function connectCOM () 
	{
		CellPhone::openSerialPort();
	}
	
	function disconnectCOM () 
	{
		CellPhone::closeSerialPort();
	}
	
	function doSendSMS () 
	{
		$args = func_get_args();
		if($args[2])
		{
//			CellPhone::openSerialPort();
//			CellPhone::sendSMS($args[1],$args[2]);
			CellPhone::sendPDUSms($args[1],$args[2]);
//			CellPhone::closeSerialPort();
		}
		return "";
	}
	
	function callMobilePhone($phone_num)
	{
		CellPhone::openSerialPort();
		CellPhone::callPhone($phone_num);
		CellPhone::closeSerialPort();
		$msg = 'Calling '.$phone_num.'...<INPUT TYPE="image" SRC="'.URLHelper::getWebBaseURL ().'images/hangup.gif" BORDER="0" >';
		$data=array("phone_num"=>$phone_num,"msg"=>$msg);
		return $data;
	}
	
	function sendSMS($phone_num)
	{
		$msg = 'Send to '.$phone_num.' Max length 160 charts<TEXTAREA NAME="content" ROWS="8" COLS="16"></TEXTAREA>';
		$msg .= '<INPUT TYPE="submit" VALUE="Send"><INPUT TYPE="hidden" name="phone_num" id="phone_num" value="'.$phone_num.'" >';
		$data=array("phone_num"=>$phone_num,"msg"=>$msg);
		return $data;
	}
	
}
?>
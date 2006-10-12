<?php
/**
 *
 * CellPhone.class.php.
 * extension=php_ser.dll
 * download from http://www.easyvitools.com/download/download.php 
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     孟远螓
 * @author     QQ:3440895
 * @version    CVS: $Id: CellPhone.class.php,v 1.5 2006/10/12 23:41:15 arzen Exp $
 */
include_once($ConfigDir."at.command.php");
include_once($ClassDir."StringHelper.class.php");
class CellPhone
{
	
	function openSerialPort()
	{
		if ($_SESSION['APF_OPEN_COM']!="Y") 
		{
			$_SESSION['APF_OPEN_COM']="Y";
			ser_open( "COM12", 9600, 8, "None", 1, "None" ); 
			$str = ser_isopen();
			ser_setDTR( True );
		}
	}
	
	function callPhone ($phone_num) 
	{
		$cmd = NOKIA_QD_CALL_AT_COMMAND."$phone_num;".chr(13);
		ser_write( $cmd );
	}
	
	function callHangUp () 
	{
		$cmd = NOKIA_QD_HANG_UP_AT_COMMAND.chr(13);
		ser_write( $cmd );
	}
	
	function sendSMS ($phone_num,$content) 
	{
		$cmd = NOKIA_QD_CMGF_AT_COMMAND."1".chr(13);
		ser_write($cmd);
		$cmd_log = $cmd;
		$cmd = NOKIA_QD_CMGS_AT_COMMAND." \"+86".$phone_num."\" ".chr(13);
		ser_write($cmd);
		$cmd_log .= $cmd;
		$cmd =$content." ".chr(26)." ".chr(13);
		ser_write($cmd);
		$cmd_log .= $cmd;
		
		$fp = fopen("log.txt","w+");
		fwrite($fp, $cmd_log);
		fclose($fp);
		return "";
	}
	
	function sendPDUSms ($phone_num,$sms_text) 
	{
		// 短信中心号码
		$smsc = SMS_SMSC;
		$cmd_log = $smsc;
		$cmd_log .= $sms_text;
		// 短信最大长度70个汉字，Unicode表示需要280个字节
		$max_len = 280;
		$invert_smsc = InvertNumbers($smsc);
	
		$len = 1; 
		$s = chr(13);
		$phone_num = "86". $phone_num;
		$sms_text = $sms_text;
	   
	   
		$pdu_text = hex2str(gb2unicode($sms_text));
		$cmd_log .= gb2unicode($sms_text);
		$invert_msisdn = InvertNumbers($phone_num);
	   
		// 拆分发送超过70汉字的短信(todo: 没有判断全英文的情况)
		$pdu_len = strlen($pdu_text);
		if ( $pdu_len > $max_len ) {
				$pdu_text1 = substr($pdu_text, 0, $max_len);
				$pdu_text = substr($pdu_text, $max_len, $pdu_len - $max_len);
		} else {
				$pdu_text1 = $pdu_text;
				$pdu_text = "";
		}
	
		$pdu_len1 = sprintf("%02X", strlen($pdu_text1)/2);
		$pdu_text1 = $pdu_len1 . $pdu_text1;
	
		$pdu_text1 = "11000D91" . $invert_msisdn ."000800" . $pdu_text1;
	
		$atcmd = "AT+CMGS=" . sprintf("%d", strlen($pdu_text1)/2) . chr(13);
		$l = strlen($atcmd);
		
		$cmd = NOKIA_QD_CMGF_AT_COMMAND."0".chr(13);
//		ser_write($cmd);
		$cmd_log .= $cmd;

//		ser_write($atcmd);
		$cmd_log .= $atcmd;

		$pdu_text1 = "0891" . $invert_smsc . $pdu_text1 . chr(26).chr(13);
		$l = strlen($pdu_text1);
//		ser_write($pdu_text1);
		$cmd_log .= $pdu_text1;
		
		$fp = fopen("pud_log.txt","w+");
		fwrite($fp, $cmd_log);
		fclose($fp);
		
	}
	
	function closeSerialPort () 
	{
		ser_close();
		$_SESSION['APF_OPEN_COM']="";
	}
	
}
?>
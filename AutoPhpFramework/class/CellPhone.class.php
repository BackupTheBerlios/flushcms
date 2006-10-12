<?php
/**
 *
 * CellPhone.class.php.
 * extension=php_ser.dll
 * download from http://www.easyvitools.com/download/download.php 
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: CellPhone.class.php,v 1.4 2006/10/12 10:37:57 arzen Exp $
 */
include_once($ConfigDir."at.command.php");
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
		$cmd = NOKIA_QD_CMGF_AT_COMMAND.chr(13);
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
	
	function closeSerialPort () 
	{
		ser_close();
		$_SESSION['APF_OPEN_COM']="";
	}
	
}
?>
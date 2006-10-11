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
 * @version    CVS: $Id: CellPhone.class.php,v 1.2 2006/10/11 23:41:05 arzen Exp $
 */

class CellPhone
{
	var $NOKIA_QD_HANG_UP_AT_COMMAND = "AT+CHUP";
	var $NOKIA_QD_CALL_AT_COMMAND = "ATD";
	
	function CellPhone () 
	{
		if (!defined('APF_OPEN_COM')) 
		{
			define("APF_OPEN_COM",true);
			$this->openSerialPort();
		}
	}
	
	function openSerialPort()
	{
		ser_open( "COM12", 9600, 8, "None", 1, "None" ); 
		$str = ser_isopen();
	}
	
	function callPhone ($phone_num) 
	{
		$this->openSerialPort();
		$cmd = $this->NOKIA_QD_CALL_AT_COMMAND."$phone_num;".chr(13);
		ser_write( $cmd );
		$this->closeSerialPort();
	}
	
	function callHangUp () 
	{
		$this->openSerialPort();
		$cmd = $this->NOKIA_QD_HANG_UP_AT_COMMAND.chr(13);
		ser_write( $cmd );
		$this->closeSerialPort();
	}
	
	function closeSerialPort () 
	{
		ser_close();
	}
	
}
?>
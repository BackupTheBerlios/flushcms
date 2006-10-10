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
 * @version    CVS: $Id: CellPhone.class.php,v 1.1 2006/10/10 23:14:42 arzen Exp $
 */

class CellPhone
{
	var $NOKIA_QD_HANG_UP_AT_COMMAND = "AT+CHUP";
	var $NOKIA_QD_CALL_AT_COMMAND = "ATD";
	
	function openSerialPort()
	{
		ser_open( "COM12", 9600, 8, "None", 1, "None" ); 
		$str = ser_isopen();
	}
	
	function closeSerialPort () 
	{
		ser_close();
	}
	
}
?>
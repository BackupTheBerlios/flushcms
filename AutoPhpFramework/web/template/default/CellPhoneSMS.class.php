<?php
/**
 *
 * CellPhoneSMS.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: CellPhoneSMS.class.php,v 1.2 2006/10/11 23:41:05 arzen Exp $
 */
include_once($ClassDir."CellPhone.class.php");
class CellPhoneSMS
{

	function callPhone($phone_num)
	{
		$serial = new CellPhone();
		$serial->callPhone($phone_num);
//		$serial->callHangUp();
		return $phone_num;
	}
	
	function hangUp () 
	{
		$serial = new CellPhone();
		$serial->callHangUp();
		return "hangup";
	}
	
	function callMobilePhone()
	{
	
	}
	
	function sendSMS()
	{
	
	}
	
}
?>
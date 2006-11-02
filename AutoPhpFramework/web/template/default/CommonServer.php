<?php
/**
 *
 * GroupUsersServer.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: CommonServer.php,v 1.8 2006/11/02 10:14:04 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/../../..'));
define('APF_LOGIN_ACCESS',       "Y");
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'init.php');

require_once 'HTML/AJAX/Server.php';

class CommonServer extends HTML_AJAX_Server
{
	// this flag must be set to on init methods
	var $initMethods = true;

	function initGroupUsers() 
	{
		include_once 'GroupUsers.class.php';
		$this->registerClass(new GroupUsers());
		// works in both php4 and 5 plus doing class name aliasing
		$this->registerClass(new GroupUsers(), 'GroupUsers', array (
			'inGroupUsers',
			'unInGroupUsers'
		));
	}

	function initGroupRights() 
	{
		include_once 'GroupRights.class.php';
		$this->registerClass(new GroupRights());
		// works in both php4 and 5 plus doing class name aliasing
		$this->registerClass(new GroupRights(), 'GroupRights', array (
			'inGroupRights',
			'unInGroupRights'
		));
	}

	function initCellPhoneSMS() 
	{
		global $ClassDir,$WebTemplateDir,$ConfigDir;
		include_once 'CellPhoneSMS.class.php';
		$this->registerClass(new CellPhoneSMS());
		// works in both php4 and 5 plus doing class name aliasing
		$this->registerClass(new CellPhoneSMS(), 'CellPhoneSMS', array (
			'callPhone',
			'hangUp',
			'connectCOM',
			'disconnectCOM',
			'callMobilePhone',
			'doSendSMS',
			'sendSMS'
		));
	}
	
	function initProductPrice() 
	{
		global $ClassDir,$WebTemplateDir,$ConfigDir,$CurrencyFormat;
		include_once 'ProductPrice.class.php';
		$this->registerClass(new ProductPrice());
		// works in both php4 and 5 plus doing class name aliasing
		$this->registerClass(new ProductPrice(), 'ProductPrice', array (
			'doEditProductPrice'
		));
	}

	function initUploadProgressMeterStatus() 
	{
		global $ClassDir,$WebTemplateDir,$ConfigDir,$CurrencyFormat;
		include_once 'HTTP/UploadProgressMeterStatus.class.php';
		$this->registerClass(new UploadProgressMeterStatus());
		// works in both php4 and 5 plus doing class name aliasing
		$this->registerClass(new UploadProgressMeterStatus(), 'UploadProgressMeterStatus', array (
			'getStatus'
		));
	}
	  
}

$server = new CommonServer();
// handle requests as needed
$server->handleRequest();

?>

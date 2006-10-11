<?php
/**
 *
 * GroupUsersServer.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: CommonServer.php,v 1.2 2006/10/11 10:29:15 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/../../..'));
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
		include_once 'CellPhoneSMS.class.php';
		$this->registerClass(new CellPhoneSMS());
		// works in both php4 and 5 plus doing class name aliasing
		$this->registerClass(new CellPhoneSMS(), 'CellPhoneSMS', array (
			'callPhone',
			'callMobilePhone',
			'sendSMS'
		));
	}
	
	  
}

$server = new CommonServer();
// handle requests as needed
$server->handleRequest();

?>

<?php
/**
 *
 * GroupUsersServer.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: CommonServer.php,v 1.1 2006/11/11 04:28:49 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/../../..'));
define('APF_DEBUG',       false);
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'front_init.php');

require_once 'HTML/AJAX/Server.php';

class CommonServer extends HTML_AJAX_Server
{
	// this flag must be set to on init methods
	var $initMethods = true;

	function initFeedback() 
	{
		include_once 'Feedback.class.php';
		$this->registerClass(new Feedback());
		// works in both php4 and 5 plus doing class name aliasing
		$this->registerClass(new Feedback(), 'Feedback', array (
			'validate'
		));
	}


	  
}

$server = new CommonServer();
// handle requests as needed
$server->handleRequest();

?>

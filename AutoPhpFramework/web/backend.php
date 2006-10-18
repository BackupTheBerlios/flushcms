<?php
/**
 *
 * backend.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: backend.php,v 1.5 2006/10/18 10:25:55 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('APF_DEBUG',       true);
define('APF_LOGIN_ACCESS',       "Y");
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'init.php');
$controller->dispatch();
?>

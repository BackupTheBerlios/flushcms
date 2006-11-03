<?php
/**
 *
 * front.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: front.php,v 1.3 2006/11/03 04:50:38 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('APF_DEBUG',       false);
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'front_init.php');
$DefaultModule = "default";
$DefaultPage = "index";
$controller->dispatch();
?>
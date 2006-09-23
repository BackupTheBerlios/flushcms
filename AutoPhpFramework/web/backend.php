<?php
/**
 *
 * backend.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: backend.php,v 1.3 2006/09/23 03:34:44 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('APF_DEBUG',       false);
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'init.php');
$controller->dispatch();
?>

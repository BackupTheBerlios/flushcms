<?php
/**
 *
 * backend.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: backend.php,v 1.4 2006/09/23 06:58:46 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('APF_DEBUG',       true);
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'init.php');
$controller->dispatch();
?>

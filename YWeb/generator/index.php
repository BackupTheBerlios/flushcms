<?php
/**
 *
 * index.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: index.php,v 1.1 2006/10/29 09:21:15 arzen Exp $
 */

define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'init.php');
ini_set('include_path', ".;".$IncludeDir."pear/");
include_once("DB/DataObject/createTables.php");

?>

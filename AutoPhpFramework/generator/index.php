<?php
/**
 *
 * index.php.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: index.php,v 1.1 2006/09/08 23:31:16 arzen Exp $
 */
include_once("../init.php");
$IniFile = "generator.ini";
ini_set('include_path', ".;".$IncludeDir."pear/");
include_once("DB/DataObject/createTables.php");

?>

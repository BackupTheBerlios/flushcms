<?php
/**
 *
 * index.php.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: index.php,v 1.1 2006/08/29 15:30:24 arzen Exp $
 */
$IncludeDir = "../Include/";
$IniFile = "example.ini";
ini_set('include_path', ".;".$IncludeDir."Pear");
include_once("DB/DataObject/createTables.php");

?>

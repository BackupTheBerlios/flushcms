<?php
/**
 *
 * Init.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: Init.php,v 1.1 2006/08/29 10:19:11 arzen Exp $
 */
$ConfigDir = "Config/";
$IncludeDir = "Include/";
$Template = "Template/";
$ModuleDir = "Module/";

include_once($ConfigDir."Config.php");
include_once($IncludeDir."DB/PEAR.php");
include_once($IncludeDir."DB/DB.php");
include_once($IncludeDir."DB/DataObject.php");
include_once($IncludeDir."TemplateEngine/PHPLIB.php");

$dsn = "{$DB_Type}://{$DB_UserName}:{$DB_PassWord}@{$DB_Host}/{$DB_Name}";
$conn =& DB::connect ($dsn);
if (DB::isError ($conn))
     die ("Cannot connect: " . $conn->getMessage () . "\n");
     
$opts = &PEAR::getStaticProperty('DB_DataObject','options');
$opts = array(
	'database'=>$dsn,
	'schema_location'=>$IncludeDir.'Schema/',
    'class_location'  => $IncludeDir.'DAO/',
    'class_prefix'    => 'DataObjects_'
);
$template = new Template_PHPLIB($Template);

?>

<?php
/**
 *
 * Init.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: Init.php,v 1.3 2006/08/29 23:23:44 arzen Exp $
 */
$ConfigDir = "Config/";
$IncludeDir = "Include/";
$Template = "Template/";
$ModuleDir = "Module/";

ini_set('include_path', ".;".$IncludeDir."Pear");

include_once($ConfigDir."Config.php");
include_once("PEAR.php");
include_once("DB.php");
include_once("DB/DataObject.php");
include_once("HTML/Template/PHPLIB.php");

$dsn = "{$DB_Type}://{$DB_UserName}:{$DB_PassWord}@{$DB_Host}/{$DB_Name}";
$conn =& DB::connect ($dsn);
if (DB::isError ($conn))
     die ("Cannot connect: " . $conn->getMessage () . "\n");
     
$opts = &PEAR::getStaticProperty('DB_DataObject','options');
$opts = array(
	'database'=>$dsn,
	'schema_location'=>$IncludeDir.'Schema/',
    'class_location'  => $IncludeDir.'DAO/',
    'class_prefix'    => 'Dao'
);
$template = new Template_PHPLIB($Template);
$template->setFile(array(
     "Page" => "page.html",
     "Header" => "header.html",
     "Foot" => "foot.html"
 ));
$template->setVar(array (
	"Title" => "Yahoo Music",
	"BgColor" => "#cccccc",
));


?>

<?php
/**
 *
 * Init.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: Init.php,v 1.4 2006/08/30 10:58:36 arzen Exp $
 */
$ConfigDir = "Config/";
$IncludeDir = "Include/";
$Template = "Template/";
$ModuleDir = "Module/";
$ClassDir = "Class/";

ini_set('include_path', ".;./".$IncludeDir."Pear");

include_once($ConfigDir."Config.php");
include_once($ClassDir."Actions.class.php");
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
 
$template->setBlock("Header", "header");
 
$template->setVar(array (
	"Title" => "Yahoo Music",
	"BgColor" => "#FFFFFF",
	"ImagesDir" => $Template."images/",
	"TemplateDir" => $Template,
));



?>

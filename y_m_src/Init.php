<?php
/**
 *
 * Init.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: Init.php,v 1.8 2006/09/07 05:29:26 arzen Exp $
 */
$RootDir = dirname(__FILE__)."/"; 
$ConfigDir = $RootDir."Config/";
$IncludeDir = $RootDir."Include/";
$TemplateDir = "Template/";
$ModuleDir = $RootDir."Module/";
$ClassDir = $RootDir."Class/";

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
{
    $separator = ";";
} 
else 
{
    $separator = ":";
}

ini_set('include_path', ".{$separator}".$IncludeDir."Pear");

include_once($ConfigDir."Config.php");
include_once($ConfigDir."Common.php");
include_once($ClassDir."Actions.class.php");
include_once($ClassDir."FormObject.php");
include_once("PEAR.php");
include_once("DB.php");
include_once("DB/DataObject.php");
include_once("DB/DataObject/Cast.php");
include_once("HTML/Template/PHPLIB.php");

$UploadDir = $RootDir.$Upload_Dir;
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
$template = new Template_PHPLIB($TemplateDir);
$template->setFile(array(
     "Page" => "page.html",
     "Header" => "header.html",
     "Foot" => "foot.html"
 ));
 
$template->setBlock("Header", "header");
 
$template->setVar(array (
	"Title" => $Site_Title,
	"ImagesDir" => $TemplateDir."images/",
	"TemplateDir" => $TemplateDir,
));

?>

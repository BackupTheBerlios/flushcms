<?php
/**
 *
 * import.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: import.php,v 1.1 2006/10/19 09:41:17 arzen Exp $
 */
set_time_limit(0);
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/../..'));
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'init.php');
require_once('Config.php');
require_once 'Config/Container.php';
require_once 'XML/Util.php';
require_once 'ConfigFile.php';
require_once 'ContentParse.php';
require_once 'Log.php';
require_once 'File/CSV.php';
require_once $ClassDir.'StringHelper.class.php';

$PattenDataDir = "data/";
$conf = array(
    'fields' => 15,
    'sep'    => ";",
    'quote'  => '"',
    'header' => false,
    'crlf' => "\r\n"
);

// read data
$filename = $PattenDataDir."2006_10_19_07_10.txt";
$x=1;
while ($fields = File_CSV::read($filename, $conf)) 
{
	$apf_company = DB_DataObject :: factory('ApfCompany');

	$apf_company->setName($fields[0]);
	$apf_company->setAddrees($fields[1]);
	$apf_company->setPhone($fields[2]);
	$apf_company->setFax($fields[3]);
	$apf_company->setHomepage($fields[5]);
	$apf_company->setLinkMan($fields[8]);
	$apf_company->setMemo($fields[14]);
	
	$apf_company->setName($fields[0]);
	$apf_company->setAddrees($fields[1]);
	$apf_company->setPhone($fields[2]);
	$apf_company->setFax($fields[3]);
	$apf_company->setEmail($fields[4]);
	$apf_company->setHomepage($fields[5]);
	$apf_company->setEmployee($fields[6]);
	$apf_company->setBankroll($fields[7]);
	$apf_company->setLinkMan($fields[8]);
	$apf_company->setIncorporator($fields[9]);
	$apf_company->setIndustry($fields[10]);
	$apf_company->setProducts($fields[11]);
	$apf_company->setMemo($fields[13].$fields[14]);

	$insert_id = $apf_company->insert();
	echo $insert_id?$x.".[Ok]\n":$x.".[Fail]\n";
	$x++;
}

//	$content = getContent($url);
//	foreach($data["root"] as $key=>$value)
//	{
//		var_dump(parseTag ($value,$content));
//	}

?>

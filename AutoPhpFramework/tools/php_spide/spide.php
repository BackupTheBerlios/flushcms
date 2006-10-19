<?php
/**
 *
 * spide.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: spide.php,v 1.5 2006/10/19 02:31:16 arzen Exp $
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

$PattenConfigDir = "config/";
if (!file_exists($PattenConfigDir)) 
{
	mkdir($PattenConfigDir,0777);
	
}

$PattenLogDir = "log/";
if (!file_exists($PattenLogDir)) 
{
	mkdir($PattenLogDir,0777);
	
}

$PattenDataDir = "data/";
if (!file_exists($PattenDataDir)) 
{
	mkdir($PattenDataDir,0777);
	
}

//http://www.sznet.com.cn/company_contact.php?userid=683
$site="www.sznet.com.cn";
$url="http://www.sznet.com.cn/company_contact.php?userid=683";
$file_type = "GenericConf";

$conf = array('mode' => 0777, 'timeFormat' => '%X %x');
$logger = &Log::singleton('file', $PattenLogDir.$site.date("Y_m_d_H_i").'.log', 'ident', $conf);

$conf = array(
    'fields' => 15,
    'sep'    => ";",
    'quote'  => '"',
    'header' => false,
    'crlf' => "\r\n"
);
$filename = $PattenDataDir.date("Y_m_d_H_i").".txt";


//createConfigFile($site,$file_type);
 
$data = readConfigFile($site,$file_type); 


// write data
//$x=1;
//$start=1;
//$end=10000;
//for ($m=$start;$m<$end;$m++)
//{
//	$url="http://www.sznet.com.cn/company_contact.php?userid=".$m;
//	$content = getContent($url);
//	if ( $content != "" ) 
//	{
//		
//		$row_data=array();
//		foreach($data["root"] as $key=>$value)
//		{
//			$row_data[] = parseTag ($value,$content);
//		}
//		$row_data[]=$url;
//		if (trim($row_data[0]) || trim($row_data[1]) || trim($row_data[2])) 
//		{
//	        File_CSV::write($filename, $row_data, $conf);
//			echo "{$x} Ok.\n";
//		}
//		else 
//		{
//			echo "{$x} Fail.\n";
//		}
//	}
//	$x++;
//	
//}

// read data
//$filename = $PattenDataDir."2006_10_19_02_03.txt";
//while ($fields = File_CSV::read($filename, $conf)) 
//{
//	$apf_company = DB_DataObject :: factory('ApfCompany');
//	$apf_company->setName($fields[0]);
//	$apf_company->setAddrees($fields[1]);
//	$apf_company->setPhone($fields[2]);
//	$apf_company->setFax($fields[3]);
//	$apf_company->setHomepage($fields[5]);
//	$apf_company->setLinkMan($fields[8]);
//	$apf_company->setMemo($fields[14]);
//	$apf_company->insert();
////    print_r($fields);
//}


?>

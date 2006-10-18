<?php
/**
 *
 * spide.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: spide.php,v 1.4 2006/10/18 11:06:26 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/../..'));
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'init.php');
require_once('Config.php');
require_once 'Config/Container.php';
require_once 'XML/Util.php';
require_once 'ConfigFile.php';
require_once 'ContentParse.php';
require_once 'Log.php';
require_once 'Spreadsheet/Excel/Writer.php';

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
$logger = &Log::singleton('file', $PattenLogDir.$site.'.log', 'ident', $conf);

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
// sending HTTP headers
$filename = $PattenDataDir.$site.date("Y_m_d").".xls";
$workbook->send($filename);
// Creating a worksheet
$worksheet =& $workbook->addWorksheet(date("Y_m_d"));


//createConfigFile($site,$file_type);
 
$data = readConfigFile($site,$file_type); 

// Write header
$i=0;
foreach($data["root"] as $title=>$lenght)
{
	$format_title =& $workbook->addFormat(array('right' => 5, 'top' => 20, 'size' => 14,
                                              'pattern' => 1, 'bordercolor' => 'blue',
                                              'Bold '=>1,'Color'=>'yellow','Align'=>'center',
                                              'fgcolor' => 'blue'));
	$worksheet->setInputEncoding('gb2312');
	$worksheet->write(0, $i, $title,$format_title);
	$worksheet->setColumn($i,$i,30);
	$i++;
}

// write data
$x=1;
for ($m=681;$m<685;$m++)
{
	$url="http://www.sznet.com.cn/company_contact.php?userid=".$m;
	$content = getContent($url);
	if ( $content != "" ) 
	{
		
		$y=0;
		foreach($data["root"] as $key=>$value)
		{
			$coloum_text = parseTag ($value,$content);
			$worksheet->setInputEncoding('gb2312');
			$worksheet->write($x, $y, $coloum_text);
			$y++;
		}
		$x++;
		echo "{$x} ok.\n";
	}
}
		
$worksheet->freezePanes(array(1, 1));
		
$workbook->close();

//var_dump($data);
//foreach($data["root"] as $key=>$value)
//{
//	if ( $value != "" ) 
//	{
//		var_dump(parseTag ($value,$content));
//	}
//}

?>

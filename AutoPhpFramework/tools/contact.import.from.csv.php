<?php
/**
 *
 * contact.import.from.csv.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: contact.import.from.csv.php,v 1.1 2006/09/27 16:08:53 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('APF_DEBUG',       true);
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'tools.init.php');

require_once 'File/CSV.php';
require_once $ClassDir.'StringHelper.class.php';
$header = array(
	"name",
	"mobile",
	"phone",
	);
	
$conf = array(
    'fields' => count($header),
    'sep'    => ";",
    'quote'  => '',
    'header' => false,
    'crlf' => "\r\n"
);
$file = "D:/nokia_tool/contact.txt";
$csv = new File_CSV;
$conf = File_CSV::discoverFormat($file);
$i=0;
while ($fields = File_CSV::read($file, $conf)) 
{
	$apf_contact = DB_DataObject :: factory('ApfContact');
	$j=0;
	foreach ($fields as $coloum_data) 
	{
		$coloum_function = "set".StringHelper::CamelCaseFromUnderscore($header[$j]);
		$apf_contact->$coloum_function($coloum_data);
		$j++;
	}
	$apf_contact->insert();
	$i++;
}
echo "Import {$i} records;";
?>

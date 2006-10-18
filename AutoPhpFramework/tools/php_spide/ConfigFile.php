<?php
/**
 *
 * ConfigFile.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: ConfigFile.php,v 1.1 2006/10/18 10:25:55 arzen Exp $
 */
function createConfigFile ($site_name,$type="xml") 
{
	global $PattenConfigDir;
	$section =& new Config_Container('section', 'main');

	$header =& $section->createItem('comment', null, 'Search Company Info Configuration', 'top');
	$section->createItem('blank', null, null, 'after', $header);

	$section->createItem('directive', 'company_name_pattren', '');
	$section->createItem('directive', 'company_address_pattren', '');
	$section->createItem('directive', 'company_phone_pattren', '');
	$section->createItem('directive', 'company_fax_pattren', '');
	$section->createItem('directive', 'company_email_pattren', '');
	$section->createItem('directive', 'company_homepage_pattren', '');
	$section->createItem('directive', 'company_employee_pattren', '');
	$section->createItem('directive', 'company_bankroll_pattren', '');
	$section->createItem('directive', 'company_link_man_pattren', '');
	$section->createItem('directive', 'company_incorporator_pattren', '');
	$section->createItem('directive', 'company_industry_pattren', '');
	$section->createItem('directive', 'company_products_pattren', '');
	$section->createItem('directive', 'company_created_at_pattren', '');
	$section->createItem('directive', 'company_memo_pattren', '');
	$section->writeDatasrc(  
							$PattenConfigDir.$site_name.'.'.$type, 
	                       $type
	                    );
	
}

function readConfigFile ($site_name,$type="xml") 
{
	global $PattenConfigDir;

	$config = new Config();
	$root =& $config->parseConfig($PattenConfigDir.$site_name.'.'.$type, $type);
	if (PEAR::isError($root)) {
	    die($root->getMessage());
	}
	$data = $root->toArray();
	return  $data;
}
?>

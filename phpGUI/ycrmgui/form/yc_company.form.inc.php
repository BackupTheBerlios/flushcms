<?php
/**
 *
 * yc_company.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_company.form.inc.php,v 1.2 2006/12/22 10:25:58 arzen Exp $
 */
function displayCompanyMainTabForm () 
{
	global $wb;
	
	include(PATH_FORM."yc_company.form.php");
	$wb->right_control = $maintab = $tab;
	include(PATH_FORM."yc_company_tab.form.php");
	
	
}
?>

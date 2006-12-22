<?php
/**
 *
 * yc_company.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_company.form.inc.php,v 1.3 2006/12/22 10:39:40 arzen Exp $
 */
function displayCompanyMainTabForm () 
{
	global $wb;
	
	include(PATH_FORM."yc_company.form.php");
	$wb->right_control = $maintab = $tab;
	include(PATH_FORM."yc_company_tab.form.php");
	
	wb_set_text(wb_get_control($maintab,IDC_COMPANY_LIST), array(
	   array($wb->vars["Lang"]["lang_id"], 	60),
	   array($wb->vars["Lang"]["lang_name"],150),
	   array($wb->vars["Lang"]["lang_gender"],	40),
	   array($wb->vars["Lang"]["lang_phone"],	100),
	   array($wb->vars["Lang"]["lang_mobile"],	100),
	   array($wb->vars["Lang"]["lang_email"],	180),
	   array($wb->vars["Lang"]["lang_addrees"],	200),
	));
	
}
?>

<?php
/**
 *
 * yc_main.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_main.form.inc.php,v 1.1 2006/12/18 05:22:34 arzen Exp $
 */
include_once PATH_FORM."yc_main.form.php";

wb_set_image($wb->tree_view, PATH_RES . "treeview.bmp", GREEN, 0, 10);
$items = wb_create_items($wb->tree_view, array(
	array($wb->vars["Lang"]["lang_cust"].$wb->vars["Lang"]["lang_manage"],  2001),				// Default insertion level is 0
	array($wb->vars["Lang"]["lang_contact"], 2002, 1),
	array($wb->vars["Lang"]["lang_company"], 2003, 1),
	array($wb->vars["Lang"]["lang_product"], 2004, 1),

	array($wb->vars["Lang"]["lang_sale"].$wb->vars["Lang"]["lang_manage"],  2005),
	array($wb->vars["Lang"]["lang_opportunity"], 2006, 1),
	array($wb->vars["Lang"]["lang_order"], 2007, 1),
	array($wb->vars["Lang"]["lang_agreement"], 2008, 1),
	
	array($wb->vars["Lang"]["lang_afterservice"].$wb->vars["Lang"]["lang_manage"],  2009),
	array($wb->vars["Lang"]["lang_complaints"], 2010, 1),
	array($wb->vars["Lang"]["lang_refundment"], 2011, 1),
	array($wb->vars["Lang"]["lang_review"], 2012, 1),
	
));
?>

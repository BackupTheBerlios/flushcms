<?php
/**
 *
 * yc_contact_search.form.inc.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_contact_search.form.inc.php,v 1.1 2006/12/19 23:43:35 arzen Exp $
 */
function create_contact_search_dlg ($parent) 
{
	global $wb;
	include(PATH_FORM."yc_contact_search.form.php");
	wb_set_handler($wb->contact_search, "process_contact_search");
	wb_set_visible($wb->contact_search, true);
//	set_default_accel($wb->contact_search, false);
	
}

function process_contact_search ($window, $id, $ctrl) 
{
	global $wb;
	switch($id) {

		case IDC_PUSHBUTTON1002:
			break;
		case IDCLOSE:		// IDCLOSE is predefined
		case IDCANCEL:
//			set_default_accel();
			wb_destroy_window($ctrl);
			break;
	}
	
}
?>

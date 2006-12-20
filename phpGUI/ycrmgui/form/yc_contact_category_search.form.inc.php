<?php
/**
 *
 * yc_contact_search.form.inc.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_contact_category_search.form.inc.php,v 1.1 2006/12/20 04:49:59 arzen Exp $
 */
function create_category_contact_search_dlg ($parent) 
{
	global $wb;
	include(PATH_FORM."yc_contact_category_search.form.php");
	wb_set_handler($wb->contact_search, "process_contact_category_search");
	wb_set_visible($wb->contact_search, true);
	
}

function process_contact_category_search ($window, $id, $ctrl) 
{
	global $wb;
	switch($id) {

		case IDC_SEARCH_SUBMIT:
			$wb->current_page = 1;
			$wb->keyword = wb_get_text(wb_get_control($window, IDC_KEYWORD));
			reset_contact_category_view ();
			wb_destroy_window($window);
			break;
		case IDCLOSE:		// IDCLOSE is predefined
		case IDCANCEL:
			wb_destroy_window($window);
			break;
	}
	
}
?>

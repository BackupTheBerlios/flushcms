<?php
/**
 *
 * yc_company_search.form.inc.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_company_search.form.inc.php,v 1.1 2006/12/24 02:18:19 arzen Exp $
 */
function create_company_search_dlg () 
{
	global $wb;
	include(PATH_FORM."yc_company_search.form.php");
	wb_set_handler($search_form, "process_company_search");
	wb_set_visible($search_form, true);
	
}

function process_company_search ($window, $id, $ctrl) 
{
	global $wb;
	switch($id) {

		case IDC_SEARCH_SUBMIT:
			$wb->current_page = 1;
			$wb->keyword = wb_get_text(wb_get_control($window, IDC_KEYWORD));
			reset_company_view ();
			wb_destroy_window($window);
			break;
		case IDCLOSE:		// IDCLOSE is predefined
		case IDCANCEL:
//			set_default_accel();
			wb_destroy_window($window);
			break;
	}
	
}
?>

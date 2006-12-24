<?php
/**
 *
 * yc_product_search.form.inc.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_order_search.form.inc.php,v 1.1 2006/12/24 11:46:48 arzen Exp $
 */
function create_order_search_dlg () 
{
	global $wb;
	include(PATH_FORM."yc_order_search.form.php");
	wb_set_handler($search_form, "process_order_search");
	wb_set_visible($search_form, true);
	
}

function process_order_search ($window, $id, $ctrl) 
{
	global $wb;
	switch($id) {

		case IDC_SEARCH_SUBMIT:
			$wb->current_page = 1;
			$wb->keyword = wb_get_text(wb_get_control($window, IDC_KEYWORD));
			reset_order_view ();
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

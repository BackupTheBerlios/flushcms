<?php
/**
 *
 * contact.handle.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: contact.handle.php,v 1.1 2006/12/18 05:22:34 arzen Exp $
 */
function process_ContactForm ($window, $id, $ctrl, $lparam1=0, $lparam2=0) 
{
	global $wb,$statusbar;

	switch($id) {

		case IDC_NAV_FIRST:
			$wb->current_page = 1;
			$wb->current_ctl->reset_listview();
			break;
		case IDC_NAV_PRE:
			$wb->current_page -= 1;
			$wb->current_page=$wb->current_page<1?1:$wb->current_page;
			$wb->current_ctl->reset_listview();
			break;
		case IDC_NAV_NEXT:
			$wb->current_page += 1;
			$wb->current_page=$wb->current_page>$wb->total_page?$wb->total_page:$wb->current_page;
			$wb->current_ctl->reset_listview();
			break;
		case IDC_NAV_LAST:
			$wb->current_page = $wb->total_page;
			$wb->current_ctl->reset_listview();
			break;
			
		case IDC_CATEGORY_SEARCH_SUBMIT:
			$wb->current_category_page = 1;
			$wb->current_ctl->reset_category_listview (wb_get_text($wb->current_ctl->category_keyword));
			break;
		case IDC_CATEGORY_NAV_PRE:
			$wb->current_category_page -= 1;
			$wb->current_category_page=$wb->current_category_page<1?1:$wb->current_category_page;
			$wb->current_ctl->reset_category_listview();
			break;
		case IDC_CATEGORY_NAV_NEXT:
			$wb->current_category_page += 1;
			$wb->current_category_page=$wb->current_category_page>$wb->total_category_page?$wb->total_category_page:$wb->current_category_page;
			$wb->current_ctl->reset_category_listview();
			break;
		case IDC_CATEGORY_SUBMIT:
			$wb->current_ctl->execCategoryAddSubmit ();
			$wb->current_ctl->reset_category_listview();
			break;
//		case IDC_CATEGORY_LIST_VIEW:
//			$sel = wb_get_selected($wb->current_ctl->category_list);
//			wb_message_box($wb->mainwin, $sel);
//			
////			wb_message_box($wb->mainwin, $wb->vars["Lang"]["lang_sure_logout"]);
//			break;

	}
}	
?>

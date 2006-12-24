<?php
/**
 *
 * yc_main.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_main.php,v 1.23 2006/12/24 12:30:27 arzen Exp $
 */

set_time_limit(0);
include_once "include/winbinder.php";

define("PATH_RES", "resource/");
define("PATH_INI", "ini/");
define("PATH_LANG", PATH_INI . "lang/");
define("PATH_FORM", "form/");
define("PATH_CLASS", "class/");
define("PATH_CONFIG", "config/");

include_once PATH_CLASS."db_mysql.php";

class Wb
{

}
create_main_window();

//set main ico
wb_main_loop();

function create_main_window()
{
	global $wb;
	
	include PATH_FORM."yc_contact.form.inc.php";
	
	$wb = new Wb;
	$wb->vars = parse_ini(file_get_contents(PATH_LANG.'zh-cn.ini'));
	$wb->setting = parse_ini(file_get_contents(PATH_INI.'system.dat'));
	
	include_once PATH_FORM."yc_main.form.inc.php";
	include_once PATH_FORM."yc_contact_search.form.inc.php";
	include_once PATH_FORM."yc_contact_category_search.form.inc.php";
	
//	db init
	$wb->db = new DB_Sql;
	$Host = $wb->setting["Settings"]["db_host"];
	$Database = $wb->setting["Settings"]["db_dbname"];
	$User = $wb->setting["Settings"]["db_username"];
	$Password = $wb->setting["Settings"]["db_password"];
	$wb->db->connect($Database , $Host , $User , $Password );
	$wb->right_control = null;
	$wb->del_ids = null;
	$wb->current_ids = null;
	$wb->current_form_state = true;
	$wb->current_module = "contact";
	$wb->current_action = "insert";
	displayContactForm ();
	wb_set_image($wb->mainwin, PATH_RES."favicon.ico");
	wb_set_handler($wb->mainwin, "process_main");

}

function process_main ($window, $id, $ctrl, $lparam1=0, $lparam2=0) 
{
	global $wb;
	switch ($id) 
	{

		case ID_CREATE:
			$wb->current_ids=null;
			$wb->current_action = "insert";
			switch ($wb->current_module) 
			{
				case "contact":
					include_once PATH_FORM."yc_contact_edit.form.inc.php";
					create_contact_edit_dlg ();
					break;
				case "contact_category":
				case "company":
				case "product":
				case "product_category":
				case "opportunity":
				case "order":
				case "order_category":
				case "agreement":
				case "agreement_category":
				case "complaints":
				case "complaints_category":
					$module_name = $wb->current_module;
					$function_name = "create_{$module_name}_edit_dlg";
					include_once PATH_FORM."yc_{$module_name}_edit.form.inc.php";
					$function_name();
					break;
			}
			wb_set_text($wb->statusbar,
				"Create module: " . $wb->current_module
			);
			break;

		case IDC_TOOLBAR_SEARCH:
			switch ($wb->current_module) 
			{
				case "contact":
					create_contact_search_dlg($window);
					break;
				case "contact_category":
					create_category_contact_search_dlg($window);
					break;
				case "company":
				case "product":
				case "product_category":
				case "opportunity":
				case "order":
				case "order_category":
				case "agreement":
				case "agreement_category":
				case "complaints":
				case "complaints_category":
					$module_name = $wb->current_module;
					$function_name = "create_{$module_name}_search_dlg";
					include_once PATH_FORM."yc_{$module_name}_search.form.inc.php";
					$function_name();
					break;
			
			}
			wb_set_text($wb->statusbar,
				"Search module: " . $wb->current_module
			);
			break;
		case ID_DELETE:
			switch ($wb->current_module) 
			{
				case "contact":
					del_selected_contact();
					break;
				case "contact_category":
				case "company":
				case "product":
				case "product_category":
				case "opportunity":
				case "order":
				case "order_category":
				case "agreement":
				case "agreement_category":
				case "complaints":
				case "complaints_category":
					$module_name = $wb->current_module;
					$function_name = "del_selected_{$module_name}";
					$function_name();
					break;
					
			}
			wb_set_text($wb->statusbar,
				"Deleted module: " . $wb->current_module
			);
			break;

		case IDC_LEFT_TREE:
				$selnode = wb_get_selected($wb->tree_view);	
				if ($wb->right_control) 
				{
					wb_set_visible($wb->right_control,false);
				}
				switch (wb_get_value($wb->tree_view)) 
				{
					case 2001:
					case 2002:
						$wb->current_module = "contact";
						$wb->keyword=null;
						$wb->current_page = 1;
						$wb->del_ids=null;
						displayContactForm ();
						break;
					case 2003:
						$wb->current_module = "company";
						$wb->keyword=null;
						$wb->current_page = 1;
						$wb->del_ids=null;
						include_once PATH_FORM."yc_company.form.inc.php";
						displayCompanyMainTabForm ();
						break;
					case 2004:
						$wb->current_module = "product";
						$wb->keyword=null;
						$wb->current_page = 1;
						$wb->del_ids=null;
						include_once PATH_FORM."yc_product.form.inc.php";
						display_product_main_tab_form ();
						break;
					case 2005:
					case 2006:
						$wb->current_module = "opportunity";
						$wb->keyword=null;
						$wb->current_page = 1;
						$wb->del_ids=null;
						include_once PATH_FORM."yc_opportunity.form.inc.php";
						display_opportunity_main_tab_form ();
						break;
					case 2007:
						$wb->current_module = "order";
						$wb->keyword=null;
						$wb->current_page = 1;
						$wb->del_ids=null;
						include_once PATH_FORM."yc_order.form.inc.php";
						display_order_main_tab_form ();
						break;
					case 2008:
						$wb->current_module = "agreement";
						$wb->keyword=null;
						$wb->current_page = 1;
						$wb->del_ids=null;
						include_once PATH_FORM."yc_agreement.form.inc.php";
						display_agreement_main_tab_form ();
						break;
					case 2009:
					case 2010:
						$wb->current_module = "complaints";
						$wb->keyword=null;
						$wb->current_page = 1;
						$wb->del_ids=null;
						include_once PATH_FORM."yc_complaints.form.inc.php";
						display_complaints_main_tab_form ();
						break;
					case 2011:
						$wb->current_module = "refundment";
						$wb->keyword=null;
						$wb->current_page = 1;
						$wb->del_ids=null;
						include_once PATH_FORM."yc_refundment.form.inc.php";
						display_refundment_main_tab_form ();
						break;
					case 2012:
						$wb->current_module = "review";
						$wb->keyword=null;
						$wb->current_page = 1;
						$wb->del_ids=null;
						include_once PATH_FORM."yc_review.form.inc.php";
						display_review_main_tab_form ();
						break;
				
				}		
				wb_set_text($wb->statusbar,
					"Selected item: " . wb_get_text($wb->tree_view, $selnode) .
					" / Value: " . wb_get_value($wb->tree_view) .
					" / Parent: " . wb_get_parent($wb->tree_view, $selnode) .
					" / Level: " . wb_get_level($wb->tree_view, $selnode) .
					" / State: " . (wb_get_state($wb->tree_view, $selnode) ? "expanded" : "collapsed")
				);
			break;
		case IDCLOSE:		// IDCLOSE is predefined
				if(wb_message_box($wb->mainwin, $wb->vars["Lang"]["lang_sure_logout"], $wb->vars["Lang"]["system_name"], WBC_QUESTION | WBC_YESNO))
					wb_destroy_window($window);
			break;
		case ID_ABOUT:
				include_once PATH_FORM."yc_about.form.inc.php";
				display_about_dlg ();
			break;
		default:
				if(process_contact($window, $id, $ctrl, $lparam1, $lparam2))
					break;
				if((wb_get_class($ctrl) == TabControl) && ($lparam1 & WBC_HEADERSEL)) {
					switch ($id) 
					{
						case IDC_CONTACT_FORM:
							if ($lparam2==0) 
							{
								$wb->current_module = "contact";
							} 
							else 
							{
								$wb->current_module = "contact_category";
							}
							break;
						case IDC_PRODUCTS_TAB:
							if ($lparam2==0) 
							{
								$wb->current_module = "product";
							} 
							else 
							{
								$wb->current_module = "product_category";
							}
							break;
						case IDC_ORDER_TAB:
							if ($lparam2==0) 
							{
								$wb->current_module = "order";
							} 
							else 
							{
								$wb->current_module = "order_category";
							}
							break;
						case IDC_AGREEMENT_TAB:
							if ($lparam2==0) 
							{
								$wb->current_module = "agreement";
							} 
							else 
							{
								$wb->current_module = "agreement_category";
							}
							break;
						case IDC_COMPLAINTS_TAB:
							if ($lparam2==0) 
							{
								$wb->current_module = "complaints";
							} 
							else 
							{
								$wb->current_module = "complaints_category";
							}
							break;
					
					}
					wb_set_text($wb->statusbar, "Tab #$lparam2 of tab control #$id selected.");
				} else
					wb_set_text($wb->statusbar, "Control ID: " . $id);
					
			break;
	}		
}

?>

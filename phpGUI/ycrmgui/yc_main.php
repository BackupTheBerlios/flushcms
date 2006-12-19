<?php
/**
 *
 * yc_main.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_main.php,v 1.5 2006/12/19 10:36:52 arzen Exp $
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
	
//	db init
	$wb->db = new DB_Sql;
	$Host = $wb->setting["Settings"]["db_host"];
	$Database = $wb->setting["Settings"]["db_dbname"];
	$User = $wb->setting["Settings"]["db_username"];
	$Password = $wb->setting["Settings"]["db_password"];
	$wb->db->connect($Database , $Host , $User , $Password );
	$wb->right_control = null;
	
	wb_set_image($wb->mainwin, PATH_RES."favicon.ico");
	wb_set_handler($wb->mainwin, "process_main");

}

function process_main ($window, $id, $ctrl, $lparam1=0, $lparam2=0) 
{
	global $wb;
	switch ($id) 
	{
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
						displayContactForm ();
						break;
					case 2003:
						$wb->right_control =  wb_create_control($wb->mainwin, CheckBox, "Checkbox 1", 170, 105, 91, 14, 0);
						break;
					case 2004:
						$wb->right_control = wb_create_control($wb->mainwin, RTFEditBox, "Rich text", 170, 120, 205, 55, 0);
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
		default:
				if(process_contact($window, $id, $ctrl, $lparam1, $lparam2))
					break;
			break;
	}		
}

?>

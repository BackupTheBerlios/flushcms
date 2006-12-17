<?php
set_time_limit(0);
/**
 *
 * main.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: main.php,v 1.2 2006/12/17 06:00:36 arzen Exp $
 */
include_once "include/winbinder.php";
define("PATH_RES",		"resource/");
define("PATH_INI",		"ini/");
define("PATH_LANG",		PATH_INI."lang/");
define("PATH_FORM",		"form/");
define("PATH_CLASS",		"class/");

//----------------------------------------------------------- CLASS DECLARATIONS

class Wb 
{

}

create_main_window();

//set main ico
wb_main_loop();

function create_main_window () 
{
	global $wb,$langObj;
	
	$wb = new Wb;
	$wb->vars = parse_ini(file_get_contents(PATH_LANG.'zh-cn.ini'));
	$wb->setting = parse_ini(file_get_contents(PATH_INI.'system.dat'));
	include_once PATH_FORM."YCRM.form.php";
	include_once PATH_CLASS."db_mysql.php";
	
//	db init
	$wb->db = new DB_Sql;
	$Host = $wb->setting["Settings"]["db_host"];
	$Database = $wb->setting["Settings"]["db_dbname"];
	$User = $wb->setting["Settings"]["db_username"];
	$Password = $wb->setting["Settings"]["db_password"];
	$wb->db->connect($Database , $Host , $User , $Password );
//	$wb->current_page=1;
	
	// Create main menu

	$wb->mainmenu = wb_create_control($wb->mainwin, Menu, array(

		"&File",
			array(ID_NEW,			"&New project\tCtrl+N", 	"", PATH_RES."menu_new.bmp",	"Ctrl+N"),
	));

	$wb->statusbar = wb_create_control($wb->mainwin, StatusBar, "");

	// Set minimum window size
	wb_set_image($wb->mainwin,"resource/favicon.ico");
	
	wb_set_handler($wb->mainwin, "process_main");
	
}

/* Main window processing */
function process_main ($window, $id, $ctrl, $lparam1=0, $lparam2=0) 
{
	global $wb, $statusbar;
	switch ($id) 
	{
		case IDC_TREEVIEW:
			$selnode = wb_get_selected($wb->tree_view);	
			if ($wb->left_control) 
			{
				wb_set_visible($wb->left_control,false);
			}
			switch (wb_get_value($wb->tree_view)) 
			{
				case 2002:
					include_once PATH_FORM.'Contact.form.php';
					$contact = new ContactForm;
					$wb->left_control = $contact->renderForm();
					break;
				case 2003:
					$wb->left_control = wb_create_control($wb->mainwin, CheckBox, "Checkbox 1", 170, 105, 91, 14, 0);
					break;
				case 2004:
					$wb->left_control = wb_create_control($wb->mainwin, RTFEditBox, "Rich text", 170, 120, 205, 55, 0);
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
//			echo $id . "\n";
			include_once PATH_FORM.'Contact.form.php';
			if(process_ContactForm($window, $id, $ctrl, $lparam1, $lparam2))
				break;
			break;
		
	
	}	
}

?>

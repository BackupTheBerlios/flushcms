<?php
/**
 *
 * yc_main.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_main.php,v 1.1 2006/12/18 05:22:34 arzen Exp $
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
	
	wb_set_image($wb->mainwin, PATH_RES."favicon.ico");
	wb_set_handler($wb->mainwin, "process_main");

}

function process_main ($window, $id, $ctrl, $lparam1=0, $lparam2=0) 
{
	global $wb, $statusbar;
	switch ($id) 
	{
		case IDC_LEFT_TREE:
			$selnode = wb_get_selected($wb->tree_view);	
			if ($wb->left_control) 
			{
				wb_set_visible($wb->left_control,false);
			}
		break;
		case IDCLOSE:		// IDCLOSE is predefined
			if(wb_message_box($wb->mainwin, $wb->vars["Lang"]["lang_sure_logout"], $wb->vars["Lang"]["system_name"], WBC_QUESTION | WBC_YESNO))
				wb_destroy_window($window);
			break;
	}		
}

?>

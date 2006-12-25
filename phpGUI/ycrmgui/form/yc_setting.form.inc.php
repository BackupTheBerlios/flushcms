<?php
/**
 *
 * yc_about.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_setting.form.inc.php,v 1.2 2006/12/25 09:23:07 arzen Exp $
 */
function display_setting_dlg () 
{
	global $wb;
	
	include(PATH_FORM."yc_setting.form.php");
	wb_set_text(wb_get_control($winmain,IDC_DB_HOST),$wb->setting["Settings"]["db_host"]);
	wb_set_text(wb_get_control($winmain,IDC_DB_USERNAME),$wb->setting["Settings"]["db_username"]);
	wb_set_text(wb_get_control($winmain,IDC_DB_PASSWORD),$wb->setting["Settings"]["db_password"]);
	wb_set_text(wb_get_control($winmain,IDC_DB_NAME),$wb->setting["Settings"]["db_dbname"]);
	$items = array(
		'chinese',
		'english',
	);
	
	wb_set_text(wb_get_control($winmain, IDC_LANGUAGE), $items);
	
	wb_set_visible($winmain, true);
	wb_set_handler($winmain, "process_setting");
}

function process_setting ($window, $id, $ctrl) 
{
	global $wb;
	switch($id) 
	{

		case IDOK:
			$wb->setting["Settings"]["db_host"] = wb_get_text(wb_get_control($window,IDC_DB_HOST));
			$wb->setting["Settings"]["db_username"] = wb_get_text(wb_get_control($window,IDC_DB_USERNAME));
			$wb->setting["Settings"]["db_password"] = wb_get_text(wb_get_control($window,IDC_DB_PASSWORD));
			$wb->setting["Settings"]["db_dbname"] = wb_get_text(wb_get_control($window,IDC_DB_NAME));
			$current_lang = wb_get_text(wb_get_control($window,IDC_LANGUAGE));
			switch ($current_lang)
			{
				case 'english':
					$lang_value='en';
					break;
				case 'chinese':
					$lang_value='zh-cn';
					break;
			
			}
			$wb->setting["Settings"]["lang_set"] = $lang_value;
			
			$contents = generate_ini($wb->setting, "; Store Setting INI file\r\n");
			file_put_contents(PATH_INI.SEETING_DAT, $contents);
			wb_destroy_window($window);
			break;		

		case IDCLOSE:		// IDCLOSE is predefined
		case IDCANCEL:
			wb_destroy_window($window);
			break;
	}
}

?>

<?php
/**
 *
 * yc_about.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_setting.form.inc.php,v 1.4 2006/12/25 12:37:27 arzen Exp $
 */
function display_setting_dlg () 
{
	global $wb;
	
	include(PATH_FORM."yc_setting.form.php");
	wb_set_text(wb_get_control($winmain,IDC_DB_HOST),$wb->setting["Settings"]["db_host"]);
	wb_set_text(wb_get_control($winmain,IDC_DB_USERNAME),$wb->setting["Settings"]["db_username"]);
	wb_set_text(wb_get_control($winmain,IDC_DB_PASSWORD),$wb->setting["Settings"]["db_password"]);
	wb_set_text(wb_get_control($winmain,IDC_DB_NAME),$wb->setting["Settings"]["db_dbname"]);
	include(PATH_CONFIG."common.php");
	$items = array_values($LangOption);
	
	wb_set_text(wb_get_control($winmain, IDC_LANGUAGE), $items);
	wb_set_text(wb_get_control($winmain, IDC_LANGUAGE), $LangOption[$wb->setting["Settings"]["lang_set"]]);
//	wb_set_selected(wb_get_control($winmain, IDC_LANGUAGE),$LangOption[$wb->setting["Settings"]["lang_set"]]);	
	wb_set_visible($winmain, true);
	wb_set_handler($winmain, "process_setting");
}

function generates_ini($data, $comments="")
{
	if(!is_array($data)) {
		trigger_error(__FUNCTION__ . ": Cannot save INI file.");
		return null;
	}
	$text = $comments;
	while(list($name, $section) = each($data))
	{
		$text .= "\r\n[$name]\r\n";

		while(list($key, $value) = each($section)) {
			$value = trim($value);
			if((string)((int)$value) == (string)$value)
				;	// Integer: does nothing
			elseif((string)((float)$value) == (string)$value)
				;	// Floating point: does nothing
			elseif($value === "")
				$value = '""';	// Empty string
			elseif($value[0] == '"' && $value[strlen($value)-1] == '"')
				;	// Has quotes already: does nothing
			else
				$value = '"' . $value . '"';
			$text .= "$key = " . $value . "\r\n";
		}
	}
	return $text;
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
			include(PATH_CONFIG."common.php");
			
			$lang_value = array_search($current_lang, $LangOption); 
//			switch ($current_lang)
//			{
//				case 'english':
//					$lang_value='en';
//					break;
//				case 'chinese':
//					$lang_value='zh-cn';
//					break;
//			
//			}
			$wb->setting["Settings"]["lang_set"] = $lang_value;
//			include('include/wb_generic.inc.php');
//			$contents = generate_ini($wb->setting, "; Store Setting INI file\r\n");
			$contents = generates_ini($wb->setting, "; Store Setting INI file\r\n");
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

<?php
/**
 *
 * yc_about.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_about.form.inc.php,v 1.1 2006/12/24 01:17:28 arzen Exp $
 */
function display_about_dlg () 
{
	global $wb;
	
	include(PATH_FORM."yc_about.form.php");
	wb_set_visible($winmain, true);
	wb_set_handler($winmain, "process_about");
}

function process_about ($window, $id, $ctrl) 
{
	global $wb;
	switch($id) 
	{

		case IDCLOSE:		// IDCLOSE is predefined
		case IDCANCEL:
			wb_destroy_window($window);
			break;
	}
}

?>

<?php
/**
 *
 * yc_contact_edit.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_contact_edit.form.inc.php,v 1.1 2006/12/20 10:36:37 arzen Exp $
 */
function create_contact_edit_dlg () 
{
	global $wb;
	
	include(PATH_FORM."yc_contact_edit.form.php");
	
	wb_set_handler($winmain, "process_contact_edit");
	wb_set_visible($winmain, true);
	
}

function process_contact_edit ($window, $id, $ctrl) 
{
	global $wb;
	
}

?>

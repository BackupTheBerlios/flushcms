<?php
/**
 *
 * yc_complaints_edit.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_complaints_edit.form.inc.php,v 1.2 2006/12/26 05:13:25 arzen Exp $
 */
 

function complaints_ctrl_mapping () 
{
	$ctrl_map = array(
		IDC_COMPLAINTS_TITLE=>'title',
		IDC_COMPLAINTS_COMPLAINANTER=>'complainanter',
		IDC_COMPLAINTS_REPLY=>'reply',
		IDC_COMPLAINTS_HANDLEMAN=>'handleman',
		IDC_COMPLAINTS_HANDLEDATE=>'handledate',
		IDC_COMPLAINTS_STATE=>'state',

		IDC_COMPLAINTS_MEMO=>'content'
	);
	return $ctrl_map;
}
 
function create_complaints_edit_dlg () 
{
	global $wb;
	
	include(PATH_FORM."yc_complaints_edit.form.php");
	
	wb_set_text(wb_get_control($winmain, IDC_COMPLAINTS_HANDLEDATE), date("Y-m-d H:i:s"));
	//-------- view detail -------
	if ($id=$wb->current_ids) 
	{
		get_complaints_by_id ($winmain,$id);
//		wb_message_box($wb->mainwin,$id);//implode(",",$all_ctrl)
	}
	if ($wb->current_action == "insert") 
	{
		wb_set_enabled(wb_get_control($winmain,IDC_SAVE),true);
		wb_set_enabled(wb_get_control($winmain,IDC_UPDATE),false);
	}
	else
	{
		wb_set_enabled(wb_get_control($winmain,IDC_SAVE),false);
		wb_set_enabled(wb_get_control($winmain,IDC_UPDATE),true);
	}
		
	wb_set_handler($winmain, "process_complaints_edit");
	wb_set_visible($winmain, true);
	
}

function get_complaints_by_id ($parent,$id) 
{
	global $wb;
	
	$ctrl_map = complaints_ctrl_mapping ();
	$table_name = $wb->setting["Settings"]["complaints_table"];
	$where_is = " WHERE id='{$id}' ";
	$sql = " SELECT * FROM {$table_name} {$where_is} ";
	$wb->db->query($sql);
	while ($wb->db->next_record()) 
	{
		while (list($ctrl_name, $field_name) = each($ctrl_map)) 
		{
			wb_set_text(wb_get_control($parent,$ctrl_name), $wb->db->f($field_name));
		}

	}
	
}

function inser_update_complaints ($parent) 
{
	global $wb;
	
	$ctrl_map = complaints_ctrl_mapping ();
	$table_name = $wb->setting["Settings"]["complaints_table"];

	$set_str = "";
	while (list($ctrl_name, $field_name) = each($ctrl_map)) 
	{
		$value = wb_get_text(wb_get_control($parent,$ctrl_name));
		$set_str .= "{$field_name}='{$value}',";
	}
	$set_str = rtrim($set_str,',');
	if ($wb->current_action=='update') 
	{
		$id=$wb->current_ids;
		$sql = "UPDATE {$table_name} SET {$set_str} WHERE id='{$id}' ";
	}
	else
	{
		$sql = "INSERT INTO {$table_name} SET {$set_str} ";
		
	}
	$wb->db->query($sql);
	reset_complaints_view ();
	
}

function process_complaints_edit ($window, $id, $ctrl) 
{
	global $wb;
	
	switch($id) 
	{

		case IDC_UPDATE:
			$wb->current_action='update';
			wb_set_enabled(wb_get_control($window,IDC_SAVE),true);
			wb_set_enabled(wb_get_control($window,IDC_UPDATE),false);
			break;
		case IDC_SAVE:
			if (!wb_get_text(wb_get_control($window,IDC_COMPLAINTS_TITLE))) 
			{
				empty_message_box ($window,$wb->vars["Lang"]["lang_please_fillup"].$wb->vars["Lang"]["lang_title"]);
				wb_set_focus(wb_get_control($window,IDC_COMPLAINTS_TITLE));
			} 
			else 
			{
				inser_update_complaints ($window);
				wb_destroy_window($window);
			}
			break;
		case IDCANCEL:
			wb_destroy_window($window);
			break;
	}	
}

?>

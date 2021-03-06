<?php
/**
 *
 * yc_contact_category_edit.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_contact_category_edit.form.inc.php,v 1.2 2006/12/22 08:51:09 arzen Exp $
 */
 

function ctrlContactCategoryMapping () 
{
	$ctrl_map = array(
		IDC_CONTACT_CATEGORY_NAME=>'category_name',
	);
	return $ctrl_map;
}
 
function create_contact_category_edit_dlg () 
{
	global $wb;
	
	include(PATH_FORM."yc_contact_category_edit.form.php");
	
	//-------- view detail -------
	if ($id=$wb->current_ids) 
	{
		getContactCategoryByID ($winmain,$id);
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
		
	wb_set_handler($winmain, "process_contact_category_edit");
	wb_set_visible($winmain, true);
	
}

function getContactCategoryByID ($parent,$id) 
{
	global $wb;
	
	$ctrl_map = ctrlContactCategoryMapping ();
	$table_name = $wb->setting["Settings"]["contact_category_table"];
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

function inserUpdateContactCategory ($parent) 
{
	global $wb;
	
	$ctrl_map = ctrlContactCategoryMapping ();
	$table_name = $wb->setting["Settings"]["contact_category_table"];

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
//	include(PATH_FORM."yc_contact.form.inc.php");
	reset_contact_category_view ();
	
}

function process_contact_category_edit ($window, $id, $ctrl) 
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
			inserUpdateContactCategory ($window);
			wb_destroy_window($window);
			break;
		case IDCANCEL:
			wb_destroy_window($window);
			break;
	}	
}

?>

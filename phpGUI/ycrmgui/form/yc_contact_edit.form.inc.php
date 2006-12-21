<?php
/**
 *
 * yc_contact_edit.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_contact_edit.form.inc.php,v 1.2 2006/12/21 10:38:41 arzen Exp $
 */
 

function ctrlMapping () 
{
	$ctrl_map = array(
		IDC_CONTACT_USERNAME=>'name',
		IDC_CONTACT_PHONE=>'phone',
		IDC_CONTACT_MOBILE=>'mobile',
		IDC_CONTACT_EMAIL=>'email',
		IDC_CONTACT_ADDREES=>'addrees',
		IDC_CONTACT_OFFICEPHONE=>'office_phone',
		IDC_CONTACT_FAX=>'fax',
		IDC_CONTACT_HOMEPAGE=>'homepage',
		IDC_CONTACT_MEMO=>'memo'
	);
	return $ctrl_map;
}
 
function create_contact_edit_dlg () 
{
	global $wb;
	
	include(PATH_FORM."yc_contact_edit.form.php");
	
	//-------- view detail -------
	if ($id=$wb->current_ids) 
	{
		getContactByID ($winmain,$id);
//		wb_message_box($wb->mainwin,$id);//implode(",",$all_ctrl)
	}
	if ($wb->current_action == "insert") 
	{
		wb_set_enabled(wb_get_control($winmain,IDC_CONTACT_SAVE),true);
		wb_set_enabled(wb_get_control($winmain,IDC_CONTACT_UPDATE),false);
	}
	else
	{
		wb_set_enabled(wb_get_control($winmain,IDC_CONTACT_SAVE),false);
		wb_set_enabled(wb_get_control($winmain,IDC_CONTACT_UPDATE),true);
	}
		
	wb_set_handler($winmain, "process_contact_edit");
	wb_set_visible($winmain, true);
	
}

function getContactByID ($parent,$id) 
{
	global $wb;
	
	$ctrl_map = ctrlMapping ();
	$table_name = $wb->setting["Settings"]["contact_table"];
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

function inserUpdateContact ($parent) 
{
	global $wb;
	
	$ctrl_map = ctrlMapping ();
	$table_name = $wb->setting["Settings"]["contact_table"];

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
//	wb_message_box($wb->mainwin,$sql);	
	$wb->db->query($sql);
//	include(PATH_FORM."yc_contact.form.inc.php");
	reset_contact_view ();
	
}

function setCtrlEnabled ($ctrl_name,$state=true) 
{
	$all_ctrl = wb_get_item_list($ctrl_name);
	foreach($all_ctrl as $ctrl)
	{
		wb_set_enabled($ctrl,false);
	}
	
}

function process_contact_edit ($window, $id, $ctrl) 
{
	global $wb;
	
	switch($id) 
	{

		case IDC_CONTACT_UPDATE:
			$wb->current_action='update';
			wb_set_enabled(wb_get_control($window,IDC_CONTACT_SAVE),true);
			wb_set_enabled(wb_get_control($window,IDC_CONTACT_UPDATE),false);
			break;
		case IDC_CONTACT_SAVE:
			inserUpdateContact ($window);
			wb_destroy_window($window);
			break;
	}	
}

?>

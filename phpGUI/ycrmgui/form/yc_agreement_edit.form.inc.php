<?php
/**
 *
 * yc_agreement_edit.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_agreement_edit.form.inc.php,v 1.1 2006/12/24 11:46:48 arzen Exp $
 */
 

function agreement_ctrl_mapping () 
{
	$ctrl_map = array(
		IDC_AGREEMENT_NOID=>'noid',
		IDC_AGREEMENT_BUYERSIGNATURE=>'buyersignature',
		IDC_AGREEMENT_EFFECTDATE=>'effectdate',
		IDC_AGREEMENT_EXPIREDDATE=>'expireddate',
		IDC_AGREEMENT_BUYER=>'buyer',
		IDC_AGREEMENT_VENDERSIGNATURE=>'vendersignature',
		IDC_AGREEMENT_VENDER=>'vender',
	
		IDC_AGREEMENT_MEMO=>'description'
	);
	return $ctrl_map;
}
 
function create_agreement_edit_dlg () 
{
	global $wb;
	
	include(PATH_FORM."yc_agreement_edit.form.php");
	
	//-------- view detail -------
	if ($id=$wb->current_ids) 
	{
		get_agreement_by_id ($winmain,$id);
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
		
	wb_set_handler($winmain, "process_agreement_edit");
	wb_set_visible($winmain, true);
	
}

function get_agreement_by_id ($parent,$id) 
{
	global $wb;
	
	$ctrl_map = agreement_ctrl_mapping ();
	$table_name = $wb->setting["Settings"]["agreement_table"];
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

function inser_update_agreement ($parent) 
{
	global $wb;
	
	$ctrl_map = agreement_ctrl_mapping ();
	$table_name = $wb->setting["Settings"]["agreement_table"];

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
	reset_agreement_view ();
	
}

function process_agreement_edit ($window, $id, $ctrl) 
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
			inser_update_agreement ($window);
			wb_destroy_window($window);
			break;
		case IDCANCEL:
			wb_destroy_window($window);
			break;
	}	
}

?>

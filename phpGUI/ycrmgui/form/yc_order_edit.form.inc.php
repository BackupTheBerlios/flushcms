<?php
/**
 *
 * yc_order_edit.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_order_edit.form.inc.php,v 1.1 2006/12/24 11:46:48 arzen Exp $
 */
 

function order_ctrl_mapping () 
{
	$ctrl_map = array(
		IDC_ORDER_NOID=>'noid',
		IDC_ORDER_PAYWAY=>'payway',
		IDC_ORDER_PRODUCT=>'product',
		IDC_ORDER_AMOUNT=>'amount',
		IDC_ORDER_MONEY=>'money',
		IDC_ORDER_DELIVERYWAY=>'deliveryway',
		IDC_ORDER_DELIVERYDATETIME=>'deliverydatetime',
		IDC_ORDER_STATE=>'state',
		IDC_ORDER_DISCOUNT=>'discount',
		
		IDC_ORDER_MEMO=>'memo'
	);
	return $ctrl_map;
}
 
function create_order_edit_dlg () 
{
	global $wb;
	
	include(PATH_FORM."yc_order_edit.form.php");
	
	//-------- view detail -------
	if ($id=$wb->current_ids) 
	{
		get_order_by_id ($winmain,$id);
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
		
	wb_set_handler($winmain, "process_order_edit");
	wb_set_visible($winmain, true);
	
}

function get_order_by_id ($parent,$id) 
{
	global $wb;
	
	$ctrl_map = order_ctrl_mapping ();
	$table_name = $wb->setting["Settings"]["order_table"];
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

function inser_update_order ($parent) 
{
	global $wb;
	
	$ctrl_map = order_ctrl_mapping ();
	$table_name = $wb->setting["Settings"]["order_table"];

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
	reset_order_view ();
	
}

function process_order_edit ($window, $id, $ctrl) 
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
			inser_update_order ($window);
			wb_destroy_window($window);
			break;
		case IDCANCEL:
			wb_destroy_window($window);
			break;
	}	
}

?>

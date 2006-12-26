<?php
/**
 *
 * yc_review_edit.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_review_edit.form.inc.php,v 1.4 2006/12/26 05:13:25 arzen Exp $
 */
 

function review_ctrl_mapping () 
{
	$ctrl_map = array(
		IDC_REVIEW_COMPANY=>'company',
		IDC_REVIEW_LINKMAN=>'linkman',
		IDC_REVIEW_REVIEWDATE=>'reviewdate',
		IDC_REVIEW_CATEGORY=>'category',

		IDC_REVIEW_MEMO=>'content'
	);
	return $ctrl_map;
}
 
function create_review_edit_dlg () 
{
	global $wb;
	
	include(PATH_FORM."yc_review_edit.form.php");
	
	include(PATH_CONFIG."common.php");
	$items = array_values($ReviewwayOption);
	
	wb_set_text(wb_get_control($winmain, IDC_REVIEW_CATEGORY), $items);
	wb_set_text(wb_get_control($winmain, IDC_REVIEW_REVIEWDATE), date("Y-m-d H:i:s"));
//	wb_set_visible (wb_get_control($winmain, IDC_REVIEW_CALENDAR), false);

	//-------- view detail -------
	if ($id=$wb->current_ids) 
	{
		get_review_by_id ($winmain,$id);
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
		
	wb_set_handler($winmain, "process_review_edit");
	wb_set_visible($winmain, true);
	
}

function get_review_by_id ($parent,$id) 
{
	global $wb,$ReviewwayOption;
	
	$ctrl_map = review_ctrl_mapping ();
	$table_name = $wb->setting["Settings"]["review_table"];
	$where_is = " WHERE id='{$id}' ";
	$sql = " SELECT * FROM {$table_name} {$where_is} ";
	$wb->db->query($sql);
	while ($wb->db->next_record()) 
	{
		while (list($ctrl_name, $field_name) = each($ctrl_map)) 
		{
			if ($field_name=='category') 
			{
				include(PATH_CONFIG."common.php");
				wb_set_text(wb_get_control($parent, $ctrl_name), $ReviewwayOption[$wb->db->f($field_name)]);
				
			} 
			else 
			{
				wb_set_text(wb_get_control($parent,$ctrl_name), $wb->db->f($field_name));
			}
		}

	}
	
}

function inser_update_review ($parent) 
{
	global $wb;
	
	$ctrl_map = review_ctrl_mapping ();
	$table_name = $wb->setting["Settings"]["review_table"];

	$set_str = "";
	while (list($ctrl_name, $field_name) = each($ctrl_map)) 
	{
		$value = wb_get_text(wb_get_control($parent,$ctrl_name));
		if ($field_name=='category') 
		{
			include(PATH_CONFIG."common.php");
			$set_str .= "{$field_name}='".array_search($value, $ReviewwayOption)."',";
			
		} 
		else 
		{
			$set_str .= "{$field_name}='{$value}',";
		}
	}
	$set_str = rtrim($set_str,',');
	if ($wb->current_action=='update') 
	{
		$id=$wb->current_ids;
		$set_str .=" ,add_ip='".$wb->add_ip."',update_at=now() ";
		$sql = "UPDATE {$table_name} SET {$set_str} WHERE id='{$id}' ";
	}
	else
	{
		$set_str .=" ,add_ip='".$wb->add_ip."',created_at=now() ";
		$sql = "INSERT INTO {$table_name} SET {$set_str} ";
		
	}
	$wb->db->query($sql);
	reset_review_view ();
	
}

function process_review_edit ($window, $id, $ctrl) 
{
	global $wb;
	
	switch($id) 
	{

//		case IDC_REVIEW_CAL_SELECT:
//			wb_set_visible (wb_get_control($window, IDC_REVIEW_CALENDAR), true);
//			break;
//		case IDC_REVIEW_CALENDAR:
//			$date = strftime("%Y-%m-%d %H:%M%:%S", wb_get_value($ctrl));
//			wb_set_text(wb_get_control($window, IDC_REVIEW_REVIEWDATE), $date);
////			wb_set_visible (wb_get_control($window, IDC_REVIEW_CALENDAR), false);
//			break;
		case IDC_UPDATE:
			$wb->current_action='update';
			wb_set_enabled(wb_get_control($window,IDC_SAVE),true);
			wb_set_enabled(wb_get_control($window,IDC_UPDATE),false);
			break;
		case IDC_SAVE:
			if (!wb_get_text(wb_get_control($window,IDC_REVIEW_COMPANY))) 
			{
				empty_message_box ($window,$wb->vars["Lang"]["lang_please_fillup"].$wb->vars["Lang"]["lang_company"]);
				wb_set_focus(wb_get_control($window,IDC_REVIEW_COMPANY));
			} 
			else 
			{
				inser_update_review ($window);
				wb_destroy_window($window);
			}
			break;
		case IDCANCEL:
			wb_destroy_window($window);
			break;
	}	
}

?>

<?php
/**
 *
 * yc_company.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_company.form.inc.php,v 1.7 2006/12/25 05:36:38 arzen Exp $
 */
function displayCompanyMainTabForm () 
{
	global $wb;
	
	include(PATH_FORM."yc_company.form.php");
	$wb->right_control = $maintab = $tab;
	include(PATH_FORM."yc_company_tab.form.php");
	
	$wb->current_page=1;
	$wb->total_page=1;

	wb_set_text(wb_get_control($maintab,IDC_COMPANY_LIST), array(
	   array($wb->vars["Lang"]["lang_id"], 	60),
	   array($wb->vars["Lang"]["lang_name"],150),
	   array($wb->vars["Lang"]["lang_linkman"],	100),
	   array($wb->vars["Lang"]["lang_phone"],	100),
	   array($wb->vars["Lang"]["lang_email"],	180),
	   array($wb->vars["Lang"]["lang_addrees"],	200),
	));
	reset_company_view ();

	wb_set_handler($wb->right_control, "process_company");
	
}

function reset_company_view () 
{
	global $wb;
	// Empty listview
	wb_delete_items(wb_get_control($wb->right_control,IDC_COMPANY_LIST), null);
	
	$keyword = $wb->keyword;
	$where_is = " where 1 ";
	if ($keyword) 
	{
		$where_is .=" AND name LIKE '%{$keyword}%' ";
	}
	
	$max_row = 22;
	$table_name = $wb->setting["Settings"]["company_table"];
	$start_num = ($wb->current_page-1)*$max_row;
	$sql = " SELECT COUNT(*) AS num FROM {$table_name} {$where_is} ";
	$wb->db->query($sql);
	$wb->db->next_record();
	$total_num = $wb->db->f("num");
	$wb->total_page=ceil($total_num/$max_row);
	
	include PATH_CONFIG."common.php";
	$sql = " SELECT * FROM {$table_name} {$where_is} ORDER BY id DESC LIMIT {$start_num},".$max_row;
	$wb->db->query($sql);
	$data = array();
	while ($wb->db->next_record()) 
	{
		$row = array();
		$row[] = $wb->db->f("id");
		$row[] = $wb->db->f("name");
		$row[] = $wb->db->f("link_man");
		$row[] = $wb->db->f("phone");
		$row[] = $wb->db->f("email");
		$row[] = $wb->db->f("addrees");

		$data[] = $row;
	}
	// Create listview items
	wb_create_items(wb_get_control($wb->right_control,IDC_COMPANY_LIST), $data);

	//	navigator
	wb_set_text(wb_get_control($wb->right_control,IDC_NAV_BAR), $wb->vars["Lang"]["lang_total"]." ".$total_num." ".$wb->vars["Lang"]["lang_records"]." ".$wb->vars["Lang"]["lang_current"].$wb->current_page."/".$wb->total_page." ".$wb->vars["Lang"]["lang_page"]);

	wb_set_enabled(wb_get_control($wb->right_control,IDC_NAV_PRE),true);
	wb_set_enabled(wb_get_control($wb->right_control,IDC_NAV_FIRST),true);
	wb_set_enabled(wb_get_control($wb->right_control,IDC_NAV_NEXT),true);
	wb_set_enabled(wb_get_control($wb->right_control,IDC_NAV_LAST),true);
		
	if (  $wb->current_page==$wb->total_page  )
	{
		wb_set_enabled(wb_get_control($wb->right_control,IDC_NAV_NEXT),false);
		wb_set_enabled(wb_get_control($wb->right_control,IDC_NAV_LAST),false);
	} 

	if (  $wb->current_page==1  )
	{
		wb_set_enabled(wb_get_control($wb->right_control,IDC_NAV_PRE),false);
		wb_set_enabled(wb_get_control($wb->right_control,IDC_NAV_FIRST),false);
	} 
}

function del_selected_company () 
{
	global $wb;
	
	if ($wb->del_ids) 
	{
		$table_name = $wb->setting["Settings"]["company_table"];
		$where_is =" WHERE id IN ($wb->del_ids) ";
		$sql = " DELETE FROM {$table_name} {$where_is} ";
		$wb->db->query($sql);
		reset_company_view ();
		$wb->del_ids=null;
	}
	else
	{
		wb_message_box($wb->mainwin, $wb->vars["Lang"]["lang_deleted_empty"], $wb->vars["Lang"]["system_name"], WBC_WARNING);
	}
	
}


function process_company ($window, $id, $ctrl, $lparam1=0, $lparam2=0) 
{
	global $wb;
	
	switch($id) 
	{

		case IDC_NAV_FIRST:
			$wb->current_page = 1;
			reset_company_view ();
			break;
			
		case IDC_NAV_PRE:
			$wb->current_page -= 1;
			$wb->current_page=$wb->current_page<1?1:$wb->current_page;
			reset_company_view ();
			break;

		case IDC_NAV_NEXT:
			$wb->current_page += 1;
			$wb->current_page=$wb->current_page>$wb->total_page?$wb->total_page:$wb->current_page;
			reset_company_view ();
			break;
			
		case IDC_NAV_LAST:
			$wb->current_page = $wb->total_page;
			reset_company_view ();
			break;
		case IDC_COMPANY_LIST:
			if($lparam1 == WBC_DBLCLICK) 
			{
				$current_rows = wb_get_text($ctrl);
				$current_id = $current_rows[0][0];
				$wb->current_ids = $current_id;
				$wb->current_form_state=false;
				$wb->current_action='update';
				include_once PATH_FORM."yc_company_edit.form.inc.php";
				create_company_edit_dlg ();
			}

			// Show current selection and checked items
			$sel = wb_get_selected($ctrl);
			$sel = $sel ? implode(", ", $sel) : "none";

			$contents = wb_get_text($ctrl);
			$text = "";
			if($contents)
				foreach($contents as $row)
					$text .= $row ? "[" . implode(", ", $row) . "]  " : "";

			$checked = wb_get_value($ctrl);
			$temp_str = "";
			if ($checked) 
			{
				foreach($checked as $value)
				{
					$row_data = wb_get_text($ctrl,$value,0);
					$temp_str .= $row_data.","; 
				}
				$del_ids = rtrim($temp_str,',');
				$wb->del_ids = $del_ids;
			}

			$checked = $checked ? implode(", ", $checked) : "none";

			wb_set_text($wb->statusbar,
			  "Selected lines: " . $sel .
			  " / checked: " . $checked .
			  " / deleted: " . $del_ids .
			  " / contents: " . $text
			);

			return true;
	}

}

?>

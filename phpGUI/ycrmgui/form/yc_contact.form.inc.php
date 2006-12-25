<?php
/**
 *
 * yc_contact.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_contact.form.inc.php,v 1.13 2006/12/25 05:36:38 arzen Exp $
 */
// Control identifiers


function displayContactForm () 
{
	global $wb;
	
	include(PATH_FORM."yc_contact.form.php");

	if (empty($wb->current_page)) 
	{
		$wb->current_page=1;
		$wb->total_page=1;
		$wb->current_category_page=1;
		$wb->total_category_page=1;
	}
	
	wb_set_text($wb->contact_list, array(
	   array($wb->vars["Lang"]["lang_id"], 	60),
	   array($wb->vars["Lang"]["lang_name"],150),
	   array($wb->vars["Lang"]["lang_gender"],	40),
	   array($wb->vars["Lang"]["lang_phone"],	100),
	   array($wb->vars["Lang"]["lang_mobile"],	100),
	   array($wb->vars["Lang"]["lang_email"],	180),
	   array($wb->vars["Lang"]["lang_addrees"],	200),
	));
	reset_contact_view ();

	// Create Category ListView header
	wb_set_text($wb->contact_category_list, array(
	   array($wb->vars["Lang"]["lang_id"],100),
	   array($wb->vars["Lang"]["lang_category"].$wb->vars["Lang"]["lang_name"],	220),
	   array($wb->vars["Lang"]["lang_state"],	140),
	));
	reset_contact_category_view ();
	
	wb_set_handler($wb->right_control, "process_contact");
}

function reset_contact_view () 
{
	global $wb;
	// Empty listview
	wb_delete_items($wb->contact_list, null);
	
	$keyword = $wb->keyword;
	$where_is = " where 1 ";
	if ($keyword) 
	{
		$where_is .=" AND name LIKE '%{$keyword}%' ";
	}
	
	$max_row = 22;
	$table_name = $wb->setting["Settings"]["contact_table"];
	$start_num = ($wb->current_page-1)*$max_row;
	$sql = " SELECT COUNT(*) AS num  FROM {$table_name} {$where_is} ";
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
		$gender = $wb->db->f("gender");
		$gender = $gender?$GenderOption[$gender]:"";
		$row[] = $gender;
		$row[] = $wb->db->f("phone");
		$row[] = $wb->db->f("mobile");
		$row[] = $wb->db->f("email");
		$row[] = $wb->db->f("addrees");

		$data[] = $row;
	}
	// Create listview items
	wb_create_items($wb->contact_list, $data);
	//	navigator
	$dim = wb_get_size($wb->right_control, true);
	$nav_button_y=$dim[1]-80;
	$nav_button_x=60+150;
	$nav_button_space=100;
	
	wb_create_control($wb->right_control, Label, $wb->vars["Lang"]["lang_total"]." ".$total_num." ".$wb->vars["Lang"]["lang_records"]." ".$wb->vars["Lang"]["lang_current"].$wb->current_page."/".$wb->total_page." ".$wb->vars["Lang"]["lang_page"], 20, $nav_button_y+5, 150, 14, 0, WBC_VISIBLE, 0, 0);
	$nav_first = wb_create_control($wb->right_control, PushButton, $wb->vars["Lang"]["lang_first_page"],  $nav_button_x, $nav_button_y, 80, 22, IDC_NAV_FIRST);
	$nav_pre = wb_create_control($wb->right_control, PushButton, $wb->vars["Lang"]["lang_pre_page"],  $nav_button_x+$nav_button_space, $nav_button_y, 80, 22, IDC_NAV_PRE);
	$nav_next = wb_create_control($wb->right_control, PushButton, $wb->vars["Lang"]["lang_next_page"],  $nav_button_x+$nav_button_space*2, $nav_button_y, 80, 22, IDC_NAV_NEXT);
	$nav_last = wb_create_control($wb->right_control, PushButton, $wb->vars["Lang"]["lang_last_page"],  $nav_button_x+$nav_button_space*3, $nav_button_y, 80, 22, IDC_NAV_LAST);
	


	if (  $wb->current_page==$wb->total_page  )
	{
		wb_set_enabled($nav_next,false);
		wb_set_enabled($nav_last,false);
		
	} 

	if (  $wb->current_page==1  )
	{
		wb_set_enabled($nav_pre,false);
		wb_set_enabled($nav_first,false);
		
	} 
	
}

function reset_contact_category_view () 
{
	global $wb;
	// Empty listview

	wb_delete_items($wb->contact_category_list, null);
	
	$keyword = $wb->keyword;
	$where_is = " where 1 ";
	if ($keyword) 
	{
		$where_is .=" AND category_name LIKE '%{$keyword}%' ";
	}
	
	$max_row = 22;
	$category_table_name = $wb->setting["Settings"]["contact_category_table"];
	$start_num = ($wb->current_category_page-1)*$max_row;
	$sql2 = " SELECT * FROM {$category_table_name} {$where_is} ";
	$wb->db->query($sql2);
	$total_category_num = $wb->db->num_rows();
	$wb->total_category_page=ceil($total_category_num/$max_row);
	
	$sql2 = " SELECT * FROM {$category_table_name} {$where_is} ORDER BY id DESC LIMIT {$start_num},".$max_row;
	$wb->db->query($sql2);
	$category_data = array();
	while ($wb->db->next_record()) 
	{
		$row = array();
		$row[] = $wb->db->f("id");
		$row[] = $wb->db->f("category_name");
		$row[] = $wb->db->f("active");
		$category_data[] = $row;
	}

	// Create listview items
	wb_create_items($wb->contact_category_list, $category_data);
	
	//category navigator
	$dim = wb_get_size($wb->right_control, true);
	$nav_button_y=$dim[1]-80;
	$nav_button_x=60+150;
	$nav_button_space=100;

	wb_create_control($wb->right_control, Label, $wb->vars["Lang"]["lang_total"]." ".$total_category_num." ".$wb->vars["Lang"]["lang_records"]." ".$wb->vars["Lang"]["lang_current"].$wb->current_category_page."/".$wb->total_category_page." ".$wb->vars["Lang"]["lang_page"], 20, $nav_button_y+5, 150, 14, 0, WBC_VISIBLE, 0, 1);
	$category_nav_first = wb_create_control($wb->right_control, PushButton, $wb->vars["Lang"]["lang_first_page"],  $nav_button_x, $nav_button_y, 80, 22, IDC_CATEGORY_NAV_FIRST, WBC_VISIBLE, 0, 1);
	$category_nav_pre = wb_create_control($wb->right_control, PushButton, $wb->vars["Lang"]["lang_pre_page"],  $nav_button_x+$nav_button_space, $nav_button_y, 80, 22, IDC_CATEGORY_NAV_PRE, WBC_VISIBLE, 0, 1);
	$category_nav_next = wb_create_control($wb->right_control, PushButton, $wb->vars["Lang"]["lang_next_page"],  $nav_button_x+$nav_button_space*2, $nav_button_y, 80, 22, IDC_CATEGORY_NAV_NEXT, WBC_VISIBLE, 0, 1);
	$category_nav_last = wb_create_control($wb->right_control, PushButton, $wb->vars["Lang"]["lang_last_page"],  $nav_button_x+$nav_button_space*3, $nav_button_y, 80, 22, IDC_CATEGORY_NAV_LAST, WBC_VISIBLE, 0, 1);
	//category 
	if (  $wb->current_category_page==$wb->total_category_page  )
	{
		wb_set_enabled($category_nav_next,false);
		wb_set_enabled($category_nav_last,false);
		
	} 

	if (  $wb->current_category_page==1  )
	{
		wb_set_enabled($category_nav_pre,false);
		wb_set_enabled($category_nav_first,false);
		
	} 
	
}

function del_selected_contact () 
{
	global $wb;
	
	if ($wb->del_ids) 
	{
		$table_name = $wb->setting["Settings"]["contact_table"];
		$where_is =" WHERE id IN ($wb->del_ids) ";
		$sql = " DELETE FROM {$table_name} {$where_is} ";
//		wb_message_box($wb->mainwin, $sql, $wb->vars["Lang"]["system_name"], WBC_WARNING);
		$wb->db->query($sql);
		reset_contact_view ();
		$wb->del_ids=null;
	}
	else
	{
		wb_message_box($wb->mainwin, $wb->vars["Lang"]["lang_deleted_empty"], $wb->vars["Lang"]["system_name"], WBC_WARNING);
	}
	
}

function del_selected_contact_category () 
{
	global $wb;
	
	if ($wb->del_ids) 
	{
		$category_table_name = $wb->setting["Settings"]["contact_category_table"];
		$where_is =" WHERE id IN ($wb->del_ids) ";
		$sql = " DELETE FROM {$category_table_name} {$where_is} ";
//		wb_message_box($wb->mainwin, $sql, $wb->vars["Lang"]["system_name"], WBC_WARNING);
		$wb->db->query($sql);
		reset_contact_category_view ();
		$wb->del_ids=null;
	}
	else
	{
		wb_message_box($wb->mainwin, $wb->vars["Lang"]["lang_deleted_empty"], $wb->vars["Lang"]["system_name"], WBC_WARNING);
	}
	
}

function process_contact ($window, $id, $ctrl, $lparam1=0, $lparam2=0) 
{
	global $wb;
	
	switch($id) {

		case IDC_NAV_FIRST:
			$wb->current_page = 1;
			reset_contact_view ();
			break;
			
		case IDC_NAV_PRE:
			$wb->current_page -= 1;
			$wb->current_page=$wb->current_page<1?1:$wb->current_page;
			reset_contact_view ();
			break;

		case IDC_NAV_NEXT:
			$wb->current_page += 1;
			$wb->current_page=$wb->current_page>$wb->total_page?$wb->total_page:$wb->current_page;
			reset_contact_view ();
			return true;
			
		case IDC_NAV_LAST:
			$wb->current_page = $wb->total_page;
			reset_contact_view ();
			break;
			
		case IDC_CONTACT_DATA_LIST:
			if($lparam1 == WBC_DBLCLICK) 
			{
				$current_rows = wb_get_text($ctrl);
				$current_id = $current_rows[0][0];
				$wb->current_ids = $current_id;
				$wb->current_form_state=false;
				$wb->current_action='update';
				include_once PATH_FORM."yc_contact_edit.form.inc.php";
				create_contact_edit_dlg ();
			}

			// Show current selection and checked items
			$sel = wb_get_selected($ctrl);
			$sel = $sel ? implode(", ", $sel) : "none";

			$contents = wb_get_text($ctrl);
			$text = "";
			if($contents)
				foreach($contents as $row)
					$text .= $row ? "[" . implode(", ", $row) . "]  " : "";

			$checked = wb_get_value($wb->contact_list);
			$temp_str = "";
			if ($checked) 
			{
				foreach($checked as $value)
				{
					$row_data = wb_get_text($wb->contact_list,$value,0);
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
			
		case IDC_CONTACT_CATEGORY_DATA_LIST:
			if($lparam1 == WBC_DBLCLICK) 
			{
				$current_rows = wb_get_text($ctrl);
				$current_id = $current_rows[0][0];
				$wb->current_ids = $current_id;
				$wb->current_form_state=false;
				$wb->current_action='update';
				include_once PATH_FORM."yc_contact_category_edit.form.inc.php";
				create_contact_category_edit_dlg ();
			}
			// Show current selection and checked items
			$sel = wb_get_selected($ctrl);
			$sel = $sel ? implode(", ", $sel) : "none";

			$contents = wb_get_text($ctrl);
			$text = "";
			if($contents)
				foreach($contents as $row)
					$text .= $row ? "[" . implode(", ", $row) . "]  " : "";

			$checked = wb_get_value($wb->contact_category_list);
			$temp_str = "";
			if ($checked) 
			{
				foreach($checked as $value)
				{
					$row_data = wb_get_text($wb->contact_category_list,$value,0);
					$temp_str .= $row_data.","; 
				}
				$del_ids = rtrim($temp_str,',');
				$wb->del_ids = $del_ids;
			}
			$checked = $checked ? implode(",", $checked) : "none";

			wb_set_text($wb->statusbar,
			  "Selected lines: " . $sel .
			  " / checked: " . $checked .
			  " / deleted: " . $del_ids .
			  " / contents: " . $text
			);

			return true;


	}
	return false;	
}

?>

<?php
/**
 *
 * yc_contact.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_contact.form.inc.php,v 1.2 2006/12/18 13:44:38 arzen Exp $
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
	}
	
	wb_set_text($contact_list, array(
	   array("File", 	100),
	   array(null, 		80),
	   array("Name",	140),
	   array("Update",	200),
	));
	reset_contact_view ($contact_list);
	wb_set_handler($wb->right_control, "process_contact");
}

function reset_contact_view ($list_ctl) 
{
	global $wb;
	// Empty listview
	wb_delete_items($list_ctl, null);
	$max_row = 25;
	$table_name = $wb->setting["Settings"]["contact_table"];
	$start_num = ($wb->current_page-1)*$max_row;
	$sql = " SELECT * FROM {$table_name} ";
	$wb->db->query($sql);
	$wb->total_num = $wb->db->num_rows();
	$wb->total_page=ceil($wb->total_num/$max_row);
	
	$sql = " SELECT * FROM {$table_name} ORDER BY id DESC LIMIT {$start_num},".$max_row;
	$wb->db->query($sql);
	$data = array();
	while ($wb->db->next_record()) 
	{
		$row = array();
		$row[] = $wb->db->f("id");
		$row[] = $wb->db->f("name");
		$row[] = $wb->db->f("gender");
		$row[] = $wb->db->f("phone");
		$data[] = $row;
	}
	// Create listview items
	wb_create_items($list_ctl, $data);
	//	navigator
	$dim = wb_get_size($wb->right_control, true);
	$nav_button_y=$dim[1]-70;
	$nav_button_x=60+150;
	$nav_button_space=100;
	
	wb_create_control($wb->right_control, Label, $wb->vars["Lang"]["lang_total"]." ".$wb->total_num." ".$wb->vars["Lang"]["lang_records"]." ".$wb->vars["Lang"]["lang_current"].$wb->current_page."/".$wb->total_page." ".$wb->vars["Lang"]["lang_page"], 20, $nav_button_y+5, 150, 14, 0, WBC_VISIBLE, 0, 0);
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

function process_contact ($window, $id, $ctrl=0, $lparam=0) 
{
	global $wb;
	
	switch($id) {

		case IDC_NAV_FIRST:
			$wb->current_page = 1;
			reset_contact_view ($wb->contact_list);
			break;
			
		case IDC_NAV_PRE:
			$wb->current_page -= 1;
			$wb->current_page=$wb->current_page<1?1:$wb->current_page;
			reset_contact_view ($wb->contact_list);
			break;

		case IDC_NAV_NEXT:
			$wb->current_page += 1;
			$wb->current_page=$wb->current_page>$wb->total_page?$wb->total_page:$wb->current_page;
			reset_contact_view ($wb->contact_list);
			return true;
			
		case IDC_NAV_LAST:
			$wb->current_page = $wb->total_page;
			reset_contact_view ($wb->contact_list);
			break;
			
		case IDC_CONTACT_DATA_LIST:
			// Show current selection and checked items
			$sel = wb_get_selected($ctrl);
			$sel = $sel ? implode(", ", $sel) : "none";

			$contents = wb_get_text($ctrl);
			$text = "";
			if($contents)
				foreach($contents as $row)
					$text .= $row ? "[" . implode(", ", $row) . "]  " : "";

			$checked = wb_get_value($wb->contact_list);
			$checked = $checked ? implode(", ", $checked) : "none";

			wb_set_text($wb->statusbar,
			  "Selected lines: " . $sel .
			  " / checked: " . $checked .
			  " / contents: " . $text
			);

			return true;

	}
	return false;	
}

?>

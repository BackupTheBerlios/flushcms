<?php

// Control identifiers

if(!defined('IDC_TABCONTROL')) define('IDC_TABCONTROL', 1002);
if(!defined('IDC_NAV_PRE')) define('IDC_NAV_PRE', 2101);
if(!defined('IDC_NAV_NEXT')) define('IDC_NAV_NEXT', 2102);
if(!defined('IDC_NAV_FIRST')) define('IDC_NAV_FIRST', 2103);
if(!defined('IDC_NAV_LAST')) define('IDC_NAV_LAST', 2104);

/**
 *
 * Contact.form.php class.
 *
 * @package    symfony.runtime.plugin
 * @author     John.meng <arzen1013@gmail.com>
 * @version    SVN: $Id: Contact.form.php,v 1.2 2006/12/17 06:00:36 arzen Exp $
 */
class ContactForm
{
	var $total_num=0;
	var $max_row=20;
	var $data_list;
	
	function renderForm () 
	{
		global $wb;

		if (empty($wb->current_page)) 
		{
			$wb->current_page=1;
			$wb->total_page=1;
		}

		$left_control = wb_create_control($wb->mainwin, TabControl, "{$wb->vars["Lang"]["lang_contact"]},{$wb->vars["Lang"]["lang_contact"]}{$wb->vars["Lang"]["lang_category"]}", 160, 2, $wb->winwidth-160, $wb->winheight-40, IDC_TABCONTROL, 0x00000000, 0|WBC_RESIZE, 0);
		$dim = wb_get_size($left_control, true);
		
		$this->data_list = wb_create_control($left_control, ListView,		"",	   0, 10,$dim[0]-10, $dim[1]-250, 	102,WBC_VISIBLE | WBC_ENABLED | WBC_SORT | WBC_LINES | WBC_CHECKBOXES, 0, 0);

			
		// Create ListView header
		
		wb_set_text($this->data_list, array(
		   array("File", 	100),
		   array(null, 		80),
		   array("Name",	140),
		   array("Update",	200),
		));
		
		$this->reset_listview();

		//	navigator
		$nav_button_y=$dim[1]-230;
		$nav_button_x=80+150;
		$nav_button_space=120;
		
		wb_create_control($left_control, Label, $wb->vars["Lang"]["lang_total"]." ".$this->total_num." ".$wb->vars["Lang"]["lang_records"]." ".$wb->vars["Lang"]["lang_current"].$wb->current_page."/".$wb->total_page." ".$wb->vars["Lang"]["lang_page"], 20, $nav_button_y+5, 150, 14, 0, WBC_VISIBLE, 0, 0);
		$nav_first = wb_create_control($left_control, PushButton, $wb->vars["Lang"]["lang_first_page"],  $nav_button_x, $nav_button_y, 80, 22, IDC_NAV_FIRST);
		$nav_pre = wb_create_control($left_control, PushButton, $wb->vars["Lang"]["lang_pre_page"],  $nav_button_x+$nav_button_space, $nav_button_y, 80, 22, IDC_NAV_PRE);
		$nav_next = wb_create_control($left_control, PushButton, $wb->vars["Lang"]["lang_next_page"],  $nav_button_x+$nav_button_space*2, $nav_button_y, 80, 22, IDC_NAV_NEXT);
		$nav_last = wb_create_control($left_control, PushButton, $wb->vars["Lang"]["lang_last_page"],  $nav_button_x+$nav_button_space*3, $nav_button_y, 80, 22, IDC_NAV_LAST);

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
			 
		wb_set_handler($left_control, "process_main");
		
		return $left_control;
	}
	
	function reset_listview()
	{
		global $wb;
		// Empty listview
	
		wb_delete_items($this->data_list, null);
		$table_name = $wb->setting["Settings"]["contact_table"];
		$start_num = ($wb->current_page-1)*$this->max_row;
		$sql = " SELECT * FROM {$table_name} ";
		$wb->db->query($sql);
		$this->total_num = $wb->db->num_rows();
		$wb->total_page=ceil($this->total_num/$this->max_row);
		
		$sql = " SELECT * FROM {$table_name} ORDER BY id DESC LIMIT {$start_num},".$this->max_row;
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
	
		wb_create_items($this->data_list, $data);
	
		// Set listview images
	
		wb_set_item_image($this->data_list, 5, 0, 1);
		wb_set_item_image($this->data_list, 2, 2, 3);
	}
	
	
}

function process_ContactForm ($window, $id, $ctrl, $lparam1=0, $lparam2=0) 
{
	global $wb;
	$contact = new ContactForm;
	switch($id) {

		case IDC_NAV_FIRST:
			if ($wb->left_control) 
			{
				wb_set_visible($wb->left_control,false);
			}
			$wb->current_page = 1;
			$wb->left_control = $contact->renderForm();
			break;
		case IDC_NAV_PRE:
			if ($wb->left_control) 
			{
				wb_set_visible($wb->left_control,false);
			}
			$wb->current_page -= 1;
			$wb->left_control = $contact->renderForm();
			break;
		case IDC_NAV_NEXT:
			if ($wb->left_control) 
			{
				wb_set_visible($wb->left_control,false);
			}
			$wb->current_page += 1;
			$wb->left_control = $contact->renderForm();
			break;
		case IDC_NAV_LAST:
			if ($wb->left_control) 
			{
				wb_set_visible($wb->left_control,false);
			}
			$wb->current_page = $wb->total_page;
			$wb->left_control = $contact->renderForm();
			break;

	}
	return true;
}	


?>
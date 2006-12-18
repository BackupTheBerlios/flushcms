<?php

// Control identifiers

if(!defined('IDC_TABCONTROL')) define('IDC_TABCONTROL', 1002);
if(!defined('IDC_DATA_LIST')) define('IDC_DATA_LIST', 3002);
if(!defined('IDC_CATEGORY_LIST_VIEW')) define('IDC_CATEGORY_LIST_VIEW', 304);

if(!defined('IDC_NAV_PRE')) define('IDC_NAV_PRE', 2101);
if(!defined('IDC_NAV_NEXT')) define('IDC_NAV_NEXT', 2102);
if(!defined('IDC_NAV_FIRST')) define('IDC_NAV_FIRST', 2103);
if(!defined('IDC_NAV_LAST')) define('IDC_NAV_LAST', 2104);

if(!defined('IDC_CATEGORY_NAV_PRE')) define('IDC_CATEGORY_NAV_PRE', 2105);
if(!defined('IDC_CATEGORY_NAV_NEXT')) define('IDC_CATEGORY_NAV_NEXT', 2106);
if(!defined('IDC_CATEGORY_NAV_FIRST')) define('IDC_CATEGORY_NAV_FIRST', 2107);
if(!defined('IDC_CATEGORY_NAV_LAST')) define('IDC_CATEGORY_NAV_LAST', 2108);

if(!defined('IDC_CATEGORY_KEYWORD')) define('IDC_CATEGORY_KEYWORD', 2109);
if(!defined('IDC_CATEGORY_SEARCH_SUBMIT')) define('IDC_CATEGORY_SEARCH_SUBMIT', 2110);
if(!defined('IDC_CATEGORY_NAME')) define('IDC_CATEGORY_NAME', 2111);
if(!defined('IDC_CATEGORY_ACTIVE')) define('IDC_CATEGORY_ACTIVE', 2112);
if(!defined('IDC_CATEGORY_SUBMIT')) define('IDC_CATEGORY_SUBMIT', 1005);

/**
 *
 * Contact.form.php class.
 *
 * @package    symfony.runtime.plugin
 * @author     John.meng <arzen1013@gmail.com>
 * @version    SVN: $Id: Contact.form.php,v 1.6 2006/12/18 05:22:34 arzen Exp $
 */
class ContactForm
{
	var $total_num=0;
	var $total_category_num=0;
	var $max_row=20;
	var $data_list;
	var $category_list;
	var $category_keyword;
	var $left_control;

	var $category_name;
	var $category_active;
	
	function renderForm () 
	{
		global $wb;

		if (empty($wb->current_page)) 
		{
			$wb->current_page=1;
			$wb->total_page=1;
			
			$wb->current_category_page=1;
			$wb->total_category_page=1;
		}

		$this->left_control = wb_create_control($wb->mainwin, TabControl, "{$wb->vars["Lang"]["lang_contact"]},{$wb->vars["Lang"]["lang_contact"]}{$wb->vars["Lang"]["lang_category"]}", 160, 2, $wb->winwidth-160, $wb->winheight-40, IDC_TABCONTROL, 0x00000000, 0|WBC_RESIZE, 0);
		$dim = wb_get_size($this->left_control, true);
		
		$this->data_list = wb_create_control($this->left_control, ListView,		"",	   0, 10,$dim[0]-10, $dim[1]-300, 	IDC_DATA_LIST,WBC_VISIBLE | WBC_ENABLED | WBC_SORT | WBC_LINES | WBC_CHECKBOXES, 0, 0);
		$this->category_list = wb_create_control($this->left_control, ListView,		"",	   0, 10,$dim[0]-10, $dim[1]-300, 	IDC_CATEGORY_LIST_VIEW,WBC_VISIBLE | WBC_ENABLED | WBC_SORT | WBC_LINES | WBC_CHECKBOXES, 0, 1);

			
		// Create ListView header
		
		wb_set_text($this->data_list, array(
		   array("File", 	100),
		   array(null, 		80),
		   array("Name",	140),
		   array("Update",	200),
		));

		// Create Category ListView header
		
		wb_set_text($this->category_list, array(
		   array($wb->vars["Lang"]["lang_id"],100),
		   array($wb->vars["Lang"]["lang_category"].$wb->vars["Lang"]["lang_name"],	220),
		   array($wb->vars["Lang"]["lang_state"],	140),
		));
		
		$this->reset_listview();
		$this->reset_category_listview();


		// render form
		$this->renderCategoryForm ($this->left_control);
		 			 
		wb_set_handler($this->left_control, "process_main");
		
		return $this->left_control;
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
	
		//	navigator
		$dim = wb_get_size($this->left_control, true);
		$nav_button_y=$dim[1]-280;
		$nav_button_x=80+150;
		$nav_button_space=120;
		
		wb_create_control($this->left_control, Label, $wb->vars["Lang"]["lang_total"]." ".$this->total_num." ".$wb->vars["Lang"]["lang_records"]." ".$wb->vars["Lang"]["lang_current"].$wb->current_page."/".$wb->total_page." ".$wb->vars["Lang"]["lang_page"], 20, $nav_button_y+5, 150, 14, 0, WBC_VISIBLE, 0, 0);
		$nav_first = wb_create_control($this->left_control, PushButton, $wb->vars["Lang"]["lang_first_page"],  $nav_button_x, $nav_button_y, 80, 22, IDC_NAV_FIRST);
		$nav_pre = wb_create_control($this->left_control, PushButton, $wb->vars["Lang"]["lang_pre_page"],  $nav_button_x+$nav_button_space, $nav_button_y, 80, 22, IDC_NAV_PRE);
		$nav_next = wb_create_control($this->left_control, PushButton, $wb->vars["Lang"]["lang_next_page"],  $nav_button_x+$nav_button_space*2, $nav_button_y, 80, 22, IDC_NAV_NEXT);
		$nav_last = wb_create_control($this->left_control, PushButton, $wb->vars["Lang"]["lang_last_page"],  $nav_button_x+$nav_button_space*3, $nav_button_y, 80, 22, IDC_NAV_LAST);
		


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
	
	function reset_category_listview ($keyword="") 
	{
		global $wb;
		// Empty listview
	
		wb_delete_items($this->category_list, null);
		
		$where_is = " where 1 ";
		if ($keyword) 
		{
			$where_is .=" AND category_name LIKE '%{$keyword}%' ";
		}
		$category_table_name = $wb->setting["Settings"]["contact_category_table"];
		$start_num = ($wb->current_category_page-1)*$this->max_row;
		$sql2 = " SELECT * FROM {$category_table_name} {$where_is} ";
		$wb->db->query($sql2);
		$this->total_category_num = $wb->db->num_rows();
		$wb->total_category_page=ceil($this->total_category_num/$this->max_row);
		
		$sql2 = " SELECT * FROM {$category_table_name} {$where_is} ORDER BY id DESC LIMIT {$start_num},".$this->max_row;
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
		wb_create_items($this->category_list, $category_data);
		
		//category navigator
		$dim = wb_get_size($this->left_control, true);
		$nav_button_y=$dim[1]-280;
		$nav_button_x=80+150;
		$nav_button_space=120;

		wb_create_control($this->left_control, Label, $wb->vars["Lang"]["lang_total"]." ".$this->total_category_num." ".$wb->vars["Lang"]["lang_records"]." ".$wb->vars["Lang"]["lang_current"].$wb->current_category_page."/".$wb->total_category_page." ".$wb->vars["Lang"]["lang_page"], 20, $nav_button_y+5, 150, 14, 0, WBC_VISIBLE, 0, 1);
		$category_nav_first = wb_create_control($this->left_control, PushButton, $wb->vars["Lang"]["lang_first_page"],  $nav_button_x, $nav_button_y, 80, 22, IDC_CATEGORY_NAV_FIRST, WBC_VISIBLE, 0, 1);
		$category_nav_pre = wb_create_control($this->left_control, PushButton, $wb->vars["Lang"]["lang_pre_page"],  $nav_button_x+$nav_button_space, $nav_button_y, 80, 22, IDC_CATEGORY_NAV_PRE, WBC_VISIBLE, 0, 1);
		$category_nav_next = wb_create_control($this->left_control, PushButton, $wb->vars["Lang"]["lang_next_page"],  $nav_button_x+$nav_button_space*2, $nav_button_y, 80, 22, IDC_CATEGORY_NAV_NEXT, WBC_VISIBLE, 0, 1);
		$category_nav_last = wb_create_control($this->left_control, PushButton, $wb->vars["Lang"]["lang_last_page"],  $nav_button_x+$nav_button_space*3, $nav_button_y, 80, 22, IDC_CATEGORY_NAV_LAST, WBC_VISIBLE, 0, 1);
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
	
	function renderCategoryForm ($p_ctl) 
	{
		global $wb;
		//	navigator
		$dim = wb_get_size($p_ctl, true);
		$form_y=$dim[1]-280+30;
		$form_x=20;
		
		$search_frame = wb_create_control($p_ctl, Frame, $wb->vars["Lang"]["lang_search"], $form_x, $form_y, $dim[0]-120, 40, 0, WBC_VISIBLE,0,1);
		$this->category_keyword = wb_create_control($search_frame, EditBox, "", 50, 15, 150, 21, IDC_CATEGORY_KEYWORD, WBC_VISIBLE | WBC_ENABLED, 0, 1);
		$category_nav_last = wb_create_control($search_frame, PushButton, $wb->vars["Lang"]["lang_search"],  220, 15, 80, 22, IDC_CATEGORY_SEARCH_SUBMIT, WBC_VISIBLE, 0, 1);
		wb_set_handler($search_frame, "process_main");

		// detail form
		$detail_frame = wb_create_control($p_ctl, Frame, $wb->vars["Lang"]["lang_detail"], $form_x, $form_y+40, $dim[0]-120, 120, 0, WBC_VISIBLE,0,1);
		wb_create_control($detail_frame, Label, $wb->vars["Lang"]["lang_category"].$wb->vars["Lang"]["lang_name"], 60, 15, 150, 14, 0, WBC_VISIBLE, 0, 1);
		$this->category_name = wb_create_control($detail_frame, EditBox, "", 120, 15, 150, 21, IDC_CATEGORY_KEYWORD, WBC_VISIBLE | WBC_ENABLED, 0, 1);
		// Group A
		include_once(PATH_CONFIG.'common.php');
		$i=0;
		foreach($ActiveOption as $key=>$value)
		{
			$this->category_active = wb_create_control($detail_frame, RadioButton, $key, 80+($i*70), 40, 70, 14, IDC_CATEGORY_ACTIVE, 0,0);
			$i++;
		}
		wb_create_control($detail_frame, PushButton, $wb->vars["Lang"]["lang_new"], 130, 80, 90, 25, IDC_CATEGORY_SUBMIT, 0x00000000, 0, 0);
		wb_set_handler($detail_frame, "process_main");
		
				
	}
	
	function execCategoryAddSubmit () 
	{
		global $wb;
		$category_table_name = $wb->setting["Settings"]["contact_category_table"];
		$category_name = wb_get_text($this->category_name);
		$category_active = wb_get_text($this->category_active);
		$sql = "INSERT INTO {$category_table_name} SET category_name = '{$category_name}' ";
		$wb->db->query($sql);
		
	}
	
}

?>
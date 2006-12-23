<?php
/**
 *
 * yc_order.form.inc.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: yc_order.form.inc.php,v 1.1 2006/12/23 03:02:44 arzen Exp $
 */
function display_order_main_tab_form () 
{
	global $wb;
	
	include(PATH_FORM."yc_order.form.php");
	$wb->right_control = $maintab = $tab;
	include(PATH_FORM."yc_order_tab.form.php");
	include(PATH_FORM."yc_order_category_tab.form.php");
	
	$wb->current_page=1;
	$wb->total_page=1;
	$wb->current_category_page=1;
	$wb->total_category_page=1;

	wb_set_text(wb_get_control($maintab,IDC_ORDER_LIST), array(
	   array($wb->vars["Lang"]["lang_id"], 	60),
	   array($wb->vars["Lang"]["lang_noid"],80),
	   array($wb->vars["Lang"]["lang_category"],	60),
	   array($wb->vars["Lang"]["lang_contactid"],	80),
	   array($wb->vars["Lang"]["lang_amount"],	60),
	   array($wb->vars["Lang"]["lang_money"],	100),
	   array($wb->vars["Lang"]["lang_discount"],	60),
	   array($wb->vars["Lang"]["lang_deliverydatetime"],	140),
	   array($wb->vars["Lang"]["lang_state"],	80),
	   array($wb->vars["Lang"]["lang_userid"],	60),
	   array($wb->vars["Lang"]["lang_createdat"],	140),
	));
	reset_order_view ();
	// category header define
	wb_set_text(wb_get_control($maintab,IDC_ORDER_CATEGORY_LIST), array(
	   array($wb->vars["Lang"]["lang_id"],100),
	   array($wb->vars["Lang"]["lang_category"].$wb->vars["Lang"]["lang_name"],	220),
	   array($wb->vars["Lang"]["lang_state"],	140),
	));
	reset_order_category_view ();
	
//
//	wb_set_handler($wb->right_control, "process_order");
	
}

function reset_order_view () 
{
	global $wb;
	// Empty listview
	wb_delete_items(wb_get_control($wb->right_control,IDC_ORDER_LIST), null);
	
	$keyword = $wb->keyword;
	$where_is = " where 1 ";
	if ($keyword) 
	{
		$where_is .=" AND name LIKE '%{$keyword}%' ";
	}
	
	$max_row = 22;
	$table_name = $wb->setting["Settings"]["order_table"];
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
		$row[] = $wb->db->f("noid");
		$row[] = $wb->db->f("category");
		$row[] = $wb->db->f("contactid");
		$row[] = $wb->db->f("amount");
		$row[] = $wb->db->f("money");
		$row[] = $wb->db->f("discount");
		$row[] = $wb->db->f("deliverydatetime");
		$row[] = $wb->db->f("state");
		$row[] = $wb->db->f("userid");
		$row[] = $wb->db->f("created_at");
		$data[] = $row;
	}
	// Create listview items
	wb_create_items(wb_get_control($wb->right_control,IDC_ORDER_LIST), $data);

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

function reset_order_category_view () 
{
	global $wb;
	// Empty listview
	wb_delete_items(wb_get_control($wb->right_control,IDC_ORDER_CATEGORY_LIST), null);
	
	$keyword = $wb->keyword;
	$where_is = " where 1 ";
	if ($keyword) 
	{
		$where_is .=" AND name LIKE '%{$keyword}%' ";
	}
	
	$max_row = 22;
	$table_name = $wb->setting["Settings"]["order_category_table"];
	$start_num = ($wb->current_category_page-1)*$max_row;
	$sql = " SELECT COUNT(*) AS num FROM {$table_name} {$where_is} ";
	$wb->db->query($sql);
	$wb->db->next_record();
	$total_num = $wb->db->f("num");
	$wb->total_category_page=ceil($total_num/$max_row);
	
	include PATH_CONFIG."common.php";
	$sql = " SELECT * FROM {$table_name} {$where_is} ORDER BY id DESC LIMIT {$start_num},".$max_row;
	$wb->db->query($sql);
	$data = array();
	while ($wb->db->next_record()) 
	{
		$row = array();
		$row[] = $wb->db->f("id");
		$row[] = $wb->db->f("category_name");
		$row[] = $wb->db->f("active");
		$data[] = $row;
	}
	// Create listview items
	wb_create_items(wb_get_control($wb->right_control,IDC_ORDER_CATEGORY_LIST), $data);

	//	navigator
	wb_set_text(wb_get_control($wb->right_control,IDC_CATEGORY_NAV_BAR), $wb->vars["Lang"]["lang_total"]." ".$total_num." ".$wb->vars["Lang"]["lang_records"]." ".$wb->vars["Lang"]["lang_current"].$wb->current_category_page."/".$wb->total_category_page." ".$wb->vars["Lang"]["lang_page"]);

	wb_set_enabled(wb_get_control($wb->right_control,IDC_CATEGORY_NAV_PRE),true);
	wb_set_enabled(wb_get_control($wb->right_control,IDC_CATEGORY_NAV_FIRST),true);
	wb_set_enabled(wb_get_control($wb->right_control,IDC_CATEGORY_NAV_NEXT),true);
	wb_set_enabled(wb_get_control($wb->right_control,IDC_CATEGORY_NAV_LAST),true);
		
	if (  $wb->current_category_page==$wb->total_category_page  )
	{
		wb_set_enabled(wb_get_control($wb->right_control,IDC_CATEGORY_NAV_NEXT),false);
		wb_set_enabled(wb_get_control($wb->right_control,IDC_CATEGORY_NAV_LAST),false);
	} 

	if (  $wb->current_category_page==1  )
	{
		wb_set_enabled(wb_get_control($wb->right_control,IDC_CATEGORY_NAV_PRE),false);
		wb_set_enabled(wb_get_control($wb->right_control,IDC_CATEGORY_NAV_FIRST),false);
	} 	
}


function process_order ($window, $id, $ctrl, $lparam1=0, $lparam2=0) 
{
	global $wb;
	
	switch($id) 
	{

		case IDC_NAV_FIRST:
			$wb->current_page = 1;
			reset_order_view ();
			break;
			
		case IDC_NAV_PRE:
			$wb->current_page -= 1;
			$wb->current_page=$wb->current_page<1?1:$wb->current_page;
			reset_order_view ();
			break;

		case IDC_NAV_NEXT:
			$wb->current_page += 1;
			$wb->current_page=$wb->current_page>$wb->total_page?$wb->total_page:$wb->current_page;
			reset_order_view ();
			break;
			
		case IDC_NAV_LAST:
			$wb->current_page = $wb->total_page;
			reset_order_view ();
			break;
	}

}

?>

<?php

/**
 *
 * ApfOrder.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfOrder.class.php,v 1.5 2006/12/14 10:18:07 arzen Exp $
 */

class ApfOrder  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$AccessOption,$OrderStateOption,$PaywayOption,$DeliverywayOption;

		$template->setFile(array (
			"MAIN" => "apf_order_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$category_arr =$this->getCategory();
		array_shift($AccessOption);
		array_shift($OrderStateOption);
		array_shift($PaywayOption);
		array_shift($DeliverywayOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"CATEGORYOPTION" => selectTag("category",$category_arr),
			"ACCESSOPTION" => radioTag("access",$AccessOption,"public"),
			"DELIVERYDATE" => inputDateTag ("deliverydatetime",date("Y-m-d H:i"),true),
			"PAYWAY_OPTION" => radioTag("payway",$PaywayOption,"cash"),
			"DELIVERY_OPTION" => radioTag("deliveryway",$DeliverywayOption,"land"),
			"STATE_OPTION" => radioTag("state",$OrderStateOption,"handling"),
			"MEMOTEXT" => textareaTag ('memo',"",false,"ROWS=\"8\" COLS=\"40\""),
			"DOACTION" => "addsubmit"
		));

	}
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$i18n,$OrderStateOption,$AccessOption,$PaywayOption,$DeliverywayOption;
		$template->setFile(array (
			"MAIN" => "apf_order_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$apf_order = DB_DataObject :: factory('ApfOrder');
		$apf_order->get($apf_order->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_order->getId(),"NOID" => $apf_order->getNoid(),"CATEGORY" => $apf_order->getCategory(),"CONTACTID" => $apf_order->getContactid(),"PRODUCT" => $apf_order->getProduct(),"AMOUNT" => $apf_order->getAmount(),"MONEY" => $apf_order->getMoney(),"DISCOUNT" => $apf_order->getDiscount(),"PAYWAY" => $apf_order->getPayway(),"DELIVERYWAY" => $apf_order->getDeliveryway(),"DELIVERYDATETIME" => $apf_order->getDeliverydatetime(),"STATE" => $apf_order->getState(),"MEMO" => $apf_order->getMemo(),"GROUPID" => $apf_order->getGroupid(),"USERID" => $apf_order->getUserid(),"ACCESS" => $apf_order->getAccess(),"ACTIVE" => $apf_order->getActive(),"ADD_IP" => $apf_order->getAddIp(),"CREATED_AT" => $apf_order->getCreatedAt(),"UPDATE_AT" => $apf_order->getUpdateAt(),));
		
		$category_arr =$this->getCategory();
		array_shift($AccessOption);
		array_shift($OrderStateOption);
		array_shift($PaywayOption);
		array_shift($DeliverywayOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"CATEGORYOPTION" => selectTag("category",$category_arr,$apf_order->getCategory()),
			"ACCESSOPTION" => radioTag("access",$AccessOption,$apf_order->getAccess()),
			"DELIVERYDATE" => inputDateTag ("deliverydatetime",$apf_order->getDeliverydatetime(),true),
			"MEMOTEXT" => textareaTag ('memo',$apf_order->getMemo(),false,"ROWS=\"8\" COLS=\"40\""),
			"PAYWAY_OPTION" => radioTag("payway",$PaywayOption,$apf_order->getPayway()),
			"DELIVERY_OPTION" => radioTag("deliveryway",$DeliverywayOption,$apf_order->getDeliveryway()),
			"STATE_OPTION" => radioTag("state",$OrderStateOption,$apf_order->getState()),
			"DOACTION" => "updatesubmit"
		));

	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$AddIP,$userid,$group_ids,$OrderStateOption,$AccessOption,$PaywayOption,$DeliverywayOption;
		$apf_order = DB_DataObject :: factory('ApfOrder');

		if ($edit_submit) 
		{
			$apf_order->get($apf_order->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_order->setNoid(stripslashes(trim($_POST['noid'])));
		$apf_order->setCategory(stripslashes(trim($_POST['category'])));
		$apf_order->setContactid(stripslashes(trim($_POST['contactid'])));
		$apf_order->setProduct(stripslashes(trim($_POST['product'])));
		$apf_order->setAmount(stripslashes(trim($_POST['amount'])));
		$apf_order->setMoney(stripslashes(trim($_POST['money'])));
		$apf_order->setDiscount(stripslashes(trim($_POST['discount'])));
		$apf_order->setPayway(stripslashes(trim($_POST['payway'])));
		$apf_order->setDeliveryway(stripslashes(trim($_POST['deliveryway'])));
		$apf_order->setDeliverydatetime(stripslashes(trim($_POST['deliverydatetime'])));
		$apf_order->setState(stripslashes(trim($_POST['state'])));
		$apf_order->setMemo(stripslashes(trim($_POST['memo'])));
		$apf_order->setAccess(stripslashes(trim($_POST['access'])));
		$apf_order->setActive(stripslashes(trim($_POST['active'])));

		$apf_order->setAddIp($AddIP);
		$apf_order->setGroupid($group_ids);
		$apf_order->setUserid($userid);

				
		$val = $apf_order->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_order->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_order->update();

				$log_string = $i18n->_("Update").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['ID']}";
				logFileString ($log_string);
				
				$this->forward("order/apf_order/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_order->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_order->insert();

				$log_string = $i18n->_("Create").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['create_date']}";
				logFileString ($log_string);

				$this->forward("order/apf_order/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_order_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			foreach ($val as $k => $v)
			{
				if ($v == false)
				{
					$template->setVar(array (
						strtoupper($k)."_ERROR_MSG" => " &darr; ".$i18n->_("Please check here")." &darr; "
					));

				}
			}
			$template->setVar(
				array (
				"ID" => $_POST['id'],"NOID" => $_POST['noid'],"CATEGORY" => $_POST['category'],"CONTACTID" => $_POST['contactid'],"PRODUCT" => $_POST['product'],"AMOUNT" => $_POST['amount'],"MONEY" => $_POST['money'],"DISCOUNT" => $_POST['discount'],"PAYWAY" => $_POST['payway'],"DELIVERYWAY" => $_POST['deliveryway'],"DELIVERYDATETIME" => $_POST['deliverydatetime'],"STATE" => $_POST['state'],"MEMO" => $_POST['memo'],"GROUPID" => $_POST['groupid'],"USERID" => $_POST['userid'],"ACCESS" => $_POST['access'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );
			 
			$category_arr =$this->getCategory();
			array_shift($AccessOption);
			array_shift($OrderStateOption);
			array_shift($PaywayOption);
			array_shift($DeliverywayOption);
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"CATEGORYOPTION" => selectTag("category",$category_arr,$_POST['category']),
				"ACCESSOPTION" => radioTag("access",$AccessOption,$_POST['access']),
				"DELIVERYDATE" => inputDateTag ("deliverydatetime",$_POST['deliverydatetime']),
				"MEMOTEXT" => textareaTag ('memo',$_POST['memo'],false,"ROWS=\"8\" COLS=\"40\""),
				"PAYWAY_OPTION" => radioTag("payway",$PaywayOption,$_POST['payway']),
				"DELIVERY_OPTION" => radioTag("deliveryway",$DeliverywayOption,$_POST['deliveryway']),
				"STATE_OPTION" => radioTag("state",$OrderStateOption,$_POST['state']),
				"DOACTION" => $do_action
			));

		}
	}
	
	function executeDel()
	{
		global $controller,$i18n;
		$apf_order = DB_DataObject :: factory('ApfOrder');
		$apf_order->get($apf_order->escape($controller->getID()));
		$apf_order->setActive('deleted');
		$apf_order->update();

		$log_string = $i18n->_("Delete").$i18n->_("File")."	{$filename}";
		logFileString ($log_string);

		$this->forward("order/apf_order/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$i18n,$WebTemplateDir,$ClassDir,$userid,$ActiveOption,$OrderStateOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_order_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_order = DB_DataObject :: factory('ApfOrder');
		$apf_order->orderBy('id desc');

		$max_row = 10;
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_order->limit($start_num,$max_row);
		$apf_order->whereAdd(" userid = '$userid' OR access = 'public' ");
		$ToltalNum = $apf_order->count();

		$apf_order->find();
		
		$myData=array();
		while ($apf_order->fetch())
		{
			$myData[] = $apf_order->toArray();
		}
		$params = array(
		    'totalItems' => $ToltalNum,
		    'perPage' => $max_row,
		    'delta' => 8,             // for 'Jumping'-style a lower number is better
		    'append' => true,
		    'separator' => ' | ',
		    'clearIfVoid' => false,
		    'urlVar' => 'entrant',
		    'useSessions' => true,
		    'closeSession' => true,
		    'prevImg'=>$i18n->_("PrevPage"),
		    'nextImg'=>$i18n->_("NextPage"),
		    //'mode'  => 'Sliding',    //try switching modes
		    'mode'  => 'Jumping',
		    'extraVars' => array(
		    ),
		
		);
		$pager = & Pager::factory($params);
		$links = $pager->getLinks();
		$current_page = $pager->getCurrentPageID();		
		$selectBox = $pager->getPageSelectBox(array('autoSubmit'=>true));
		$i = 0;
		foreach($myData as $data)
		{
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));
			
			$template->setVar(array ("ID" => $data['id'],"NOID" => $data['noid'],"CATEGORY" => $data['category'],"CONTACTID" => $data['contactid'],"PRODUCT" => $data['product'],"AMOUNT" => $data['amount'],"MONEY" => $data['money'],"DISCOUNT" => $data['discount'],"PAYWAY" => $data['payway'],"DELIVERYWAY" => $data['deliveryway'],"DELIVERYDATETIME" => $data['deliverydatetime'],"STATE" => $OrderStateOption[$data['state']],"MEMO" => $data['memo'],"GROUPID" => $data['groupid'],"USERID" => $data['userid'],"ACCESS" => $data['access'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"TOLTAL_NUM" => $ToltalNum,
			"PAGINATION" => $links['all']
		));

	}
	
	function getCategory () 
	{
		$apf_order_category = DB_DataObject :: factory('ApfOrderCategory');
		$apf_order_category->orderBy('id ASC');
		$apf_order_category->find();
		$myData = array();
		while ($apf_order_category->fetch())
		{
			$myData[$apf_order_category->getId()] = $apf_order_category->getCategoryName();
		}
		return $myData;
	}
	
}
?>
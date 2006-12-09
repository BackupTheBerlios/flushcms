<?php

/**
 *
 * ApfOrder.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfOrder.class.php,v 1.1 2006/12/09 04:17:35 arzen Exp $
 */

class ApfOrder  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_order_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "addsubmit"
		));

	}
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$i18n;
		$template->setFile(array (
			"MAIN" => "apf_order_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

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
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n;
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
		$apf_order->setGroupid(stripslashes(trim($_POST['groupid'])));
		$apf_order->setUserid(stripslashes(trim($_POST['userid'])));
		$apf_order->setAccess(stripslashes(trim($_POST['access'])));
		$apf_order->setActive(stripslashes(trim($_POST['active'])));
		$apf_order->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_order->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_order->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
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
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"DOACTION" => $do_action
			));
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
		global $template,$WebBaseDir,$i18n,$WebTemplateDir,$ClassDir,$userid,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_order_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_order = DB_DataObject :: factory('ApfOrder');
		$apf_order->orderBy('id desc');

		$max_row = 10;
		$ToltalNum = $apf_order->count();
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_order->limit($start_num,$max_row);
		$apf_order->whereAdd(" userid = '$userid' OR access = 'public' ");

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
			
			$template->setVar(array ("ID" => $data['id'],"NOID" => $data['noid'],"CATEGORY" => $data['category'],"CONTACTID" => $data['contactid'],"PRODUCT" => $data['product'],"AMOUNT" => $data['amount'],"MONEY" => $data['money'],"DISCOUNT" => $data['discount'],"PAYWAY" => $data['payway'],"DELIVERYWAY" => $data['deliveryway'],"DELIVERYDATETIME" => $data['deliverydatetime'],"STATE" => $data['state'],"MEMO" => $data['memo'],"GROUPID" => $data['groupid'],"USERID" => $data['userid'],"ACCESS" => $data['access'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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
	
}
?>
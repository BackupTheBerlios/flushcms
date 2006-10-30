<?php

/**
 *
 * ApfFinance.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfFinance.class.php,v 1.5 2006/10/30 05:24:37 arzen Exp $
 */

class ApfFinance  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$ActiveOption,$DebitOption;

		$template->setFile(array (
			"MAIN" => "apf_finance_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$category_arr =$this->getCategory();
		array_shift($ActiveOption);
		array_shift($DebitOption);

		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"CATEGORYOPTION" => selectTag("category",$category_arr),
			"CREATEDATE" => inputDateTag ("create_date",date("Y-m-d")),
			"AMOUNTTEXT" => textTag ("amount",1),
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,"new"),
			"DEBITOPTION" => radioTag("debit",$DebitOption,"I"),
			"DOACTION" => "addsubmit"
		));

	}
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$i18n,$ActiveOption,$DebitOption;
		$template->setFile(array (
			"MAIN" => "apf_finance_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_finance = DB_DataObject :: factory('ApfFinance');
		$apf_finance->get($apf_finance->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_finance->getId(),"CATEGORY" => $apf_finance->getCategory(),"CREATE_DATE" => $apf_finance->getCreateDate(),"AMOUNT" => $apf_finance->getAmount(),"DEBIT" => $apf_finance->getDebit(),"MONEY" => $apf_finance->getMoney(),"MEMO" => $apf_finance->getMemo(),"ACTIVE" => $apf_finance->getActive(),"ADD_IP" => $apf_finance->getAddIp(),"CREATED_AT" => $apf_finance->getCreatedAt(),"UPDATE_AT" => $apf_finance->getUpdateAt(),));

		$category_arr =$this->getCategory();
		array_shift($ActiveOption);
		array_shift($DebitOption);

		$template->setVar(array (
			"CATEGORYOPTION" => selectTag("category",$category_arr,$apf_finance->getCategory()),
			"CREATEDATE" => inputDateTag ("create_date",$apf_finance->getCreateDate()),
			"AMOUNTTEXT" => textTag ("amount",$apf_finance->getAmount()),
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_finance->getActive()),
			"DEBITOPTION" => radioTag("debit",$DebitOption,$apf_finance->getDebit()),
		));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$ActiveOption,$DebitOption;
		$apf_finance = DB_DataObject :: factory('ApfFinance');

		if ($edit_submit) 
		{
			$apf_finance->get($apf_finance->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_finance->setCategory(stripslashes(trim($_POST['category'])));
		$apf_finance->setCreateDate(stripslashes(trim($_POST['create_date'])));
		$apf_finance->setAmount(stripslashes(trim($_POST['amount'])));
		$apf_finance->setDebit(stripslashes(trim($_POST['debit'])));
		$apf_finance->setMoney(stripslashes(trim($_POST['money'])));
		$apf_finance->setMemo(stripslashes(trim($_POST['memo'])));
		$apf_finance->setActive(stripslashes(trim($_POST['active'])));
		$apf_finance->setAddIp(stripslashes(trim($_POST['add_ip'])));

				
		$val = $apf_finance->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_finance->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_finance->update();
				$this->forward("finance/apf_finance/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_finance->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_finance->insert();
				$this->forward("finance/apf_finance/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_finance_edit.html"
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
				"ID" => $_POST['ID'],"CATEGORY" => $_POST['category'],"CREATE_DATE" => $_POST['create_date'],"AMOUNT" => $_POST['amount'],"DEBIT" => $_POST['debit'],"MONEY" => $_POST['money'],"MEMO" => $_POST['memo'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );
			 
			$category_arr =$this->getCategory();
			array_shift($ActiveOption);
			array_shift($DebitOption);
	
			$template->setVar(array (
				"CATEGORYOPTION" => selectTag("category",$category_arr,$_POST['category']),
				"CREATEDATE" => inputDateTag ("create_date",$_POST['create_date']),
				"AMOUNTTEXT" => textTag ("amount",$_POST['amount']),
				"ACTIVEOPTION" => radioTag("active",$ActiveOption,$_POST['active']),
				"DEBITOPTION" => radioTag("debit",$DebitOption,$_POST['debit']),
			));

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_finance = DB_DataObject :: factory('ApfFinance');
		$apf_finance->get($apf_finance->escape($controller->getID()));
		$apf_finance->setActive('deleted');
		$apf_finance->update();
		$this->forward("finance/apf_finance/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$CurrencyFormat,$DebitOption,$ActiveOption;
		
		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		require_once 'I18N/Currency.php';
		
		$currency = new I18N_Currency($CurrencyFormat);
		$category_arr =$this->getCategory();
		
		$template->setFile(array (
			"MAIN" => "apf_finance_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_finance = DB_DataObject :: factory('ApfFinance');

		$apf_finance->orderBy('id desc');
		
		$apf_finance->find();
		
		$i=0;
		while ($apf_finance->fetch())
		{
			$myData[] = $apf_finance->toArray();
			$i++;
		}
		$ToltalNum =$i;
		
		$params = array(
		    'itemData' => $myData,
		    'perPage' => 10,
		    'delta' => 8,             // for 'Jumping'-style a lower number is better
		    'append' => true,
		    'separator' => ' | ',
		    'clearIfVoid' => false,
		    'urlVar' => 'entrant',
		    'useSessions' => true,
		    'closeSession' => true,
		    //'mode'  => 'Sliding',    //try switching modes
		    'mode'  => 'Jumping',
		    'extraVars' => array(
		    ),
		
		);
		$pager = & Pager::factory($params);
		$page_data = $pager->getPageData();
		$links = $pager->getLinks();
		
		$selectBox = $pager->getPerPageSelectBox();
		$i = 0;
		foreach($page_data as $data)
		{
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));
			
			$template->setVar(array ("ID" => $data['id'],"CATEGORY" => $category_arr[$data['category']],"CREATE_DATE" => $data['create_date'],"AMOUNT" => $data['amount'],"DEBIT" => $DebitOption[$data['debit']],"MONEY" => $currency->format( $data['money'] ),"MEMO" => $data['memo'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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
		$apf_finance_category = DB_DataObject :: factory('ApfFinanceCategory');
		$apf_finance_category->orderBy('id ASC');
		$apf_finance_category->find();
		$myData = array();
		while ($apf_finance_category->fetch())
		{
			$myData[$apf_finance_category->getId()] = $apf_finance_category->getCategoryName();
		}
		return $myData;
	}
	
}
?>
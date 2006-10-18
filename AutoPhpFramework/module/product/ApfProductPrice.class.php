<?php

/**
 *
 * ApfProductPrice.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfProductPrice.class.php,v 1.3 2006/10/18 02:13:24 arzen Exp $
 */

class ApfProductPrice  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_product_price_edit.html"
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
			"MAIN" => "apf_product_price_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_product_price = DB_DataObject :: factory('ApfProductPrice');
		$apf_product_price->get($apf_product_price->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_product_price->getId(),"COMPANY_ID" => $apf_product_price->getCompanyId(),"PRODUCT_ID" => $apf_product_price->getProductId(),"PRICE" => $apf_product_price->getPrice(),"ADD_IP" => $apf_product_price->getAddIp(),"CREATED_AT" => $apf_product_price->getCreatedAt(),"UPDATE_AT" => $apf_product_price->getUpdateAt(),));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n;
		$apf_product_price = DB_DataObject :: factory('ApfProductPrice');

		if ($edit_submit) 
		{
			$apf_product_price->get($apf_product_price->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_product_price->setCompanyId(stripslashes(trim($_POST['company_id'])));
		$apf_product_price->setProductId(stripslashes(trim($_POST['product_id'])));
		$apf_product_price->setPrice(stripslashes(trim($_POST['price'])));
		$apf_product_price->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_product_price->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_product_price->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
		$val = $apf_product_price->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_product_price->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_product_price->update();
				$this->forward("product/apf_product_price/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_product_price->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_product_price->insert();
				$this->forward("product/apf_product_price/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_product_price_edit.html"
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
				"ID" => $_POST['id'],"COMPANY_ID" => $_POST['company_id'],"PRODUCT_ID" => $_POST['product_id'],"PRICE" => $_POST['price'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_product_price = DB_DataObject :: factory('ApfProductPrice');
		$apf_product_price->get($apf_product_price->escape($controller->getID()));
		$apf_product_price->setActive('deleted');
		$apf_product_price->update();
		$this->forward("product/apf_product_price/");
	}
	
	function executeList()
	{
		global $template,$controller,$WebBaseDir,$WebTemplateDir,$ClassDir,$CurrencyFormat;

		require_once 'I18N/Currency.php';
		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_product_price_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$currency = new I18N_Currency($CurrencyFormat);
		$apf_product_price = DB_DataObject :: factory('ApfProductPrice');
		if ($product_id = $controller->getURLParam(0)) 
		{
			$apf_product_price->whereAdd("apf_product_price.product_id ='".$apf_product_price->escape($product_id)."' ");
		}
		if ($company_id = $controller->getURLParam(1)) 
		{
			$apf_product_price->whereAdd("apf_product_price.company_id ='".$apf_product_price->escape($company_id)."' ");
		}
		$apf_product_price->orderBy('apf_product_price.id desc');
		$apf_product_price->buildJoin(); 
		$apf_product_price->selectAs(array("id","price","created_at"), 'p_%s');
		$apf_product_price->selectAdd('apf_company.name AS company_name,apf_product.name AS product_name ');

//		$apf_product_price->debugLevel(4);
		$apf_product_price->find();
		
		$i=0;
		while ($apf_product_price->fetch())
		{
			$myData[] = $apf_product_price->toArray();
			$i++;
		}
		$ToltalNum =$i;
		
		$params = array(
		    'itemData' => $myData,
		    'perPage' => 15,
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
//			Var_Dump::display($data);
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));
			
			$template->setVar(array ("ID" => $data['p_id'],"COMPANY_ID" => $data['company_name'],"PRODUCT_ID" => $data['product_name'],"PRICE" => $currency->format( $data['p_price'] ),"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['p_created_at'],"UPDATE_AT" => $data['update_at'],));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"TOLTAL_NUM" => $ToltalNum,
			"PAGINATION" => $links['all']
		));

		$controller->parseTemplateLang();		
		$template->parse("OUT", array (
			"LAOUT",
		));
		$template->p("OUT");
		exit;

	}
	
}
?>
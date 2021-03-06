<?php

/**
 *
 * ApfProduct.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfProduct.class.php,v 1.12 2006/12/08 10:10:55 arzen Exp $
 */

class ApfProduct  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$ActiveOption;

		$template->setFile(array (
			"MAIN" => "apf_product_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$category_arr =$this->getCategory();
		array_shift($ActiveOption);
		$template->setVar(array (
			"CATEGORYOPTION" => selectTag("category",$category_arr),
			"FILEPHOTO" => fileTag("photo"),
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,"new"),
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
		global $template,$WebBaseDir,$controller,$i18n,$ActiveOption;
		$template->setFile(array (
			"MAIN" => "apf_product_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_product = DB_DataObject :: factory('ApfProduct');
		$apf_product->get($apf_product->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_product->getId(),"CATEGORY" => $apf_product->getCategory(),"COMPANY_ID" => $apf_product->getCompanyId(),"NAME" => $apf_product->getName(),"PRICE" => $apf_product->getPrice(),"PHOTO" => $apf_product->getPhoto(),"MEMO" => $apf_product->getMemo(),"ACTIVE" => $apf_product->getActive(),"ADD_IP" => $apf_product->getAddIp(),"CREATED_AT" => $apf_product->getCreatedAt(),"UPDATE_AT" => $apf_product->getUpdateAt(),));
		
		$category_arr =$this->getCategory();
		array_shift($ActiveOption);
		$template->setVar(array (
			"CATEGORYOPTION" => selectTag("category",$category_arr,$apf_product->getCategory()),
			"FILEPHOTO" => fileTag("photo",$apf_product->getPhoto()),
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_product->getActive()),
		));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$ActiveOption,$ClassDir,$UploadDir,$AllowUploadFilesType,$AddIP,$userid,$group_ids;
		$apf_product = DB_DataObject :: factory('ApfProduct');

		if ($edit_submit) 
		{
			$apf_product->get($apf_product->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_product->setCategory(stripslashes(trim($_POST['category'])));
		$apf_product->setCompanyId(stripslashes(trim($_POST['company_id'])));
		$apf_product->setName(stripslashes(trim($_POST['name'])));
		$apf_product->setPrice(stripslashes(trim($_POST['price'])));
		$apf_product->setMemo(stripslashes(trim($_POST['memo'])));
		$apf_product->setActive(stripslashes(trim($_POST['active'])));

		$apf_product->setAddIp($AddIP);
		$apf_product->setGroupid($group_ids);
		$apf_product->setUserid($userid);

		if ($_POST['photo_del']=='Y') 
		{
			unlink($UploadDir.$_POST['photo_old']);
			$apf_product->setPhoto("");
			$_POST['photo_old']="";
		}
		if($_POST['upload_temp'])
		{
			$apf_product->setPhoto($_POST['upload_temp']);	
		}
		$allow_upload_file = TRUE;
		if($_FILES['photo']['name'])
		{
			require_once ($ClassDir."FileHelper.class.php");
			$upload_data = FileHelper::uploadFile ("product");
			$allow_upload_file = $upload_data["upload_state"];
			if ($allow_upload_file) 
			{
				$photos_arr = $upload_data["upload_msg"];
				if ($photo_pic = $photos_arr['photo']) 
				{
					$apf_product->setPhoto($photo_pic);
					$_POST['upload_temp'] = $photo_pic;
				}
			}
			else
			{
				$upload_error_msg = $upload_data["upload_msg"];
			}

		}
				
		$val = $apf_product->validate();
		if (($val === TRUE) && ($allow_upload_file === TRUE))
		{
			if ($edit_submit) 
			{
				$apf_product->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_product->update();

				$log_string = $i18n->_("Update").$i18n->_("Product")."\t{$_POST['name']}=>{$_POST['ID']}";
				logFileString ($log_string);

				$this->forward("product/apf_product/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_product->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_product->insert();

				$log_string = $i18n->_("Create").$i18n->_("Product")."\t{$_POST['name']}";
				logFileString ($log_string);

				$this->forward("product/apf_product/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_product_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"DOACTION" => $do_action
			));
			
			$category_arr =$this->getCategory();
			array_shift($ActiveOption);
			$template->setVar(array (
				"CATEGORYOPTION" => selectTag("category",$category_arr,$_POST['category']),
				"FILEPHOTO" => fileTag("photo",$_POST['photo_old']),
				"ACTIVEOPTION" => radioTag("active",$ActiveOption,$_POST['active']),
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
				"ID" => $_POST['id'],"CATEGORY" => $_POST['category'],"COMPANY_ID" => $_POST['company_id'],"NAME" => $_POST['name'],"PRICE" => $_POST['price'],"PHOTO" => $_POST['photo'],"MEMO" => $_POST['memo'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_product = DB_DataObject :: factory('ApfProduct');
		$apf_product->get($apf_product->escape($controller->getID()));
		$apf_product->setActive('deleted');
		$apf_product->update();
		$this->forward("product/apf_product/");
	}

	function executeRelated () 
	{
		global $controller,$template;
		$this->executeList(true);
		$controller->parseTemplateLang();		
		$template->parse("OUT", array (
			"LAOUT",
		));
		$template->p("OUT");
		exit;
	}
	
	function executeList($is_related=false)
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$i18n,$WebUploadDir,$CurrencyFormat,$ActiveOption,$userid;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		require_once 'I18N/Currency.php';

		$template->setFile(array (
			"MAIN" => $is_related?"apf_product_related_list.html":"apf_product_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$currency = new I18N_Currency($CurrencyFormat);
		$category_arr =array(""=>$i18n->_("All"))+$this->getCategory();

		$max_row = 30;
		$apf_product = DB_DataObject :: factory('ApfProduct');

		$apf_product->orderBy('id desc');
		
		if (($keyword = trim($_REQUEST['q'])) != "") 
		{
			$apf_product->whereAdd("name LIKE '%".$apf_product->escape("{$keyword}") . "%' ");
		}
		if (($category = trim($_REQUEST['category'])) != "") 
		{
			$apf_product->whereAdd(" category = '".$apf_product->escape("{$category}") . "'  ");
		}
		if (($active = trim($_REQUEST['active'])) != "") 
		{
			$apf_product->whereAdd(" active = '".$apf_product->escape("{$active}") . "'  ");
		}
		$apf_product->setUserid($userid);
		
		$ToltalNum = $apf_product->count();
		
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_product->limit($start_num,$max_row);
		$apf_product->find();
		
		$myData=array();
		while ($apf_product->fetch())
		{
			$myData[] = $apf_product->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"CATEGORY" => $category_arr[$data['category']],"COMPANY_ID" => $data['company_id'],"NAME" => $data['name'],"PRICE" => $currency->format( $data['price'] ),"PHOTO" => imageTag ($data['photo']),"MEMO" => $data['memo'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"KEYWORD" => textTag ("q",$_REQUEST['q']),
			"CATEGORYOPTION" => selectTag("category",$category_arr,$_REQUEST['category']),
			"ACTIVEOPTION" => selectTag("active",$ActiveOption,$_REQUEST['active']),
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"TOLTAL_NUM" => $ToltalNum,
			"CURRENT_PAGE" => $current_page,
			"SELECT_BOX" => $selectBox,
			"PAGINATION" => $links['all']
		));

	}
	
	function getCategory () 
	{
		$apf_product_category = DB_DataObject :: factory('ApfProductCategory');
		$apf_product_category->orderBy('id ASC');
		$apf_product_category->find();
		$myData = array();
		while ($apf_product_category->fetch())
		{
			$myData[$apf_product_category->getId()] = $apf_product_category->getCategoryName();
		}
		return $myData;
	}
	
}
?>
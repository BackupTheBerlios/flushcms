<?php

/**
 *
 * ApfAgreement.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfAgreement.class.php,v 1.4 2006/12/14 10:18:07 arzen Exp $
 */

class ApfAgreement  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$AccessOption;

		$template->setFile(array (
			"MAIN" => "apf_agreement_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$category_arr =$this->getCategory();
		array_shift($AccessOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"CATEGORYOPTION" => selectTag("category",$category_arr),
			"EFFECT_DATE" => inputDateTag ("effectdate"),
			"EXPIRED_DATE" => inputDateTag ("expireddate"),
			"ACCESSOPTION" => radioTag("access",$AccessOption,"public"),
			"DESCRIPTION_TEXT" => textareaTag ('description',"",false,"ROWS=\"8\" COLS=\"40\""),
			"DOACTION" => "addsubmit"
		));

	}
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$i18n,$AccessOption;
		$template->setFile(array (
			"MAIN" => "apf_agreement_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");

		$apf_agreement = DB_DataObject :: factory('ApfAgreement');
		$apf_agreement->get($apf_agreement->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_agreement->getId(),"NOID" => $apf_agreement->getNoid(),"CATEGORY" => $apf_agreement->getCategory(),"EFFECTDATE" => $apf_agreement->getEffectdate(),"EXPIREDDATE" => $apf_agreement->getExpireddate(),"BUYER" => $apf_agreement->getBuyer(),"VENDER" => $apf_agreement->getVender(),"BUYERSIGNATURE" => $apf_agreement->getBuyersignature(),"VENDERSIGNATURE" => $apf_agreement->getVendersignature(),"DESCRIPTION" => $apf_agreement->getDescription(),"GROUPID" => $apf_agreement->getGroupid(),"USERID" => $apf_agreement->getUserid(),"ACCESS" => $apf_agreement->getAccess(),"ACTIVE" => $apf_agreement->getActive(),"ADD_IP" => $apf_agreement->getAddIp(),"CREATED_AT" => $apf_agreement->getCreatedAt(),"UPDATE_AT" => $apf_agreement->getUpdateAt(),));
	
		$category_arr =$this->getCategory();
		array_shift($AccessOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"CATEGORYOPTION" => selectTag("category",$category_arr,$apf_agreement->getCategory()),
			"EFFECT_DATE" => inputDateTag ("effectdate",$apf_agreement->getEffectdate()),
			"EXPIRED_DATE" => inputDateTag ("expireddate",$apf_agreement->getExpireddate()),
			"ACCESSOPTION" => radioTag("access",$AccessOption,$apf_agreement->getAccess()),
			"DESCRIPTION_TEXT" => textareaTag ('description',$apf_agreement->getDescription(),false,"ROWS=\"8\" COLS=\"40\""),
			"DOACTION" => "updatesubmit"
		));

		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$AddIP,$userid,$group_ids,$AccessOption;
		$apf_agreement = DB_DataObject :: factory('ApfAgreement');

		if ($edit_submit) 
		{
			$apf_agreement->get($apf_agreement->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_agreement->setNoid(stripslashes(trim($_POST['noid'])));
		$apf_agreement->setCategory(stripslashes(trim($_POST['category'])));
		$apf_agreement->setEffectdate(stripslashes(trim($_POST['effectdate'])));
		$apf_agreement->setExpireddate(stripslashes(trim($_POST['expireddate'])));
		$apf_agreement->setBuyer(stripslashes(trim($_POST['buyer'])));
		$apf_agreement->setVender(stripslashes(trim($_POST['vender'])));
		$apf_agreement->setBuyersignature(stripslashes(trim($_POST['buyersignature'])));
		$apf_agreement->setVendersignature(stripslashes(trim($_POST['vendersignature'])));
		$apf_agreement->setDescription(stripslashes(trim($_POST['description'])));

		$apf_agreement->setAccess(stripslashes(trim($_POST['access'])));
		$apf_agreement->setActive(stripslashes(trim($_POST['active'])));

		$apf_agreement->setAddIp($AddIP);
		$apf_agreement->setGroupid($group_ids);
		$apf_agreement->setUserid($userid);

				
		$val = $apf_agreement->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_agreement->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_agreement->update();

				$log_string = $i18n->_("Update").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['ID']}";
				logFileString ($log_string);
				
				$this->forward("agreement/apf_agreement/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_agreement->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_agreement->insert();

				$log_string = $i18n->_("Create").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['create_date']}";
				logFileString ($log_string);

				$this->forward("agreement/apf_agreement/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_agreement_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			$category_arr =$this->getCategory();
			array_shift($AccessOption);
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"CATEGORYOPTION" => selectTag("category",$category_arr,$_POST['category']),
				"EFFECT_DATE" => inputDateTag ("effectdate",$_POST['effectdate']),
				"EXPIRED_DATE" => inputDateTag ("expireddate",$_POST['expireddate']),
				"ACCESSOPTION" => radioTag("access",$AccessOption,$_POST['access']),
				"DESCRIPTION_TEXT" => textareaTag ('description',$_POST['description'],false,"ROWS=\"8\" COLS=\"40\""),
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
				"ID" => $_POST['id'],"NOID" => $_POST['noid'],"CATEGORY" => $_POST['category'],"EFFECTDATE" => $_POST['effectdate'],"EXPIREDDATE" => $_POST['expireddate'],"BUYER" => $_POST['buyer'],"VENDER" => $_POST['vender'],"BUYERSIGNATURE" => $_POST['buyersignature'],"VENDERSIGNATURE" => $_POST['vendersignature'],"DESCRIPTION" => $_POST['description'],"GROUPID" => $_POST['groupid'],"USERID" => $_POST['userid'],"ACCESS" => $_POST['access'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller,$i18n;
		$apf_agreement = DB_DataObject :: factory('ApfAgreement');
		$apf_agreement->get($apf_agreement->escape($controller->getID()));
		$apf_agreement->setActive('deleted');
		$apf_agreement->update();

		$log_string = $i18n->_("Delete").$i18n->_("File")."	{$filename}";
		logFileString ($log_string);

		$this->forward("agreement/apf_agreement/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$i18n,$WebTemplateDir,$ClassDir,$userid,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_agreement_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_agreement = DB_DataObject :: factory('ApfAgreement');
		$apf_agreement->orderBy('id desc');

		$max_row = 10;
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_agreement->limit($start_num,$max_row);
		$apf_agreement->whereAdd(" userid = '$userid' OR access = 'public' ");
		$ToltalNum = $apf_agreement->count();

		$apf_agreement->find();
		
		$myData=array();
		while ($apf_agreement->fetch())
		{
			$myData[] = $apf_agreement->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"NOID" => $data['noid'],"CATEGORY" => $data['category'],"EFFECTDATE" => $data['effectdate'],"EXPIREDDATE" => $data['expireddate'],"BUYER" => $data['buyer'],"VENDER" => $data['vender'],"BUYERSIGNATURE" => $data['buyersignature'],"VENDERSIGNATURE" => $data['vendersignature'],"DESCRIPTION" => $data['description'],"GROUPID" => $data['groupid'],"USERID" => $data['userid'],"ACCESS" => $data['access'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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
		$apf_agreement_category = DB_DataObject :: factory('ApfAgreementCategory');
		$apf_agreement_category->orderBy('id ASC');
		$apf_agreement_category->find();
		$myData = array();
		while ($apf_agreement_category->fetch())
		{
			$myData[$apf_agreement_category->getId()] = $apf_agreement_category->getCategoryName();
		}
		return $myData;
	}
	
}
?>
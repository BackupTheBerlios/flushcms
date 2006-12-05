<?php

/**
 *
 * ApfNews.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfNews.class.php,v 1.13 2006/12/05 05:04:48 arzen Exp $
 */

class ApfNews  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$ActiveOption;

		$template->setFile(array (
			"MAIN" => "apf_news_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$category_arr =$this->getCategory();
		
		array_shift($ActiveOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"CATEGORYOPTION" => selectTag("category_id",$category_arr),
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,"new"),
			"TEXTAREACONTENT" => textareaTag ("content","",true),
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
			"MAIN" => "apf_news_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_news = DB_DataObject :: factory('ApfNews');
		$apf_news->get($apf_news->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_news->getId(),"CATEGORY_ID" => $apf_news->getCategoryId(),"TITLE" => $apf_news->getTitle(),"CONTENT" => $apf_news->getContent(),"ACTIVE" => $apf_news->getActive(),"ADD_IP" => $apf_news->getAddIp(),"CREATED_AT" => $apf_news->getCreatedAt(),"UPDATE_AT" => $apf_news->getUpdateAt(),));

		$category_arr =$this->getCategory();
		array_shift($ActiveOption);
		$template->setVar(array (
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_news->getActive()),
			"CATEGORYOPTION" => selectTag("category_id",$category_arr,$apf_news->getCategoryId()),
			"TEXTAREACONTENT" => textareaTag ("content",$apf_news->getContent(),true),
		));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$ActiveOption,$AddIP,$userid,$group_ids;
		$apf_news = DB_DataObject :: factory('ApfNews');

		if ($edit_submit) 
		{
			$apf_news->get($apf_news->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_news->setCategoryId(stripslashes(trim($_POST['category_id'])));
		$apf_news->setTitle(stripslashes(trim($_POST['title'])));
		$apf_news->setContent(stripslashes(trim($_POST['content'])));
		$apf_news->setActive(stripslashes(trim($_POST['active'])));


		$apf_finance->setAddIp($AddIP);
		$apf_finance->setGroupid($group_ids);
		$apf_finance->setUserid($userid);


				
		$val = $apf_news->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_news->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_news->update();
				$this->forward("news/apf_news/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_news->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_news->insert();
				$this->forward("news/apf_news/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_news_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"DOACTION" => $do_action
			));
			$category_arr =$this->getCategory();
			array_shift($ActiveOption);
			$template->setVar(array (
				"ACTIVEOPTION" => radioTag("active",$ActiveOption,$_POST['active']),
				"CATEGORYOPTION" => selectTag("category_id",$category_arr,$_POST['category_id']),
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
				"ID" => $_POST['id'],"CATEGORY_ID" => $_POST['category_id'],"TITLE" => $_POST['title'],"CONTENT" => $_POST['content'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_news = DB_DataObject :: factory('ApfNews');
		$apf_news->get($apf_news->escape($controller->getID()));
		$apf_news->setActive('deleted');
		$apf_news->update();
		$this->forward("news/apf_news/");
	}
	
	function executeDetail () 
	{
		global $template,$WebBaseDir,$controller,$i18n,$ActiveOption,$WebTemplateFullPath;
		$template->setFile(array (
			"MAIN" => "apf_news_detail.html"
		));
		$template->setBlock("MAIN", "detail_block");
		
		$apf_news = DB_DataObject :: factory('ApfNews');
		$apf_news->get($apf_news->escape($controller->getID()));

		$template->setVar(array ("ID" => $apf_news->getId(),"CATEGORY_ID" => $apf_news->getCategoryId(),"TITLE" => $apf_news->getTitle(),"CONTENT" => $apf_news->getContent(),"ACTIVE" => $apf_news->getActive(),"ADD_IP" => $apf_news->getAddIp(),"CREATED_AT" => $apf_news->getCreatedAt(),"UPDATE_AT" => $apf_news->getUpdateAt(),));
		$template->setVar(array (
			"TEMPLATEDIR" => $WebTemplateFullPath,
			));
			
		$controller->parseTemplateLang();		
		$template->parse("OUT", array (
			"LAOUT",
		));
		$template->p("OUT");
		exit;
	
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$CurrencyFormat,$ActiveOption,$i18n;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		require_once 'I18N/Currency.php';

		$template->setFile(array (
			"MAIN" => "apf_news_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$currency = new I18N_Currency($CurrencyFormat);
		$category_arr =array(""=>$i18n->_("All"))+$this->getCategory();

		$max_row = 30;
		$apf_news = DB_DataObject :: factory('ApfNews');
		$apf_news->orderBy('apf_news.id desc');
		
		if (($keyword = trim($_REQUEST['q'])) != "") 
		{
			$apf_news->whereAdd("title LIKE '%".$apf_news->escape("{$keyword}") . "%' OR content LIKE '%".$apf_news->escape("{$keyword}") . "%' ");
		}
		if (($category = trim($_REQUEST['category'])) != "") 
		{
			$apf_news->whereAdd(" category_id = '".$apf_news->escape("{$category}") . "'  ");
		}
		if (($active = trim($_REQUEST['active'])) != "") 
		{
			$apf_news->whereAdd(" active = '".$apf_news->escape("{$active}") . "'  ");
		}

		$ToltalNum = $apf_news->count();
		
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_news->limit($start_num,$max_row);
//		$apf_news->buildCategroyJoin();
//		$apf_news->selectAs(array('id','active'), 'n_%s','apf_news');
//		$apf_news->debugLevel(4);
		$apf_news->find();
		
		$myData=array();
		while ($apf_news->fetch())
		{
			$myData[] = $apf_news->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"CATEGORY_ID" => $category_arr[$data['category_id']],"TITLE" => "<a href=\"###\" onclick=\"popOpenWindow('{$WebBaseDir}/news/apf_news/detail/{$data['id']}', '', '', 600, 600, 'yes')\">".$data['title']."</a>","CONTENT" => $data['content'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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
		$apf_news_category = DB_DataObject :: factory('ApfNewsCategory');
		$apf_news_category->orderBy('orderid ASC');
		$apf_news_category->find();
		$myData = array();
		while ($apf_news_category->fetch())
		{
			$myData[$apf_news_category->getId()] = $apf_news_category->getCategoryName();
		}
		return $myData;
	}
	
}
?>
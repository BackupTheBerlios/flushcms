<?php

/**
 *
 * index.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: Index.class.php,v 1.4 2006/11/26 23:39:59 arzen Exp $
 */

class index
{

	function executeList()
	{
		global $template,$web_base_name;
		$template->setFile(array (
			"MAIN_LEFT" => $this->getMenuLeftTemplate (),
			"MAIN" => "main_news_detail.html",
		));
		$template->setBlock("MAIN", "main_list", "list_block");
		$template->setBlock("MAIN_LEFT", "main_left", "left_block");
		if ($web_base_name=="front_en.php") 
		{
			$data = $this->getNewsDetailByID (8) ;
		} 
		else 
		{
			$data = $this->getNewsDetailByID (7) ;
		}
		$template->setVar(array (
			"CONTENT" => $data["content"],
		));

	
	}
	
	function executeDownload () 
	{
		global $template,$WebBaseDir,$web_base_name;
		$template->setFile(array (
			"MAIN_LEFT" => $this->getMenuLeftTemplate (),
			"MAIN" => "main_news_detail.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");
		$template->setBlock("MAIN_LEFT", "main_left", "left_block");
	
		if ($web_base_name=="front_en.php") 
		{
			$data = $this->getNewsDetailByID (10) ;
		} 
		else 
		{
			$data = $this->getNewsDetailByID (9) ;
		}
		$template->setVar(array (
			"CONTENT" => $data["content"],
		));
		
	}

	function executeDevelop () 
	{
		global $template,$WebBaseDir,$web_base_name;
		$template->setFile(array (
			"MAIN_LEFT" => $this->getMenuLeftTemplate (),
			"MAIN" => "main_news_detail.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");
		$template->setBlock("MAIN_LEFT", "main_left", "left_block");
	
		if ($web_base_name=="front_en.php") 
		{
			$data = $this->getNewsDetailByID (10) ;
		} 
		else 
		{
			$data = $this->getNewsDetailByID (9) ;
		}
		$template->setVar(array (
			"CONTENT" => $data["content"],
		));
		
	}

	function executeAboutus () 
	{
		global $template;
		$template->setFile(array (
			"MAIN_LEFT" => $this->getMenuLeftTemplate (),
			"MAIN" => "main_aboutus.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");
		$template->setBlock("MAIN_LEFT", "main_left", "left_block");
	}
	
	function executeDomain () 
	{
		global $template;
		$template->setFile(array (
			"MAIN_LEFT" => $this->getMenuLeftTemplate (),
			"MAIN" => "main_domain.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");
		$template->setBlock("MAIN_LEFT", "main_left", "left_block");
	}
	
	function executeTech () 
	{
		global $template,$WebBaseDir,$WebTemplateDir,$controller,$RootDir;
		require_once $RootDir.'/connect.php';
		require_once 'Pager/Pager.php';

		$template->setFile(array (
			"MENU_SUB" => "main_left_tech_category.html",
			"MAIN_LEFT" => $this->getMenuLeftTemplate (),
			"MAIN" => "main_tech.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");
		$template->setBlock("MAIN_LEFT", "main_left", "left_block");

		$category = $controller->getID()?$controller->getID():1;
		if($category != 4 )		
			$template->setBlock("MENU_SUB", "main_left_sub", "left_sub_block");
		
		$max_row = 30;
		$apf_news = DB_DataObject :: factory('ApfNews');
		$apf_news->orderBy('apf_news.id desc');
		
		
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_news->limit($start_num,$max_row);
		$apf_news->whereAdd(" category_id = '".$apf_news->escape("{$category}") . "'  ");
		$apf_news->whereAdd(" active='live' ");
		$ToltalNum = $apf_news->count();
		$apf_news->find();
		
		$i=0;
		$myData=array();
		while ($apf_news->fetch())
		{
			$myData[] = $apf_news->toArray();
			$i++;
		}
		
		$tmpData = ($ToltalNum>$max_row)?array_pad($myData, $ToltalNum, array()):$myData;
		$params = array(
		    'itemData' => $tmpData,
		    'perPage' => $max_row,
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
		foreach($myData as $data)
		{
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));
			
			$template->setVar(array ("ID" => $data['id'],"CATEGORY_ID" => $data['category_id'],"TITLE" => $data['title'],"CONTENT" => $data['content'],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"KEYWORD" => textTag ("q",$_REQUEST['q']),
			"WEB_DIR" => $WebBaseDir,
			"WEB_TEMPLATE_DIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"TOLTAL_NUM" => $ToltalNum,
			"PAGINATION" => $links['all']
		));
		
	}
	
	function executeTechdetail () 
	{
		global $template,$WebBaseDir,$WebTemplateDir,$controller,$WebTemplateFullPath,$cache,$RootDir;
		
		$template->setFile(array (
			"MENU_SUB" => "main_left_tech_category.html",
			"MAIN_LEFT" => $this->getMenuLeftTemplate (),
			"MAIN" => "main_tech_detail.html"
		));
		$template->setBlock("MAIN", "main_list", "list_block");
		$template->setBlock("MAIN_LEFT", "main_left", "left_block");
		$template->setBlock("MENU_SUB", "main_left_sub", "left_sub_block");
		
		$cache_key = $controller->getID()."_tech_detail";
		if ($cache_data=$cache->get($cache_key)) 
		{
			$data = unserialize($cache_data);
		} 
		else 
		{
			require_once $RootDir.'/connect.php';
			$apf_news = DB_DataObject :: factory('ApfNews');
			$apf_news->get($apf_news->escape($controller->getID()));
			$data = $apf_news->toArray();
			$cache->save(serialize($data),$cache_key);
		}

		$template->setVar(array ("TITLE" => $data['title'],"CONTENT" => $data['content'],"CREATED_AT" => $data['created_at']));
		$template->setVar(array (
			"TEMPLATEDIR" => $WebTemplateFullPath,
			"WEB_DIR" => $WebBaseDir,
			));
		
	}
	
	function executeSolution () 
	{
		global $template;
		$template->setFile(array (
			"MAIN_LEFT" => $this->getMenuLeftTemplate (),
			"MAIN" => "main_solution.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");
		$template->setBlock("MAIN_LEFT", "main_left", "left_block");
	}
	
	function executeMoney () 
	{
		global $template;
		$template->setFile(array (
			"MAIN_LEFT" => $this->getMenuLeftTemplate (),
			"MAIN" => "main_money.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");
		$template->setBlock("MAIN_LEFT", "main_left", "left_block");
	}
	
	function executeFeedback () 
	{
		global $template,$WebTemplateFullPath,$WebBaseDir;
		$template->setFile(array (
			"MAIN_LEFT" => $this->getMenuLeftTemplate (),
			"MAIN" => "main_feedback.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");
		$template->setBlock("MAIN_LEFT", "main_left", "left_block");
		$template->setVar(array (
			"WEB_TEMPLATE_DIR" => $WebTemplateFullPath,
			"WEB_DIR" => $WebBaseDir,
			));
	}
	
	function getMenuLeftTemplate () 
	{
		global $web_base_name;
		if ($web_base_name=="front_en.php") 
		{
			$menu_left = "main_left_en.html";
		} 
		else 
		{
			$menu_left = "main_left.html";
		}
		return $menu_left;
	}
	
	function getNewsDetailByID ($id) 
	{
		global $RootDir,$cache;
		$cache_key = $id."_tech_detail";
		if ($cache_data=$cache->get($cache_key)) 
		{
			$data = unserialize($cache_data);
		} 
		else 
		{
			require_once $RootDir.'/connect.php';
			$apf_news = DB_DataObject :: factory('ApfNews');
			$apf_news->get($apf_news->escape($id));
			$data = $apf_news->toArray();
			$cache->save(serialize($data),$cache_key);
		}
		return $data;
	}

}
?>
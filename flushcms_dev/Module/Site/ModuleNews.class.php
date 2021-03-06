<?php

/*
   +----------------------------------------------------------------------+
   | FlushPHP                                                             |
   +----------------------------------------------------------------------+
   | Copyright (c) 2005-2006 The FlushPHP Group                           |
   +----------------------------------------------------------------------+
   | This library is free software; you can redistribute it and/or        |
   | modify it under the terms of the GNU Lesser General Public           |
   | License as published by the Free Software Foundation; either         |
   | version 2.1 of the License, or (at your option) any later version.   |
   +----------------------------------------------------------------------+
   | Author: John.meng(��Զ��)  Jan 19, 2006 12:13:26 PM                        
   +----------------------------------------------------------------------+
 */

/* $Id$ */

include_once (APP_DIR."UI.class.php");
include_once ("DAO/ModuleNewsDAO.class.php");

class ModuleNews extends UI
{

	var $_DAO;
	function ModuleNews()
	{
		global $smarty,$smarty_site;
		$this->_DAO = new ModuleNewsDAO();
		include_once("DAO/SiteMenuDAO.class.php");
		$siteMenuDAO = & new SiteMenuDAO();
		if ($_GET['MenuID'] && $_GET['PID']==0) 
		{
			$top_pid = $_GET['MenuID'];
		}else 
		{
			$top_pid = $_GET['PID'];
		}
		$smarty->assign("__MenuID__",$_GET['MenuID']);
		$smarty_site->assign("__site_sub_menu__",$siteMenuDAO->getSubMenu($top_pid));
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opAdd () 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$__SITE_VAR__,$form,$FlushPHPObj,$thisDAO,$smarty,$class_path;
		
		include_once (PEAR_DIR.'HTML/QuickForm.php');
		$form = new HTML_QuickForm('firstForm','post','','_self' ,"onsubmit='save_in_textarea_all();'");

		$renderer =& $form->defaultRenderer();
		$renderer->setFormTemplate("\n<form{attributes}>\n<table border=\"0\" class=\"new_table\" width='100%'>\n{content}\n</table>\n</form>");
		$renderer->setHeaderTemplate("\n\t<tr>\n\t\t<td class=\"grid_table_head\" align=\"left\" valign=\"top\" colspan=\"2\"><b>{header}</b></td>\n\t</tr>");

		$Content = $_POST['Content'];
		if ($_REQUEST['Action']=='Update') 
		{
			$this_data = $this->_DAO->getRowByID(SITE_NEWS_TABLE,"NewsID",$_REQUEST['ID']);
			$form->setDefaults(array(
								"Title"=>$this_data['Title'],
								"Summary"=>$this_data['Summary'],
								"Source"=>$this_data['Source'],
								"Author"=>$this_data['Author']
								)
							   );
			$Content = $this_data['Content'];
			$form->addElement('hidden', 'ID', $this_data['NewsID']); 
		}

		$class_path =INCLUDE_DIR. "editor/";
		$CurrentUserPathImages=HTML_IMAGES_DIR;
		$SiteCssFile = CURRENT_HTML_DIR."style.css";
		
		$ed_4 = & new rich("", 'Content', $Content,
				 "380", "350","../../".$CurrentUserPathImages,
				   "../../".$CurrentUserPathImages, false, false);
		$ed_4->set_default_stylesheet($SiteCssFile);
		$ed_4->myModule(true);
		$editors=$ed_4->draw();
		$smarty->assign("class_path_editor",$class_path);

		$form->addElement('header', null, $__Lang__['langGeneralAdd']." ".$__Lang__['langSiteModuleNews']);
		
		$form->addElement('text', 'Title', $__Lang__['langModuleNewsTitle'].' : ',array('size'=>40));
		$form->addElement('textarea', 'Summary', $__Lang__['langModuleNewsSummary'].' : ',array('rows' => 5, 'cols' => 40));
		$form->addElement('static', 'Content', NULL,$editors);
		$form->addElement('text', 'Source', $__Lang__['langModuleNewsSource'].' : ',array('size'=>30));
		$form->addElement('text', 'Author', $__Lang__['langModuleNewsAuthor'].' : ',array('size'=>20));
		
		$form->addElement('submit', null, $__Lang__['langGeneralSubmit']);
		
		$form->addRule('Title', $__Lang__['langGeneralPleaseEnter']." ".$__Lang__['langModuleNewsTitle'], 'required');

		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action',$_REQUEST['Action']); 
		$form->addElement('hidden', 'MenuID',$_GET['MenuID']); 

		if ($form->validate()) 
		{
			if (get_magic_quotes_gpc()) 
			{
				$record["Content"] = stripslashes($_POST['Content']);
			}
			 else
			{
				$record["Content"] = $_POST['Content'];
			}
			$record["Title"] = $_POST['Title'];
			$record["Summary"] = $_POST['Summary'];
			$record["Source"] = $_POST['Source'];
			$record["Author"] = $_POST['Author'];
			$record["SiteMenuID"] = $_POST['MenuID'];

			$record = $record + $this->_DAO->baseField();
			if ($_POST['ID'] && $_POST['Action']=='Update') 
			{
				$this->_DAO->opUpdate(SITE_NEWS_TABLE,$record," NewsID = ".$_POST['ID']);
			}
			else 
			{
				$this->_DAO->opAdd (SITE_NEWS_TABLE,$record);
			} 
			
			echo "<SCRIPT LANGUAGE='JavaScript'>opener.window.location.reload();window.close();</SCRIPT>";
		}
		$html_code = "<link rel=\"StyleSheet\" type=\"text/css\" href=\"".$class_path."rich_files/rich.css\"><script language=\"JScript.Encode\" src=\"".$class_path."rich_files/rich.js\"></script>".$form->toHTML();
		$smarty->assign("Main", str_replace(ROOT_DIR,"../",$html_code));
	}
	/**
	 *
	 *
	 * @author  John.meng (��Զ��)
	 * @since   version - 2006-1-21 11:35:43
	 * @param   string  
	 *
	 */
	function opDetail () 
	{
		global $smarty,$smarty_site,$__Lang__;
		$row = $this->_DAO->getRowByID(SITE_NEWS_TABLE,"NewsID",$_GET['NewsID']);
		$news_title=$row["Title"];
		$news_date = $row['CreateTime'];
		$news_content=$row["Content"];
		$news_source = $row['Source'];
		$news_author = $row['Author'];
		$source = $__Lang__['langModuleNewsSource'];
		$author = $__Lang__['langModuleNewsAuthor'];
		$html_code =<<<EOT
		<TABLE class='site_news_table'>
		<TR>
			<TD align="center"><p><h1>$news_title</h1><br/>
			$source: <font class="site_news_date">$news_source</font>
			$author: <font class="site_news_date">$news_author</font> 
			($news_date)</p>
			<hr noshade size="1" color="#000000">
			</TD>
		</TR>
		<TR>
			<TD>$news_content</TD>
		</TR>
		</TABLE>		
EOT;
		include_once("ModuleQuickLink.php");
		$smarty_site->assign("__site_main__",$html_code);
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Dec 20, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opUpdate () 
	{
		global $__Lang__, $FlushPHPObj,$form, $smarty;
		
		$this_data = $thisDao->getRowByID(SITE_NEWS_TABLE,"NewsID",$_REQUEST['ID']);
		$form->setDefaults(array(
							"user_name"=>$this_data['UserName']
							)
						   );
		$form->addElement('hidden', 'ID', $this_data['NewsID']); 
		
	}
	/**
	* Cancel operation
	*
	* @author	John.meng
	* @since    version - Dec 21, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opCancel () 
	{
		global $__Lang__, $MessageObj,$smarty;
		if ($delNum = $this->_DAO->delRowsByID(SITE_NEWS_TABLE,"NewsID",$_REQUEST['ID'])) 
		{
			$smarty->assign("Main",$MessageObj->displayMsg($__Lang__['langGeneralCancel']." <font color='red' > <b> $delNum </b> </font> ".$__Lang__['langGeneralRecord'],"MSG"));
		}
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Dec 23, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opCancelSelected () 
	{
		global $__Lang__, $MessageObj,$smarty;
		
		if (is_array($_POST['CheckID'])) 
		{
			$check_ids = implode(",",$_POST['CheckID']);
			if ($delNum = $this->_DAO->delRowsByID(SITE_NEWS_TABLE,"NewsID",$check_ids)) 
			{
				$smarty->assign("Main",$MessageObj->displayMsg($__Lang__['langGeneralCancel']." <font color='red' > <b> $delNum </b> </font> ".$__Lang__['langGeneralRecord'],"MSG"));
			}
		}else 
		{
			$smarty->assign("Main",$MessageObj->displayMsg($__Lang__['langGeneralCancel']." <font color='red' > <b> $delNum </b> </font> ".$__Lang__['langGeneralRecord'],"NOTICE"));
		}
		
	}
	
	/**
	 *
	 *
	 * @author  John.meng (��Զ��)
	 * @since   version - 2006-1-19 21:40:54
	 * @param   string  
	 *
	 */
	function getNewsAll ($MenuID=null) 
	{
		global $SiteDB;
		if ($MenuID) 
		{
			$where_is = "  AND a.SiteMenuID = '$MenuID'  ";
		}
		$Sql = " SELECT a.*,b.PID FROM ".SITE_NEWS_TABLE." AS a LEFT JOIN ".SITE_MENU_TABLE." AS b ON a.SiteMenuID=b.SiteMenuID WHERE a.VersionCode = '".$_SESSION['CURRENT_LANG']."' $where_is ORDER BY a.CreateTime DESC ";
		return $SiteDB->GetAll($Sql);
	}
	
	/**
	 *
	 *
	 * @author  John.meng (��Զ��)
	 * @since   version - 2006-1-19 21:43:38
	 * @param   string  
	 *
	 */
	function displayFormat1 (&$Array,$display_nav=true) 
	{
		global $__Lang__,$page_data,$all_data,$links,$UrlParameter;
		$all_data = $Array;
		parent::viewList();

		if (is_array($page_data) && sizeof($page_data)) 
		{
			$html_code = "<TABLE class='site_news_table'><TR><TD>";
			foreach ($page_data as $key=>$NewsArray) 
			{
				$news_title = $NewsArray['Title'];
				$news_date = $NewsArray['CreateTime'];
				$news_summary = $NewsArray['Summary'];
				$news_source = $NewsArray['Source'];
				$news_author = $NewsArray['Author'];
				$prefix_url=(__IS_ADMIN__ == 'Yes')?$UrlParameter:"?";
				$news_url = $prefix_url."&Ver=".$NewsArray['VersionCode']."&MenuID=".$NewsArray['SiteMenuID']."&PID=".$NewsArray['PID']."&NewsID=".$NewsArray['NewsID']."&Action=Detail";
				$source = $__Lang__['langModuleNewsSource'];
				$author = $__Lang__['langModuleNewsAuthor'];
				
				$html_code .=<<<EOT
					<a href="$news_url"><h1>$news_title</h1></a>
					
					<P> <font class="site_news_date">[$news_date]</font>
					$news_summary
					</P>
					
					<P>
					$source: <font class="site_news_date">$news_source</font>
					$author: <font class="site_news_date">$news_author</font>
					</P>			
	
					<hr noshade size="1" color="#000000">        
				
EOT;
	
			}
			$html_code .= "</TD></TR>" ;
			if ($display_nav) 
			{
				$html_code .= "<TR><TD align='center'>".$links['all']."</TD></TR>";
			}
			$html_code .= "</TABLE>";			
		}

		return $html_code;
	}
	
	/**
	 *
	 *
	 * @author  John.meng (��Զ��)
	 * @since   version - 2006-1-21 16:06:46
	 * @param   string  
	 *
	 */
	function &getTopNews ($Num) 
	{
		$all_news = $this->getNewsAll ();
		if(is_array($all_news))
		{
			$use_news = array_slice ($this->getNewsAll (), 0, $Num);
		}
		return $this->displayFormat1($use_news,false);
	}
	
	/**
	* View list
	*
	* @author	John.meng
	* @since    version 1.0 - Dec 13, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function viewList () 
	{
		global $__Lang__,$UrlParameter,$FlushPHPObj,$table,$page_data,$all_data,$links,$form, $smarty;

		$all_data = $this->_DAO->getMenuIDNews($_GET['MenuID']);

		parent::viewList();
		$table->setHeaderContents(0, 0,NULL);
		$table->setHeaderContents(0, 1, $__Lang__['langModuleNewsTitle']);
		$table->setHeaderContents(0, 2, $__Lang__['langGeneralCreateTime']);
		$table->setHeaderContents(0, 3, $__Lang__['langGeneralOperation']);

		foreach($page_data as $key=>$data )
		{
			$user_id = $data['NewsID'];
			$table->addRow(array("<INPUT TYPE=\"checkbox\" NAME=\"CheckID[]\" value=\"$user_id\">",$data['Title'],$data['CreateTime'],$this->_actionBars($user_id)));
		}
		
		$altRow = array ("class" => "grid_table_tr_alternate");
		$table->altRowAttributes(1, null, $altRow);
		
		$form->addElement('static', 'fieldsAssoc','',$table->toHtml());
		$form->addElement('submit', NULL,$__Lang__['langGeneralCancel'].$__Lang__['langGeneralSelect']);
		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action', 'CancelSelected'); 
		$html_grib = $form->toHtml();          
		$smarty->assign("Main", $html_grib.$links['all']);
		
	}
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function toHtml () 
	{
		global $__Lang__,$smarty_site,$smarty;
		include_once("ModuleQuickLink.php");
		
		$smarty_site->assign("__site_main__",$this->displayFormat1($this->getNewsAll ($_GET['MenuID'])));
	}
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Dec 26, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function &_actionBars ($id) 
	{
		global $__Lang__,$MenuObj;
		
		$action_data = array(
			'update'=>array(
				'title'=>$__Lang__['langGeneralUpdate'],
				'url'=>"?Module=Site&Page=ModuleNews&Action=Update&MenuID=".$_GET['MenuID']."&ID=".$id,
				'imgName'=>'edit.gif'
			),
			'del'=>array(
				'title'=>$__Lang__['langGeneralCancel'],
				'url'=>'?Module=Site&Page=ModuleNews&Action=Cancel&ID='.$id,
				'js'=>" onclick=\"return confirm ( '".$__Lang__['langGeneralCancelConfirm']."');\" ",
				'imgName'=>'delete.gif'
			)
		);
		return $MenuObj->_actionBars(&$action_data);
	}
	
}
?>
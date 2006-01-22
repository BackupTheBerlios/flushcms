<?php
/*
   +----------------------------------------------------------------------+
   | FlushPHP                                                             |
   +----------------------------------------------------------------------+
   | Copyright (c) 2005 The FlushPHP Group                                |
   +----------------------------------------------------------------------+
   | This library is free software; you can redistribute it and/or        |
   | modify it under the terms of the GNU Lesser General Public           |
   | License as published by the Free Software Foundation; either         |
   | version 2.1 of the License, or (at your option) any later version.   |
   +----------------------------------------------------------------------+
   | Author: John.meng(ÃÏÔ¶òû)  Jan 5, 2006 12:26:05 PM                        
   +----------------------------------------------------------------------+
 */

/* $Id: Auth.class.php,v 1.7 2006/01/22 06:41:15 arzen Exp $ */

class Auth 
{
	

	function Auth()
	{
		if (empty($_COOKIE['UserName']) && $_SESSION['UserName']) 
		{
			setcookie("UserName", $_SESSION['UserName'], time()+3600*360);
			
		}
		@session_start();
		
		if ($_REQUEST['Action'] == "Logout" && $_POST['Action']!='LOGON') 
		{
			$this->logout();
		}

		if ($_SESSION['IsLogined']==false) 
		{
			$this->drawLogin();
		}
	}
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 5, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function drawLogin () 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$FlushPHPObj,$form,$smarty;
		
		include_once (PEAR_DIR.'HTML/QuickForm.php');
		$form = new HTML_QuickForm('firstForm');
		
		$replace_str = "../";
		$html_code = str_replace(ROOT_DIR,$replace_str,THEMES_DIR);
		
		echo "<link href='".$html_code."style.css' rel='stylesheet' type='text/css'>";
		$renderer =& $form->defaultRenderer();
		$renderer->setFormTemplate("\n<form{attributes}>\n<table border=\"0\" class=\"log_table\" align=\"center\">\n{content}\n</table>\n</form>");
		$renderer->setHeaderTemplate("\n\t<tr>\n\t\t<td class=\"log_table_head\" align=\"left\" valign=\"top\" colspan=\"2\" ><b>{header}</b></td>\n\t</tr>");

		$form->addElement('header', null, "<img src=\"".$html_code."images/logo.gif\" border=\"0\" >");
		$form->addElement('text', 'user_name', $__Lang__['langMenuUser'].$__Lang__['langGeneralName'].' : ');
		$form->addElement('password', 'user_passwd', $__Lang__['langMenuUser'].$__Lang__['langGeneralPassword'].' : ');

		$form->addRule('user_name', $__Lang__['langGeneralPleaseEnter']." ".$__Lang__['langMenuUser']." ".$__Lang__['langGeneralName'], 'required');
		$form->addRule('user_passwd',$__Lang__['langGeneralPleaseEnter']." ".$__Lang__['langMenuUser']." ".$__Lang__['langGeneralPassword'], 'required');
		$form->addElement('hidden', 'Action', 'LOGON'); 
		
		$form->setDefaults(array('user_name'=>$_COOKIE['UserName']));
		
		$form->addElement('submit', null, $__Lang__['langGeneralSubmit']);
		$form->addElement('static', 'login_message');

		if ($form->validate() && $_POST['Action']=='LOGON') 
		{
			$user_name=$_POST['user_name'];
			$user_password=md5($_POST['user_passwd']);
			$this->checkAuth($user_name,$user_password);
		}
		
		$form->display();
		exit();		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 5, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function login () 
	{
		
	}
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 5, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function checkAuth ($user_name,$user_password) 
	{
		global $SiteDB,$FlushPHPObj,$form,$__Lang__;
		$where_is = " UserName = '$user_name' AND Passwd = '$user_password' ";
		$DBAppObj = $FlushPHPObj->loadApp("DBApp");
		$res_row = $DBAppObj->checkExists(USERS_TABLE,$where_is);
		if ($res_row) 
		{
			$_SESSION['UserName'] = $res_row['UserName'];
			$_SESSION['UsersID'] = $res_row['UsersID'];
			$_SESSION['IsLogined'] = true;
			echo "<script>window.location='".$_SERVER['PHP_SELF']."'</script>";
		}
		else 
		{
			$form->setDefaults(array('login_message'=>"<font color='red'> ".$__Lang__['langLoginFail']." </font>"));
		}
	}
	
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 5, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function logout () 
	{
		$_SESSION['IsLogined']=false;
		$_SESSION['UserName'] = "";
		$_SESSION['UsersID'] = "";
	}
		
}
?>
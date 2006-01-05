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

/* $Id: Auth.class.php,v 1.1 2006/01/05 05:36:55 arzen Exp $ */

class Auth 
{

	function Auth()
	{
		$this->drawLogin();
	}
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 5, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function drawLogin ($message_str=null) 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$FlushPHPObj,$form,$smarty;
		
		include_once (PEAR_DIR.'HTML/QuickForm.php');
		$form = new HTML_QuickForm('firstForm');
		echo "<link href='".THEMES_DIR."style.css' rel='stylesheet' type='text/css'>";
		$renderer =& $form->defaultRenderer();
		$renderer->setFormTemplate("\n<form{attributes}>\n<table border=\"0\" class=\"log_table\" align=\"center\">\n{content}\n</table>\n</form>");
		$renderer->setHeaderTemplate("\n\t<tr>\n\t\t<td class=\"log_table_head\" align=\"left\" valign=\"top\" colspan=\"2\"><b>{header}</b></td>\n\t</tr>");

		$form->addElement('header', null, $__Lang__['langLoginHeader']);
		$form->addElement('text', 'user_name', $__Lang__['langMenuUser'].$__Lang__['langGeneralName'].' : ');
		$form->addElement('password', 'user_passwd', $__Lang__['langMenuUser'].$__Lang__['langGeneralPassword'].' : ');

		$form->addRule('user_name', $__Lang__['langGeneralPleaseEnter']." ".$__Lang__['langMenuUser']." ".$__Lang__['langGeneralName'], 'required');
		$form->addRule('user_passwd',$__Lang__['langGeneralPleaseEnter']." ".$__Lang__['langMenuUser']." ".$__Lang__['langGeneralPassword'], 'required');

		$form->addElement('submit', null, $__Lang__['langGeneralSubmit']);
		if ($message_str) 
		{
			$form->addElement('static', null,null, $message_str);
		}

		if ($form->validate()) 
		{
			$user_name="";
			$user_password="";
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
		global $SiteDB;
		
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
		
	}
		
}
?>
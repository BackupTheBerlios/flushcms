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
   | Author: John.meng(ÃÏÔ¶òû)  2005-12-12 21:25:26                        
   +----------------------------------------------------------------------+
 */

/* $Id: UI.class.php,v 1.3 2005/12/14 13:46:32 arzen Exp $ */

require_once (PEAR_DIR.'HTML/QuickForm.php');
require_once (PEAR_DIR.'HTML/QuickForm/element.php');
require_once (PEAR_DIR.'HTML/QuickForm/autocomplete.php');

class UIElement
{

	var $_actionMapping;

	function display()
	{
		echo $this->toHtml();
	}

	function addToForm(& $form, $name, $before = null)
	{
		if ($name == "")
		{
			$name = "UI_UTIL_ELEM".rand(10000, 99999);
		}
		if (is_subclass_of($form, "HTML_QuickForm"))
		{
			$form->addElement('static', $name, NOLABEL, $this->toHtml());
			if ($before != null)
			{
				@ ($form->insertElementBefore($form->removeElement($name, false), $before));
			}
		}

	}

	/**
	* Checks for permissions in the action mapping
	*
	* @param $module string module
	* @param $page   string page
	* @param $mode   string mode
	* @returns READ, WRITE, or NONE
	*/
	function hasPermission($module, $page, $mode)
	{
		return true;
		/*
		require_once("Include/Action_Mapping.php");
		
		if (($module == null) || (strlen($module) == 0) ||
		    ($page   == null) || (strlen($page)   == 0))
		{
		    return WRITE;
		}
		
		if (!(is_object($this->_actionMapping)))
		{
		    $this->_actionMapping = new Action_Mapping();
		}
		return $this->_actionMapping->getPermission($module, $page,$mode);        
		*/
	}

	/**
	* Checks for Read (or write) permissions
	*
	* returns true if user has read or write permission to this element
	*
	* @param $module string module
	* @param $page   string page
	* @param $mode   string mode
	* @returns bool whether has permissions
	*/
	function hasReadPermission($module, $page, $mode)
	{
		return true;
		//$perm = $this->hasPermission($module, $page, $mode);
		//return (($perm == READ) || ($perm == WRITE));

	}

	/**
	* Checks for write permissions
	*
	* returns true if user has write permission to this element
	*
	* @param $module string module
	* @param $page   string page
	* @param $mode   string mode
	* @returns bool whether has write permission
	*/
	function hasWritePermission($module, $page, $mode)
	{
		return true;
		//return ($this->hasPermission($module, $page, $mode) == WRITE);
	}

	function actionMappingFromLink($link)
	{
		return array ("", "", "");
		//list($junk, $link) = explode("module=", $link);
		//list($module, $link) = explode("&", $link);
		//list($junk, $link) = explode("page=", $link);
		//list($page, $link) = explode("&", $link);
		//list($junk, $link) = explode("mode=", $link);
		//list($mode, $link) = explode("&", $link);
		//return array($module, $page, $mode); 
	}
}

/* example for using UI tools:
*******************************************
Tabset:

$tabs = new Tabset($tabdef, $active);
$tabs->addTab("Page 1", "page1.php", true);
$tabs->addTab("Page 2", "page2.php");
$tabs->display();
*/
class Tabset extends UIElement
{

    var $_tabs = array();
    var $_selected = 0;

    /*
    *  default constructor for a tabset
    *
    * @param $tabs array - optional array of ($title, $link) for
    *                      adding all the tabs at creation time
    * @param $selected integer - optional index in the array of the currently selected tab.  defaults to 1st tab.
    *
    */
    function Tabset($tabs = array(), $selected = 0)
    {
         //$this->_tabs = $tabs;
         $this->addTabs($tabs, $selected);
         //$this->_selected = $selected;

    }

    
    /* Adds a tab to a tabset
    *@param $title  the title displayed for the tab
    *@param $link  the link the tab goes to
    *@param $current boolean  optional whether this is the currently selected tab (defaults to false)
    *@param $module  string   module name for permissions mgmt
    *@param $page    string   page name for permissions mgmt
    *@param $mode    string   mode name for permissions mgmt
    */
    function addTab($title, $link, $current = false, $module = null, $page=null, $mode=null)
    {
        if ($this->hasReadPermission($module, $page, $mode))
        {
            $this->_tabs[] = array($title, $link);
            if ($current === true)
            {
               $this->_selected = count($this->_tabs) - 1;
            }
        }
        else
        {
            if (count($this->_tabs) <= $this->_selected)
            {
               $this->_selected--; 
            }
        }
    }

    /* Adds multiple tabs to the tabset
    *
    *@param $tabs  array of ($title, $link, [$module], [$page], [$mode]) for tabs
    *@param $selected optional integer specifying index of active tab
    */
    function addTabs($tabs, $selected = "")
    {
        if ($selected !== "")
        {
           $this->_selected = $selected; 
        }

        foreach ($tabs as $tab)
        {
            $this->addTab($tab[0], $tab[1], false, $tab[2], $tab[3], $tab[4]);        
        }
    }

    /* displays the tabset 
    *
    *  displays a tabset to the screen
    */
    function toHtml()
    {
        $out = "";
       $out .= "<div id='navcontainer'>\n";
       $out .= "<ul id='navlist'>\n";

       $ctr = 0;
       foreach ($this->_tabs as $tab)
       {
           $active = "";
           if ($ctr == $this->_selected)
           {
              $active = "id=\"current\" "; 
           }
           $out .= "<li ><a $active href=\"$tab[1]\">$tab[0]</a></li>\n";
           $ctr++;
       }
       $out .= "</ul>\n";
       $out .= "</div>\n";

       return $out;
        
    }
    
}


/**
 * class_description
 * @package	package_name
 */

class UIImage extends UIElement
{
	var $_src;
	var $_border=0;
	var $_height;
	var $_width;

	function UIImage($src, $height = null, $width = null, $border = 0 )
	{
		$this->_src = $src;
		$this->_border = $border;
		$this->_height = $height;
		$this->_width = $width;
	}

	function toHTML()
	{
		$out  = "<img src='".$this->_src."'";
		$out .= " border=".$this->_border;
		if ($this->_height) 
		{
			$out .= " height=".$this->_height;
		}
		if ($this->_width) 
		{
			$out .= " height=".$this->_width;
		}
		$out .= " /> \n";
		return $out;
	}

	function display($param = "")
	{
		echo $this->toHTML($param);
	}
}

class UIButton extends UIElement
{
	var $_name;
	var $_id;
	var $_attrib;
	var $_label;
	var $_canDisplay;

	function UIButton($label, $module = null, $page = null, $mode = null)
	{
		$this->_label = $label;
		$this->_canDisplay = $this->hasReadPermission($module, $page, $mode);
		$this->_attrib = "";
	}

	function setAttribs($attribText)
	{
		$this->_attrib = $attribText;
	}

	function addAttribs($attribText)
	{
		$this->_attrib .= $attribText;
	}

	function toHTML($param = "")
	{
		if ($this->_canDisplay)
		{
			$out = "<input type='button' value='";
			$out .= $this->_label."' ";
			$out .= $this->_attrib." /> \n";
			return $out;
		}
	}

	function display($param = "")
	{
		echo $this->toHTML($param);
	}

}

class JSButton extends UIButton
{
	function JSButton($label, $func, $params, $module = null, $page = null, $mode = null)
	{
		UIButton :: UIButton($label, $module, $page, $mode);
		$this->setAttribs(" onClick=\"javascript: $func($params)\"");
	}
}

class LinkButton extends JSButton
{
	function Linkbutton($label, $link, $module = null, $page = null, $mode = null)
	{
		if ($module == null)
		{
			list ($module, $page, $mode) = $this->actionMappingFromLink($link);
		}
		JSButton :: JSButton($label, "window.open", "'$link', '_self'", $module, $page, $mode);
	}
}

class PopupLinkButton extends JSButton
{
	function PopupLinkButton($label, $link, $width = 400, $height = 400, $module = null, $page = null, $mode = null)
	{
		JSButton :: JSButton($label, "popOpenWindow", "'$link','','',$width,$height,1", $module, $page, $mode);
	}
}

?>
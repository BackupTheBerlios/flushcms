<?php
/**
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the BSD License.
 *
 * Copyright(c) 2004 by Qiang Xue. All rights reserved.
 *
 * To contact the author write to {@link mailto:qiang.xue@gmail.com Qiang Xue}
 * The latest version of PRADO can be obtained from:
 * {@link http://prado.sourceforge.net/}
 *
 * @author John.meng <john.meng@achievo.com>
 * @version $id$
 * @package System.Web.UI.WebControlsExt
 */

/**
 * PNavMenuPageItem class
 *
 * PNavMenuPageItem node of PNavMenuPanel .
 *
 * Namespace: System.Web.UI.WebControlsExt
 *
 * Properties
 * - <b>Text</b>, string, kept in viewstate
 * - <b>Target</b>, string, kept in viewstate
 * - <b>PageName</b>, string, kept in viewstate
 * - <b>ModuleName</b>, string, kept in viewstate
 *   <br />Returns result.
 *
 *
 * @author John.meng <john.meng@achievo.com>
 * @version v1.0, last update on May 19, 2006 9:23:31 AM
 * @package System.Web.UI.WebControlsExt
 */

class PNavMenuPageItem extends PNavMenuItem
{

    /**
     * @return string the link Target
     */
	function getTarget () 
	{
		return $this->getViewState('Target','_self');
		
	}
    /**
     * @param string the link target
     */
	function setTarget ($value) 
	{
		$this->setViewState('Target',$value,'');
	}
	/**
	 * @return string the pages of the link
	 */ 
	function getPageName () 
	{
		return $this->getViewState('PageName','');
	}
	/**
	 * Sets the pages of the link.
	 * @param string the pages to be set
	 */ 
	function setPageName ($value) 
	{
		$this->setViewState('PageName',$value,'');
	}
	/**
	 * @return string the modules of the link
	 */ 
	function getModuleName () 
	{
		return $this->getViewState('ModuleName','');
	}
	/**
	 * Sets the modules of the link.
	 * @param string the modules to be set
	 */ 
	function setModuleName ($value) 
	{
		$this->setViewState('ModuleName',$value,'');
	}
	

	

	
}
?>

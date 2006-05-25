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
 * PNavMenuLinkItem class
 *
 * PNavMenuLinkItem node of PNavMenuPanel .
 *
 * Namespace: System.Web.UI.WebControlsExt
 *
 * Properties
 * - <b>Text</b>, string, kept in viewstate
 * - <b>Target</b>, string, kept in viewstate
 * - <b>LinkUrl</b>, string, kept in viewstate
 *   <br />Returns result.
 *
 * Events

 * @author John.meng <john.meng@achievo.com>
 * @version v1.0, last update on May 19, 2006 9:41:20 AM
 * @package System.Web.UI.WebControlsExt
 */

class PNavMenuLinkItem extends PNavMenuItem
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
	 * @return string the url of the button
	 */ 
	function getLinkUrl () 
	{
		return $this->getViewState('LinkUrl','');
	}
	/**
	 * Sets the url caption of the button.
	 * @param string the url caption to be set
	 */ 
	function setLinkUrl ($value) 
	{
		$this->setViewState('LinkUrl',$value,'');
	}
	
}
?>

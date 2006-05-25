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
 * PNavMenuItem class
 *
 * PNavMenuItem abstract class .
 *
 * Namespace: System.Web.UI.WebControls
 *
 * Properties
 * - <b>Text</b>, string, kept in viewstate
 *   <br />Returns result.
 *
 * Events
 *
 * @author John.meng <john.meng@achievo.com>
 * @version v1.0, last update on May 11, 2006 11:17:51 AM
 * @package System.Web.UI.WebControlsExt
 */

class PNavMenuItem extends TWebControl 
{
	/**
	* Constructor.
	*/
	function __construct()
	{
		parent::__construct();
		
	}	
	/**
	 * @return string the text caption of the button
	 */ 
	function getText () 
	{
		return $this->getViewState('Text','');
	}
	/**
	 * Sets the text caption of the button.
	 * @param string the text caption to be set
	 */ 
	function setText ($value) 
	{
		$this->setViewState('Text',$value,'');
	}
}
?>

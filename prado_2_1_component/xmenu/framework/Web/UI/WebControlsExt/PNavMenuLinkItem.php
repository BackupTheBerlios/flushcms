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
 * TControl class
 *
 * TControl comment write here.
 *
 * Namespace: System.Web.UI.WebControls
 *
 * Properties
 * - <b>Text</b>, string, kept in viewstate
 *   <br />Returns result.
 *
 * Events
 * - <b>OnEvents</b> Events comment write here.
 *
 * @author John.meng <john.meng@achievo.com>
 * @version v1.0, last update on May 19, 2006 9:41:20 AM
 * @package System.Web.UI.WebControlsExt
 */

class PNavMenuLinkItem extends PNavMenuLabelItem
{
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getLinkUrl () 
	{
		return $this->getViewState('LinkUrl','');
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setLinkUrl ($value) 
	{
		$this->setViewState('LinkUrl',$value,'');
	}
	
}
?>

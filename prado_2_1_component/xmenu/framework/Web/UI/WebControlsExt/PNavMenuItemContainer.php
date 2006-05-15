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

require_once(dirname(__FILE__).'/PNavMenuItem.php');
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
 * @version v1.0, last update on May 11, 2006 1:49:22 PM
 * @package System.Web.UI.WebControlsExt
 */


class PNavMenuItemContainer extends TWebControl
{
	
	/**
	 * list of TListItem controls
	 */
	protected $menuItems;
	private $text='';
	private $linkurl = '';
	
	public function __construct()
	{
		parent::__construct();
		$this->menuItems = new TCollection();
	}
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getText () 
	{
		$text = $this->text;
		if(empty($text))
			$text = $this->renderBody();
		return $text;
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setText ($value) 
	{
		$this->text=$value;
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getLinkUrl () 
	{
		$linkurl = $this->linkurl;
		if(empty($linkurl))
			$linkurl = $this->renderBody();
		return $linkurl;
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setLinkUrl ($value) 
	{
		$this->linkurl=$value;
	}
	/**
	 * Determines whether the control can add the object as a body.
	 * Only TTableCell or its descendant can be added as body.
	 * @param mixed the object to be added
	 * @return boolean
	 */
	public function allowBody($object)
	{
		return (($object instanceof PNavMenuItem) || ($object instanceof PNavMenuItemContainer));
	}
	
	/**
	 * This method overrides the parent implementation to handle TListItem.
	 * @param TComponent|string the newly parsed object
	 * @param TComponent the template owner
	 */
	public function addParsedObject($object,$context)
	{
		if(($object instanceof PNavMenuItem) || ($object instanceof PNavMenuItemContainer))
			$this->menuItems->add($object);
	}
	/**
	 * @return ArrayObject list of TListItem components
	 */
	public function getMenuItems()
	{
		return $this->menuItems;
	}

}
?>

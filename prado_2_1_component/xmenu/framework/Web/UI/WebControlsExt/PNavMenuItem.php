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
 
require_once(dirname(__FILE__).'/PNavMenuItemContainer.php');
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
 * @version v1.0, last update on May 11, 2006 11:17:51 AM
 * @package System.Web.UI.WebControlsExt
 */

class PNavMenuItem extends TWebControl
{
	private $text='';
	private $linkurl = '';
	
	protected $subMenuItemContainer;
	
	/**
	* Constructor.
	*/
	function __construct($text='',$linkurl=null)
	{
		$this->text = $text;
		$this->linkurl = $linkurl;
		parent::__construct();
		$this->subMenuItemContainer = new TCollection();
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
	public function addParsedObject($object,$context)
	{
		if($object instanceof PNavMenuItemContainer)
			$this->subMenuItemContainer->add($object);
	}
	/**
	 * @return ArrayObject list of TListItem components
	 */
	public function getSubMenuItemContainer()
	{
		return $this->subMenuItemContainer;
	}
	
}
?>

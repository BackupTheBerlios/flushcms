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
 * @version v1.0, last update on May 11, 2006 1:49:22 PM
 * @package System.Web.UI.WebControlsExt
 */


class PNavMenuItemContainer extends TWebControl
{
	/**
	 * whether the item is selected
	 * @var mixed
	 */
	private $selected=false;
	
	/**
	 * value of the text to be displayed for this item
	 * @var mixed
	 */
	private $text='';
	
	/**
	 * The value of the listitem (if different from the text)
	 * @var string
	 */
	private $value=null;
	
	
	public function __construct($text='', $value=null)
	{
		$this->text = $text;
		$this->value = $value;
		parent::__construct();
	}
	
	/**
	 * @return mixed the index of the data item
	 */
	public function isSelected()
	{
		return $this->selected;
	}

	/**
	 * Sets whether the item is selected.
	 * @param mixed the data item index
	 */
	public function setSelected($value)
	{
		$this->selected=$value;
	}

	/**
	 * @return mixed the value of the data item
	 */
	public function getText()
	{
		$text = $this->text;
		if(empty($text))
			$text = $this->renderBody();
		return $text;
	}

	/**
	 * Sets the value of the data item
	 * @param mixed the value of the data item
	 */
	public function setText($value)
	{
		$this->text=$value;
	}

	/**
	 * @return string the item value 
	 */
	public function getValue()
	{
		$value = $this->value;
		if(is_null($value))
		{
			$value = $this->renderBody();
			if(empty($value))
				$value = $this->getText();
		}
		return $value;
	}

	/**
	 * Sets the item value
	 * @param string the item value
	 */
	public function setValue($value)
	{
		$this->value=$value;
	}
}
?>

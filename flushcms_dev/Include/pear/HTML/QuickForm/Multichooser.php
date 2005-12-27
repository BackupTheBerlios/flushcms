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
   | Author: John.meng(ÃÏÔ¶òû)  2005-12-27 21:36:04                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: Multichooser.php,v 1.3 2005/12/27 14:26:14 arzen Exp $ */
require_once(PEAR_DIR."HTML/QuickForm/hidden.php");
require_once PEAR_DIR.'HTML/QuickForm.php';
require_once (PEAR_DIR.'HTML/QuickForm/element.php');
require_once (PEAR_DIR.'HTML/QuickForm/autocomplete.php');

/**
*
* Class HTML_QuickForm_Multichooser
*
* This is a quickform element that implements a "multichooser", which
* is a set of 2 select boxes.  You can pick items from the one on the left, and 
* move them to the "selected" group on right, and vice versa.  It returns all
* items that are on the right
*/

class HTML_QuickForm_Multichooser extends HTML_QuickForm_element
{
	var $_fromBox;
	var $_inBox;
	var $_addButton;
	var $_remButton;
	var $_hidden;
	var $_existing = array ();
	var $_fromLabel;
	var $_toLabel;
	var $_pickerOptions;
	var $_pickerLabel;
	var $_usePicker;
	var $_multiname;
	var $_oldValue;
	var $_fromOptions;
	var $_toOptions;

	/* constructor for HTML_Quickform_Multichooser
	*
	* @param $elementName - the form name for this element
	* @param $elementLabel - the name for this element group
	* @param $labels  - an array of 2 labels, for the left select box and the right
	* @param $options - associative array of options for the left select box ("value" => "label")
	* @param $existing - associate array of existing options for the right select box
	* @param $attributes - attributes for this input.  good luck getting it to work right.
	*/

	function HTML_Quickform_Multichooser($elementName = "name", $elementLabel = "label", $labels = array (), $options = null, $existing = null, $attributes = null)
	{

//		$commUtil = new Common_Util();

		if ($elementName == '')
		{
			$elementName = "AUTOGENMULTICHOOSERID".rand(10000, 99999);
		}

		$this->_pickerOptions = array ();
		$this->_usePicker = false;

		require_once (PEAR_DIR.'HTML/QuickForm/select.php');
		require_once (PEAR_DIR.'HTML/QuickForm/button.php');
        //require_once('HTML/QuickForm/password.php');

		HTML_Quickform_element :: HTML_Quickform_element($elementName, $elementLabel, $attributes);

		$this->_elementName = $elementName;

		$this->_fromLabel = $labels[0];
		$this->_toLabel = $labels[1];

		$this->_existing = array ();

		$this->_allUsers = array ();

		$this->_multiname = $elementName;

		$this->_fromBox = new HTML_QuickForm_select($elementName."From", $elementLabel, array (), $attributes." id='{$elementName}FROMID'");

		$this->_fromOptions = $options;

		$this->_inBox = new HTML_QuickForm_select($elementName."To", "", array (), $attributes." id='{$elementName}TOID' ");

		$this->_toOptions = $existing;

        $this->_hidden = new HTML_QuickForm_hidden($elementName, '', "id='$elementName' ", '');

		if (is_array($existing))
		{
			foreach ($existing as $key => $value)
			{
				$this->_hidden->setValue($this->_hidden->getValue()."$key;");

			}
		}

		$this->_addButton = new HTML_QuickForm_button("", "Add -->", "onclick=\"javascript:addMultiChooserVal('$elementName')\"", "size='10'");
		$this->_remButton = new HTML_QuickForm_button("", "<-- Remove", "onclick=\"javascript:removeMultiChooserVal('$elementName')\"", null);
		$this->_addButton->updateAttributes("style='width: 100px'");
		$this->_remButton->updateAttributes("style='width: 100px'");

		$this->_fromBox->setMultiple(true);
		$this->_fromBox->setSize(10);

		$this->_inBox->setMultiple(true);
		$this->_inBox->setSize(10);

		$this->_persistantFreeze = true;
		$this->_type = 'multichooser';

//		$this->_oldValue = $commUtil->request($elementName);

		$this->_refreshOldValue(true);
	}

	function useAutoComplete($autoArray)
	{
		$autoTxtName = 'autotxt';
		$this->txt = new HTML_QuickForm_autocomplete($autoTxtName.'From', 'txt', $autoArray, "onkeyup=\"javascript:findMultiChooserVal('$this->_elementName','$autoTxtName')\" id='{$autoTxtName}FROMID' ");
		$this->txt->setSize(10);
		$this->_autoComplete = true;
	}

	function addOptionPicker($label, $values)
	{

		$this->_pickerLabel = $label;
		$this->_pickerOptions = $values;
		$this->_usePicker = true;
		$this->_refreshOldValue(false);

	}

	function _refreshOldValue($useOriginal = false)
	{

//		$commUtil = new Common_Util();
//
//		$lastPicker = $commUtil->request($this->_multiname."PICKER");

		$old = $this->_oldValue;
		if (strlen($old) < 1)
		{
			$firstGroup = "none";
			$ctr = 0;
			foreach ($this->_pickerOptions as $key => $optionGroup)
			{
				if ($firstGroup === "none")
				{
					$firstGroup = $optionGroup;
				}
				if ($ctr == $lastPicker)
				{
					$firstGroup = $optionGroup;
				}
				$ctr ++;
			}

			if ($firstGroup !== "none")
			{
				$this->_fromOptions = $firstGroup;
			}

			if ($useOriginal || ($firstGroup !== "none"))
			{
				$leftOptions = array ();
				if (is_array($this->_fromOptions))
				{
					foreach ($this->_fromOptions as $value => $label)
					{
						if ((!is_array($this->_toOptions)) || (array_key_exists($value, $this->_toOptions) == false))
						{
							$leftOptions[$value] = $label;
						}
					}
				}
				$this->_fromBox->loadArray($leftOptions);
				if ($useOriginal)
				{
					$this->_inBox->loadArray($this->_toOptions);
				}
			}
			return;
		}

		//get all possibilities of key=>value pairs

		$allChoices = array ();
		if ($useOriginal)
		{
			if (is_array($this->_fromOptions))
			{
				$allChoices = $allChoices + $this->_fromOptions;
			}
			if (is_array($this->_toOptions))
			{
				$allChoices = $allChoices + ($this->_toOptions);
			}
		}

		$ctr = 0;
		foreach ($this->_pickerOptions as $optionGroup)
		{
			$allChoices = $allChoices + $optionGroup;
			if ($ctr == $lastPicker)
			{
				$firstGroup = $optionGroup;
			}
			$ctr ++;
		}

		$chosen = explode(";", $old);

		//add all the chosen options to the "to" box
		//and remove from the "from" box

		$newToBox = array ();
		foreach ($chosen as $selectedKey)
		{
			if (($selectedKey != "") && ($allChoices[$selectedKey] != ""))
			{
				$newToBox[$selectedKey] = $allChoices[$selectedKey];
				$this->_existing[$selectedKey] = $allChoices[$selectedKey];
			}
		}

		$newFromBox = $firstGroup;

		if ($useOriginal || ($firstGroup !== null))
		{
			if ($firstGroup !== null)
			{
				$this->_fromOptions = $newFromBox;
			}
			$newFromBox = array ();
			if (is_array($this->_fromOptions))
			{
				foreach ($this->_fromOptions as $fromKey => $fromVal)
				{
					if (array_search($fromKey, $chosen) === false)
					{
						$newFromBox[$fromKey] = $fromVal;
					}
				}
			}
		}

		$this->_fromOptions = $newFromBox;
		$this->_toOptions = $newToBox;

		$this->_fromBox->loadArray($newFromBox);
		$this->_inBox->loadArray($newToBox);

		$this->_hidden->setValue($old);

	}

	/**
	*
	*  sets the name of the element
	*/
	function setName($name)
	{
		$this->updateAttributes(array ('name' => $name));
	}

	/**
	*
	*  gets the name of the element
	*/
	function getName()
	{
		return $this->getAttribute('name');
	}

	/**
	 * Returns the element name (possibly with brackets appended)
	 * 
	 * @since     1.0
	 * @access    public
	 * @return    string
	 */
	function getPrivateName()
	{
		return $this->getName();
	}

	function setValue($value)
	{
		//TODO:  sets the items in the final dropdown  
	}

	function getValue()
	{
		return $this->_hidden->getValue();

	}

	function setSize($size)
	{
		$this->_fromBox->setSize($size);
		$this->_inBox->setSize($size);
	}

	function exportValue(& $submitValues, $assoc = false)
	{
		return $this->_hidden->exportValue($submitValues, $assoc);
	}

	function toHtml()
	{

		if ($this->_flagFrozen)
		{
			return $this->getFrozenHtml();
		}

//		$commUtil = new Common_Util();
//
//		$lastPicker = $commUtil->request($this->_multiname."PICKER");

//		$out .= "<script src='/Html/JS/multichooser.js' language='Javascript' type='text/Javascript'></script>\n";

		$out .= "<table>";

		if ($this->_usePicker)
		{
			//$pickerVals = array("0"=>"Please Select...");
			$pickerVals = $this->_pickerOptions;
			$optionArray = array ();

			foreach ($this->_pickerOptions as $label => $options)
			{
//				$pickerVals[] = $label;
				$optionArray[] = $options;
			}

			$elementName = $this->_multiname;

			$out .= "<tr><td colspan='4'><Br><Br>\n";
			$out .= "<script type='text/javascript'>";
			$out .= "var PickerData$elementName = [[]";
			foreach ($optionArray as $optionSet)
			{
				$out .= ",[";
				$first = 1;
				if (is_array($optionSet)) 
				{
					foreach ($optionSet as $value => $label)
					{
						if ($first == 1)
						{
							$first = 0;
						}
						else
						{
							$out .= ",";
						}
						$label = preg_replace("/\'/", "\\'", $label);
						$out .= "['$label', '$value']";
					}					
				}

				$out .= "]\n";
			}
			$out .= "];\n";
			$out .= "</script>";
			$out .= "<b>".$this->_pickerLabel."</b>&nbsp;";
			$picker = new HTML_QuickForm_select($elementName."PICKER", "", $pickerVals, $attributes." id='{$elementName}PICKER' onchange=\"multichooserPick('$elementName')\"");

			$picker->setSize(1);
			$picker->setSelected($lastPicker);
			$out .= $picker->toHtml();
			$out .= "</td></tr>\n";

		}

		$out .= "<tr><td>";
		if ($this->_autoComplete)
		{
			$out .= $this->txt->toHtml()."<br>";
		}
		$out .= "<b>".$this->_fromLabel."</b><br>";
		$out .= $this->_fromBox->toHtml();
		$out .= "</td><td>";
		$out .= $this->_addButton->toHtml();
		$out .= "<br>";
		$out .= $this->_remButton->toHtml();
		$out .= "</td><td>";
		$out .= "<b>".$this->_toLabel."</b><br>";
		$out .= $this->_inBox->toHtml();
		$out .= "</td></tr></table>\n";
		$out .= $this->_hidden->toHtml();
        $out .= "<script type='text/javascript'>document.getElementById('".$this->_multiname."').value = '".
                            $this->_hidden->getValue()."';</script>";
		return $out;
	}

	function getFrozenHtml()
	{

		$out .= "<table>";
		foreach ($this->_existing as $key => $val)
		{
			$out .= "<tr><td>$val</td><tr>";
		}
		$out .= "</table>\n";
		$out .= $this->_hidden->toHtml();
		return $out;
	}

}

?>

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
 * @version v1.0, last update on May 11, 2006 1:47:15 PM
 * @package System.Web.UI.WebControlsExt
 */

class PNavMenuPanel extends TWebControl  implements IActiveControl
{
	/**
	 * list of TListItem controls
	 */
	protected $items;
	/**
	* Constructor.
	*/
	function __construct()
	{
		parent::__construct();
		$this->setTagName('div');
		$this->items = new TCollection();
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getDisplayMode () 
	{
		return $this->getViewState('DisplayMode', 'Horizontal');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setDisplayMode ($value) 
	{
		if($value!=='Vertical')
			$value='Horizontal';
		$this->setViewState('DisplayMode',$value,'Horizontal');
		
	}
	/**
	 * This method overrides the parent implementation to handle TListItem.
	 * @param TComponent|string the newly parsed object
	 * @param TComponent the template owner
	 */
	public function addParsedObject($object,$context)
	{
		if($object instanceof PNavMenuItem)
			$this->items->add($object);
	}
	/**
	 * @return ArrayObject list of TListItem components
	 */
	public function getItems()
	{
		return $this->items;
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 12, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getHorizontalCSS () 
	{
		return $this->getViewState('CSSFile', 'menu_styles.css');		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 12, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setHorizontalCSS ($value) 
	{
        $this->setViewState('CSSFile',$value,'menu_styles.css');
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 12, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function buildJSInit () 
	{
		$headJS = <<<EOT
<script language="JavaScript">

	
	//Copyright & Base Path Settings

	cdd__notice='DHTML Web Menu, (c) 2004 OpenCube Inc., All Rights Reserved, Visit - www.opencube.com'
	cdd__codebase='/dev/prado-2.1RC1/prado/examples/js/sample_script/'		//location of script files
	cdd__database='/dev/prado-2.1RC1/prado/examples/js/sample4_data/'	//location of data - settings files


	//global settings (applies to all menus)

  	cdd__activate_onclick = false			//Choose between click or mouse over menu functionality.
	cdd__showhide_delay = 100			//Defined in milliseconds
	cdd__url_target = "_self"			//Default target - use: _self, _top, _blank, _parent, (frame name)
	cdd__url_features = ""				//Sample: "height=200,width=400,status=yes,toolbar=no,menubar=no,location=no"
	cdd__display_urls_in_status_bar = true
	cdd__default_statusbar_text = "OpenCube - DHTML Web Menu - www.opencube.com"
	

	//Web Menu Code (Warning: Do Not Alter!)
	
	if (window.showHelp){b_type = "ie"; if (!window.attachEvent) b_type += "mac";}if (document.createElementNS) b_type = "dom";if (window.opera) b_type = "opera"; qmap1 = "\<\script language=\"JavaScript1.2\" src=\""; qmap2 = ".js\"\>\<\/script\>";
	if(document.layers){document.write(qmap1+cdd__database+"menu_ns4_styles"+qmap2);b_type = "ns4";}
	if (b_type){document.write(qmap1+cdd__codebase+"cbrowser_"+b_type+qmap2);document.close();}

	

</script>

EOT;
		return 	$headJS;	
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 12, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function buildItemJSData () 
	{
		$ItemData="";
		$level=0;
		foreach($this-> getItems() as $item)
		{
			$text=$item->getText();
			$linkurl=$item->getLinkUrl();
			$parents = $item->getParentID();
			$Target = $item->getTarget();
			if (!$parents) 
			{
				$ItemData.="this.item$level = \"$text\" \n";
				$ItemData.="this.icon_rel$level = 0 \n";
			}
			$level++;
		}
		
		
		$JS = <<<EOT
/*---------------------------------------------
Main Menu Group and Items
---------------------------------------------*/


   //Main Menu Group 0

	
$ItemData

/*---------------------------------------------
Sub Menu Group and Items
---------------------------------------------*/



   //Sub Menu 0

	this.menu_xy0 = "-100,24"
	this.menu_width0 = 150

	this.item0_0 = "Features"

	this.icon_rel0_0 = 0

	this.url0_0 = '../../documents/sample_link.htm'
	
   //Sub Menu 0_0

	this.menu_xy0_0 = "-4,2"
	this.menu_width0_0 = 150

	this.item0_0_0 = "DHTML Menu"
	this.icon_rel0_0_0 = 0
	this.url0_0_0 = '../../documents/sample_link.htm'

   //Sub Menu 0_0_0

	this.menu_xy0_0_0 = "-4,2"
	this.menu_width0_0_0 = 150

	this.item0_0_0_0 = "DHTML Menu"
	this.icon_rel0_0_0_0 = 0
	this.url0_0_0_0 = '../../documents/sample_link.htm'

   //Sub Menu 0_0_0_0

	this.menu_xy0_0_0_0 = "-4,2"
	this.menu_width0_0_0_0 = 150

	this.item0_0_0_0_0 = "DHTML Menu"
	this.icon_rel0_0_0_0_0 = 0
	this.url0_0_0_0_0 = '../../documents/sample_link.htm'

   //Sub Menu 1

	this.menu_xy1 = "-100,24"
	this.menu_width1 = 150

	this.item1_0 = "Features"

	this.icon_rel1_0 = 0

	this.url1_0 = '../../documents/sample_link.htm'
	
   //Sub Menu 0_0

	this.menu_xy1_0 = "-4,2"
	this.menu_width1_0 = 150

	this.item1_0_0 = "DHTML Menu"
	this.icon_rel1_0_0 = 0
	this.url1_0_0 = '../../documents/sample_link.htm'

   //Sub Menu 0_0_0

	this.menu_xy1_0_0 = "-4,2"
	this.menu_width1_0_0 = 150

	this.item1_0_0_0 = "DHTML Menu"
	this.icon_rel1_0_0_0 = 0
	this.url1_0_0_0 = '../../documents/sample_link.htm'

   //Sub Menu 0_0_0_0

	this.menu_xy1_0_0_0 = "-4,2"
	this.menu_width1_0_0_0 = 150

	this.item1_0_0_0_0 = "DHTML Menu"
	this.icon_rel1_0_0_0_0 = 0
	this.url1_0_0_0_0 = '../../documents/sample_link.htm'	
	
EOT;
		return 	$JS;			
		
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 12, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function buildItem ($SourceItem,$append="",$level=0,$content) 
	{
		$sub_level=0;
		foreach($SourceItem as $item)
		{
			if ($level==0) 
			{
				//$append=0;
				$append=$sub_level;

			}
			 else
			{
				//$append=1_1
				$append=$append."_".$sub_level;
			}
			$text=$item->getText();
			$linkurl=$item->getLinkUrl();
			$parents = $item->getParentID();
			$Target = $item->getTarget();
			if ($parents) 
			{
				
			}
			 else
			{
				
			}
			
			$sub_level++;
		}
		
	}
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 12, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function buildJSData () 
	{
		$ItemData = $this->buildItemJSData();
		$JS = <<<EOT
<script language="JavaScript">
function cdd_menu0()
{
/*---------------------------------------------
Icon Images
---------------------------------------------*/



    //Relative positioned icon images (flow with main menu or sub item text)

	this.rel_icon_image0 = "../sample_images/bullet.gif"
	this.rel_icon_rollover0 = "../sample_images/bullet_hl.gif"
	this.rel_icon_image_wh0 = "13,8"
	
	


    //Absolute positioned icon images (coordinate positioned)

	this.abs_icon_image0 = "../sample_images/arrow.gif"
	this.abs_icon_rollover0 = "../sample_images/arrow.gif"
	this.abs_icon_image_wh0 = "13,10"
	this.abs_icon_image_xy0 = "-20,8"




/*---------------------------------------------
Divider Settings
---------------------------------------------*/


	this.use_divider_caps = false		//cap the top and bottom of each menu group
	this.divider_width = 1			//applies to horizontal menus only
	this.divider_height = 2			//applies to vertical menus only


    //available specific settings

	this.use_divider_capsX_X = true
/*---------------------------------------------
Menu Orientation and Dimensions
---------------------------------------------*/

   //All values below are defined in pixel units.  Only the 
   //width of items and menu groups may be defined, heights 
   //are automatically determined by the font size and padding
   //values below.  See the menu_styles.css file for additional
   //border color and style settings.


	this.is_horizontal = false		//false = vertical menus, true = horizontal menus
	this.is_horizontal_main = true

	
	this.menu_width = 200			//applies to vertical menus
	this.menu_width_items = 120		//applies to items in a horizontal menu
	this.menu_width_item0_4 = 140		//applies to items in a horizontal menu



   //Padding Values
  

	this.menu_padding_main = "0,0,0,0"		//top, right, bottom, left
	this.menu_padding_sub = "0,0,0,0"

	this.item_padding_main = "5,5,5,5"
	this.item_padding_sub = "5,5,5,5"

	

   //Border Sizing


	this.menu_border_main = 1
	this.menu_border_sub = 1

	this.item_border_main = 0
	this.item_border_sub = 0



   //Specific Item Setting Examples (change 'X' to appropriate index value)
	

	this.is_horizontalX = true
	
	this.menu_widthX = 200
	this.menu_width_itemsX = 100
	this.menu_width_itemX_X = 100

	this.menu_padding_subX = "10,5,10,5"
	this.item_padding_mainX = "10,5,10,5"
	this.item_padding_subX_X = "10,5,10,5"

	this.menu_border_subX = 1
	this.item_border_mainX = 1
	this.item_border_subX_X = 1




/*---------------------------------------------
Optional Style Sheet Class Name Association
---------------------------------------------*/

//Use the following sections to optionally associate menu groups 
//and menu items with existing CSS classes from your site.



   //global class names

	//this.main_menu_class = "myclassname"
	//this.main_items_class = "myclassname"
	//this.main_items_rollover_class = "myclassname"

	//this.sub_menu_class = "myclassname"
	//this.sub_items_class = "myclassname"
	//this.sub_items_rollover_class = "myclassname"


   //specific menu items

	//this.item_classX_X = "myclassname"
	//this.item_rollover_classX_X = "myclassname"



/*---------------------------------------------
Exposed Menu Events - Custom Script Attachment
---------------------------------------------*/


	this.show_menu = "";
	this.hide_menu = "";


 //available specific settings


	//this.show_menuX = "alert('show id')";
	//this.hide_menuX = "alert('hide id')";
	//this.clickX = "alert('execute custom click item code')"




/*---------------------------------------------
Main Menu Group and Items
---------------------------------------------*/


   //Main Menu Group 0

	
$ItemData	

}
</script>

EOT;
		return 	$JS;			
	}
	
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function renderBody () 
	{
		$content=$this->getDisplayMode ();
		$jsBasePath = $this->Application->getResourceLocator()->getJsPath().'/';
		$cssBasePath = $jsBasePath."sample4_data/";
		$content.='<link rel=stylesheet href="'.$cssBasePath.$this->getHorizontalCSS().'" type="text/css">';
		$content.=$this->buildJSData();
		$content.=$this->buildJSInit ();
		foreach($this-> getItems() as $item)
		{
			$text=$item->getText();
			$linkurl=$item->getLinkUrl();
			$parents = $item->getParentID();
			$Target = $item->getTarget();
			$content.="<li><a href='$linkurl'>".$text."</a>$parents $Target";
		
		}
		$content.='<script language="JavaScript">create_menu(0)</script>';
		return $content;		
	}
	
	
}

?>

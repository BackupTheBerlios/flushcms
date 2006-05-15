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
 * @version v1.0, last update on May 11, 2006 1:47:15 PM
 * @package System.Web.UI.WebControlsExt
 */

class PNavMenuPanel extends TWebControl
{
	/**
	 * list of TListItem controls
	 */
	protected $menuItemContainer;
	private $ComponentID="";
	private $MenuLayoutString="";
	private $SubMenuSpacing="";
	/**
	* Constructor.
	*/
	function __construct()
	{
		parent::__construct();
		$this->setTagName('div');
		$this->menuItemContainer = new TCollection();
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
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getTarget () 
	{
		return $this->getViewState('Target','_self');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setTarget ($value) 
	{
		$this->setViewState('Target',$value,'');
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getItemWidth () 
	{
		return $this->getViewState('ItemWidth','120');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setItemWidth ($value) 
	{
		$this->setViewState('ItemWidth',$value,'');
	}
	/**
	 * This method overrides the parent implementation to handle TListItem.
	 * @param TComponent|string the newly parsed object
	 * @param TComponent the template owner
	 */
	public function addParsedObject($object,$context)
	{
		if($object instanceof PNavMenuItemContainer)
			$this->menuItemContainer->add($object);
	}
	/**
	 * @return ArrayObject list of TListItem components
	 */
	public function getMenuItemContainer()
	{
		return $this->menuItemContainer;
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
		$content="";
		$js_patch=$this->Application->getResourceLocator()->getJsPath().'/';
		$ComponentUniqueID=$this->getUniqueID();
		$patten=array("C_PActiveNavMenuPanel","C_PNavMenuPanel");
		$replace=array("","");
		$panelID=$this->ComponentID= (str_replace($patten,$replace,$ComponentUniqueID)-1);

		if ($this->getDisplayMode ()=="Vertical") 
		{
			$this->MenuLayoutString="";
			$this->SubMenuSpacing="-6,-2";
		}
		 else
		{
			$this->MenuLayoutString=" this.is_horizontal_main = true ";
			$this->SubMenuSpacing="-100,24";
		}
		if ($this->ComponentID<1) 
		{
			$content.=$this->buildHeadJavascript ();		
		}
		$content.=$this->buildCSS();	
		$content.=$this->buildJavascriptData();	
		$content.="\n <script language=\"JavaScript\">create_menu({$panelID})</script> \n";		

		return $content;		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - 2006-5-14
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function parsedContainer ($ContainerCollection,$level=0,$append="") 
	{
		if (empty($content)) 
		{
			$content="";
		}
		if ($ContainerCollection->length()>0) 
		{
			$z=0;
			foreach($ContainerCollection as $menuItemContainer)
			{
				if ($level==0) 
				{
					$append=$z;
					$ContainerAppend=$append;
					
					$ContainerText=$menuItemContainer->getText();
					$ContainerUrl=$menuItemContainer->getLinkUrl();
					
					$content.=" <!-------- menu {$ContainerAppend} start -------------> \n ";
					$content.=" this.menu_xy{$ContainerAppend} = \"".$this->SubMenuSpacing."\" \n ";
					$content.=" this.menu_width{$ContainerAppend} = ".$this->getItemWidth()." \n ";
					$content.=" this.item{$ContainerAppend} = \"{$ContainerText}\" \n ";
					$content.=" this.icon_rel{$ContainerAppend} = 0 \n";
					$content.="this.url{$ContainerAppend} = \"{$ContainerUrl}\" \n ";
					if ($this->getDisplayMode ()=="Vertical") 
					{
						$content.=" this.icon_abs{$ContainerAppend} = 0 \n";
					}
				}
				
				
				$y=0;
				foreach($menuItemContainer->getMenuItems() as $menuItems)
				{
					if ($level==0) 
					{
						$append=$sub_append=$z."_".$y;
					}
					else
					{
						$sub_append=$append."_".$y;
						$append=substr($sub_append,0,(sizeof($sub_append)-3));
					}
					
					$text=$menuItems->getText();
					$link_url=$menuItems->getLinkUrl();
					$content.="this.item{$sub_append} = \"{$text}==={$append}\" \n ";
					$content.="this.icon_rel{$sub_append} = \"0\" \n ";
					$content.="this.url{$sub_append} = \"{$link_url}\" \n ";
					
					//recursion invoke
					if ($menuItems->getSubMenuItemContainer()->length()>0) 
					{
						$content.="this.icon_abs{$sub_append} = \"0\" \n ";
						$level++;
						$content.=$this->parsedContainer ($menuItems->getSubMenuItemContainer(),$level,$append);
					}
					$y++;
				}
				$content.=" <!-------- menu  end -------------> \n \n ";
				$level=0;
				$z++;
			}
			
		}

		return $content;

	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 15, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function buildHeadJavascript () 
	{
		$js_patch=$this->Application->getResourceLocator()->getJsPath().'/';
		$taget = $this->getTarget ();
		
		$data = <<<EOT
<script language="JavaScript">

	
	//Copyright & Base Path Settings

	cdd__notice='DHTML Web Menu, (c) 2004 OpenCube Inc., All Rights Reserved, Visit - www.opencube.com'
	cdd__codebase='{$js_patch}sample_script/'		//location of script files
	cdd__database='{$js_patch}sample4_data/'	//location of data - settings files


	//global settings (applies to all menus)

  	cdd__activate_onclick = false			//Choose between click or mouse over menu functionality.
	cdd__showhide_delay = 100			//Defined in milliseconds
	cdd__url_target = "{$taget}"			//Default target - use: _self, _top, _blank, _parent, (frame name)
	cdd__url_features = ""				//Sample: "height=200,width=400,status=yes,toolbar=no,menubar=no,location=no"
	cdd__display_urls_in_status_bar = true
	cdd__default_statusbar_text = "OpenCube - DHTML Web Menu - www.opencube.com"
	

	//Web Menu Code (Warning: Do Not Alter!)
	
	if (window.showHelp){b_type = "ie"; if (!window.attachEvent) b_type += "mac";}if (document.createElementNS) b_type = "dom";if (window.opera) b_type = "opera"; qmap1 = "\<\script language=\"JavaScript1.2\" src=\""; qmap2 = ".js\"\>\<\/script\>";
	if(document.layers){document.write(qmap1+cdd__database+"menu_ns4_styles"+qmap2);b_type = "ns4";}
	if (b_type){document.write(qmap1+cdd__codebase+"cbrowser_"+b_type+qmap2);document.close();}

	

</script>

EOT;
		return $data;	
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 15, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function buildJavascriptData () 
	{
		$js_patch=$this->Application->getResourceLocator()->getJsPath().'/';
		$item_data = $this->parsedContainer ($this-> getMenuItemContainer());
		$panelID = $this->ComponentID;
		$layout = $this->MenuLayoutString;
		$item_width = $this->getItemWidth ();
		$data = <<<EOT
<SCRIPT LANGUAGE="JavaScript">
<!--
function cdd_menu{$panelID}()
{//////////////////////////Start Menu Data/////////////////////////////////
/**********************************************************************************************

	Menu 0 - General Settings and Menu Structure

	**See the menu_styles.css file for additional customization options**

***********************************************************************************************/



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
	{$layout}

	
	this.menu_width = {$item_width}			//applies to vertical menus
	this.menu_width_items = {$item_width}		//applies to items in a horizontal menu
	this.menu_width_item0_4 = {$item_width}		//applies to items in a horizontal menu



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
	
	this.menu_widthX = {$item_width}
	this.menu_width_itemsX = {$item_width}
	this.menu_width_itemX_X = {$item_width}

	this.menu_padding_subX = "10,5,10,5"
	this.item_padding_mainX = "10,5,10,5"
	this.item_padding_subX_X = "10,5,10,5"

	this.menu_border_subX = 1
	this.item_border_mainX = 1
	this.item_border_subX_X = 1

/*---------------------------------------------
Exposed Menu Events - Custom Script Attachment
---------------------------------------------*/


	this.show_menu = "";
	this.hide_menu = "";

/*---------------------------------------------
Main Menu Group and Items
---------------------------------------------*/

   //Main Menu Group 0

	{$item_data}	
	


}///////////////////////// END Menu 0 Data /////////////////////////////////////////


//-->
</SCRIPT>		
EOT;
		return $data;	
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 15, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function buildCSS () 
	{
		$panelID = $this->ComponentID;
		$layout = $this->MenuLayoutString;
		$data = <<<EOT
<style type="text/css">
<!--

/**********************************************************************************************

	Main Menu Style Settings

***********************************************************************************************/


/*---------------------------------------------------------
Main Menu Group Settings - (Applies to the main container)
----------------------------------------------------------*/
.cdd{$panelID}_main_menu{

	
	background-color:#eeeeee;
	
	cursor:hand;
	cursor:pointer;

	color:#333333;
	font-family:Arial;
	font-size:13px;

	border-style:solid;
	border-color:#29a9e7;
	
	

}/*---------------------------------------------------------
Main Menu Item Settings
----------------------------------------------------------*/
.cdd{$panelID}_main_items{


	background-color:#88b592;
	cursor:hand;

	border-style:solid;
	border-color:#f3da49;



}/*---------------------------------------------------------
Main Menu Item Rollover Settings
----------------------------------------------------------*/
.cdd{$panelID}_main_items_rollover{



	/*background-color:#ebe7b2;*/
	color:#ff0000;
	cursor:hand;

	text-decoration:underline;

	border-style:dashed;
	border-color:#aaaaaa;





}/**********************************************************************************************

	Sub Menu Style Settings

***********************************************************************************************/


/*---------------------------------------------------------
Sub Menu Group Settings - (Applies to all sub containers)
----------------------------------------------------------*/
.cdd{$panelID}_sub_menu{

	
	background-color:#eeeeee;
	cursor:hand;

	color:#333333;
	font-family:Arial;
	font-size:12px;

	border-style:solid;
	border-color:#333333;



	filter:progid:DXImageTransform.Microsoft.Fade(duration=.4);





}/*---------------------------------------------------------
Sub Menu Item Settings
----------------------------------------------------------*/
.cdd{$panelID}_sub_items{
	

	/*background-color:#cccccc;*/
	cursor:hand;

	border-style:solid;
	border-color:#999999;



}/*---------------------------------------------------------
Sub Menu Item Rollover Settings
----------------------------------------------------------*/
.cdd{$panelID}_sub_items_rollover{

	
	/*background-color:#ebe7b2;*/
	cursor:hand;

	color:#ff0000;
	text-decoration:underline;
	

	border-style:dashed;
	border-color:#ff0000;
	



}/**********************************************************************************************

	Divider Style Settings

***********************************************************************************************/



/*---------------------------------------------------------
Vertical Dividers
----------------------------------------------------------*/
.cdd{$panelID}_dividers_vertical{



	background-color:#333333;





}/*---------------------------------------------------------
Horizontal Dividers
----------------------------------------------------------*/
.cdd{$panelID}_dividers_horizontal{



	background-color:#cccccc;




	
}/**********************************************************************************************

	Optional Specific Settings

	Specifically define settings for any item or menu group
	by using the following syntax with the items index.

***********************************************************************************************/	

-->
</style>
EOT;
		return $data;	
		
	}
	
	
	
	
	
}

?>

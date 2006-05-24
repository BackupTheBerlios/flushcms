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

class PNavMenuPanel extends TWebControl 
{
	/**
	 * list of TListItem controls
	 */
	private $ComponentID="";
	private $MenuLayoutString="";
	private $SubMenuSpacing="";
	private $ActiveScript="";
	/**
	* Constructor.
	*/
	function __construct()
	{
		parent::__construct();
//		$this->setTagName('span');
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
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getMainMenuBgColor () 
	{
		return $this->getViewState('MainMenuBgColor','f1f1f1');
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setMainMenuBgColor ($value) 
	{
		$this->setViewState('MainMenuBgColor',$value,'');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getSubMenuBgColor () 
	{
		return $this->getViewState('SubMenuBgColor','');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setSubMenuBgColor ($value) 
	{
		$this->setViewState('SubMenuBgColor',$value,'');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getRolloverBgColor () 
	{
		return $this->getViewState('RolloverBgColor','CCCCCC');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setRolloverBgColor ($value) 
	{
		$this->setViewState('RolloverBgColor',$value,'');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getRolloverColor () 
	{
		return $this->getViewState('RolloverColor','000000');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setRolloverColor ($value) 
	{
		$this->setViewState('RolloverColor',$value,'');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getPreImage () 
	{
		return $this->getViewState('PreImage','squares_0.gif');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setPreImage ($value) 
	{
		$this->setViewState('PreImage',$value,'');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getPreImageRollover () 
	{
		return $this->getViewState('PreImageRollover','squares_0_hl.gif');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setPreImageRollover ($value) 
	{
		$this->setViewState('PreImageRollover',$value,'');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getAppendImage () 
	{
		return $this->getViewState('AppendImage','arrows_4.gif');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setAppendImage ($value) 
	{
		$this->setViewState('AppendImage',$value,'');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getAppendImageRollover () 
	{
		return $this->getViewState('AppendImageRollover','arrows_4_hl.gif');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setAppendImageRollover ($value) 
	{
		$this->setViewState('AppendImageRollover',$value,'');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getTextSize () 
	{
		return $this->getViewState('TextSize','12px');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setTextSize ($value) 
	{
		$this->setViewState('TextSize',$value,'');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getTextColor () 
	{
		return $this->getViewState('TextColor','000000');//#333333
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setTextColor ($value) 
	{
		$this->setViewState('TextColor',$value,'');
		
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
		$first_panel = "";
		$all_childs = $this->getParent( )->getChildren( );
		foreach ($all_childs as $key => $child)
		{
			if ($child instanceof PNavMenuPanel ) 
			{
				$first_panel=$key;
				break;
			}
		}
		
		$this->ComponentID=rand(100000,999999);
		$content = $this->buildTopJavascript ();
		if ($this->getID()==$first_panel) 
		{
			$content .= $this->buildHeadJavascript ();
		}
		$content .= $this->buildJavascriptData ();
		$content .="\n <script vqptag=\"placement\" vqp_menuid=\"{$this->ComponentID}\" language=\"JavaScript\">create_menu({$this->ComponentID})</script> \n"; //
		$content .="\n {$this->ActiveScript} \n";
		

		return $content;		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Sun May 21 08:21:44 CST 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function parsedBodies ($bodies,$level=0,$append="") 
	{
		if (empty($content)) 
		{
			$content="";
		}
		
		$x=0;
	 	foreach ($bodies as $bodies_object)
	 	{
	 		if ( 
	 		
	 		($bodies_object instanceof PNavMenuPageItem) || 
	 		($bodies_object instanceof PActiveNavMenuCommandItem) ||
	 		($bodies_object instanceof PNavMenuCommandItem) ||
	 		($bodies_object instanceof PNavMenuLinkItem) ||
	 		($bodies_object instanceof PNavMenuLabelItem) 
	 				
	 		  ) 
			{
				if ($level>0 && $append!="" )
				{
					$sub_append="{$append}_{$x}";
				}
				else
				{
					$sub_append = "{$x}";
				}
				
				
		 		if ($bodies_object instanceof PNavMenuPageItem) 
		 		{
				 	$content.=$this->renderPageItem($bodies_object,$sub_append);
		 		}
		 		elseif ($bodies_object instanceof PActiveNavMenuCommandItem) 
		 		{
				 	$content.=$this->renderActiveCommandItem($bodies_object,$sub_append);
		 				
		 		}	
		 		elseif ($bodies_object instanceof PNavMenuCommandItem) 
		 		{
				 	$content.=$this->renderCommandItem($bodies_object,$sub_append);
		 				
		 		}
		 		elseif ($bodies_object instanceof PNavMenuLinkItem) 
		 		{
				 	$content.=$this->renderLinkItem($bodies_object,$sub_append);
		 				
		 		}
		 		elseif ($bodies_object instanceof PNavMenuLabelItem) 
		 		{
				 	$content.=$this->renderLabelItem($bodies_object,$sub_append);
		 				
		 		}
				
				$sub_bodies=$bodies_object->getBodies();
			 	if (sizeof($sub_bodies->getArray())>0) 
			 	{
		 			if ($level>0 && $append!="") 
					{
						$send_append="{$append}_{$x}";
					}
					else
					{
						$send_append="{$x}";
					}
			 		$level++;
			 		$content.=" this.icon_abs{$sub_append} = \"0\" \n ";
			 		$content.=$this->parsedBodies($sub_bodies,$level,$send_append);
			 	}
				$x++;
				
			}
	 		
		}
		$x=$level=0;
		return 	$content;	
	}
	

	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function renderPageItem ($menuItem,$append) 
	{
		$id = $menuItem->getID();
	 	$text = $menuItem->getText();
	 	$pages = $menuItem->getPages();
	 	$modules = $menuItem->getModules(); 
		if(strstr($append,"_")==FALSE)
		{
			$content=" //<!-------- menu {$append} start -------------> \n ";
//			$content.=" this.menu_xy{$append} = \"".$this->SubMenuSpacing."\" \n ";
//			$content.=" this.menu_width{$append} = ".$this->getItemWidth()." \n ";
			$content.=" this.item{$append} = \"{$text}\" \n ";
			$content.=" this.url{$append} = \"?Page={$pages}&Module={$modules}\" \n ";
//			$content.=" this.icon_rel{$append} = 0 \n";
		
		}
		else
		{
			$content="this.item{$append} = \"{$text}\" \n ";
			$content.=" this.url{$append} = \"?Page={$pages}&Module={$modules}\" \n ";
//			$content.="this.icon_rel{$append} = \"0\" \n ";
		}
//		$content="<br/> PageItem<===>{$append}<a href=\"###Page={$pages}&Module={$modules}\">{$text}</a>{$id} <br/>\n ";
		return $content;
	}

	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function renderCommandItem ($menuItem,$append) 
	{
		$page=$menuItem->getPage();
		$postBack=$page->getPostBackClientEvent($menuItem,'');
//		$postBack = str_replace("'","\\'",$postBack);
		$text = $menuItem->getText();
		$id = $menuItem->getID();

		$text = $menuItem->getText();
		$id = $menuItem->getID();
		if(strstr($append,"_")==FALSE)
		{
			$content=" //<!-------- menu {$append} start -------------> \n ";
//			$content.=" this.menu_xy{$append} = \"".$this->SubMenuSpacing."\" \n ";
//			$content.=" this.menu_width{$append} = ".$this->getItemWidth()." \n ";
//			$content.=" this.item{$append} = \"<a id=\\\"{$id}\\\" href=\\\"javascript:{$postBack}\\\">{$text}</a>\" \n ";
			$content.="this.item{$append} = \"{$text}\" \n ";
			$content.="this.nameid{$append} = \"{$id}\" \n ";
			$content.="this.postback{$append} = \"javascript:{$postBack}\" \n ";
//			$content.=" this.url{$append} = \" javascript:{$postBack} \" \n ";
//			$content.=" this.icon_rel{$append} = 0 \n";
		
		}
		else
		{
//			$content="this.item{$append} = \"<a id=\\\"{$id}\\\" href=\\\"javascript:{$postBack}\\\">{$text}</a>\" \n ";
			$content="this.item{$append} = \"{$text}\" \n ";
			$content.="this.nameid{$append} = \"{$id}\" \n ";
			$content.="this.postback{$append} = \"javascript:{$postBack}\" \n ";
//			$content.=" this.url{$append} = \"javascript:{$postBack}\" \n ";
//			$content.="this.icon_rel{$append} = \"0\" \n ";
		}
//		$content="<br/> CommandItem<===>{$append}<a id=\"{$id}\" href=\"javascript:{$postBack}\">{$text}</a> <br/>\n ";
		return $content;
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function renderActiveCommandItem ($menuItem,$append) 
	{
		$page=$menuItem->getPage();
		$postBack=$page->getPostBackClientEvent($menuItem,'');
//		$postBack = str_replace("'","\\'",$postBack);
		$id = $menuItem->getID();
		$text = $menuItem->getText();
		$active_script = $menuItem->render();
		$this->ActiveScript .=$active_script;
		
		$text = $menuItem->getText();
		$id = $menuItem->getID();
		
		if(strstr($append,"_")==FALSE)
		{
			$content=" //<!-------- menu {$append} start -------------> \n ";
//			$content.=" this.menu_xy{$append} = \"".$this->SubMenuSpacing."\" \n ";
//			$content.=" this.menu_width{$append} = ".$this->getItemWidth()." \n ";
			$content.=" this.item{$append} = \"{$text}\" \n ";
			$content.="this.nameid{$append} = \"{$id}\" \n ";
			$content.="this.postback{$append} = \"javascript:{$postBack}\" \n ";
//			$content.=" this.icon_rel{$append} = 0 \n";
		
		}
		else
		{
			$content="this.item{$append} = \"{$text}\" \n ";
			$content.="this.nameid{$append} = \"{$id}\" \n ";
			$content.="this.postback{$append} = \"javascript:{$postBack}\" \n ";
///			$content.="this.icon_rel{$append} = \"0\" \n ";
		}
		
//		$content="<br/> ActiveCommandItem<===>{$append}<a id=\"{$id}\" href=\"javascript:{$postBack}\">{$text}</a>{$textdd} <br/>\n ";
		return $content;
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function renderLinkItem ($menuItem,$append) 
	{
		$id = $menuItem->getID();
	 	$text = $menuItem->getText();
	 	$linkurl = $menuItem->getLinkUrl();
	 	
		if(strstr($append,"_")==FALSE)
		{
			$content=" //<!-------- menu {$append} start -------------> \n ";
//			$content.=" this.menu_xy{$append} = \"".$this->SubMenuSpacing."\" \n ";
//			$content.=" this.menu_width{$append} = ".$this->getItemWidth()." \n ";
			$content.=" this.item{$append} = \"{$text}\" \n ";
			$content.=" this.url{$append} = \"{$linkurl}\" \n ";
//			$content.=" this.icon_rel{$append} = 0 \n";
		
		}
		else
		{
			$content="this.item{$append} = \"{$text}\" \n ";
			$content.=" this.url{$append} = \"{$linkurl}\" \n ";
//			$content.="this.icon_rel{$append} = \"0\" \n ";
		}
	 	
	 	
//		$content="<br/> LinkItem<===>{$append}<a id=\"{$id}\" href=\"{$linkurl}\">{$text}</a><br/>\n ";
		return $content;
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function renderLabelItem ($menuItem,$append) 
	{
		$id = $menuItem->getID();
	 	$text = $menuItem->getText();
	 	
		if(strstr($append,"_")==FALSE)
		{
			$content=" //<!-------- menu {$append} start -------------> \n ";
//			$content.=" this.menu_xy{$append} = \"".$this->SubMenuSpacing."\" \n ";
//			$content.=" this.menu_width{$append} = ".$this->getItemWidth()." \n ";
			$content.=" this.item{$append} = \"{$text}\" \n ";
//			$content.=" this.icon_rel{$append} = 0 \n";
		
		}
		else
		{
			$content="this.item{$append} = \"{$text}\" \n ";
//			$content.="this.icon_rel{$append} = \"0\" \n ";
		}

//		$content="<br/> LabelItem<===>{$append}   {$text}  {$id}<br/>\n ";
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
	function buildTopJavascript () 
	{
		$js_patch=$this->Application->getResourceLocator()->getJsPath().'/';
		$taget = $this->getTarget ();
		$panelID = $this->ComponentID;
		
		$data = <<<EOT
<script language="JavaScript" vqptag="doc_level_settings" is_vqp_html=1 vqp_uid0={$panelID}>cdd__codebase = "{$js_patch}code/";cdd__codebase{$panelID} = "{$js_patch}code/";</script>		

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
	function buildHeadJavascript () 
	{
		$js_patch=$this->Application->getResourceLocator()->getJsPath().'/';
		$taget = $this->getTarget ();
		$panelID = $this->ComponentID;
		
		$data = <<<EOT

<SCRIPT LANGUAGE="JavaScript">
<!--
//Document Level Settings

cdd__activate_onclick = false
cdd__showhide_delay = 100
cdd__url_target = "_self"
cdd__url_features = "resizable=1, scrollbars=1, titlebar=1, menubar=1, toolbar=1, location=1, status=1, directories=1, channelmode=0, fullscreen=0"
cdd__display_urls_in_status_bar = true
cdd__default_cursor = "hand"



//NavStudio Code (Warning: Do Not Alter!)

if (window.showHelp){b_type = "ie"; if (!window.attachEvent) b_type += "mac";}if (document.createElementNS) b_type = "dom";if (navigator.userAgent.indexOf("afari")>-1) b_type = "safari";if (window.opera) b_type = "opera"; qmap1 = "\<\script language=\"JavaScript\" vqptag='loader_sub' src=\""; qmap2 = ".js\">\<\/script\>";;function iesf(){};;function vqp_error(val){/*alert(val)*/}
if (b_type){document.write(qmap1+cdd__codebase+"pbrowser_"+b_type+qmap2);document.close();}
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
	function buildJavascriptData () 
	{
		$item_data = $this->parsedBodies ($this->getBodies());
		$panelID = $this->ComponentID;
		if ($this->getDisplayMode ()=="Vertical") 
		{
			$is_horizontal=false;
			$menu_xy = "-5,-19";
		}
		 else
		{
			$is_horizontal=true;
			$menu_xy = "-20,-2";
		}
		$item_width = $this->getItemWidth ();
		$text_color = $this->getTextColor();
		$text_rollover_color = $this->getRolloverColor ();
		$text_size = $this->getTextSize ();
		$main_menu_bg_color = $this->getMainMenuBgColor ();
		$sub_menu_bg_color = $this->getSubMenuBgColor ();
		$menu_rollover_bg_color = $this->getRolloverBgColor ();
		$pre_image = $this->getPreImage();
		$pre_image_rollover = $this->getPreImageRollover();
		$append_image = $this->getAppendImage();
		$append_image_rollover = $this->getAppendImageRollover();
		$data = <<<EOT
<script language="JavaScript" >
function cdd_menu{$panelID}(){//////////////////////////Start Menu Data/////////////////////////////////

//**** NavStudio, (c) 2004, OpenCube Inc.,  -  www.opencube.com ****
//Note: This data file may be manually customized outside of the visual interface.

    //Unique Menu Id
	this.uid = {$panelID}


/**********************************************************************************************

                               Icon Images

**********************************************************************************************/

    //Inline positioned icon images (flow with the item text)

	this.rel_icon_image0 = "{$pre_image}"
	this.rel_icon_rollover0 = "{$pre_image_rollover}"
	this.rel_icon_image_wh0 = "13,8"

    //Absolute positioned icon images (x,y positioned)

//	this.abs_icon_image0 = "default_icon.gif"
//	this.abs_icon_rollover0 = "default_icon.gif"
//	this.abs_icon_image_wh0 = "7,7"
//	this.abs_icon_image_xy0 = "-12,6"
//
//	this.abs_icon_image1 = "main_divider.gif"
//	this.abs_icon_rollover1 = "main_divider.gif"
//	this.abs_icon_image_wh1 = "178,1"
//	this.abs_icon_image_xy1 = "-175,2"

	this.abs_icon_image0 = "{$append_image}"
	this.abs_icon_rollover0 = "{$append_image_rollover}"
	this.abs_icon_image_wh0 = "13,10"
	this.abs_icon_image_xy0 = "-16,5"



/**********************************************************************************************

                              Global - Menu Container Settings

**********************************************************************************************/


	this.menu_border_width = 1
	this.menu_padding = "2,2,2,2"
	this.menu_border_style = "solid"
	this.divider_caps = false
//	this.divider_width = 0
//	this.divider_height = 0
//	this.divider_background_color = "#CCCCCC"
	this.divider_width = 2
	this.divider_height = 2
	this.divider_background_color = "#a2a2a2"

	this.divider_border_style = "none"
	this.divider_border_width = 0
//	this.divider_border_color = "#000000"
	this.menu_is_horizontal = false
	this.menu_width = {$item_width}
	this.menu_xy = "{$menu_xy}"




/**********************************************************************************************

                              Global - Menu Item Settings

**********************************************************************************************/

	this.icon_rel = 0

	this.menu_items_background_color_roll = "#{$menu_rollover_bg_color}"
	this.menu_items_background_color ="#{$sub_menu_bg_color}";
	this.menu_items_text_color = "#{$text_color}"
	this.menu_items_text_decoration = "none"
	this.menu_items_font_family = "Verdana"
	this.menu_items_font_size = "{$text_size}"
	this.menu_items_font_style = "normal"
	this.menu_items_font_weight = "normal"
	this.menu_items_text_align = "left"
	this.menu_items_padding = "2,5,2,7"
	this.menu_items_border_style = "solid"
	this.menu_items_border_color = "#{$main_menu_bg_color}"
	this.menu_items_border_width = "1"
	this.menu_items_width = {$item_width}
	this.menu_items_text_color_roll = "#{$text_rollover_color}"
	this.menu_items_border_color_roll = "#{$main_menu_bg_color}"
    this.divider_background_color_items = "#{$sub_menu_bg_color}"




/**********************************************************************************************

                              Main Menu Settings

**********************************************************************************************/


        this.menu_background_color_main = "#{$main_menu_bg_color}"
        this.menu_items_background_color_main = "transparent"
        this.menu_items_background_color_roll_main = "#{$menu_rollover_bg_color}"
        this.menu_items_text_color_main = "#{$text_color}"
        this.menu_items_text_color_roll_main = "#{$text_rollover_color}"
        this.menu_border_color_main = "#000000"
        this.menu_items_border_color_roll_main = "#{$main_menu_bg_color}"
        this.menu_width_main = {$item_width}
        this.menu_is_horizontal_main = {$is_horizontal}
        this.divider_height_main = 0
        this.divider_background_color_main = "#999999"

		{$item_data}




}///////////////////////// END Menu Data /////////////////////////////////////////
</script>		
		

EOT;
		return $data;	
	}
		
	

	
	
}

?>
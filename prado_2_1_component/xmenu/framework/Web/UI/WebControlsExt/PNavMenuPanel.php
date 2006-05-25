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
 * PNavMenuPanel class
 *
 * PNavMenuPanel comment write here.
 *
 * Namespace: System.Web.UI.WebControlsExt
 * Example:
 * <com:TForm>
 * <com:PNavMenuPanel 
 * 	DisplayMode="Vertical"
 * 	PreImage="squares_0.gif" PreImageRollover="squares_0_hl.gif"
 * 	>
 *     <com:PNavMenuPageItem Text="Item_1" PageName="NewPage" ModuleName="User">
 *            <com:PNavMenuLinkItem Text="Item_1_1" LinkUrl="http://www.518ic.com" />
 *            <com:PNavMenuPageItem Text="Item_1_2" PageName="NewPage" ModuleName="User" />
 *     </com:PNavMenuPageItem>
 *     <com:PNavMenuLinkItem Text="Item_2" LinkUrl="http://www.518ic.com" />
 *     <com:PNavMenuLabelItem Text="Item_3">
 *        <com:PNavMenuCommandItem Text="CommandItem_3_1" OnCommand="buttonClicked" CommandName="command_name" 
 *               CommandParameter="command_value" OnClick="clickMe" />
 *        <com:PActiveNavMenuCommandItem Text="ActiveItem_3_2" OnCommand="buttonClicked" CommandName="command_name" 
 *               CommandParameter="command_value" OnClick="clickMe" />
 *     </com:PNavMenuLabelItem>
 *     <com:PNavMenuLinkItem Text="LinkItemSelf_4" LinkUrl="http://www.518ic.com" />
 *     <com:PNavMenuLinkItem Text="LinkUrlBlank_5" Target="_blank" LinkUrl="http://www.518ic.com" />
 * </com:PNavMenuPanel>
 * </com:TForm> 
 *
 * Properties
 * - <b>DisplayMode</b>, string, kept in viewstate
 * - <b>SubDisplayMode</b>, string, kept in viewstate
 * - <b>MainBorderColor</b>, string, kept in viewstate
 * - <b>SplitBarWidth</b>, string, kept in viewstate
 * - <b>SplitBarColor</b>, string, kept in viewstate
 * - <b>TextSize</b>, string, kept in viewstate
 * - <b>ItemWidth</b>, string, kept in viewstate
 * - <b>MainMenuBgColor</b>, string, kept in viewstate
 * - <b>SubMenuBgColor</b>, string, kept in viewstate
 * - <b>ItemBgImage</b>, string, kept in viewstate
 * - <b>RolloverBgColor</b>, string, kept in viewstate
 * - <b>RolloverColor</b>, string, kept in viewstate
 * - <b>TextColor</b>, string, kept in viewstate
 * - <b>MainMenuBgImage</b>, string, kept in viewstate
 * - <b>PreImage</b>, string, kept in viewstate
 * - <b>PreImageRollover</b>, string, kept in viewstate
 * - <b>AppendImage</b>, string, kept in viewstate
 * - <b>AppendImageRollover</b>, string, kept in viewstate
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
	function getSubDisplayMode () 
	{
		return $this->getViewState('SubDisplayMode', 'Vertical');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setSubDisplayMode ($value) 
	{
		if($value!=='Horizontal')
			$value='Vertical';
		$this->setViewState('SubDisplayMode',$value,'Vertical');
		
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
	function getMainMenuBgImage () 
	{
		return $this->getViewState('MainMenuBgImage','f1f1f1');
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setMainMenuBgImage ($value) 
	{
		$this->setViewState('MainMenuBgImage',$value,'');
		
	}

	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getMainBorderColor () 
	{
		return $this->getViewState('MainBorderColor','000000');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setMainBorderColor ($value) 
	{
		$this->setViewState('MainBorderColor',$value,'');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getSplitBarWidth () 
	{
		return $this->getViewState('SplitBarWidth','0');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setSplitBarWidth ($value) 
	{
		$this->setViewState('SplitBarWidth',$value,'');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getSplitBarColor () 
	{
		return $this->getViewState('SplitBarColor','c9c9c9');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setSplitBarColor ($value) 
	{
		$this->setViewState('SplitBarColor',$value,'');
		
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
	function getItemBgImage () 
	{
		return $this->getViewState('ItemBgImage','');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 22, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setItemBgImage ($value) 
	{
		$this->setViewState('ItemBgImage',$value,'');
		
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
		return $this->getViewState('PreImage','');
		
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
		return $this->getViewState('AppendImage','');
		
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
		return $this->getViewState('AppendImageRollover','');
		
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
			 		if ($this->getAppendImage()) 
					{
				 		$content.=" this.icon_abs{$sub_append} = \"0\" \n ";
					}
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
	 	$pages = $menuItem->getPageName();
	 	$modules = $menuItem->getModuleName(); 
	 	$target = $menuItem->getTarget();
	 	$content="";
		if(strstr($append,"_")==FALSE && $this->getDisplayMode ()!="Vertical" )
		{
			$content=" //<!-------- menu {$append} start -------------> \n ";
			$content.=" this.menu_xy{$append} = \"-{$this->getItemWidth ()},-2\" \n ";
		
		}
		$content.=" this.item{$append} = \"{$text}\" \n ";
		$content.=" this.url{$append} = \"?Page={$pages}&Module={$modules}\" \n ";
		$content.=" this.url_target{$append} = \"{$target}\" \n ";
		
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
		$text = $menuItem->getText();
		$id = $menuItem->getID();

	 	$content="";
		
		if(strstr($append,"_")==FALSE && $this->getDisplayMode ()!="Vertical")
		{
			$content=" //<!-------- menu {$append} start -------------> \n ";
			$content.=" this.menu_xy{$append} = \"-{$this->getItemWidth ()},-2\" \n ";
		
		}
		$content="this.item{$append} = \"{$text}\" \n ";
		$content.="this.nameid{$append} = \"{$id}\" \n ";
		$content.="this.postback{$append} = \"javascript:{$postBack}\" \n ";
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
		$active_script = $menuItem->render();
		$this->ActiveScript .=$active_script;
		$text = $menuItem->getText();
		$id = $menuItem->getID();
		
	 	$content="";
		
		if(strstr($append,"_")==FALSE && $this->getDisplayMode ()!="Vertical")
		{
			$content=" //<!-------- menu {$append} start -------------> \n ";
			$content.=" this.menu_xy{$append} = \"-{$this->getItemWidth ()},-2\" \n ";
		
		}
		$content="this.item{$append} = \"{$text}\" \n ";
		$content.="this.nameid{$append} = \"{$id}\" \n ";
		$content.="this.postback{$append} = \"javascript:{$postBack}\" \n ";
		
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
	 	$target = $menuItem->getTarget();
	 	$content="";
	 	
		if(strstr($append,"_")==FALSE && $this->getDisplayMode ()!="Vertical")
		{
			$content=" //<!-------- menu {$append} start -------------> \n ";
			$content.=" this.menu_xy{$append} = \"-{$this->getItemWidth ()},-2\" \n ";
		
		}
		$content.="this.item{$append} = \"{$text}\" \n ";
		$content.=" this.url{$append} = \"{$linkurl}\" \n ";
		$content.=" this.url_target{$append} = \"{$target}\" \n ";
	 	
	 	
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
	 	$content="";
	 	
		if(strstr($append,"_")==FALSE && $this->getDisplayMode ()!="Vertical")
		{
			$content=" //<!-------- menu {$append} start -------------> \n ";
			$content.=" this.menu_xy{$append} = \"-{$this->getItemWidth ()},-2\" \n ";	
		}
		$content.="this.item{$append} = \"{$text}\" \n ";

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
		$panelID = $this->ComponentID;
		
		$data = <<<EOT
<script language="JavaScript" vqptag="doc_level_settings" is_vqp_html=1 vqp_uid0={$panelID}>cdd__codebase = "{$js_patch}nav_menu/";cdd__codebase{$panelID} = "{$js_patch}nav_menu/";</script>		

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
		$this->getSubDisplayMode();
		$sub_display_model = ($this->getSubDisplayMode()=="Vertical")?"false":"true";
		$item_width = $this->getItemWidth ();
		
		$text_color = $this->getTextColor();
		$text_rollover_color = $this->getRolloverColor ();
		$text_size = $this->getTextSize ();
		
		$split_bar_width = $this->getSplitBarWidth();
		$split_bar_color = $this->getSplitBarColor();
		$main_menu_bg_color = $this->getMainMenuBgColor ();
		$main_menu_bg_image = $this->getMainMenuBgImage ();
		$main_menu_border_color = $this->getMainBorderColor();
		$sub_menu_bg_color = $this->getSubMenuBgColor ();
		$item_bg_image = $this->getItemBgImage();
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
    var pre_image="{$pre_image}"
    if(pre_image != "")
    {
		this.rel_icon_image0 = "{$pre_image}";
		this.rel_icon_rollover0 = "{$pre_image_rollover}";
	 	this.icon_rel = 0
    }
    
	this.rel_icon_image_wh0 = "13,8"

    //Absolute positioned icon images (x,y positioned)

	var append_image="{$append_image}"
	if(append_image != "")
	{
		this.abs_icon_image0 = "{$append_image}";
		this.abs_icon_rollover0 = "{$append_image_rollover}";
	}
	this.abs_icon_image_wh0 = "13,10"
	this.abs_icon_image_xy0 = "-16,5"



/**********************************************************************************************

                              Global - Menu Container Settings

**********************************************************************************************/


	this.menu_border_width = 1
	this.menu_padding = "0,0,0,0"
	this.menu_border_style = "solid"
	this.divider_caps = true
//	this.divider_background_color = "#CCCCCC"
	this.divider_width = {$split_bar_width}
	this.divider_height = 0
//	this.divider_background_color = "#FF0000"

	this.divider_border_style = "none"
	this.menu_is_horizontal = {$sub_display_model}
	this.menu_width = {$item_width}
	this.menu_xy = "{$menu_xy}"




/**********************************************************************************************

                              Global - Menu Item Settings

**********************************************************************************************/


	this.menu_items_background_color_roll = "#{$menu_rollover_bg_color}"
	this.menu_items_background_color ="#{$sub_menu_bg_color}";
	this.menu_items_background_image ="{$item_bg_image}";
	this.menu_items_text_color = "#{$text_color}"
	this.menu_items_text_decoration = "none"
	this.menu_items_font_family = "Verdana"
	this.menu_items_font_size = "{$text_size}"
	this.menu_items_font_style = "normal"
	this.menu_items_font_weight = "normal"
	this.menu_items_text_align = "left"
	this.menu_items_padding = "4,5,4,5"
	this.menu_items_border_style = "solid"
	this.menu_items_border_color = "#{$main_menu_bg_color}"
	this.menu_items_border_width = "0"
	this.menu_items_width = {$item_width}
	this.menu_items_text_color_roll = "#{$text_rollover_color}"
	this.menu_items_border_color_roll = "#00FF00"//{$main_menu_bg_color}
    this.divider_background_color_items = "#{$sub_menu_bg_color}"




/**********************************************************************************************

                              Main Menu Settings

**********************************************************************************************/


        this.menu_background_image_main = "{$main_menu_bg_image}"
        this.menu_background_color_main = "#{$main_menu_bg_color}"
        this.menu_items_background_color_main = "transparent"
        this.menu_items_background_color_roll_main = "#{$menu_rollover_bg_color}"
        this.menu_items_text_color_main = "#{$text_color}"
        this.menu_items_text_color_roll_main = "#{$text_rollover_color}"
        this.menu_border_color_main = "#{$main_menu_border_color}"
        this.menu_items_border_color_roll_main = "#{$main_menu_bg_color}"
        this.menu_width_main = {$item_width}
        this.menu_is_horizontal_main = {$is_horizontal}
        this.divider_height_main = 0
        this.divider_background_color_main = "#{$split_bar_color}"

		{$item_data}




}///////////////////////// END Menu Data /////////////////////////////////////////
</script>		
		

EOT;
		return $data;	
	}
		
	

	
	
}

?>
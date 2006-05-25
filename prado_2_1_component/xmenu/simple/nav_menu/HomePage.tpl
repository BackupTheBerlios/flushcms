<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Navigator Menu Example </TITLE>
</HEAD>

<BODY>

<p>This is the design document for the navigator menu PRADO component. You can set the alignment of the menu through the DisplayMode property. You can set the Item width of the menu through the ItemWidth property. Not limit the sub menu level. </p>

<p><b>Horizontal Menu ;Sub Menu Vertical </b></p>
<com:TForm>

<com:PNavMenuPanel
	 DisplayMode="Horizontal"
	 
	 TextColor="000000" RolloverColor="FF0000" 
	 MainBorderColor="cccccc" SplitBarWidth="2" SplitBarColor="895465"
	 TextSize="12px" MainMenuBgColor="eeeeee"
	 RolloverBgColor="F0F900" ItemWidth="140" 
	 
	 PreImage="sample0_bullet.gif" PreImageRollover="sample0_bullet_hl.gif"
	 AppendImage="bullet_down_red.gif" AppendImageRollover="bullet_down_gray.gif" 
	 SubMenuBgColor="eeeeee" 
	 MainMenuBgImage="sample0_bg.jpg" 
  >

    <com:PNavMenuLabelItem Text="Item_0">
    	<com:PNavMenuPageItem Text="Item_0_0" PageName="NewPage" ModuleName="User" />
    	<com:PNavMenuPageItem Text="Item_0_1" PageName="NewPage0_1" ModuleName="User0_1" >
    		<com:PNavMenuPageItem Text="Item_0_1_0" PageName="NewPage" ModuleName="User" />
    	</com:PNavMenuPageItem>
    </com:PNavMenuLabelItem>
    
    <com:PNavMenuPageItem Text="Item_1" PageName="NewPage" ModuleName="User" />
    <com:PNavMenuPageItem Text="Item_2" PageName="NewPage" ModuleName="User" >
    
    	<com:PNavMenuPageItem Text="Item_2_0" PageName="NewPage" ModuleName="User" />
    	<com:PNavMenuPageItem Text="Item_2_1" PageName="NewPage" ModuleName="User" />
    	<com:PActiveNavMenuCommandItem Text="Item_2_2" OnClick="buttonClicked" > 
    		<com:PNavMenuPageItem Text="Item_2_2_0" PageName="NewPage" ModuleName="User" />
    		<com:PNavMenuPageItem Text="Item_2_2_1" PageName="NewPage" ModuleName="User" >
    			<com:PNavMenuPageItem Text="Item_2_2_1_0" PageName="NewPage" ModuleName="User" >
    			
    				<com:PNavMenuLinkItem Text="Item_2_2_1_0_0" LinkUrl="http://www.518ic.com" >
    					<com:PNavMenuLabelItem Text="Item_2_2_1_0_0_0"/>
    				</com:PNavMenuLinkItem>
    				
    			</com:PNavMenuPageItem>
    			
    		</com:PNavMenuPageItem>
    	</com:PActiveNavMenuCommandItem>   
    	
     </com:PNavMenuPageItem>
    <com:PNavMenuPageItem Text="PageItem_3" PageName="NewPage" ModuleName="User" />

    	<com:PNavMenuCommandItem Text="CommandItem_4" OnClick="buttonClicked" /> 
    	   
    	<com:PActiveNavMenuCommandItem Text="ActiveItem_5" OnClick="buttonClicked" />    
              
    	<com:PNavMenuLabelItem Text="LabelItem"  />    
              
    
</com:PNavMenuPanel>
<br/>
<br/>
<br/>
<p><b>Horizontal Menu ;Sub Menu Also Horizontal</b></p>
<com:PNavMenuPanel
	 SubDisplayMode="Horizontal"	 
	 TextColor="000000" RolloverColor="FFFFFF" 
	 TextSize="14px" SplitBarWidth="1" SplitBarColor="000000"
	 RolloverBgColor="999900" ItemWidth="120" 
	 PreImage="bullet_blocktriangle_red.gif" PreImageRollover="bullet_blocktriangle_gray.gif"
	 MainMenuBgColor="ebe7b2" SubMenuBgColor="ebe7b2"
  >

    <com:PNavMenuLabelItem Text="Item_0">
    	<com:PNavMenuPageItem Text="Item_0_0" PageName="NewPage" ModuleName="User" />
    	<com:PNavMenuPageItem Text="Item_0_1" PageName="NewPage0_1" ModuleName="User0_1" >
    		<com:PNavMenuPageItem Text="Item_0_1_0" PageName="NewPage" ModuleName="User" />
    	</com:PNavMenuPageItem>
    </com:PNavMenuLabelItem>
    
    <com:PNavMenuPageItem Text="Item_1" PageName="NewPage" ModuleName="User" />
    <com:PNavMenuPageItem Text="Item_2" PageName="NewPage" ModuleName="User" >
    
    	<com:PNavMenuPageItem Text="Item_2_0" PageName="NewPage" ModuleName="User" />
    	<com:PNavMenuPageItem Text="Item_2_1" PageName="NewPage" ModuleName="User" />
    	<com:PActiveNavMenuCommandItem Text="Item_2_2" OnClick="buttonClicked" > 
    		<com:PNavMenuPageItem Text="Item_2_2_0" PageName="NewPage" ModuleName="User" />
    		<com:PNavMenuPageItem Text="Item_2_2_1" PageName="NewPage" ModuleName="User" >
    			<com:PNavMenuPageItem Text="Item_2_2_1_0" PageName="NewPage" ModuleName="User" >
    			
    				<com:PNavMenuLinkItem Text="Item_2_2_1_0_0" LinkUrl="http://www.518ic.com" >
    					<com:PNavMenuLabelItem Text="Item_2_2_1_0_0_0"/>
    				</com:PNavMenuLinkItem>
    				
    			</com:PNavMenuPageItem>
    			
    		</com:PNavMenuPageItem>
    	</com:PActiveNavMenuCommandItem>   
    	
     </com:PNavMenuPageItem>
    <com:PNavMenuPageItem Text="Item_3" PageName="NewPage" ModuleName="User" />

    	<com:PNavMenuCommandItem Text="Item_4" OnClick="buttonClicked" /> 
    	   
    	<com:PActiveNavMenuCommandItem Text="Item_5" OnClick="buttonClicked" />    
              
    	<com:PNavMenuLabelItem Text="Item_6" OnClick="buttonClicked" />    
              
    
</com:PNavMenuPanel>

<br/>
<br/>
<br/>
<p><b>Vertical Menu</b></p>

<com:PNavMenuPanel 
	DisplayMode="Vertical"
	PreImage="squares_0.gif" PreImageRollover="squares_0_hl.gif"
	>
    <com:PNavMenuPageItem Text="Item_1" PageName="NewPage" ModuleName="User">
           <com:PNavMenuLinkItem Text="Item_1_1" LinkUrl="http://www.518ic.com" />
           <com:PNavMenuPageItem Text="Item_1_2" PageName="NewPage" ModuleName="User" />
    </com:PNavMenuPageItem>
    <com:PNavMenuLinkItem Text="Item_2" LinkUrl="http://www.518ic.com" />
    <com:PNavMenuLabelItem Text="Item_3">
       <com:PNavMenuCommandItem Text="Item_3_1" OnCommand="buttonClicked" CommandName="command_name" 
              CommandParameter="command_value" OnClick="clickMe" />
       <com:PActiveNavMenuCommandItem Text="Item_3_2" OnCommand="buttonClicked" CommandName="command_name" 
              CommandParameter="command_value" OnClick="clickMe" />
    </com:PNavMenuLabelItem>
    <com:PNavMenuLinkItem Text="LinkItemSelf_4" LinkUrl="http://www.518ic.com" />
    <com:PNavMenuLinkItem Text="LinkUrlBlank_5" Target="_blank" LinkUrl="http://www.518ic.com" />
</com:PNavMenuPanel>

</com:TForm> 


</BODY>
</HTML>

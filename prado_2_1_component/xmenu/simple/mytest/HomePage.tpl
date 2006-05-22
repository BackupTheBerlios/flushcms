<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Arzen Test Prado </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>

<BODY>
<!--
<com:PNavMenuPanel DisplayMode="Vertical" ItemWidth="130">
    <com:PNavMenuPageItem Text="Item_1" Pages="NewPage" Modules="User">
           <com:PNavMenuLinkItem Text="Item_1_1" LinkUrl="http://www.google.com" />
           <com:PNavMenuPageItem Text="Item_1_2" Pages="NewPage" Modules="User" />
    </com:PNavMenuPageItem>
    <com:PNavMenuLinkItem Text="Item_2" LinkUrl="http://www.google.com" />
    <com:PNavMenuLabelItem Text="Item_3">
       <com:PNavMenuCommandItem Text="Item_3_1" OnCommand="buttonClicked" CommandName="command_name" 
              CommandParameter="command_value" OnClick="clickMe" />
       <com:PActiveNavMenuCommandItem Text="Item_3_2" OnCommand="buttonClicked" CommandName="command_name" 
              CommandParameter="command_value" OnClick="clickMe" />
    </com:PNavMenuLabelItem>
    <com:PNavMenuLinkItem Text="Item_4" LinkUrl="http://www.yahoo.com" />
</com:PNavMenuPanel>
-->


<com:TForm>
<com:PNavMenuPanel DisplayMode="Vertical" ItemWidth="130">

    <com:PNavMenuLabelItem Text="Item_0">
    	<com:PNavMenuPageItem Text="Item_0_0" Pages="NewPage" Modules="User" />
    	<com:PNavMenuPageItem Text="Item_0_1" Pages="NewPage0_1" Modules="User0_1" >
    		<com:PNavMenuPageItem Text="Item_0_1_0" Pages="NewPage" Modules="User" />
    	</com:PNavMenuPageItem>
    </com:PNavMenuLabelItem>
    
    <com:PNavMenuPageItem Text="Item_1" Pages="NewPage" Modules="User" />
    <com:PNavMenuPageItem Text="Item_2" Pages="NewPage" Modules="User" >
    
    	<com:PNavMenuPageItem Text="Item_2_0" Pages="NewPage" Modules="User" />
    	<com:PNavMenuPageItem Text="Item_2_1" Pages="NewPage" Modules="User" />
    	<com:PActiveNavMenuCommandItem Text="Item_2_2" OnClick="buttonClicked" > 
    		<com:PNavMenuPageItem Text="Item_2_2_0" Pages="NewPage" Modules="User" />
    		<com:PNavMenuPageItem Text="Item_2_2_1" Pages="NewPage" Modules="User" >
    			<com:PNavMenuPageItem Text="Item_2_2_1_0" Pages="NewPage" Modules="User" >
    			
    				<com:PNavMenuLinkItem Text="Item_2_2_1_0_0" LinkUrl="http://www.yahoo.com" >
    					<com:PNavMenuLabelItem Text="Item_2_2_1_0_0_0"/>
    				</com:PNavMenuLinkItem>
    				
    			</com:PNavMenuPageItem>
    			
    		</com:PNavMenuPageItem>
    	</com:PActiveNavMenuCommandItem>   
    	
     </com:PNavMenuPageItem>
    <com:PNavMenuPageItem Text="Item_3" Pages="NewPage" Modules="User" />

    	<com:PNavMenuCommandItem Text="Item_4" OnClick="buttonClicked" /> 
    	   
    	<com:PActiveNavMenuCommandItem Text="Item_5" OnClick="buttonClicked" />    
              
    	<com:PActiveNavMenuCommandItem Text="Item_6" OnClick="buttonClicked" />    
              
    
</com:PNavMenuPanel>




</com:TForm> 

</BODY>
</HTML>

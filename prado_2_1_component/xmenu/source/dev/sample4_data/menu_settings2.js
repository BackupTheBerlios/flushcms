//**** DHTML Web Menu, (c) 2004, OpenCube Inc.,  -  www.opencube.com ****


function cdd_menu1(){//////////////////////////Start Menu Data/////////////////////////////////
/**********************************************************************************************

	Menu 1 - General Settings and Menu Structure

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

	
	this.menu_width = 160			//applies to vertical menus
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

	
	this.item0 = "Web Menu"
	this.icon_rel0 = 0
	this.icon_abs0 = 0
	
	this.item1 = "Products"
	this.icon_rel1 = 0
	this.icon_abs1 = 0	

	this.item2 = "Download"
	this.icon_rel2 = 0
	this.icon_abs2 = 0
	
	this.item3 = "Contact"
	this.icon_rel3 = 0
	this.icon_abs3 = 0
	
	this.item4 = "Documentation"
	this.icon_rel4 = 0
	this.icon_abs4 = 0
	



/*---------------------------------------------
Sub Menu Group and Items
---------------------------------------------*/



   //Sub Menu 0

	this.menu_xy0 = "-6,2"
	this.menu_width0 = 150

	this.item0_0 = "Features"
	this.item0_1 = "Cross Browser"
	this.item0_2 = "Implementations"
	this.item0_3 = "Unlimited Levels"
	this.item0_4 = "Support"

	this.icon_rel0_0 = 0
	this.icon_rel0_1 = 0
	this.icon_rel0_2 = 0
	this.icon_rel0_3 = 0
	this.icon_rel0_4 = 0

	this.url0_0 = '../../documents/sample_link.htm'
	this.url0_1 = '../../documents/sample_link.htm'
	this.url0_2 = '../../documents/sample_link.htm'
	this.url0_3 = '../../documents/sample_link.htm'
	this.url0_4 = '../../documents/sample_link.htm'



   //Sub Menu 1
	
	this.menu_xy1 = "-6,2"
	this.menu_width1 = 200
        
	this.item1_0 = "New Effects"
	this.item1_1 = "Implementations"
	this.item1_2 = "QuickMenu Pro"
	this.item1_3 = "DHTML Effects"
	this.item1_4 = "CSS Drop Down Menu"	
	this.item1_5 = "Applet Effects"

	this.icon_rel1_0 = 0
	this.icon_rel1_1 = 0
	this.icon_rel1_3 = 0
	this.icon_rel1_2 = 0
	this.icon_rel1_4 = 0
	this.icon_rel1_5 = 0
	this.icon_abs1_0 = 0
	this.icon_abs1_1 = 0	

	this.url1_0 = '../../documents/sample_link.htm'
	this.url1_1 = '../../documents/sample_link.htm'
	this.url1_2 = '../../documents/sample_link.htm'
	this.url1_3 = '../../documents/sample_link.htm'
	this.url1_4 = '../../documents/sample_link.htm'
	this.url1_5 = '../../documents/sample_link.htm'



   //Sub Menu 1_0

	this.menu_xy1_0 = "-4,2"
	this.menu_width1_0 = 150

	this.item1_0_0 = "DHTML Menu"
	this.item1_0_1 = "DHTML Tree"
	this.item1_0_2 = "Vertical Scroll"
	this.item1_0_3 = "Scroll Window"

	this.icon_rel1_0_0 = 0
	this.icon_rel1_0_1 = 0
	this.icon_rel1_0_2 = 0
	this.icon_rel1_0_3 = 0

	this.url1_0_0 = '../../documents/sample_link.htm'
	this.url1_0_1 = '../../documents/sample_link.htm'
	this.url1_0_2 = '../../documents/sample_link.htm'
	this.url1_0_3 = '../../documents/sample_link.htm'
	


   //Sub Menu 1_1

	this.menu_xy1_1 = "-4,2"
	this.menu_width1_1 = 100

	this.item1_1_0 = "J & J"
	this.item1_1_1 = "Memorex"
	this.item1_1_2 = "Ouidad"

	this.icon_rel1_1_0 = 0
	this.icon_rel1_1_2 = 0
	this.icon_rel1_1_1 = 0

	this.url1_1_0 = '../../documents/sample_link.htm'
	this.url1_1_2 = '../../documents/sample_link.htm'
	this.url1_1_1 = '../../documents/sample_link.htm'



    //Sub Menu 2

	this.menu_xy2 = "-6,2"
	this.menu_width2 = 155
	
	this.item2_0 = "QuickMenu Pro"
	this.item2_1 = "Web Effects"
	this.item2_2 = "Web Menu"
	this.item2_3 = "Web Effects Java"

	this.icon_rel2_0 = 0
	this.icon_rel2_1 = 0
	this.icon_rel2_2 = 0
	this.icon_rel2_3 = 0

	this.url2_0 = '../../documents/sample_link.htm'
	this.url2_1 = '../../documents/sample_link.htm'
	this.url2_2 = '../../documents/sample_link.htm'
	this.url2_3 = '../../documents/sample_link.htm'



    //Sub Menu 3

	this.menu_xy3 = "-6,2"
	this.menu_width3 = 130
	
	this.item3_0 = "Cust. Service"
	this.item3_1 = "Tech. Support"
	this.item3_2 = "Product Sales"

	this.icon_rel3_0 = 0
	this.icon_rel3_1 = 0
	this.icon_rel3_2 = 0

	this.url3_0 = '../../documents/sample_link.htm'
	this.url3_1 = '../../documents/sample_link.htm'
	this.url3_2 = '../../documents/sample_link.htm'



    //Sub Menu 4

	this.menu_xy4 = "-6,2"
	this.menu_width4 = 130

	this.item4_0 = "Users Guide"
	this.item4_1 = "FAQ"
	this.item4_2 = "Features"

	this.icon_rel4_0 = 0
	this.icon_rel4_1 = 0
	this.icon_rel4_2 = 0

	this.url4_0 = '../../documents/sample_link.htm'
	this.url4_1 = '../../documents/sample_link.htm'
	this.url4_2 = '../../documents/sample_link.htm'
	


}///////////////////////// END Menu Data /////////////////////////////////////////














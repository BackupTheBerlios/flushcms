//**** DHTML Web Menu, (c) 2004, OpenCube Inc.,  -  www.opencube.com ****


function cdd_menu0(){//////////////////////////Start Menu Data/////////////////////////////////
/**********************************************************************************************

	Menu 0 - General Settings and Menu Structure

	**See the menu_styles.css file for additional customization options**

***********************************************************************************************/



/*---------------------------------------------
Icon Images
---------------------------------------------*/



    //Relative positioned icon images (flow with main menu or sub item text)

	this.rel_icon_image0 = "../sample_images/sample6_Icon0.gif"
	this.rel_icon_rollover0 = "../sample_images/sample6_Icon0.gif"
	this.rel_icon_image_wh0 = "22,18"

	this.rel_icon_image1 = "../sample_images/sample6_Icon1.gif"
	this.rel_icon_rollover1 = "../sample_images/sample6_Icon1.gif"
	this.rel_icon_image_wh1 = "22,18"

	this.rel_icon_image2 = "../sample_images/sample6_Icon2.gif"
	this.rel_icon_rollover2 = "../sample_images/sample6_Icon2.gif"
	this.rel_icon_image_wh2 = "22,18"

	this.rel_icon_image3 = "../sample_images/sample6_Icon3.gif"
	this.rel_icon_rollover3 = "../sample_images/sample6_Icon3.gif"
	this.rel_icon_image_wh3 = "22,18"

	this.rel_icon_image4= "../sample_images/sample6_Icon4.gif"
	this.rel_icon_rollover4 = "../sample_images/sample6_Icon4.gif"
	this.rel_icon_image_wh4 = "22,18"

	this.rel_icon_image5= "../sample_images/sample6_Icon5.gif"
	this.rel_icon_rollover5 = "../sample_images/sample6_Icon5.gif"
	this.rel_icon_image_wh5 = "22,18"

	this.rel_icon_image6= "../sample_images/sample6_Icon6.gif"
	this.rel_icon_rollover6 = "../sample_images/sample6_Icon6.gif"
	this.rel_icon_image_wh6 = "22,18"

	this.rel_icon_image7 = "../sample_images/sample6_Icon7.gif"
	this.rel_icon_rollover7 = "../sample_images/sample6_Icon7.gif"
	this.rel_icon_image_wh7 = "21,16"

	this.rel_icon_image8 = "../sample_images/sample6_Icon8.gif"
	this.rel_icon_rollover8 = "../sample_images/sample6_Icon8.gif"
	this.rel_icon_image_wh8 = "21,16"

	this.rel_icon_image9 = "../sample_images/sample6_Icon9.gif"
	this.rel_icon_rollover9 = "../sample_images/sample6_Icon9.gif"
	this.rel_icon_image_wh9 = "21,16"

	this.rel_icon_image10 = "../sample_images/sample6_Icon10.gif"
	this.rel_icon_rollover10 = "../sample_images/sample6_Icon10.gif"
	this.rel_icon_image_wh10 = "21,16"


	this.rel_icon_image11 = "../sample_images/sample6_Icon11.gif"
	this.rel_icon_rollover11 = "../sample_images/sample6_Icon11.gif"
	this.rel_icon_image_wh11 = "21,16"

	this.rel_icon_image12 = "../sample_images/sample6_Icon12.gif"
	this.rel_icon_rollover12 = "../sample_images/sample6_Icon12.gif"
	this.rel_icon_image_wh12 = "21,16"

	this.rel_icon_image13 = "../sample_images/sample6_Icon13.gif"
	this.rel_icon_rollover13 = "../sample_images/sample6_Icon13.gif"
	this.rel_icon_image_wh13 = "21,16"

	this.rel_icon_image14 = "../sample_images/sample6_Icon14.gif"
	this.rel_icon_rollover14 = "../sample_images/sample6_Icon14.gif"
	this.rel_icon_image_wh14 = "21,16"

	this.rel_icon_image15 = "../sample_images/sample6_Icon15.gif"
	this.rel_icon_rollover15 = "../sample_images/sample6_Icon15.gif"
	this.rel_icon_image_wh15 = "21,16"

	this.rel_icon_image16 = "../sample_images/pix_trans.gif"
	this.rel_icon_rollover16 = "../sample_images/pix_trans.gif"
	this.rel_icon_image_wh16 = "1,16"

	this.rel_icon_image17 = "../sample_images/sample6_Icon17.gif"
	this.rel_icon_rollover17 = "../sample_images/sample6_Icon17.gif"
	this.rel_icon_image_wh17 = "21,16"

	this.rel_icon_image18 = "../sample_images/sample6_Icon18.gif"
	this.rel_icon_rollover18 = "../sample_images/sample6_Icon18.gif"
	this.rel_icon_image_wh18 = "21,16"

	this.rel_icon_image19 = "../sample_images/sample6_Icon19.gif"
	this.rel_icon_rollover19 = "../sample_images/sample6_Icon19.gif"
	this.rel_icon_image_wh19 = "21,16"

	this.rel_icon_image20 = "../sample_images/sample6_Icon20.gif"
	this.rel_icon_rollover20 = "../sample_images/sample6_Icon20.gif"
	this.rel_icon_image_wh20 = "21,16"

	this.rel_icon_image21 = "../sample_images/sample6_Icon21.gif"
	this.rel_icon_rollover21 = "../sample_images/sample6_Icon21.gif"
	this.rel_icon_image_wh21 = "21,16"

    //Absolute positioned icon images (coordinate positioned)

	this.abs_icon_image0 = "../sample_images/sample6_Icon0_abs.gif"
	this.abs_icon_rollover0 = "../sample_images/sample6_Icon0_abs.gif"
	this.abs_icon_image_wh0 = "17,18"
	this.abs_icon_image_xy0 = "-35,2"

	this.abs_icon_image1 = "../sample_images/sample6_Icon0_abs.gif"
	this.abs_icon_rollover1 = "../sample_images/sample6_Icon0_abs.gif"
	this.abs_icon_image_wh1 = "17,18"
	this.abs_icon_image_xy1 = "-23,2"


/*---------------------------------------------
Divider Settings
---------------------------------------------*/


	this.use_divider_caps = false		//cap the top and bottom of each menu group
	this.divider_width = 1			//applies to horizontal menus only
	this.divider_height = 0			//applies to vertical menus only


    //available specific settings

	this.use_divider_capsX_X = true



/*---------------------------------------------
Menu Orientation and Sizing
---------------------------------------------*/


	this.is_horizontal = false		//false = vertical menus, true = horizontal menus
	this.is_horizontal_main = true


	this.menu_width = 200			//applies to vertical menus
	this.menu_width_items = 90		//applies to items in a horizontal menu
	this.menu_width_item0_0 = 10		//applies to items in a horizontal menu


   //Padding Values


	this.menu_padding_main = "0,0,0,0"		//top, right, bottom, left
	this.menu_padding_sub = "0,0,0,0"

	this.item_padding_main = "0,0,0,0"
	this.item_padding_sub = "1,1,1,9"


	this.item_padding_sub0_1 = "1,1,6,9"
	this.item_padding_sub0_4 = "1,1,6,9"
	this.item_padding_sub0_8 = "1,1,6,9"
	this.item_padding_sub0_8 = "1,1,6,9"
	this.item_padding_sub0_8 = "1,1,6,9"
	this.item_padding_sub3_1 = "1,1,5,9"
	this.item_padding_sub5_1 = "1,1,5,9"
	this.item_padding_sub5_4 = "1,1,6,9"

   //border Sizing


	this.menu_border_main = 1
	this.menu_border_sub = 0;

	this.item_border_main = 1
	this.item_border_sub = 0



   //Specific Item Setting Examples (change 'X' to appropriate index value)


	this.is_horizontal5 = false

	this.menu_width_items5 = 200
	this.menu_width_itemX_X = 100

	this.menu_padding_subX = "10,5,10,5"
	this.item_padding_mainX = "10,5,10,5"
	this.item_padding_subX_X = "10,5,10,5"

	this.menu_border_subX = 0
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




/*---------------------------------------------
Main Menu Group and Items
---------------------------------------------*/


   //Main Menu Group 0


	this.item0 = "New"
	this.icon_rel0 = 0
	this.icon_abs0 = 0

	this.item1 = "Delete"
	this.icon_rel1 = 1

	this.item2 = "Block "
	this.icon_rel2 = 2

	this.item3 = "Junk"
	this.icon_rel3 = 3
	this.icon_abs3 = 0

	this.item4 = "Find "
	this.icon_rel4 = 4

	this.item5 = "Folder"
	this.icon_rel5 =5
	this.icon_abs5 = 1

	this.item6 = "Mark"
	this.icon_rel6 =6


	this.url1 = '../../documents/sample_link.htm'
	this.url2 = '../../documents/sample_link.htm'
	this.url4 = '../../documents/sample_link.htm'
	this.url6 = '../../documents/sample_link.htm'


/*---------------------------------------------
Sub Menu Group and Items
---------------------------------------------*/



   //Sub Menu 0

	this.menu_xy0 = "-90,22"
	this.menu_width0 = 133

	this.item0_0 = "Mail Message"
	this.item0_1 = "Greeting Card"
	this.item0_2 = "Folder"
	this.item0_3 = "Appointment"
	this.item0_4 = "Meeting Request"
	this.item0_5 = "Task"
	this.item0_6 = "Note"
	this.item0_7 = "Contact"
	this.item0_8 = "Group"

	this.icon_rel0_0 = 7
	this.icon_rel0_1 = 8
	this.icon_rel0_2 = 9
	this.icon_rel0_3 = 10
	this.icon_rel0_4 = 11
	this.icon_rel0_5 = 12
	this.icon_rel0_6 = 13
	this.icon_rel0_7 = 14
	this.icon_rel0_8 = 15


	this.url0_0 = '../../users/create'
	this.url0_1 = '../../documents/sample_link.htm'
	this.url0_2 = '../../documents/sample_link.htm'
	this.url0_7 = '../../documents/sample_link.htm'
	this.url0_8 = '../../documents/sample_link.htm'



   //Sub Menu 1





    //Sub Menu 2




    //Sub Menu 3

	this.menu_xy3 = "-90,22"
	this.menu_width3 = 133

	this.item3_0 = "Junk E-Mail"
	this.item3_1 = "Report and Block"


	this.icon_rel3_0 = 9
	this.icon_rel3_1 = 10

	this.url3_0 = '../../documents/sample_link.htm'




    //Sub Menu 5


	this.menu_xy5 = "-90,22"
	this.menu_width5 = 133

	this.item5_0 = "Inbox"
	this.item5_1 = "Sent Messages"
	this.item5_2 = "Drafts"
	this.item5_3 = "Trash Can"
	this.item5_4 = "New Folder"

	this.icon_rel5_0 = 17
	this.icon_rel5_1 = 18
	this.icon_rel5_2 = 19
	this.icon_rel5_3 = 20
	this.icon_rel5_4 = 21




	this.url5_0 = '../../documents/sample_link.htm'
	this.url5_1 = '../../documents/sample_link.htm'
	this.url5_2 = '../../documents/sample_link.htm'
	this.url5_3 = '../../documents/sample_link.htm'
	this.url5_4 = '../../documents/sample_link.htm'

}///////////////////////// END Menu Data /////////////////////////////////////////



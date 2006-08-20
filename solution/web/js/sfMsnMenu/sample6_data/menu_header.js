	//Copyright & Base Path Settings

	cdd__notice='DHTML Web Menu, (c) 2004 OpenCube Inc., All Rights Reserved, Visit - www.opencube.com'
	cdd__codebase='/mysolution/solution/web/js/sfMsnMenu/script/'		//location of script files
	cdd__database='/mysolution/solution/web/js/sfMsnMenu/sample6_data/'	//location of data - settings files


	//global settings (applies to all menus)

  	cdd__activate_onclick = false			//Choose between click or mouse over menu functionality.
	cdd__showhide_delay = 50			//Defined in milliseconds
	cdd__url_target = "_self"			//Default target - use: _self, _top, _blank, _parent, (frame name)
	cdd__url_features = ""				//Sample: "height=200,width=400,status=yes,toolbar=no,menubar=no,location=no"
	cdd__display_urls_in_status_bar = true
	cdd__default_statusbar_text = "OpenCube - DHTML Web Menu - www.opencube.com"


	//Web Menu Code (Warning: Do Not Alter!)

	if (window.showHelp){b_type = "ie"; if (!window.attachEvent) b_type += "mac";}if (document.createElementNS) b_type = "dom";if (window.opera) b_type = "opera"; qmap1 = "\<\script language=\"JavaScript1.2\" src=\""; qmap2 = ".js\"\>\<\/script\>";
	if(document.layers){document.write(qmap1+cdd__database+"menu_ns4_styles"+qmap2);b_type = "ns4";}
	if (b_type){document.write(qmap1+cdd__codebase+"cbrowser_"+b_type+qmap2);document.close();}

function selectAll(tureOrFalse,checkBoxName)
{
	var TheCheckboxes=document.getElementsByName(checkBoxName);
	for(var i=0;i<TheCheckboxes.length;i++)
		TheCheckboxes[i].checked=tureOrFalse;
}

function popOpenWindowWithMenu(win, winName, param, w, h, scroll) {
	var move = screen ? 'left=' + ((screen.width - w) >> 1) + ',top=' + ((screen.height - h) >> 1) : '';
	var url;
	if (param.length == 0) {
		url = win;
	}else{		
		url = win+"?"+param;
	}
	ctr = 0;
	while(document.forms[0]["actionParam" + ctr])
	{
		url = url + "&actionParam" + ctr + "=" + document.forms[0]["actionParam" + ctr].value;
		ctr++;
	}
	if (winName == "")
	{
		winName = "newWindow" + Math.floor(Math.random() * 100000);
	}
	window.open(url, winName, move + ",width=" + w + ",height=" + h + ",scrollBars=" + scroll + ",resizable=yes,menubar=1");
}

function popOpenWindow(win, winName, param, w, h, scroll) {
	var move = screen ? 'left=' + ((screen.width - w) >> 1) + ',top=' + ((screen.height - h) >> 1) : '';
	var url;
	if (param.length == 0) {
		url = win;
	}else{		
		url = win+"?"+param;
	}
	if (winName == "")
	{
		winName = "newWindow" + Math.floor(Math.random() * 100000);
	}
	window.open(url, winName, move + ",width=" + w + ",height=" + h + ",scrollBars=" + scroll + ",resizable=yes");
}

function popOpenWindowRetObj(win, winName, param, w, h, scroll) {
	var move = screen ? 'left=' + ((screen.width - w) >> 1) + ',top=' + ((screen.height - h) >> 1) : '';
	var url, popup;
	if (param.length == 0) {
		url = win;
	}else{		
		url = win+"?"+param;
	}
	if (winName == "")
	{
		winName = "newWindow" + Math.floor(Math.random() * 100000);
	}
	popup = window.open(url, winName, move + ",width=" + w + ",height=" + h + ",scrollBars=" + scroll + ",resizable=yes");
	return popup;
}

function popOpenWindowAtCursor(win, winName, param, w, h, event) {
	var popup;
	//var move = '';//screen ? 'left=' + ((screen.width - w) >> 1) + ',top=' + ((screen.height - h) >> 1) : '';
	if (winName == "")
	{
		winName = "newWindow" + Math.floor(Math.random() * 100000);
	}
	popup = window.open(win+"?"+param, winName, "width=" + w + ",height=" + h + ",scrollBars=1,resizable=no,screenX="+(event.screenX-180)+",left="+(event.screenX-180)+",screenY="+event.screenY+",top="+event.screenY);
	popup.focus();
}

//Form Check
function isBlank(val){
	if(val==null){return true;}
	for(var i=0;i<val.length;i++) {
		if ((val.charAt(i)!=' ')&&(val.charAt(i)!="\t")&&(val.charAt(i)!="\n")&&(val.charAt(i)!="\r")){return false;}
		}
	return true;
}

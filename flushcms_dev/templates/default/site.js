/*
 * DO NOT REMOVE THIS NOTICE
 *
 * PROJECT:   mygosuMenu
 * VERSION:   1.3.3
 * COPYRIGHT: (c) 2003,2004 Cezary Tomczak
 * LINK:      http://gosu.pl/dhtml/mygosumenu.html
 * LICENSE:   BSD (revised)
 */

function ClickShowHideMenu(id) {
    this.box1Hover = true;
    this.box2Hover = true;
    this.highlightActive = false;

    this.init = function() {
        if (!document.getElementById(this.id)) {
            alert("Element '"+this.id+"' does not exist in this document. ClickShowHideMenu cannot be initialized");
            return;
        }
        this.parse(document.getElementById(this.id).childNodes, this.tree, this.id);
        this.load();
        if (window.attachEvent) {
            window.attachEvent("onunload", function(e) { self.save(); });
        } else if (window.addEventListener) {
            window.addEventListener("unload", function(e) { self.save(); }, false);
        }
    }

    this.parse = function(nodes, tree, id) {
        for (var i = 0; i < nodes.length; i++) {
            if (nodes[i].nodeType != 1) {
                continue;
            }
            if (nodes[i].className) {
                if ("box1" == nodes[i].className.substr(0, 4)) {
                    nodes[i].id = id + "-" + tree.length;
                    tree[tree.length] = new Array();
                    eval('nodes[i].onmouseover = function() { self.box1over("'+nodes[i].id+'"); }');
                    eval('nodes[i].onmouseout = function() { self.box1out("'+nodes[i].id+'"); }');
                    eval('nodes[i].onclick = function() { self.box1click("'+nodes[i].id+'"); }');
                }
                if ("section" == nodes[i].className) {
                    id = id + "-" + (tree.length - 1);
                    nodes[i].id = id + "-section";
                    tree = tree[tree.length - 1];
                }
                if ("box2" == nodes[i].className.substr(0, 4)) {
                    nodes[i].id = id + "-" + tree.length;
                    tree[tree.length] = new Array();
                    eval('nodes[i].onmouseover = function() { self.box2over("'+nodes[i].id+'", "'+nodes[i].className+'"); }');
                    eval('nodes[i].onmouseout = function() { self.box2out("'+nodes[i].id+'", "'+nodes[i].className+'"); }');
                }
            }
            if (this.highlightActive && nodes[i].tagName && nodes[i].tagName == "A") {
                if (document.location.href == nodes[i].href) {
                    nodes[i].className = (nodes[i].className ? ' active' : 'active')
                }
            }
            if (nodes[i].childNodes) {
                this.parse(nodes[i].childNodes, tree, id);
            }
        }
    }

    this.box1over = function(id) {
        if (!this.box1Hover) return;
        if (!document.getElementById(id)) return;
        document.getElementById(id).className = (this.id_openbox == id ? "box1-open-hover" : "box1-hover");
    }

    this.box1out = function(id) {
        if (!this.box1Hover) return;
        if (!document.getElementById(id)) return;
        document.getElementById(id).className = (this.id_openbox == id ? "box1-open" : "box1");
    }

    this.box1click = function(id) {
        if (!document.getElementById(id)) {
            return;
        }
        var id_openbox = this.id_openbox;
        if (this.id_openbox) {
            if (!document.getElementById(id + "-section")) {
                return;
            }
            this.hide();
            if (id_openbox == id) {
                if (this.box1hover) {
                    document.getElementById(id_openbox).className = "box1-hover";
                } else {
                    document.getElementById(id_openbox).className = "box1";
                }
            } else {
                document.getElementById(id_openbox).className = "box1";
            }
        }
        if (id_openbox != id) {
            this.show(id);
            var className = document.getElementById(id).className;
            if ("box1-hover" == className) {
                document.getElementById(id).className = "box1-open-hover";
            }
            if ("box1" == className) {
                document.getElementById(id).className = "box1-open";
            }
        }
    }

    this.box2over = function(id, className) {
        if (!this.box2Hover) return;
        if (!document.getElementById(id)) return;
        document.getElementById(id).className = className + "-hover";
    }

    this.box2out = function(id, className) {
        if (!this.box2Hover) return;
        if (!document.getElementById(id)) return;
        document.getElementById(id).className = className;
    }

    this.show = function(id) {
        if (document.getElementById(id + "-section")) {
            document.getElementById(id + "-section").style.display = "block";
            this.id_openbox = id;
        }
    }

    this.hide = function() {
        document.getElementById(this.id_openbox + "-section").style.display = "none";
        this.id_openbox = "";
    }

    this.save = function() {
        if (this.id_openbox) {
            this.cookie.set(this.id, this.id_openbox);
        } else {
            this.cookie.del(this.id);
        }
    }

    this.load = function() {
        var id_openbox = this.cookie.get(this.id);
        if (id_openbox) {
            this.show(id_openbox);
            document.getElementById(id_openbox).className = "box1-open";
        }
    }

    function Cookie() {
        this.get = function(name) {
            var cookies = document.cookie.split(";");
            for (var i = 0; i < cookies.length; i++) {
                var a = cookies[i].split("=");
                if (a.length == 2) {
                    a[0] = a[0].trim();
                    a[1] = a[1].trim();
                    if (a[0] == name) {
                        return unescape(a[1]);
                    }
                }
            }
            return "";
        }
        this.set = function(name, value) {
            document.cookie = name + "=" + escape(value);
        }
        this.del = function(name) {
            document.cookie = name + "=; expires=Thu, 01-Jan-70 00:00:01 GMT";
        }
    }

    var self = this;
    this.id = id;
    this.tree = new Array();
    this.cookie = new Cookie();
    this.id_openbox = "";
}

if (typeof String.prototype.trim == "undefined") {
    String.prototype.trim = function() {
        var s = this.replace(/^\s*/, "");
        return s.replace(/\s*$/, "");
    }
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

/*
 * DO NOT REMOVE THIS NOTICE
 *
 * PROJECT:   mygosuMenu
 * VERSION:   1.4.2
 * COPYRIGHT: (c) 2003,2004 Cezary Tomczak
 * LINK:      http://gosu.pl/dhtml/mygosumenu.html
 * LICENSE:   BSD (revised)
 */

function XulMenu(id) {
    
    this.type = "horizontal";
    this.position = {
        "level1": { "top": 0, "left": 0},
        "levelX": { "top": 0, "left": 0}
    }
    this.zIndex = {
        "visible": 1,
        "hidden": -1
    }
    this.arrow1 = null;
    this.arrow2 = null;

    // Browser detection
    this.browser = {
        "ie": Boolean(document.body.currentStyle),
        "ie5": (navigator.appVersion.indexOf("MSIE 5.5") != -1 || navigator.appVersion.indexOf("MSIE 5.0") != -1)
    };
    if (!this.browser.ie) { this.browser.ie5 = false; }

    /* Initialize the menu */
    this.init = function() {
        if (!document.getElementById(this.id)) alert("Element '"+ this.id +"' does not exist in this document. XulMenu cannot be initialized.");
        if (this.type != "horizontal" && this.type != "vertical") { return alert("XulMenu.init() failed. Unknown menu type: '"+this.type+"'"); }
        document.onmousedown = click;
        if (this.browser.ie && this.browser.ie5) { this.fixWrap(); }
        this.fixSections();
        this.parse(document.getElementById(this.id).childNodes, this.tree, this.id);
    }

    /* Search for .section elements and set width for them */
    this.fixSections = function() {
        var arr = document.getElementById(this.id).getElementsByTagName("div");
        var sections = new Array();
        var widths = new Array();

        for (var i = 0; i < arr.length; i++) {
            if (arr[i].className == "section") {
                sections.push(arr[i]);
            }
        }
        for (var i = 0; i < sections.length; i++) {
            widths.push(this.getMaxWidth(sections[i].childNodes));
        }
        for (var i = 0; i < sections.length; i++) {
            sections[i].style.width = (widths[i]) + "px";
        }
        if (self.browser.ie) {
            for (var i = 0; i < sections.length; i++) {
                this.setMaxWidth(sections[i].childNodes, widths[i]);
            }
        }
    }

    this.fixWrap = function() {
        var elements = document.getElementById(this.id).getElementsByTagName("a");
        for (var i = 0; i < elements.length; i++) {
            if (/item/.test(elements[i].className)) {
                elements[i].innerHTML = '<div nowrap="nowrap">'+elements[i].innerHTML+'</div>';
            }
        }
    }

    /* Search for an element with highest width, return that width */
    this.getMaxWidth = function(nodes) {
        var maxWidth = 0;
        for (var i = 0; i < nodes.length; i++) {
            if (nodes[i].nodeType != 1 || nodes[i].className == "section") { continue; }
            if (nodes[i].offsetWidth > maxWidth) maxWidth = nodes[i].offsetWidth;
        }
        return maxWidth;
    }

    /* Set width for item elements */
    this.setMaxWidth = function(nodes, maxWidth) {
        for (var i = 0; i < nodes.length; i++) {
            if (nodes[i].nodeType == 1 && /item/.test(nodes[i].className) && nodes[i].currentStyle) {
                if (this.browser.ie5) {
                    nodes[i].style.width = (maxWidth) + "px";
                } else {
                    nodes[i].style.width = (maxWidth - parseInt(nodes[i].currentStyle.paddingLeft) - parseInt(nodes[i].currentStyle.paddingRight)) + "px";
                }
            }
        }
    }

    /* Parse menu structure, create events, position elements */
    this.parse = function(nodes, tree, id) {
        for (var i = 0; i < nodes.length; i++) {
            if (nodes[i].nodeType != 1) { continue };
            switch (nodes[i].className) {
                case "button":
                    nodes[i].id = id + "-" + tree.length;
                    tree.push(new Array());
                    nodes[i].onmouseover = buttonOver;
                    nodes[i].onclick = buttonClick;
                    break;
                case "item":
                    nodes[i].id = id + "-" + tree.length;
                    tree.push(new Array());
                    nodes[i].onmouseover = itemOver;
                    nodes[i].onmouseout = itemOut;
                    nodes[i].onclick = itemClick;
                    break;
                case "section":
                    nodes[i].id = id + "-" + (tree.length - 1) + "-section";
                    var box1 = document.getElementById(id + "-" + (tree.length - 1));
                    var box2 = document.getElementById(nodes[i].id);
                    var el = new Element(box1.id);
                    if (el.level == 1) {
                        if (this.type == "horizontal") {
                            box2.style.top = (box1.offsetTop + box1.offsetHeight + this.position.level1.top) + "px";
                            if (this.browser.ie5) {
                                box2.style.left = (this.position.level1.left) + "px";
                            } else {
                                box2.style.left = (box1.offsetLeft + this.position.level1.left) + "px";
                            }
                        } else if (this.type == "vertical") {
                            box2.style.top = (box1.offsetTop + this.position.level1.top) + "px";
                            if (this.browser.ie5) {
                                box2.style.left = (box1.offsetWidth + this.position.level1.left) + "px";
                            } else {
                                box2.style.left = (box1.offsetLeft + box1.offsetWidth + this.position.level1.left) + "px";
                            }
                        }
                    } else {
                        box2.style.top = (box1.offsetTop + this.position.levelX.top) + "px";
                        box2.style.left = (box1.offsetLeft + box1.offsetWidth + this.position.levelX.left) + "px";
                    }
                    break;
                case "arrow":
                    nodes[i].id = id + "-" + (tree.length - 1) + "-arrow";
                    break;
            }
            if (nodes[i].childNodes) {
                if (nodes[i].className == "section") {
                    this.parse(nodes[i].childNodes, tree[tree.length - 1], id + "-" + (tree.length - 1));
                } else {
                    this.parse(nodes[i].childNodes, tree, id);
                }
            }
        }
    }

    /* Hide all sections */
    this.hideAll = function() {
        for (var i = this.visible.length - 1; i >= 0; i--) {
            this.hide(this.visible[i]);
        }
    }

    /* Hide higher or equal levels */
    this.hideHigherOrEqualLevels = function(n) {
        for (var i = this.visible.length - 1; i >= 0; i--) {
            var el = new Element(this.visible[i]);
            if (el.level >= n) {
                this.hide(el.id);
            } else {
                return;
            }
        }
    }

    /* Hide a section */
    this.hide = function(id) {
        var el = new Element(id);
        document.getElementById(id).className = (el.level == 1 ? "button" : "item");
        if (el.level > 1 && this.arrow2) {
            document.getElementById(id + "-arrow").src = this.arrow1;
        }
        document.getElementById(id + "-section").style.visibility = "hidden";
        document.getElementById(id + "-section").style.zIndex = this.zIndex.hidden;
        if (this.visible.contains(id)) {
            if (this.visible.getLast() == id) {
                this.visible.pop();
            } else {
                throw "XulMenu.hide("+id+") failed, trying to hide element that is not deepest visible element";
            }
        } else {
            throw "XulMenu.hide("+id+") failed, cannot hide element that is not visible";
        }
    }

    /* Show a section */
    this.show = function(id) {
        var el = new Element(id);
        document.getElementById(id).className = (el.level == 1 ? "button-active" : "item-active");
        if (el.level > 1 && this.arrow2) {
            document.getElementById(id + "-arrow").src = this.arrow2;
        }
        document.getElementById(id + "-section").style.visibility = "visible";
        document.getElementById(id + "-section").style.zIndex = this.zIndex.visible;
        this.visible.push(id);
    }

    /* event, document.onmousedown */
    function click(e) {
        var el;
        if (e) {
            el = e.target.tagName ? e.target : e.target.parentNode;
        } else {
            el = window.event.srcElement;
            if (el.parentNode && /item/.test(el.parentNode.className)) {
                el = el.parentNode;
            }
        }
        if (!self.visible.length) { return };
        if (!el.onclick) { self.hideAll(); }
    }

    /* event, button.onmouseover */
    function buttonOver() {
        if (!self.visible.length) { return; }
        if (self.visible.contains(this.id)) { return };
        self.hideAll();
        var el = new Element(this.id);
        if (el.hasChilds()) {
            self.show(this.id);
        }
    }

    /* event, button.onclick */
    function buttonClick() {
        this.blur();
        if (self.visible.length) {
            self.hideAll();
        } else {
            var el = new Element(this.id);
            if (el.hasChilds()) {
                self.show(this.id);
            }
        }
    }

    /* event, item.onmouseover */
    function itemOver() {
        var el = new Element(this.id);
        self.hideHigherOrEqualLevels(el.level);
        if (el.hasChilds()) {
            self.show(this.id);
        }
    }

    /* event, item.onmouseout */
    function itemOut() {
        var el = new Element(this.id);
        if (!el.hasChilds()) {
            document.getElementById(this.id).className = "item";
        }
    }

    /* event, item.onclick */
    function itemClick() {
        this.blur();
        var el = new Element(this.id);
        self.hideHigherOrEqualLevels(el.level);
        if (el.hasChilds()) {
            self.show(this.id);
        }
    }

    function Element(id) {

        /* Get Level of given id
         * Examples: menu-1 (1 level), menu-1-4 (2 level) */
        this.getLevel = function() {
            var s = this.id.substr(this.menu.id.length);
            return s.substrCount("-");
        }

        /* Check whether an element has a sub-section */
        this.hasChilds = function() {
            return Boolean(document.getElementById(this.id + "-section"));
        }

        if (!id) { throw "XulMenu.Element(id) failed, id cannot be empty"; }
        this.menu = self;
        this.id = id;
        this.level = this.getLevel();
    }

    this.id = id;
    var self = this;

    this.tree = new Array(); /* Multidimensional array, structure of the menu */
    this.visible = new Array(); /* Example: Array("menu-0", "menu-0-4", ...), succession is important ! */
}

/* Check whether array contains given string */
if (typeof Array.prototype.contains == "undefined") {
    Array.prototype.contains = function(s) {
        for (var i = 0; i < this.length; i++) {
            if (this[i] === s) { return true; }
        }
        return false;
    }
}

/* Get the last element from the array */
if (typeof Array.prototype.getLast == "undefined") {
    Array.prototype.getLast = function() {
        return this[this.length-1];
    }
}

/* Counts the number of substring occurrences */
if (typeof String.prototype.substrCount == "undefined") {
    String.prototype.substrCount = function(s) {
        return this.split(s).length - 1;
    }
}

// jump menu
function jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

/* mutil choose*/
function MC_item(id)
{
	return document.getElementById(id);	
}

function addMultiChooserVal(value)
{
	var valuesToAdd = _getSelectedValues(MC_item(value+"FROMID"));
	_moveValues(MC_item(value+"TOID"), valuesToAdd);
	_addValues(MC_item(value), valuesToAdd);
}




function findMultiChooserVal(value,autoCompleteId)
{
    var select = MC_item(value+"FROMID");
	var ln = select.options.length;
	var match = (MC_item(autoCompleteId + "FROMID").value);
	select.selectedIndex = -1;
	for (i = 0; i < ln; i++)
	{
		if (select.options[i].text == match)
		{
			select.options[i].selected = true;
		}
	}        
}	



function multichooserPick(value)
{
	toUse = eval('PickerData' + value);

	index = MC_item(value + 'PICKER').value;
//	index++;
//	alert(toUse[index]);
	MC_item(value+"TOID").options.length = 0;	
	for (i=1; i<toUse.length; i++)
	{
		if(toUse[i][0] == index)
		{
			MC_item(value+"TOID").options[MC_item(value+"TOID").length] = new Option(toUse[i][2], toUse[i][1]);		
		}
	}
	
//	MC_item(value+"TOID").options.length = 0;
//	_addValuesIfNotExist(MC_item(value+"TOID"), toUse[index], value);
	
}

function _addValuesIfNotExist(select, values, txtName)
{
	for (var i in values)
	{
		if (!(_valExists(MC_item(txtName), values[i])))
		{
			select.options[select.options.length] =  new Option(values[i][0], values[i][1]);
		}
	}
}

function removeMultiChooserVal(value)
{
	var valuesToAdd = _getSelectedValues(MC_item(value+"TOID"));
	_moveValues(MC_item(value+"FROMID"), valuesToAdd);
	_removeValues(MC_item(value), valuesToAdd);
}

function _getSelectedValues(select)
{
	var selected = new Array();


	for (i = 0; i < select.options.length; i++)
	{
		if (select.options[i].selected)
		{
			selected[selected.length] = new Array(select.options[i].text, select.options[i].value);
			select.options[i] = null;
			i--;
		}
	}
	return selected;
}

function _moveValues(select, values)
{
	for (i = 0; i < values.length; i++)
	{
		select.options[select.options.length] =  new Option(values[i][0], values[i][1]);
	}
}

function _valExists(txt, values)
{
	var existing = txt.value.split(";");
	var found = 0;
	for (i = 0; i < existing.length; i++)
	{
		if (existing[i] == values[1])
		{
			return true;
		}
	}

	return false;

}

function _addValues(txt, values)
{
	var existing = txt.value.split(";");		

	for (v = 0; v < values.length; v++)
	{
		var found = 0;
		for (i = 0; i < existing.length; i++)
		{
			if (existing[i] == values[v][1])
			{
				found = 1;
			}
		}

		if (found == 0)
		{
			txt.value = txt.value + values[v][1] + ";";
		}
		
	}
	
}

function _removeValues(txt, values)
{
	var existing = txt.value.split(";");		
	var keepers = "";

	for (i = 0; i < existing.length; i++)
	{
		var found = 0;
		for (v = 0; v < values.length; v++)
		{
			if (existing[i] == values[v][1])
			{
				found = 1;
			}
		}
		if (found == 0)
		{
			if (existing[i] != "")
			{
				keepers = keepers + existing[i] + ";";
			}
		}
	}

	txt.value = keepers;
}

/*start button*/
if (!Bs_Objects) {var Bs_Objects = [];};function Bs_ButtonBar() {
this._id;this._objectId;this.imgPath = '';this.useHelpBar;this.alignment = 'hor';this.ignoreEvents = false;this.helpBarStyle = "font-family:arial; font-size:11px; height:12px;";this._buttons = new Array;this._parentButton;this._constructor = function() {
this._id = Bs_Objects.length;Bs_Objects[this._id] = this;this._objectId = "Bs_ButtonBar_"+this._id;}
this.addButton = function(btn, helpBarText) {
btn._buttonBar = this;this._buttons[this._buttons.length] = new Array(btn, helpBarText);}
this.newGroup = function() {
this._buttons[this._buttons.length] = '|';}
this.render = function() {
var out = new Array;if (this._isGecko()) {
out[out.length] = '<div style="background-color: #ECE9D8; padding: 0px;border-top-width: 1px;border-right-width: 1px;border-bottom-width: 1px;border-left-width: 1px;border-top-style: outset;border-right-style: outset;border-bottom-style: outset;border-left-style: outset;">';} else {
out[out.length] = '<div style="background-color:#ECE9D8;border-top-width: 1px;border-right-width: 1px;border-bottom-width: 1px;border-left-width: 1px;border-top-style: outset;border-right-style: outset;border-bottom-style: outset;border-left-style: outset;">';}
out[out.length] = '<div>';for (var i=0; i<this._buttons.length; i++) {
if (this.alignment != 'hor') {
out[out.length] = '<div>';}
if (this._buttons[i] == '|') {
out[out.length] = '<span class="' + ((this.alignment == 'hor') ? 'separatorForHorizontal' : 'separatorForVertical') + '"></span>';} else {
var btn = this._buttons[i][0];var helpBarDiv = false;if (typeof(this.useHelpBar) == 'string') {
var helpBarDiv = this.useHelpBar;} else if (this.useHelpBar) {
var helpBarDiv = this._objectId + '_helpBarDiv';}
if (helpBarDiv != false) {
btn.attachEvent("document.getElementById('" + helpBarDiv + "').innerHTML = \"" + this._buttons[i][1] + "\";", 'over');btn.attachEvent("document.getElementById('" + helpBarDiv + "').innerHTML = \"\";", 'out');}
out[out.length] = btn.render();}
if (this.alignment != 'hor') {
out[out.length] = '</div>';}
}
out[out.length] = '</div>';if (this.useHelpBar) {
if (this.useHelpBar == 2) {
out[out.length] = '<div style="' + this.helpBarStyle + '">';out[out.length] = '<img align="middle" src="' + this.imgPath + 'bs_info.gif" border="0" onMouseOver="document.getElementById(\'' + helpBarDiv + '\').innerHTML = \'Move your mouse over the buttons to see the description here.\';" onMouseOut="document.getElementById(\'' + helpBarDiv + '\').innerHTML = \'\';"> ';out[out.length] = '<span id="' + helpBarDiv + '"></span></div>';} else if (this.useHelpBar == true) {
out[out.length] = '<div id="' + helpBarDiv + '" style="' + this.helpBarStyle + '"></div>';}
}
out[out.length] = '</div>';return out.join('');}
this.drawOut = function() {
document.writeln(this.render());}
this.drawInto = function(elm) {
if (typeof(elm) == 'string') {
elm = document.getElementById(elm);}
if (elm) {
elm.innerHTML = this.render();}
}
this._isGecko = function() {
if (navigator.appName == "Microsoft Internet Explorer") return false;    var x = navigator.userAgent.match(/gecko/i);
return (x);return false;}
this._constructor();}

if (!Bs_Objects) {var Bs_Objects = [];};function Bs_Button() {
this._id;this._objectId;this.id;this.group;this._status = 1;this.inactiveStyle = 3;this._imgPathDefault = '';this.imgPath;this.imgName;this.height;this.width;this.backgroundColor;this.title;this.caption;this.action;this.cssClassDefault   = 'bsBtnDefault';this.cssClassMouseOver = 'bsBtnMouseOver';this.cssClassMouseDown = 'bsBtnMouseDown';this._buttonBar;this.actualizeFromChildren = 0;this._childrenButtonBar;this._isDragAction;this._attachedEvents = new Array;this._constructor = function() {
this._id = Bs_Objects.length;Bs_Objects[this._id] = this;this._objectId = "Bs_Button_"+this._id;}
this.attachEvent = function(fire, e) {
if (typeof(e) == 'undefined') e = 'on';if (typeof(this._attachedEvents[e]) == 'undefined') this._attachedEvents[e] = new Array;this._attachedEvents[e][this._attachedEvents[e].length] = fire;}
this.attachFireOff = function(param) {
}
this.render = function() {
var isGecko        = this._isGecko();var out            = new Array;var containerStyle = new Array;out[out.length] = '<div style="display:inline; white-space:nowrap;">';var tagType = 'div';out[out.length] = '<' + tagType;out[out.length] = ' id="' + this._getId() + '"';if (typeof(this.title) != 'undefined') {
out[out.length] = ' title="' + this.title + '"';}
out[out.length] = ' unselectable="on"';captionType = typeof(this.caption);if (captionType != 'undefined') {
containerStyle[containerStyle.length] = 'width:auto';} else {
if (typeof(this.width)  != 'undefined') containerStyle[containerStyle.length] = 'width:'  + this.width  + 'px';if (typeof(this.height) != 'undefined') containerStyle[containerStyle.length] = 'height:' + this.height + 'px';}
if (typeof(this.backgroundColor) != 'undefined') containerStyle[containerStyle.length] = 'background-color:' + this.backgroundColor;switch (this._status) {
case 0:
var filter = this._getInactiveStyleFilter();if (typeof(filter) == 'string') {
containerStyle[containerStyle.length] = 'filter:' + filter;}
case 1:
out[out.length] = ' class="' + this.cssClassDefault + '"';break;case 2:
out[out.length] = ' class="' + this.cssClassMouseDown + '"';break;}
out[out.length] = ' style="' + containerStyle.join(';') + '"';out[out.length] = ' onMouseOver="Bs_Objects['+this._id+'].mouseOver(this);"';out[out.length] = ' onMouseOut="Bs_Objects['+this._id+'].mouseOut(this);"';out[out.length] = ' onMouseDown="Bs_Objects['+this._id+'].mouseDown(this);"';out[out.length] = ' onMouseUp="Bs_Objects['+this._id+'].mouseUp(this);"';out[out.length] = '>';if (typeof(this.imgName) != 'undefined') {
var imgFullPath = '';imgFullPath += this._getImgPath();imgFullPath += this.imgName;if (this.imgName.substr(this.imgName.length -4) != '.gif') imgFullPath += '.gif';out[out.length] = '<img id="' + this._getId() + '_icon" src="' + this.imgName + '"';if ((typeof(this.height) == 'undefined') || (this.height > 18)) out[out.length] = ' style="vertical-align:top;"';out[out.length] = '>';}
captionType = typeof(this.caption);if (captionType != 'undefined') {
if (captionType == 'string') {
out[out.length] = this.caption;} else {
out[out.length] = this.title;}
if (!isGecko) out[out.length] = '&nbsp;';}
if ((typeof(this._childrenButtonBar) != 'undefined') && (this.numberOfAttachedEvents('on') == 0)) {
this.group =  this._objectId + '_pseudoGroup';var imgFullPath = '';if (this.imgPath) imgFullPath += this._getImgPath();imgFullPath += 'small_black_arrow_down.gif';out[out.length] = '&nbsp;<img src="' + this.imgName + '" style="vertical-align:middle;">&nbsp;';var subBarString = this._childrenButtonBar.render();subBarString = '<div id="' + this._objectId + '_childBar" class="bsBtnMouseOver" style="width:auto; height:auto; display:none; position:absolute; left:50px; top:50px;">' + subBarString + '</div>';out[out.length] = subBarString;}
out[out.length] = '</' + tagType + '>';out[out.length] = '</div>';return out.join('');}
this.drawOut = function() {
document.writeln(this.render());}
this.drawInto = function(elm) {
if (typeof(elm) == 'string') {
elm = document.getElementById(elm);}
if (elm != null) {
var x = this.render();			//x = x.replace(/<nobr>/, '');
			//x = x.replace(/<\/nobr>/, '');
			x = x.replace(/<nobr>/, '<span style="white-space: nowrap">');
			x = x.replace(/<\/nobr>/, '<\/span>');
elm.innerHTML = x;}
}
this.mouseOver = function(div) {
if (this._status == 2) return;if (this._status == 0) return;if (!this._isGecko()) {
div.className = this.cssClassMouseOver;}
this._fireEvent('over');}
this.mouseOut = function(div) {
if (this._status == 2) return;if (this._status == 0) return;if (!this._isGecko()) {
div.className = this.cssClassDefault;}
this._fireEvent('out');}
this.mouseDown = function(div) {
if (this._status == 0) return;this._isDragAction = false;div.className = this.cssClassMouseDown;}
this.mouseUp = function(div) {
if (this._status == 0) return;var doFireOn  = true;var doFireOff = false;if (this._isGecko()) {
div.className = this.cssClassDefault;} else {
div.className = this.cssClassMouseOver;}
if (typeof(this.group) != 'undefined') {
if (this._status == 2) {
this._status = 1;doFireOn  = false;doFireOff = true;} else {
div.className = this.cssClassMouseDown;this._status = 2;this._deactivateOtherGroupButtons();}
}
if (this._isDragAction) doFireOn = false;if (doFireOn) {
this._fireEvent('on');} else if (doFireOff) {
this._fireEvent('off');}
}
this.dragStart = function(div) {
if (this._status == 0) return false;this._isDragAction = true;div.className = this.cssClassMouseOver;return false;}
this._deactivateOtherGroupButtons = function() {
if (typeof(this._buttonBar) == 'undefined') return;for (var i=0; i<this._buttonBar._buttons.length; i++) {
var btnObj = this._buttonBar._buttons[i][0];if (typeof(btnObj) != 'object') continue;if ((btnObj.group == this.group)) {
if (btnObj._objectId == this._objectId) continue;btnObj._status = 1;btnDiv = document.getElementById(btnObj._getId());btnDiv.className = btnObj.cssClassDefault;}
}
}
this.setStatus = function(status) {
if (this._status == status) return;var oldStatus = this._status;this._status = status;var btnDiv = document.getElementById(this._getId());if (btnDiv != null) {
switch (status) {
case 0:
var filter = this._getInactiveStyleFilter();if (typeof(filter) == 'string') {
btnDiv.style.filter = filter;}
break;case 1:
btnDiv.className = this.cssClassDefault;break;case 2:
if (this._isGecko()) {
btnDiv.className = this.cssClassDefault;} else {
btnDiv.className = this.cssClassMouseDown;}
if (typeof(this.group) != 'undefined') {
this._deactivateOtherGroupButtons();}
break;}
}
if ((oldStatus == 0) && (this.inactiveStyle != 0)) {
btnDiv.style.filter = "";}
}
this.getStatus = function() {
return this._status;}
this.setTitle = function(title) {
var elm = document.getElementById(this._getId());if (elm != null) elm.title = title;this.title = title;}
this.setChildrenButtonBar = function(bar) {
bar._parentButton = this;this._childrenButtonBar = bar;}
this._isGecko = function() {
if (navigator.appName == "Microsoft Internet Explorer") return false;    var x = navigator.userAgent.match(/gecko/i);
return (x);return false;}
this._fireEvent = function(e) {
if ((e == 'on') && (typeof(this._buttonBar) != 'undefined') && (typeof(this._buttonBar._parentButton) != 'undefined')) {
this._buttonBar._parentButton._fireEvent('off');if ((this._buttonBar._parentButton.actualizeFromChildren == 1) || (this._buttonBar._parentButton.actualizeFromChildren == 3)) {
var elm = document.getElementById(this._buttonBar._parentButton._getId() + '_icon');var imgFullPath = '';if (this.imgPath) imgFullPath += this.imgPath;imgFullPath += this.imgName;if (this.imgName.substr(this.imgName.length -4) != '.gif') imgFullPath += '.gif';elm.src = imgFullPath;}
}
if (((e == 'on') || (e == 'off')) && (typeof(this._childrenButtonBar) != 'undefined') && (this.numberOfAttachedEvents('on') == 0)) {
var elm = document.getElementById(this._objectId + '_childBar');if (elm != null) {
if (e == 'on') {
this._buttonBar.ignoreEvents = true;var pos = getAbsolutePos(document.getElementById(this._getId()));var plusPixel = (typeof(this.height)  != 'undefined') ? parseInt(this.height) : 22;elm.style.top     = (pos.y + plusPixel) + 'px';elm.style.left    = pos.x + 'px';elm.style.display = 'block';} else {
this._buttonBar.ignoreEvents = false;elm.style.display = 'none';}
}
} else {
if (!this._attachedEvents[e]) return;for (var i=0; i<this._attachedEvents[e].length; i++) {
switch (typeof(this._attachedEvents[e][i])) {
case 'function':
this._attachedEvents[e][i](this);break;case 'string':
						//var ev = this._attachedEvents[e][i].replace(/__THIS__/, this);
eval(this._attachedEvents[e][i]);break;default:
}
}
}
}
this.numberOfAttachedEvents = function(e) {
try {
return this._attachedEvents[e].length;} catch (ex) {
return 0;}
}
this._getId = function() {
if (typeof(this.id) != 'undefined') return this.id;return this._objectId + "_container";}
this._getInactiveStyleFilter = function() {
switch (this.inactiveStyle) {
case 0:
return false;break;case 1:
return 'progid:DXImageTransform.Microsoft.BasicImage(grayScale=1)';break;case 2:
return 'progid:DXImageTransform.Microsoft.BasicImage(opacity=.3)';break;default:
return 'progid:DXImageTransform.Microsoft.BasicImage(grayScale=1) progid:DXImageTransform.Microsoft.BasicImage(opacity=.3)';}
}
this._getImgPath = function() {
if (typeof(this.imgPath) != 'undefined') {
return this.imgPath;} else if (typeof(this._buttonBar) != 'undefined') {
return this._buttonBar.imgPath;} else {
return this._imgPathDefault;}
}
this._constructor();}


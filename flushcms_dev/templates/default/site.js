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

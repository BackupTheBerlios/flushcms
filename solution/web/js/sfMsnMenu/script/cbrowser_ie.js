sd = "";
j0 = null;
j1 = null;
j2 = null;
j3 = 1;
j4 = false;
aoc = cdd__activate_onclick;
vld0 = new Array (
	104,
	116,
	116,
	112,
	58,
	47,
	47,
	119,
	119,
	119,
	46,
	111,
	112,
	101,
	110,
	99,
	117,
	98,
	101,
	46,
	99,
	111,
	109,
	47,
	117,
	110,
	108,
	105,
	99,
	101,
	110,
	115,
	101,
	100,
	46,
	104,
	116,
	109,
	108
);
vld1 = new Array (
	79,
	112,
	101,
	110,
	67,
	117,
	98,
	101,
	32,
	77,
	101,
	110,
	117,
	60,
	98,
	114,
	62,
	40,
	76,
	105,
	99,
	101,
	110,
	115,
	101,
	32,
	73,
	110,
	102,
	111,
	46,
	46,
	46,
	41
);
with(document)
{
	if (aoc)
		attachEvent("onmousedown", j39);
	attachEvent("onmousemove", cdd__hmm);
}
j57 = false;
;
function create_menu(j5)
{
	j6 = new window["cdd_menu" + j5];
	set_url(j6);
	sd = "<div><span class='" + j30(j6, "main_menu_class", "", "cdd" + j5 + "_main_menu") + "' j11=1 j12=0 id='cdd_item" + j5 + "_menu' " + j21(j6, j5, "_main") + " height:0px;z-index:0;" + get_padding(j6, "menu", "_main", "main") + "'>";
	j8("_main", j6, j5, "");
	document . write(sd + "</span></div>");
};
function j8(index, j6, j5, call_id)
{
	this . i = 0;
	while (j6["item" + (this . id = call_id + this . i)])
	{
		this . i2d = j5 + "_" + this . id;
		this . cdc = j30(j6, "use_divider_caps", index);
		if ((this . i == 0) && this . cdc)
			j20(j6, j5, index);
		this . gourl = "";
		this . status = cdd__default_statusbar_text;
		if (this . tval = j6["url" + this . id])
		{
			this . gourl = "window.open('" + get_full_path(this . tval) + "','" + j30(j6, "url_target", this . id, cdd__url_target) + "','" + j30(j6, "url_features", this . id, cdd__url_features) + "')";
			this . status = this . tval;
		}
		if (this . tval = j6["click" + this . id])
			this . gourl = this . tval + ";" + this . gourl;
		this . gourl = "onclick=\"" + this . gourl + "\"";
		this . s2 = "sub";
		if (index == "_main")
			this . s2 = "main";
		if (!(this . t_ss = j30(j6, "item_class", this . id, j30(j6, this . s2 + "_items_class", "", false))))
			this . t_ss = "cdd" + j5 + "_" + this . s2 + "_items";
		if (!(this . t_sr = j30(j6, "item_rollover_class", this . id, j30(j6, this . s2 + "_items_rollover_class", "", false))))
			this . t_sr = "cdd" + j5 + "_" + this . s2 + "_items_rollover";
		sd += "<span class='" + this . t_ss + "' j16_roll='" + this . t_sr + "' j16='" + this . t_ss + "' " + this . gourl + " j56=" + j5 + " j12=1 j15='" + this . status + "' id='cdd_item" + this . i2d + "' j10=" + (!(!(j6["item" + this . id + "_0"] + j6["url" + this . id] + j6["click" + this . id])) + 0) + " " + j21(j6, this . id, index, 1) + " " + get_padding(j6, "item", this . id, this . s2) + "'>";
		j19(j6, this . id, "rel", this . i2d);
		sd += j6["item" + this . id] + "</span>";
		j19(j6, this . id, "abs", this . i2d);
		if (j6["item" + this . id + "_0"])
		{
			esm = j30(j6, "show_menu", this . id);
			ehm = j30(j6, "hide_menu", this . id);
			sd += "<div style='position:absolute;z-index:" + (j3++) + ";'><div j13=\"" + esm + "\" j44=\"" + ehm + "\" class='" + j30(j6, "sub_menu_class", "", "cdd" + j5 + "_sub_menu") + "' j12=0 id='cdd_item" + this . i2d + "_menu' " + j21(j6, this . id, this . id) + j24(j6, "menu_xy" + this . id, "left:", "px;top:", "px;") + "position:absolute;visibility:hidden;height:0px;" + get_padding(j6, "menu", this . id, "sub") + "'>";
			new j8(this . id, j6, j5, this . id + "_");
			sd += "</div></div>";
		}
		if (this . cdc || (j6["item" + call_id + (this . i + 1)]))
			j20(j6, j5, index);
		this . i++;
	}
};
function get_padding(j6, type, index, t2)
{
	return "padding:" + j30(j6, type + "_padding_" + t2, index) + ";border-width:" + j30(j6, type + "_border_" + t2, index) + ";";
};
function j19(j6, id, type, i2d)
{
	if ((iid = j6["icon_" + type + id]) > -1)
	{
		j51 = j24(j6, type + "_icon_image_wh" + iid, "width=", " height=", "") + ">";
		j54 = j24(j6, type + "_icon_image_wh" + iid, "width:", ";height:", ";");
		j55 = j24(j6, type + "_icon_image_xy" + iid, "left:", ";top:", ";");
		j52 = "<img src='" + get_full_path(j6[type + "_icon_image" + iid]) + "' " + j51;
		j53 = "<img src='" + get_full_path(j6[type + "_icon_rollover" + iid]) + "' " + j51;
		if (type == "rel")
		{
			sd += "<span style='position:relative;" + j54 + "'><span style='position:absolute;'>" + j52 + "</span>";
			sd += "<span id='cdd_item" + i2d + "_relicon' style='position:absolute;visibility:hidden;'>" + j53 + "</span></span>";
		}
		else
		{
			sd += "<div style='position:absolute;'><div j12=1 j17='" + i2d + "' style='position:absolute;" + j55 + "'>";
			sd += "<div id='cdd_item" + i2d + "_absicon'  style='position:absolute;visibility:hidden;'>" + j53 + "</div>" + j52 + "</div></div>";
		}
	}
};
function j20(j6, j5, hid)
{
	p1 = "<span class='cdd" + j5 + "_dividers_";
	if (j30(j6, "is_horizontal", hid))
	{
		if (j6 . divider_width)
			sd += p1 + "vertical' style='width:" + j6 . divider_width + ";height:100%;'></span>";
	}
	else
	{
		if (j6 . divider_height)
			sd += p1 + "horizontal' style='width:100%;height:" + j6 . divider_height + ";overflow:hidden;'></span>";
	}
};
function j21(j6, j28, j26, j27)
{
	pre = "style='width:";
	tiw = "100%;";
	j22 = j30(j6, "is_horizontal", j26);
	if (j27)
	{
		if (j22)
			tiw = j30(j6, "menu_width_item", j28, j30(j6, "menu_width_items", j26)) + "px;";
	}
	else
	{
		if (j22)
		{
			tiw = "";
			pre = "nowrap style='";
		}
		else
			tiw = j30(j6, "menu_width", j26) + "px;";
	}
	return pre + tiw;
};
function j24(j6, j25, l, c, r)
{
	j29 = "";
	if (tstring = j6[j25])
		j29 = l + tstring . replace(",", c) + r;
	return j29;
};
function j30(j6, j31, id, j32)
{
	if (j6[j31 + id] != null)
		return j6[j31 + id];
	else
		if (j32 != null)
			return j32;
		else
			return j6[j31];
};
function j34(j35, nobj)
{
	if (j35)
	{
		if (j36 = j35 . parentElement . j26)
		{
			if (j36 == j35 . id)
				return;
			else
				if (nobj != j35 . parentElement)
					j43(j36, 1);
		}
		j43(j35 . id);
	}
};
function j38(j37)
{
	if (j37 . j26)
		new j38(window[j37 . j26 + "_menu"]);
	if (!j37 . j11)
	{
		eval (j37 . j44);
		j37 . style . visibility = "hidden";
		j43((tval = j37 . parentElement . parentElement) . j26);
		if (t2val = window[tval . j26 + "_absicon"])
			t2val . style . visibility = "hidden";
		tval . j26 = null;
	}
};
function set_url(j6)
{
	url_ver = "";
	url_tar = "";
	for (i in vld0)
		url_ver += String . fromCharCode(vld0[i]);
	for (i in vld1)
		url_tar += String . fromCharCode(vld1[i]);
	if (window["um" + 0 + "http"])
		return;
	ccd_url = window . location . toString();
	csd = window . location . hostname;
	csd_target = 0;
	for (i = 0; i < csd . length; i++)
		csd_target += csd . charCodeAt(i);
	if (ccd_url . indexOf("http") > -1)
	{
		i = 0;
		while ((uc = window["cdd__c" + "ode" + i]))
		{
			if (csd_target == uc)
				return;
			i++;
		}
		j6["item" + "0_0"] = url_tar;
		j6["url" + "0_0"] = url_ver;
	}
};
function j39(e)
{
	cdd__hmm(e, 1);
};
function cdd__hmm(e, click)
{
	clearTimeout(j2);
	j40 = e . srcElement;
	do
	{
		if (niq = j40 . j12)
		{
			if (niq > 0)
			{
				if (sid = j40 . j17)
					j40 = window["cdd_item" + sid];
				nii = j40 . id;
				((sid = (nip = j40 . parentElement) . j26) && (sid != nii)) ? undo_obj = window[sid + "_menu"] : undo_obj = null;
				if (j1 != j40 . j56)
					undo_obj = window["cdd_item" + j1 + "_menu"];
				if (j40 != j0)
				{
					if (j18 = nip . j26)
						if (nii != j18)
							j43(j18);
					j34(j0, nip);
					j43(nii, 1);
					j0 = j40;
				}
				qmd = cdd__showhide_delay;
				if (aoc && !j1 && !click && !j4)
					return;
				else
				{
					j4 = 1;
					if (click)
						qmd = 0;
				}
				(window[nii + "_menu"]) ? j41 = "j40,undo_obj" : j41 = "null,undo_obj,1";
				j2 = setTimeout("j46(" + j41 + ")", qmd);
			}
			return;
		}
	}
	while ((j40 = j40 . parentElement))
		qmd = cdd__showhide_delay;
	if (aoc && click && j4)
	{
		j4 = false;
		qmd = 0;
	}
	if (j1 != null)
		j2 = setTimeout("j46(null,window['cdd_item" + j1 + "_menu'],1,1)", qmd);
	j34(j0, 1);
	j0 = null;
	if (j57)
	{
		status = cdd__default_statusbar_text;
		j57 = false;
	}
};
function j43(j18, j45)
{
	j18 = window[j18];
	if ((j45) && (j18 . j15))
	{
		j57 = 1;
		status = j18 . j15;
	}
	if (j18 . j10 > 0)
	{
		(j45) ? j18 . className = j18 . j16_roll : j18 . className = j18 . j16;
		if (j18 = window[j18 . id + "_relicon"])
		{
			if (j45)
				j18 . style . visibility = "visible";
			else
				j18 . style . visibility = "hidden";
		}
	}
};
function j46(j40, j47, j48, j49)
{
	if (j47)
		j38(j47);
	if (j49)
		j1 = null;
	if (!j48)
	{
		if ((tval = window[(nid = j40 . id) + "_menu"]) . style . visibility == "hidden")
		{
			eval (tval . j13);
			try
			{
				if (t2val = tval . filters[0])
				{
					t2val . apply();
					t2val . play();
				}
			}
			catch (e)
			{
			}
			tval . style . visibility = "visible";
			j40 . parentElement . j26 = nid;
			j1 = j40 . j56;
			if (tval = window[nid + "_absicon"])
				tval . style . visibility = "visible";
		}
	}
};
function get_full_path(j50)
{
	if (j50 . indexOf(':') > -1)
		return j50;
	else
	{
		return cdd__database + j50;
	}
}
/* 
	calendar-cs-win.js
	language: Czech
	encoding: windows-1250
	author: Lubos Jerabek (xnet@seznam.cz)
	        Jan Uhlir (espinosa@centrum.cz)
*/

// ** I18N
Calendar._DN  = new Array('Nedìle','Pondìl?','Úter?','Støeda','Ètvrtek','Pátek','Sobota','Nedìle');
Calendar._SDN = new Array('Ne','Po','Út','St','Èt','P?','So','Ne');
Calendar._MN  = new Array('Leden','Únor','Bøezen','Duben','Kvìten','Èerven','Èervenec','Srpen','Záø?','Øíjen','Listopad','Prosinec');
Calendar._SMN = new Array('Led','Úno','Bøe','Dub','Kv?','Èrv','Èvc','Srp','Záø','Øíj','Lis','Pro');

// First day of the week. "0" means display Sunday first, "1" means display
// Monday first, etc.
Calendar._FD = 0;

// tooltips
Calendar._TT = {};
Calendar._TT["INFO"] = "O komponent? kalendáø";
Calendar._TT["TOGGLE"] = "Zmìna prvního dne v týdnu";
Calendar._TT["PREV_YEAR"] = "Pøedchoz? rok (pøidr? pro menu)";
Calendar._TT["PREV_MONTH"] = "Pøedchoz? mìsíc (pøidr? pro menu)";
Calendar._TT["GO_TODAY"] = "Dnešn? datum";
Calendar._TT["NEXT_MONTH"] = "Další mìsíc (pøidr? pro menu)";
Calendar._TT["NEXT_YEAR"] = "Další rok (pøidr? pro menu)";
Calendar._TT["SEL_DATE"] = "Vyber datum";
Calendar._TT["DRAG_TO_MOVE"] = "Chy? a táhni, pro pøesun";
Calendar._TT["PART_TODAY"] = " (dnes)";
Calendar._TT["MON_FIRST"] = "Uka? jako prvn? Pondìl?";
//Calendar._TT["SUN_FIRST"] = "Uka? jako prvn? Nedìli";

Calendar._TT["ABOUT"] =
"DHTML Kalendáø\n" +
"(c) dynarch.com 2002-2005 / Autor: Mihai Bazon\n" + // don't translate this this ;-)
"Aktuáln? verzi najdete na: http://www.dynarch.com/projects/calendar/\n" +
"Distribuováno pod licenc? GNU LGPL.  Viz. http://gnu.org/licenses/lgpl.html" +
"\n\n" +
"Výbìr datumu:\n" +
"- Použijte \xab, \xbb tlaèítka k výbìru roku\n" +
"- Použijte tlaèítka " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " k výbìru mìsíce\n" +
"- Podržte tlaèítko myši na jakémkoliv z tìch tlaèítek pro rychlejší výbìr.";

Calendar._TT["ABOUT_TIME"] = "\n\n" +
"Výbìr èasu:\n" +
"- Kliknìte na jakoukoliv z èást? výbìru èasu pro zvýšen?.\n" +
"- nebo Shift-click pro snížení\n" +
"- nebo kliknìte a táhnìte pro rychlejší výbìr.";

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
Calendar._TT["DAY_FIRST"] = "Zobraz %s prvn?";

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Calendar._TT["WEEKEND"] = "0,6";

Calendar._TT["CLOSE"] = "Zavøít";
Calendar._TT["TODAY"] = "Dnes";
Calendar._TT["TIME_PART"] = "(Shift-)Klikni nebo táhni pro zmìnu hodnoty";

// date formats
Calendar._TT["DEF_DATE_FORMAT"] = "d.m.yy";
Calendar._TT["TT_DATE_FORMAT"] = "%a, %b %e";

Calendar._TT["WK"] = "wk";
Calendar._TT["TIME"] = "Èas:";


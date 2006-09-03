�?// ** I18N

// Calendar FI language (Finnish, Suomi)
// Author: Jarno Käyhkö, <gambler@phnet.fi>
// Encoding: UTF-8
// Distributed under the same terms as the calendar itself.

// full day names
Calendar._DN = new Array
("Sunnuntai",
 "Maanantai",
 "Tiistai",
 "Keskiviikko",
 "Torstai",
 "Perjantai",
 "Lauantai",
 "Sunnuntai");

// short day names
Calendar._SDN = new Array
("Su",
 "Ma",
 "Ti",
 "Ke",
 "To",
 "Pe",
 "La",
 "Su");

// full month names
Calendar._MN = new Array
("Tammikuu",
 "Helmikuu",
 "Maaliskuu",
 "Huhtikuu",
 "Toukokuu",
 "Kesäkuu",
 "Heinäkuu",
 "Elokuu",
 "Syyskuu",
 "Lokakuu",
 "Marraskuu",
 "Joulukuu");

// short month names
Calendar._SMN = new Array
("Tam",
 "Hel",
 "Maa",
 "Huh",
 "Tou",
 "Kes",
 "Hei",
 "Elo",
 "Syy",
 "Lok",
 "Mar",
 "Jou");

// tooltips
Calendar._TT = {};
Calendar._TT["INFO"] = "Tietoja kalenterista";

Calendar._TT["ABOUT"] =
"DHTML Date/Time Selector\n" +
"(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n" + // don't translate this this ;-)
"Uusin versio osoitteessa: http://www.dynarch.com/projects/calendar/\n" +
"Julkaistu GNU LGPL lisenssin alaisuudessa. Lisätietoja osoitteessa http://gnu.org/licenses/lgpl.html" +
"\n\n" +
"Päivämäärä valinta:\n" +
"- Käytä \xab, \xbb painikkeita valitaksesi vuosi\n" +
"- Käytä " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " painikkeita valitaksesi kuukausi\n" +
"- Pitämällä hiiren painiketta minkä tahansa yllä olevan painikkeen kohdalla, saat näkyviin valikon nopeampaan siirtymiseen.";
Calendar._TT["ABOUT_TIME"] = "\n\n" +
"Ajan valinta:\n" +
"- Klikkaa kellonajan numeroita lisätäksesi aikaa\n" +
"- tai pitämällä Shift-näppäintä pohjassa saat aikaa taaksepäin\n" +
"- tai klikkaa ja pidä hiiren painike pohjassa sekä liikuta hiirtä muuttaaksesi aikaa nopeasti eteen- ja taaksepäin.";

Calendar._TT["PREV_YEAR"] = "Edell. vuosi (paina hetki, näet valikon)";
Calendar._TT["PREV_MONTH"] = "Edell. kuukausi (paina hetki, näet valikon)";
Calendar._TT["GO_TODAY"] = "Siirry tähän päivään";
Calendar._TT["NEXT_MONTH"] = "Seur. kuukausi (paina hetki, näet valikon)";
Calendar._TT["NEXT_YEAR"] = "Seur. vuosi (paina hetki, näet valikon)";
Calendar._TT["SEL_DATE"] = "Valitse päivämäärä";
Calendar._TT["DRAG_TO_MOVE"] = "Siirrä kalenterin paikkaa";
Calendar._TT["PART_TODAY"] = " (tänään)";
Calendar._TT["MON_FIRST"] = "Näytä maanantai ensimmäisenä";
Calendar._TT["SUN_FIRST"] = "Näytä sunnuntai ensimmäisenä";
Calendar._TT["CLOSE"] = "Sulje";
Calendar._TT["TODAY"] = "Tänään";
Calendar._TT["TIME_PART"] = "(Shift-) Klikkaa tai liikuta muuttaaksesi aikaa";

// date formats
Calendar._TT["DEF_DATE_FORMAT"] = "%d.%m.%Y";
Calendar._TT["TT_DATE_FORMAT"] = "%d.%m.%Y";

Calendar._TT["WK"] = "Vko";

// ** I18N

// Calendar RU language
// Translation: Sly Golovanov, http://golovanov.net, <sly@golovanov.net>
// Encoding: any
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

// full day names
Calendar._DN = new Array
("воскресень?",
 "понедельни?",
 "вторни?",
 "сред?",
 "четвер?",
 "??тниц?",
 "суббот?",
 "воскресень?");

// Please note that the following array of short day names (and the same goes
// for short month names, _SMN) isn't absolutely necessary.  We give it here
// for exemplification on how one can customize the short day names, but if
// they are simply the first N letters of the full name you can simply say:
//
//   Calendar._SDN_len = N; // short day name length
//   Calendar._SMN_len = N; // short month name length
//
// If N = 3 then this is not needed either since we assume a value of 3 if not
// present, to be compatible with translation files that were written before
// this feature.

// short day names
Calendar._SDN = new Array
("вс?",
 "по?",
 "вт?",
 "ср?",
 "че?",
 "???",
 "су?",
 "вс?");

// full month names
Calendar._MN = new Array
("?нвар?",
 "феврал?",
 "март",
 "апрель",
 "ма?",
 "июнь",
 "июль",
 "август",
 "сент?бр?",
 "ок??бр?",
 "но?бр?",
 "декабр?");

// short month names
Calendar._SMN = new Array
("?нв",
 "фе?",
 "ма?",
 "ап?",
 "ма?",
 "ию?",
 "ию?",
 "ав?",
 "се?",
 "ок?",
 "но?",
 "де?");

// tooltips
Calendar._TT = {};
Calendar._TT["INFO"] = "? календар?...";

Calendar._TT["ABOUT"] =
"DHTML Date/Time Selector\n" +
"(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n" + // don't translate this this ;-)
"For latest version visit: http://www.dynarch.com/projects/calendar/\n" +
"Distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Ка? выбрат? дату:\n" +
"- Пр? помощи кнопок \xab, \xbb можн? выбрат? год\n" +
"- Пр? помощи кнопок " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " можн? выбрат? ме??ц\n" +
"- Подержит? эт? кнопки нажатыми, чтоб? по?вилось меню быстрого выбора.";
Calendar._TT["ABOUT_TIME"] = "\n\n" +
"Ка? выбрат? врем?:\n" +
"- Пр? клик? на часа? ил? минута? он? увеличиваютс?\n" +
"- пр? клик? ? нажато? клавишей Shift он? уменьшаютс?\n" +
"- если нажать ? двигат? мышкой влев?/вправо, он? буду? ме??ть?? быстре?.";

Calendar._TT["PREV_YEAR"] = "На го? наза? (удерживать дл? меню)";
Calendar._TT["PREV_MONTH"] = "На ме??? наза? (удерживать дл? меню)";
Calendar._TT["GO_TODAY"] = "Сегодн?";
Calendar._TT["NEXT_MONTH"] = "На ме??? вперед (удерживать дл? меню)";
Calendar._TT["NEXT_YEAR"] = "На го? вперед (удерживать дл? меню)";
Calendar._TT["SEL_DATE"] = "Выберите дату";
Calendar._TT["DRAG_TO_MOVE"] = "Перетаскивайте мышкой";
Calendar._TT["PART_TODAY"] = " (сегодн?)";

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
Calendar._TT["DAY_FIRST"] = "Первый день недели буде? %s";

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Calendar._TT["WEEKEND"] = "0,6";

Calendar._TT["CLOSE"] = "Закрыт?";
Calendar._TT["TODAY"] = "Сегодн?";
Calendar._TT["TIME_PART"] = "(Shift-)клик ил? нажать ? двигат?";

// date formats
Calendar._TT["DEF_DATE_FORMAT"] = "%Y-%m-%d";
Calendar._TT["TT_DATE_FORMAT"] = "%e %b, %a";

Calendar._TT["WK"] = "не?";
Calendar._TT["TIME"] = "Врем?:";

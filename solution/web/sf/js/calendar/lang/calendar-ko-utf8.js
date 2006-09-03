// ** I18N

// Calendar EN language
// Author: Mihai Bazon, <mihai_bazon@yahoo.com>
// Translation: Yourim Yi <yyi@yourim.net>
// Encoding: EUC-KR
// lang : ko
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

// full day names

Calendar._DN = new Array
("일요�?",
 "월요�?",
 "화요�?",
 "수요�?",
 "목요�?",
 "금요�?",
 "토요�?",
 "일요�?");

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
("�?",
 "�?",
 "�?",
 "�?",
 "�?",
 "�?",
 "�?",
 "�?");

// full month names
Calendar._MN = new Array
("1�?",
 "2�?",
 "3�?",
 "4�?",
 "5�?",
 "6�?",
 "7�?",
 "8�?",
 "9�?",
 "10�?",
 "11�?",
 "12�?");

// short month names
Calendar._SMN = new Array
("1",
 "2",
 "3",
 "4",
 "5",
 "6",
 "7",
 "8",
 "9",
 "10",
 "11",
 "12");

// tooltips
Calendar._TT = {};
Calendar._TT["INFO"] = "calendar �? �?해서";

Calendar._TT["ABOUT"] =
"DHTML Date/Time Selector\n" +
"(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n" + // don't translate this this ;-)
"\n"+
"최신 버전�? 받으시려�? http://www.dynarch.com/projects/calendar/ �? 방문하세요\n" +
"\n"+
"GNU LGPL 라이센스�? 배포됩니�?. \n"+
"라이센스�? �?�? 자세�? 내용�? http://gnu.org/licenses/lgpl.html �? 읽으세요." +
"\n\n" +
"날짜 선택:\n" +
"- 연도�? 선택하려�? \xab, \xbb 버튼�? 사용합니다\n" +
"- 달을 선택하려�? " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " 버튼�? 누르세요\n" +
"- 계속 누르�? 있으�? �? 값들�? 빠르�? 선택하실 �? 있습니다.";
Calendar._TT["ABOUT_TIME"] = "\n\n" +
"시간 선택:\n" +
"- 마우스로 누르�? 시간�? 증가합니다\n" +
"- Shift 키와 함께 누르�? 감소합니다\n" +
"- 누른 상태에서 마우스를 �?직이�? �? �? 빠르�? 값이 �?합니�?.\n";

Calendar._TT["PREV_YEAR"] = "�?�? �? (길게 누르�? 목록)";
Calendar._TT["PREV_MONTH"] = "�?�? �? (길게 누르�? 목록)";
Calendar._TT["GO_TODAY"] = "오늘 날짜�?";
Calendar._TT["NEXT_MONTH"] = "다음 �? (길게 누르�? 목록)";
Calendar._TT["NEXT_YEAR"] = "다음 �? (길게 누르�? 목록)";
Calendar._TT["SEL_DATE"] = "날짜�? 선택하세�?";
Calendar._TT["DRAG_TO_MOVE"] = "마우�? 드래그로 이동 하세�?";
Calendar._TT["PART_TODAY"] = " (오늘)";
Calendar._TT["MON_FIRST"] = "월요일을 �? 주의 시작 요일�?";
Calendar._TT["SUN_FIRST"] = "일요일을 �? 주의 시작 요일�?";
Calendar._TT["CLOSE"] = "닫기";
Calendar._TT["TODAY"] = "오늘";
Calendar._TT["TIME_PART"] = "(Shift-)클릭 또는 드래�? 하세�?";

// date formats
Calendar._TT["DEF_DATE_FORMAT"] = "%Y-%m-%d";
Calendar._TT["TT_DATE_FORMAT"] = "%b/%e [%a]";

Calendar._TT["WK"] = "�?";

<?php
function gb2unicode($str)
{
        return iconv("gb2312", "UCS-2", $str);
}

function hex2str($hexstring) 
{
        $str = '';
        for($i=0; $i<strlen($hexstring); $i++){
                $str .= sprintf("%02X",ord(substr($hexstring,$i,1)));
        }
        return $str;
}

function InvertNumbers($msisdn) 
{
        $len = strlen($msisdn);
        if ( 0 != fmod($len, 2) ) {
                $msisdn .= "F";
                $len = $len + 1;
        }

        for ($i=0; $i<$len; $i+=2) {
                $t = $msisdn[$i];
                $msisdn[$i] = $msisdn[$i+1];
                $msisdn[$i+1] = $t;
        }
        return $msisdn;
}

function dosendsms($msisdn,$sms_text)
{
	// 短信中心号码
	$smsc = "8613800755500";
	// 短信最大长度70个汉字，Unicode表示需要280个字节
	$max_len = 280;
	$invert_smsc = InvertNumbers($smsc);

	$len = 1; 
	$s = chr(13);
	$msisdn = "86". $msisdn;
	$sms_text = $sms_text;
   
   
	$pdu_text = hex2str(gb2unicode($sms_text));
	echo gb2unicode($sms_text)."\n";
	$invert_msisdn = InvertNumbers($msisdn);
   
	// 拆分发送超过70汉字的短信(todo: 没有判断全英文的情况)
	$pdu_len = strlen($pdu_text);
	if ( $pdu_len > $max_len ) {
			$pdu_text1 = substr($pdu_text, 0, $max_len);
			$pdu_text = substr($pdu_text, $max_len, $pdu_len - $max_len);
	} else {
			$pdu_text1 = $pdu_text;
			$pdu_text = "";
	}

	$pdu_len1 = sprintf("%02X", strlen($pdu_text1)/2);
	$pdu_text1 = $pdu_len1 . $pdu_text1;

	$pdu_text1 = "11000D91" . $invert_msisdn ."000800" . $pdu_text1;

	$atcmd = "AT+CMGS=" . sprintf("%d", strlen($pdu_text1)/2) . chr(13);
	$l = strlen($atcmd);
	echo $atcmd."\n";
	/*
	$ll = @dio_write($fd,$atcmd);
	while ($l != $ll) {
			sleep(10);
			$ll = @dio_write($fd,$atcmd);
	}
	if ($DEBUG) echo date("Y-m-d H:i:s")." DEBUG $atcmd\n";

	do {
			$data = dio_read($fd, $len);
			echo $data;
	} while ( $data != $s );

	sleep(1);
	*/

	$pdu_text1 = "0891" . $invert_smsc . $pdu_text1 . chr(26).chr(13);
	$l = strlen($pdu_text1);
	echo $pdu_text1."\n";
	/*
	$ll = @dio_write($fd,$pdu_text1);
	while ($l != $ll) {
			sleep(10);
			$ll = @dio_write($fd,$pdu_text1);
	}
	if ($DEBUG) echo date("Y-m-d H:i:s")." DEBUG $pdu_text1\n";

	do {
			$data = dio_read($fd, $len);
			echo $data;
	} while ( $data != $s );
   
	sleep(7);
	*/


}
dosendsms("13684987661","中华人民共和国");
/*

AT+CMGF=? 获得模块所支持的短消息模式（设为0）
AT+CSCS=? 获得模块所支持的字符集（设为“UCS2”）

AT+CMGF=0

AT+CMGS=29
0891683108705505F011000D91683186947866F10008000E4E2D534E4EBA6C115171548C56FD
0891683108705505F011000D91683186947866F10008000E4E2D534E4EBA6C115171548C56FD
*/
?>
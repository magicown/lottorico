<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2019-04-09
 * Time: 오전 10:51
 */
// 메시지발송
function SendMesg($url) {
    $fp = fsockopen("211.233.20.184", 80, $errno, $errstr, 10);
    if(!$fp){
        echo "$errno : $errstr";
        exit;
    }

    fwrite($fp, "GET $url HTTP/1.0\r\nHost: 211.233.20.184\r\n\r\n");
    $flag = 0;

    while(!feof($fp)){
        $row = fgets($fp, 1024);

        if($flag) $out .= $row;
        if($row=="\r\n") $flag = 1;
    }
    fclose($fp);
    return $out;
}


$userid         = "lottofirst";           // 문자나라 아이디
$passwd         = "jun1126k";           // 문자나라 2차 비밀번호
$hpSender       = "01047176650";         // 보내는분 핸드폰번호
$sender_name    = "로또리코";
$adminPhone     = "01036638877";       // 비상시 메시지를 받으실 관리자 핸드폰번호
//$hpMesg = "854회차 1등 예상번호 로또리코 체험클래스\n[01]12,20,33,34,35,37\n[02]11,19,25,30,40,44\n[03]10,27,32,35,39,44\n[04]3,8,14,19,21,28\n[05]3,8,12,19,27,41\n[06]9,13,21,31,32,45\n[07]1,29,30,32,33,38\n[08]5,11,14,20,25,44\n[09]17,19,22,24,25,28\n[10]12,13,16,33,42,44\n[11]10,16,19,35,41,43\n[12]8,26,29,32,41,42\n[13]2,5,17,19,26,42\n[14]9,17,26,37,42,45\n[15]13,15,16,24,33,39\n[16]3,4,6,8,10,31\n[17]22,23,32,34,37,41\n[18]10,26,36,39,40,45\n[19]2,6,30,33,37,41\n[20]2,17,18,19,20,45\n[21]10,18,21,24,29,34\n\n\n무료거부 (080-0000-0000)";
/*  UTF-8 글자셋 이용으로 한글이 깨지는 경우에만 주석을 푸세요. */
$hpMesg = iconv("UTF-8", "EUC-KR","$hpMesg");
/*  ---------------------------------------- */
$hpMesg = urlencode($hpMesg);
$endAlert = 0;  // 전송완료알림창 ( 1:띄움, 0:안띄움 )
echo "hp->".$hpReceiver."<br>";
echo $hpMesg."<br>";
// 한줄로 이어쓰기 하세요.
$sms_result = SendMesg("/MSG/send/web_admin_send.htm?userid=$userid&passwd=$passwd&sender=$hpSender&receiver=$hpReceiver&encode=1&end_alert=$endAlert&message=$hpMesg&allow_mms=1&sender_name=$sender_name");
?>
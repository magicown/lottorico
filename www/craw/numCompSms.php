<?php
//===========================================================================
// 사용자 설정부분
//===========================================================================
$root_path = "/home/lotto/www"; //그누보드 설치된 물리적 위치, 끝에 "/"을 붙이지 않음
$root_url = "http://www.lottofirst.co.kr"; //그누보드가 설치된 위치의 url, 끝에 "/"을 붙이지 않음



include($root_path."/common.php");

ini_set("display_errors",1);
set_time_limit(0);
ini_set("memory_limit", -1);



//금주에 회차를 구한다.
$sql = "SELECT hit_turn FROM lotto_hit_result WHERE 1 ORDER BY idx DESC LIMIT 1";
echo $sql."<br>";
$rs = sql_fetch($sql);
$turn = $rs['hit_turn']+1;

//오늘 요일 구하기:
$today_n = date("N");


$today = date("N");
$week = array(1=>"mon_sms_cnt",2=>"tue_sms_cnt",3=>"wed_sms_cnt",4=>"thu_sms_cnt",5=>"fri_sms_cnt",6=>"sat_sms_cnt");
$fail = 0;
$que = "SELECT * FROM today_will_make_num_chk WHERE week_turn = '{$turn}' AND (today_do_make_num = 'N' OR today_send_sms_yn = 'N') ";
echo $que."<br>";
$res_que = sql_query($que);
while ($pay = sql_fetch_array($res_que)) {
    $sql1 = "SELECT COUNT(*) as ccnt FROM member_lotto_num WHERE lotto_turn = '{$turn}' and mb_id = '{$pay['today_will_make_id']}' ";
    echo $sql1."<br><br>";
    $rs = sql_fetch($sql1);
    if($rs['ccnt']>0){
        $sql2 = "UPDATE today_will_make_num_chk SET today_do_make_num = 'Y' WHERE week_turn = '{$turn}' AND today_will_make_id = '{$pay['today_will_make_id']}' ";
        echo $sql2."<br>";
        sql_query($sql2);
    }

    $sql = "SELECT COUNT(*) AS cnt FROM g5_sms_log WHERE sms_turn = '{$turn}' AND mb_id = '{$pay['today_will_make_id']}' ";
    echo $sql."<br><br>";
    $row = sql_fetch($sql);
    echo $row['mb_id']." 전송여부 : ".$row['cnt']."<br>";
    if($row['cnt']>0){
        $sql2 = "UPDATE today_will_make_num_chk SET today_send_sms_yn = 'Y' WHERE week_turn = '{$turn}' AND today_will_make_id = '{$pay['today_will_make_id']}' ";
        echo $sql2."<br>";
        sql_query($sql2);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2019-03-26
 * Time: 오전 10:40
 */


//===========================================================================
// 사용자 설정부분
//===========================================================================
$root_path = "/home/lotto/www"; //그누보드 설치된 물리적 위치, 끝에 "/"을 붙이지 않음
$root_url = "http://www.lottofirst.co.kr"; //그누보드가 설치된 위치의 url, 끝에 "/"을 붙이지 않음

//===========================================================================
// 이하 수정금지
//===========================================================================


include($root_path."/common.php");


set_time_limit(0);
ini_set("memory_limit", -1);


//금주에 회차를 구한다.
$sql = "SELECT hit_turn FROM lotto_hit_result WHERE 1 ORDER BY idx DESC LIMIT 1 ";
echo $sql."<br>";
$rs = sql_fetch($sql);
$turn = $rs['hit_turn']+1;

//오늘 요일 구하기
$today_n = date("N");


//$today = date("N");
$today = 1;
$week = array(1=>"mon_sms_cnt",2=>"tue_sms_cnt",3=>"wed_sms_cnt",4=>"thu_sms_cnt",5=>"fri_sms_cnt",6=>"sat_sms_cnt");
$fail = 0;

$cnt = 1;
$que = "SELECT * FROM g5_member WHERE mb_10 > '1' AND mb_hp != '' AND mb_leave_date = '' AND {$week[$today]} > 0  AND mb_2 > DATE_FORMAT(NOW(), '%Y-%m-%d') ";
echo $que."<br>";
$res_que = sql_query($que);
while ($row = sql_fetch_array($res_que)) {
    $sql1 = "SELECT COUNT(today_will_make_id) AS cnt FROM today_will_make_num_chk WHERE today_will_make_id = '{$row['mb_id']}' AND week_turn = '{$turn}' ";
    $rs = sql_fetch($sql1);
    if(!$rs['cnt']) {
        $sql = "INSERT INTO today_will_make_num_chk SET ";
        $sql .= "today_will_make_id = '{$row['mb_id']}', ";
        $sql .= "week_turn = '{$turn}', ";
        $sql .= "reg_date = NOW() ";
        echo $sql . "<br>";
        sql_query($sql);
        $cnt++;
    }
}

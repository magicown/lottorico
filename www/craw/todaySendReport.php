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
$sql = "SELECT hit_turn FROM lotto_hit_result WHERE 1 ORDER BY idx DESC LIMIT 1";
echo $sql."<br>";
$rs = sql_fetch($sql);
$turn = $rs['hit_turn']+1;

//오늘 요일 구하기
$today_n = date("N");

//무료 회원 번호 만들기
$today_date = date("Y-m-d");
$today = date("N");
//$today = 4;
$week = array(1=>"mon_sms_cnt",2=>"tue_sms_cnt",3=>"wed_sms_cnt",4=>"thu_sms_cnt",5=>"fri_sms_cnt",6=>"sat_sms_cnt");
$fail = 0;

//오늘 발송할 회원들 수
$today_send_person_cnt = 0;
$sms_send_person_cnt = 0;
$que = "SELECT * FROM g5_member WHERE mb_10 > '1' AND mb_hp != '' AND mb_leave_date = '' AND mb_5 != 'Y' AND {$week[$today]} > 0  AND mb_2 > DATE_FORMAT(NOW(), '%Y-%m-%d') ";
echo $que."<br>";
$res = sql_query($que);
while($pay = sql_fetch_array($res)){
//오늘 발송된 sms 수
    $sql = "SELECT * FROM g5_sms_log WHERE (sms_turn = '{$turn}' OR sms_content LIKE '{$turn}회차%') AND mb_id = '{$pay['mb_id']}' AND DATE_FORMAT(sms_regdate, '%Y-%m-%d') = '{$today_date}'";
    echo $sql."<br>";
    $row1 = sql_fetch($sql);
    echo $row1['mb_id']."<br>";
    if($row1['mb_id']!=''){
        echo $row1['mb_id']."<br>";
        $sms_send_person_cnt++;
    }
    $today_send_person_cnt++;
}





echo date("Y년 m월 d일")." 발송될 회원은 : {$today_send_person_cnt}명이고 금일 SMS 전송된 갯수는 : {$sms_send_person_cnt}입니다.";



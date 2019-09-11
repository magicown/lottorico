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


//유료 회원중 종료일자가 지난 회원은 무료회원으로 변경한다.
$sql = "SELECT * 
FROM  `g5_member` 
WHERE DATE_FORMAT( mb_2,  '%Y-%m-%d' ) < DATE_FORMAT( NOW( ) ,  '%Y-%m-%d' ) 
AND mb_10 >1
AND mb_level = 2 ";
echo $sql."<br>";
$res = sql_query($sql);
while($rs = sql_fetch_array($res)){
    $que = "UPDATE g5_member SET mb_1 = '', mb_3 = '',mb_4 = '', mon_sms_cnt = '0', mon_sms_cnt = '0', tue_sms_cnt = '0', wed_sms_cnt = '0', thu_sms_cnt = '0', fri_sms_cnt = '0', sat_sms_cnt = '0' WHERE mb_id = '{$rs['mb_id']}'";
    echo $que."<br>";
    sql_query($que);

    $que1 = "INSERT INTO g5_member_grade_log SET ";
    $que1 .= "log_mb_id = '{$rs['mb_id']}', ";
    $que1 .= "log_org_grade = '{$rs['mb_10']}', ";
    $que1 .= "log_chg_grade = '', ";
    $que1 .= "log_memo = '회원 유료결제일자 종료 시스템 자동 변경', ";
    $que1 .= "log_change_id = 'admin', ";
    $que1 .= "log_regdate = NOW() ";
    sql_query($que1);



}



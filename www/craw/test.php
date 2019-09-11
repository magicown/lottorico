<?php

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

$que = "SELECT * FROM g5_member WHERE member_grade_date = '0000-00-00'  ";
$res = sql_query($que);
while($rows = sql_fetch_array($res)){
    $date = substr($rows['mb_datetime'],0,10);
    $sql = "UPDATE g5_member SET member_grade_date = '{$date}' WHERE mb_id = '{$rows['mb_id']}'";
    echo $sql."<br>";
    sql_query($sql);
}
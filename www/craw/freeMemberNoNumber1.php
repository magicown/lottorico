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
echo $sql."\n";
$rs = sql_fetch($sql);
$turn = $rs['hit_turn']+1;



    $fail = 0;
    $que = "SELECT * FROM g5_member WHERE mb_level = '2' AND mb_hp != '' AND mb_leave_date = '' AND mb_10 = '' ";
    //echo $que . "\n";
    $res_que = sql_query($que);
    while ($free = sql_fetch_array($res_que)) {
        $sql = "SELECT COUNT(mb_id) as cnt FROM member_lotto_num WHERE mb_id = '{$free['mb_id']}' AND lotto_turn = '867'";
        //echo $sql . "\n";
        $row = sql_fetch($sql);
        if(!$row['cnt']) {
            echo "회원 아이디:" . $free['mb_id'] . " - " . $row['cnt'] . "\n";
        }
    }


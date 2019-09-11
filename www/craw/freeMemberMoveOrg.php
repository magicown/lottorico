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



$fail = 0;
$que = "SELECT * FROM member_lotto_num_temp WHERE lotto_turn = '{$turn}' AND move_yn = 'n'  ";
echo $que . "<br>";
$res_que = sql_query($que);
while ($free = sql_fetch_array($res_que)) {
    $sql = "SELECT COUNT(mb_id) as cnt FROM member_lotto_num WHERE lotto_turn = '{$turn}' AND mb_id = '{$free['mb_id']}' ";
    echo $sql . "<br>";
    $row = sql_fetch($sql);
    if ($row['cnt']<10) {

        sql_query("SET AUTOCOMMIT=0");
        sql_query("START TRANSACTION");



        $que = "INSERT INTO member_lotto_num SET ";
        $que .= "lotto_idx      = '{$free['lotto_idx']}', ";
        $que .= "mb_id          = '{$free['mb_id']}', ";
        $que .= "lotto_num      = '{$free['lotto_num']}', ";
        $que .= "lotto_turn     = '{$turn}', ";
        $que .= "direct_send    = 'N', ";
        $que .= "lotto_result   = '', ";
        $que .= "pay_yn         = 'N', ";
        $que .= "reg_date       = NOW() ";
        echo $que . "<br><br>";
        $res_cnt = sql_query($que);
        if (!$res_cnt) {
            $fail++;
        }

        $que2 = "UPDATE member_lotto_num_temp SET move_yn = 'y' WHERE idx = '{$free['idx']}'";
        echo $que2."<br>";
        $res2 = sql_query($que2);
        if(!$res2){
            $fail++;
        }

        if ($fail > 0) {
            sql_query("ROLLBACK");
        } else {
            sql_query("COMMIT");
        }
    }
}


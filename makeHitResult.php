<?php

//===========================================================================
// 사용자 설정부분
//===========================================================================
$root_path = "/home/lotto/www"; //그누보드 설치된 물리적 위치, 끝에 "/"을 붙이지 않음
$root_url = "http://www.lottorico.co.kr"; //그누보드가 설치된 위치의 url, 끝에 "/"을 붙이지 않음

//===========================================================================
// 이하 수정금지
//===========================================================================


include($root_path."/common.php");


set_time_limit(0);
ini_set("memory_limit", -1);


$fail = 0;

sql_query("START TRANSACTION");
//당첨결과가 전송이 안된게 있는지 확인 한다.
/*$que = "SELECT * FROM lotto_hit_result WHERE hit_sms_send_yn = 'N'";
$row = sql_fetch($que);
if($row['hit_sms_send_yn']=='N'){*/
    $cnt = 0;
    //해당회차에 당첨된 회원을 가져온다.
    $sql = "
            SELECT 
                   idx, mb_id, lotto_turn, lotto_result, COUNT( mb_id ) AS cnt
            FROM (            
                SELECT * 
                FROM member_lotto_num
                WHERE lotto_turn =  '{$row['hit_turn']}'
                AND lotto_result >0
                AND lotto_result_yn =  'y'
                ORDER BY mb_id
            ) a
            GROUP BY mb_id, lotto_result
          ";
    //echo $sql."<br>";
    $res = sql_query($sql);
    while($arr=sql_fetch_array($res)){
        $que2 = "SELECT COUNT(*) AS win_cnt FROM member_win_cnt WHERE win_turn  = '{$arr['lotto_turn']}' AND win_mb_id = '{$arr['mb_id']}' ";
        //echo $que2."<br>";
        $row2 = sql_fetch($que2);
        if($row2[win_cnt]>0){
            $que3  = "UPDATE member_win_cnt SET ";
            if($arr['lotto_result']==1) {
                $que3 .= "win_grade1 = '{$arr['cnt']}', ";
            }
            if($arr['lotto_result']==2) {
                $que3 .= "win_grade2 = '{$arr['cnt']}', ";
            }
            if($arr['lotto_result']==3) {
                $que3 .= "win_grade3 = '{$arr['cnt']}', ";
            }
            if($arr['lotto_result']==4) {
                $que3 .= "win_grade4 = '{$arr['cnt']}', ";
            }
            if($arr['lotto_result']==5) {
                $que3 .= "win_grade5 = '{$arr['cnt']}', ";
            }
            $que3 .= "win_mb_id = '{$arr['mb_id']}' ";
            $que3 .= " WHERE win_mb_id = '{$arr['mb_id']}' AND win_turn = '{$arr['lotto_turn']}' ";
            //echo $que3."<br>";
            $rs = sql_query($que3);
            if(!$rs){
                $fail++;
            }
        } else {
            $que3  = "INSERT INTO member_win_cnt SET ";
            $que3 .= "win_turn = '{$arr['lotto_turn']}', ";
            $que3 .= "win_mb_id = '{$arr['mb_id']}', ";
            if($arr['lotto_result']==1) {
                $que3 .= "win_grade1 = '{$arr['cnt']}', ";
            }
            if($arr['lotto_result']==2) {
                $que3 .= "win_grade2 = '{$arr['cnt']}', ";
            }
            if($arr['lotto_result']==3) {
                $que3 .= "win_grade3 = '{$arr['cnt']}', ";
            }
            if($arr['lotto_result']==4) {
                $que3 .= "win_grade4 = '{$arr['cnt']}', ";
            }
            if($arr['lotto_result']==5) {
                $que3 .= "win_grade5 = '{$arr['cnt']}', ";
            }
            $que3 .= "win_regdate = NOW() ";
            //echo $que3."<br>";
            $rs = sql_query($que3);
            if(!$rs){
                $fail++;
            }
        }
    }


    if($fail>0){
        sql_query("ROLLBACK");
    } else {
        sql_query("COMMIT");
    }
//}


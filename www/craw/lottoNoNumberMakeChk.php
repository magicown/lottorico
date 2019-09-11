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

$today_date = date("Y-m-d");
$today = date("N");
$week = array(1=>"mon_sms_cnt",2=>"tue_sms_cnt",3=>"wed_sms_cnt",4=>"thu_sms_cnt",5=>"fri_sms_cnt",6=>"sat_sms_cnt");
$fail = 0;
//SELECT * FROM g5_member WHERE mb_level = '2' AND mb_hp != '' AND mb_leave_date = '' AND mb_10 > 0 AND mb_1 = '3' AND mb_2 > '2019-05-27'
$que = "SELECT * FROM today_will_make_num_chk WHERE  week_turn = '{$turn}' AND today_do_make_num = 'N' AND make_date = '{$today_date}' ";
//echo $que."<br>";
$res_que = sql_query($que);
while ($pay = sql_fetch_array($res_que)) {
    /*$sql = "SELECT COUNT(*) AS cnt FROM member_lotto_num WHERE lotto_turn = '{$turn}' AND mb_id = '{$pay['today_will_make_id']}' ";
    echo $sql ."<br><br>";
    $row1 = sql_fetch($sql);
    if(!$row1['cnt']){*/
    //echo "보낸게 없음->".$pay['today_will_make_id']." : ".$row1['cnt']."<br>";


    $que1 = "SELECT * FROM g5_member WHERE mb_id = '{$pay['today_will_make_id']}' ";
    //echo $que1."<br>";
    $rs = sql_fetch($que1);

    $pay_class = getPayType($rs[mb_10]);
    //제외수를 가져온다.
    $except = getExceptNumCron($turn, $rs[mb_10]);

    //연번을 가져온다.

    if($rs['mb_5']!='Y') {
        //로또번호를 생성한다.
        $lotto = makeLottoNumPay($except, $rs['mb_3'], $rs[$week[$today]], $rs['mb_id'], $turn);

        $sm = $hpMesg = "";
        sql_query("SET AUTOCOMMIT=0");
        sql_query("START TRANSACTION");
        for ($i = 0; $i < count($lotto); $i++) {
            //생성된 번호는 사용으로 만든다.
            $que1 = "UPDATE lotto_num SET use_yn = 'Y', mb_id = '{$rs[mb_id]}', regdate = NOW() WHERE idx = {$lotto[$i][idx]}";
            //echo $que1 . "<br>";
            $res = sql_query($que1);
            if (!$res) {
                $fail++;
            }
            //print_r($lotto);

            $lnum[$i] = $lotto[$i][no1] . "," . $lotto[$i][no2] . "," . $lotto[$i][no3] . "," . $lotto[$i][no4] . "," . $lotto[$i][no5] . "," . $lotto[$i][no6];
            $que = "INSERT INTO member_lotto_num SET ";
            $que .= "lotto_idx      = '{$lotto[$i][idx]}', ";
            $que .= "mb_id          = '{$rs['mb_id']}', ";
            $que .= "lotto_num      = '{$lnum[$i]}', ";
            $que .= "lotto_turn     = '{$turn}', ";
            $que .= "pay_yn         = 'Y', ";
            $que .= "lotto_result   = '', ";
            $que .= "reg_date       = NOW() ";
            //echo $que . "<br>";
            $res_cnt = sql_query($que);
            if (!$res_cnt) {
                $fail++;
            }

            //금일 보내야 할 회원 아이디 체크
            $que2 = "UPDATE today_will_make_num_chk SET  ";
            $que2 .= "today_do_make_num = 'Y', ";
            $que2 .= "update_date = NOW() ";
            $que2 .= " WHERE today_will_make_id = '{$rs['mb_id']}' ";
            //echo $que2 . "<br>";
            $res_que2 = sql_query($que2);
            /*if (!$res_que2) {
                $fail++;
            }*/

            $num = ($i < 9) ? '0' . ($i + 1) : ($i + 1);
            $sm .= "[" . $num . "] " . $lnum[$i] . "\n";
        }

    }
    if ($fail > 0) {
        sql_query("ROLLBACK");
    } else {
        sql_query("COMMIT");
    }
    //}
}
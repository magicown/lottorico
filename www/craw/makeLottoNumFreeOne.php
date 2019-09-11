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
//echo $sql."<br>";
$rs = sql_fetch($sql);
$turn = $rs['hit_turn']+1;

//오늘 요일 구하기
$today_n = date("N");

//무료 회원 번호 만들기

$que = "SELECT COUNT(mb_id) AS total FROM g5_member WHERE mb_hp != '' AND mb_leave_date = '' AND mb_10 = ''   ";
//echo $que."<br>";
$total = sql_fetch($que);
echo $total['total'];




    $fail = 0;
    $que = "SELECT * FROM g5_member WHERE mb_level = '2' AND mb_hp != '' AND mb_leave_date = '' AND mb_10 = '' and mb_id = '01085326911' ";
    echo $que . "<br><br>";
    $res_que = sql_query($que);
    while ($free = sql_fetch_array($res_que)) {
        //회원정보와 회차로 등록된 정보가 있는지 확인 한다.
        $already = alreadyUpdateLottoNumber($free['mb_id'], $turn);
        if (!$already) {
            //로또번호를 생성한다.
            $lotto = makeLottoNumFree();

            $sm = $hpMesg = "";
            sql_query("SET AUTOCOMMIT=0");
            sql_query("START TRANSACTION");
            for ($i = 0; $i < count($lotto); $i++) {
                //생성된 번호는 사용으로 만든다.
                $que = "UPDATE lotto_num SET use_yn = 'Y', mb_id = '{$free[mb_id]}', regdate = NOW() WHERE idx = {$lotto[$i][idx]}";
                echo $que . "<br><br>";
                $res = sql_query($que);
                if (!$res) {
                    $fail++;
                }

                $lnum[$i] = $lotto[$i][no1] . "," . $lotto[$i][no2] . "," . $lotto[$i][no3] . "," . $lotto[$i][no4] . "," . $lotto[$i][no5] . "," . $lotto[$i][no6];
                $que = "INSERT INTO member_lotto_num SET ";
                $que .= "lotto_idx      = '{$lotto[$i][idx]}', ";
                $que .= "mb_id          = '{$free[mb_id]}', ";
                $que .= "lotto_num      = '{$lnum[$i]}', ";
                $que .= "lotto_turn     = '{$turn}', ";
                $que .= "lotto_result   = '', ";
                $que .= "reg_date       = NOW() ";
                echo $que . "<br><br>";
                $res_cnt = sql_query($que);
                if (!$res_cnt) {
                    $fail++;
                }
            }

            if ($fail > 0) {
                sql_query("ROLLBACK");
            } else {
                sql_query("COMMIT");
            }
        }
    }



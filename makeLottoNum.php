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
if($today_n == 3) {//수요일에만 번호를 생성한다.
    $fail = 0;


    $que = "SELECT * FROM g5_member WHERE mb_level = '2' AND mb_hp != '' AND mb_leave_date = '' AND mb_10 = '0'  ";
    //echo $que."<br>";
    $res_que = sql_query($que);
    while ($free = sql_fetch_array($res_que)) {
        //회원정보와 회차로 등록된 정보가 있는지 확인 한다.
        $already = alreadyUpdateLottoNumber($free['mb_id'],$turn);
        if(!$already) {
            sql_query("START TRANSACTION");
            //생성된 번호는 사용으로 만든다.
            $que = "UPDATE lotto_num SET use_yn = 'Y', mb_id = '{$free[mb_id]}', regdate = NOW() WHERE idx IN ({$lotto})";
            //echo $que."<br>";
            $res = sql_query($que);
            if(!$res){
                sql_query("ROLLBACK");
            }

            //사용된 번호를 회원정보에 업데이트 한다.
            $data = explode(",",$lotto);
            for ($i = 0; $i < count($data); $i++) {
                $que = "SELECT no1,no2,no3,no4,no5,no6 FROM lotto_num WHERE idx = '{$data[$i]}'";
                //echo $que."<br>";
                $res = sql_query($que);
                while ($row = sql_fetch_array($res)) {
                    $lnum = $row[no1] . "," . $row[no2] . "," . $row[no3] . "," . $row[no4] . "," . $row[no5] . "," . $row[no6];
                    $que = "INSERT INTO member_lotto_num SET ";
                    $que .= "mb_id          = '{$free[mb_id]}', ";
                    $que .= "lotto_num      = '{$lnum}', ";
                    $que .= "lotto_turn     = '{$turn}', ";
                    $que .= "lotto_result   = '', ";
                    $que .= "reg_date       = NOW() ";
                    //echo $que."<br>";
                    $res_cnt = sql_query($que);
                    if (!$res_cnt) {
                        $fail++;
                    }
                }
            }
            if ($fail > 0) {
                sql_query("ROLLBACK");
            } else {
                sql_query("COMMIT");
            }
        }
    }
}

//유료 결제가 아직 끝나지 않았다면
$fail = 0;
$que = "SELECT * FROM g5_member WHERE mb_level IN ('3','4','5','6') AND mb_hp != '' AND mb_leave_date = '' AND mb_1 = '{$today_n}' ";
echo $que."<br>";
$res_que = sql_query($que);
while ($pay = sql_fetch_array($res_que)) {
    //번호를 생성한다.
    $lotto = makeLottoNum($pay[mb_level]);

    //회원정보와 회차로 등록된 정보가 있는지 확인 한다.
    $already = alreadyUpdateLottoNumber($pay['mb_id'],$turn);

    sql_query("START TRANSACTION");

    if(!$already) {
        //생성된 번호는 사용으로 만든다.
        $que = "UPDATE lotto_num SET use_yn = 'Y', mb_id = '{$pay[mb_id]}', regdate = NOW() WHERE idx IN ({$lotto})";
        echo $que."<br>";
        $res = sql_query($que);
        if(!$res){
            sql_query("ROLLBACK");
        }

        //사용된 번호를 회원정보에 업데이트 한다.
        $data = explode(",",$lotto);
        for ($i = 0; $i < count($data); $i++) {
            $que = "SELECT no1,no2,no3,no4,no5,no6 FROM lotto_num WHERE idx = '{$data[$i]}'";
            echo $que."<br>";
            $res = sql_query($que);
            while ($row = sql_fetch_array($res)) {
                $lnum = $row[no1] . "," . $row[no2] . "," . $row[no3] . "," . $row[no4] . "," . $row[no5] . "," . $row[no6];
                $que = "INSERT INTO member_lotto_num SET ";
                $que .= "mb_id          = '{$pay[mb_id]}', ";
                $que .= "lotto_num      = '{$lnum}', ";
                $que .= "lotto_turn     = '{$turn}', ";
                $que .= "lotto_result   = '', ";
                $que .= "reg_date       = NOW() ";
                echo $que."<br>";
                $res_cnt = sql_query($que);
                if (!$res_cnt) {
                    $fail++;
                }
            }
        }
        if ($fail > 0) {
            sql_query("ROLLBACK");
        } else {
            sql_query("COMMIT");
        }
    }
}









<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2019-04-03
 * Time: 오후 4:39
 */

//로또 번호를 생성한다. 인자는 회원아이디, 회차
function makeLottoNumFree(){
    $total_cnt = 8145059;

    $total = 0;
    $chk = array();
    while($total<=20){
        $rand = mt_rand(1, $total_cnt);
        if (!isset($chk[$rand])) {
            $chk[$rand] = 1;
            //$except = explode(",", "5,7,13,15,20,23,29,31,35,37,41,44,45");
            $que = "SELECT idx, no1,no2,no3,no4,no5,no6 FROM lotto_num WHERE idx = {$rand} AND use_yn = 'N'";
            $row = sql_fetch($que);
            $data[] = $row;
            /*$intens = array_intersect($row, $except);
            if (!$intens) {
                $data[] = $row;
                $total++;
            }*/
        }
    }

    return $data;
}

function makeLottoNumPay($except, $mb_cnt){
    $total_cnt = 8145059;

    if(!$mb_cnt){
        $mb_cnt = 20;
    }

    echo "여기";
    $total = 0;
    $chk = array();
    while($total<=$mb_cnt){
        $rand = mt_rand(1, $total_cnt);
        if (!isset($chk[$rand])) {
            $chk[$rand] = 1;
            $que = "SELECT idx, no1,no2,no3,no4,no5,no6 FROM lotto_num WHERE idx = {$rand} AND use_yn = 'N'";
            //echo $que;
            $row = sql_fetch($que);

            $intens = array_intersect($row, $except);
            if (!$intens) {
                $data[] = $row;
                $total++;
            }
        }
    }

    return $data;
}

//생성된 정보로 회원 금주 로또 번호를 업데이트 한다.
function alreadyUpdateLottoNumber($mb_id, $turn){
    $que = "SELECT COUNT(*) AS cnt FROM member_lotto_num WHERE mb_id = '{$mb_id}' AND lotto_turn = '{$turn}'";
    echo $que."<br>";
    $rs = sql_fetch($que);
    return $rs[cnt];
}

//제외수 확인해서 가져온다.
function getExceptNum($turn, $except){
    $que = "SELECT except_num FROM g5_except_num WHERE pay_idx = {$except} AND turn = '{$turn}'";
    $row = sql_fetch($que);
    return explode(",",$row['except_num']);
}
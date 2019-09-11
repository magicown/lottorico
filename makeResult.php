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

include($root_path."/common.php");


set_time_limit(0);
ini_set("memory_limit", -1);

$fail = 0;

sql_query("START TRANSACTION");

//당첨 번호를 가져온다.
$que = "SELECT * FROM lotto_hit_result WHERE 1 ORDER BY hit_turn DESC LIMIT 1";
//echo $que."<br>";
$row = sql_fetch($que);

$last_turn = $row['hit_turn'];
$hit_num = explode("|",$row['hit_num']);
//print_r($hit_num);
$mem = array();

unset($que);
//회원들의 번호를 가져온다.
$sql = "SELECT * FROM member_lotto_num WHERE lotto_turn = '{$last_turn}' AND lotto_result_yn = 'n'";
//echo $sql."<br>";
$res = sql_query($sql);
while($arr = sql_fetch_array($res)){
    $cnt = 0;
    $bonus_cnt = 0;
    //회원로또 번호를 분리한다.
    $lotto_num = explode(",",$arr['lotto_num']);

    //print_r($lotto_num);
    for($i=0;$i<=5;$i++){
        if(in_array($hit_num[$i],$lotto_num)){
            $cnt++;
        }
    }

    if($cnt==6){
        $que = "UPDATE member_lotto_num SET lotto_result = '1', lotto_result_yn = 'y', update_result_date =  NOW() WHERE idx = '{$arr[idx]}'";
        //sql_query($que);
    } else if($cnt == 5){
        //보너스 번호가 맞았는지 확인한다.

        if(in_array($hit_num[6],$lotto_num)){
            $bonus_cnt = 2;
        }
        //echo "bonus_cnt = ".$bonus_cnt."<br>";
        if($bonus_cnt==2){
            $que = "UPDATE member_lotto_num SET lotto_result = '2', lotto_result_yn = 'y', update_result_date =  NOW() WHERE idx = '{$arr[idx]}'";
            //sql_query($que);
        } else {
            $que = "UPDATE member_lotto_num SET lotto_result = '3', lotto_result_yn = 'y', update_result_date =  NOW() WHERE idx = '{$arr[idx]}'";
            //sql_query($que);
        }

    } else if($cnt == 4){
        $que = "UPDATE member_lotto_num SET lotto_result = '4', lotto_result_yn = 'y', update_result_date =  NOW() WHERE idx = '{$arr[idx]}'";
        //sql_query($que);
    } else if($cnt == 3){
        $que = "UPDATE member_lotto_num SET lotto_result = '5', lotto_result_yn = 'y', update_result_date =  NOW() WHERE idx = '{$arr[idx]}'";
        //sql_query($que);
    } else {
        $que = "UPDATE member_lotto_num SET lotto_result = '0', lotto_result_yn = 'y', update_result_date =  NOW() WHERE idx = '{$arr[idx]}'";
    }
    //echo $que."<br>";
    $que_res = sql_query($que);
    if(!$que_res){
        $fail++;
    }
}
//echo "fail->".$fail;
if($fail>0){
    sql_query("ROLLBACK");
} else {
    sql_query("COMMIT");
}

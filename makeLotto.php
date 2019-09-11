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

$total_cnt = 8145059;

$cnt = 0;
$end = 10;
if($mb_level>2){
    $end = 20;
}

$end = 20;
$chk = $data = array();
while ($cnt < $end) {
    $rand = mt_rand(1, $total_cnt);
    if (!isset($chk[$rand])) {
        $chk[$rand] = 1;
        $data[] = $rand;
        $cnt++;
    }
}

print_r($data);



<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2019-04-05
 * Time: 오후 1:30
 */
include("../common.php");



$total_cnt = 8145059;

$total = 0;
$chk = array();
while($total<=20){
    $rand = mt_rand(1, $total_cnt);
    if (!isset($chk[$rand])) {
        $chk[$rand] = 1;
        $except = explode(",", "5,7,13,15,20,23,29,31,35,37,41,44,45");
        $que = "SELECT no1,no2,no3,no4,no5,no6 FROM lotto_num WHERE idx = {$rand} AND use_yn = 'n'";
        $row = sql_fetch($que);

        $intens = array_intersect($row, $except);
        if (!$intens) {
            $num[$total] = $row;
            $total++;
        }
    }
}
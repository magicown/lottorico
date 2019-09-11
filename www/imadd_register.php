<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/json.lib.php');


$referr_txt = $_REQUEST['referr_txt'];
$hp = str_replace("-","",$_REQUEST['hp']);

$sql = "SELECT COUNT(*) AS cnt FROM g5_member WHERE mb_hp = '{$hp}%' ";
//echo $sql;
$row = sql_fetch($sql);
$new_pw = substr($hp,-4);
//print_r($_POST);
$que1 = "INSERT INTO g5_member SET ";
$que1 .= "mb_id          = '{$hp}', ";
$que1 .= "mb_name        = '아이엠애드 광고', ";
$que1 .= "mb_password    = '" . get_encrypt_string($new_pw) . "', ";
$que1 .= "mb_hp          = '{$hp}', ";
$que1 .= "mb_level       = '2', ";
$que1 .= "mb_9           = '{$referr_txt}', ";
$que1 .= "mb_10         = '1', ";
$que1 .= "member_grade_date = NOW(), ";
$que1 .= "mb_datetime    = NOW() ";

//echo $que1;
$res = sql_query($que1);
if($res) {
    regCounselor($hp, $hp, '아이엠애드 광고', 'I');
}

?>
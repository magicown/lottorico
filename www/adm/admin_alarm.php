<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2019-04-02
 * Time: 오전 10:21
 */

include_once("./_common.php");
//알람이 있는지 확인 한다.
$str = "";
$cnt = 0;
$today = date("Y-m-d H:i:s");
$que = "SELECT alarm_type, COUNT(*) as cnt FROM g5_alarm_schedule WHERE alarm_datetime <= '{$today}' AND reg_mb_id = '{$_SESSION['ss_mb_id']}' AND alarm_chk_yn = 'N' GROUP BY alarm_type";
//echo $que."";
$res = sql_query($que);
while($arr = sql_fetch_array($res)){
    switch($arr['alarm_type']){
        case '1':
            $str .= "예약 : ".$arr['cnt']."건 <br>";
            break;
        case '2':
            $str .= "재통 : ".$arr['cnt']."건 <br>";
            break;
        case '3':
            $str .= "부재 : ".$arr['cnt']."건 <br>";
            break;
        case '4':
            $str .= "캐어 : ".$arr['cnt']."건 <br>";
            break;
    }
    $cnt++;
}

if($cnt>0) {
    $str .= "확인해주세요.";
    echo $str;
} else {
    echo false;
}



?>
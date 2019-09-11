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
$root_url = "http://www.lottorico.co.kr"; //그누보드가 설치된 위치의 url, 끝에 "/"을 붙이지 않음

//===========================================================================
// 이하 수정금지
//===========================================================================


include($root_path."/common.php");

$fail = 0;

//sql_query("START TRANSACTION");

//당첨결과가 전송이 안된게 있는지 확인 한다.
$turn = get_current_hit_turn();

//1등 당첨 결과
$que = "SELECT hit_num FROM lotto_hit_result WHERE hit_turn = '{$turn}' ";
$row = sql_fetch($que);



//문자 발송하자.
unset($str);
$sql2 = "SELECT a.*, b.mb_name, b.mb_hp FROM member_win_cnt a LEFT JOIN g5_member b ON a.win_mb_id = b.mb_id  WHERE win_turn  = '{$turn}' AND send_sms_yn = 'N' ";
echo $sql2."<br>";
$res2 = sql_query($sql2);
while($arr = sql_fetch_array($res2)){

    $str = "로또리코 당첨알림문자 입니다.\n";
    $str .= "{$turn}회차 1등당첨번호 ".str_replace("|",",",$row['hit_num'])."\n";
    $str .= "{$arr['mb_name']}({$arr['win_mb_id']})님 당첨을 축하드립니다.\n";
    if($arr['win_grade1']>0) {
        $ct = "({$arr['win_grade1']}개) ";
        $str .= "1등{$ct}당첨되셨습니다.\n";
    }
    if($arr['win_grade2']>0){
        $ct = "({$arr['win_grade2']}개) ";
        $str .= "2등{$ct}당첨되셨습니다.\n";
    }
    if($arr['win_grade3']>0){
        $ct = "({$arr['win_grade3']}개) ";
        $str .= "3등{$ct}당첨되셨습니다.\n";
    }
    if($arr['win_grade4']>0){
        $ct = "({$arr['win_grade4']}개) ";
        $str .= "4등{$ct}당첨되셨습니다.\n";
    }
    if($arr['win_grade5']>0){
        $ct = "({$arr['win_grade5']}개) ";
        $str .= "5등{$ct}당첨되셨습니다.\n";
    }
    //echo $str;
    echo $sms_result = SendMesg($arr['mb_hp'],$str);
    save_sms_log($arr['win_mb_id'],$turn,$str,$arr['mb_hp'],$sms_result);
    //문자 발송되었다는 걸 업데이트 한다.
    if($sms_result == 'R000') {
        $sql3 = "UPDATE member_win_cnt SET send_sms_yn = 'Y' WHERE win_turn = '{$turn}' AND win_mb_id = '{$arr['win_mb_id']}'";
        echo $sql3 . "<br>";
        $res3 = sql_query($sql3);
    }
}

/*if($fail>0){
    sql_query("ROLLBACK");
} else {
    sql_query("COMMIT");
}*/
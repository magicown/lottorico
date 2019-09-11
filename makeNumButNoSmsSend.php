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
//ini_set("display_errors",1);

//금주에 회차를 구한다.
$sql = "SELECT hit_turn FROM lotto_hit_result WHERE 1 ORDER BY idx DESC LIMIT 1";
//echo $sql."<br>";
$rs = sql_fetch($sql);
$turn = $rs['hit_turn']+1;

//오늘 요일 구하기
$today_n = date("N");
$today_date = date("Y-m-d");

//무료 회원 번호 만들기
$today_date = date("Y-m-d");
$today = date("N");
//$today = 4;
$week = array(1=>"mon_sms_cnt",2=>"tue_sms_cnt",3=>"wed_sms_cnt",4=>"thu_sms_cnt",5=>"fri_sms_cnt",6=>"sat_sms_cnt");
$fail = 0;
//SELECT * FROM g5_member WHERE mb_level = '2' AND mb_hp != '' AND mb_leave_date = '' AND mb_10 > 0 AND mb_1 = '3' AND mb_2 > '2019-05-27'
$que = "SELECT today_will_make_id AS mb_id FROM today_will_make_num_chk WHERE  week_turn = '{$turn}' AND today_do_make_num = 'Y' AND today_send_sms_yn = 'N' AND make_date = '{$today_date}' ";
echo $que."<br>";
$res_que = sql_query($que);
while ($pay = sql_fetch_array($res_que)) {
    unset($que2);
    unset($num_chk);
    //sms 보내기전에 등록된 금일의 데이터가 있는지 확인한다.
    $que2 = "SELECT COUNT(*) AS ccnt FROM member_lotto_num WHERE mb_id = '{$pay['mb_id']}' AND lotto_turn = '{$turn}' AND direct_send = 'N' AND DATE_FORMAT(reg_date, '%Y-%m-%d') = '{$today_date}' ";
    echo $que2."<br>";
    $num_chk = sql_fetch($que2);
    echo "만든번호 갯수->".$num_chk['ccnt']."<br>";
    unset($que1);
    if($num_chk['ccnt']>0) {
        $que1 = "SELECT lotto_num FROM member_lotto_num WHERE mb_id = '{$pay['mb_id']}' AND lotto_turn = '{$turn}' AND direct_send = 'N' AND DATE_FORMAT(reg_date, '%Y-%m-%d') = '{$today_date}' ";
        echo $que1 . "<br><br><br>";
        $que1_res = sql_query($que1);
        $i = 0;
        unset($num);
        unset($chk);
        unset($sm);
        while ($chk = sql_fetch_array($que1_res)) {
            $num = ($i < 9) ? '0' . ($i + 1) : ($i + 1);
            $sm .= "[" . $num . "] " . $chk['lotto_num'] . "\n";
            $i++;
        }

        $pay_name = get_member_pay_name($pay['mb_id']);


        unset($hpMesg);
        $hp = str_replace("-", "", $pay_name['mb_hp']);
        echo $hpMesg = "{$turn}회차 1등 예상번호 로또리코 {$pay_name['pay_name']}\n{$sm}\n\n무료거부 (080-855-6398)";
        echo "<br><br>";

        $str = str_replace("\n","",$hpMesg);
        echo $str."<br>";

        //금일 동일한 문자로 발송된게 있는지 확인 한다.
        unset($sql);
        $sql = "SELECT COUNT(*) as cnt FROM g5_sms_log WHERE replace(sms_content,'\\n','') LIKE '%{$str}%' AND mb_id = '{$pay['mb_id']}' AND DATE_FORMAT(sms_regdate, '%Y-%m-%d') = '{$today_date}'";
        echo $sql."<br>";
        $row = sql_fetch($sql);

        if($pay_name['mb_5']!='Y' && !$row['cnt']) {//일시정지 회원은 문자발송 안한다.
            $sms_result = SendMesg($hp, $hpMesg);
            save_sms_log($pay['mb_id'], $turn, $hpMesg, $hp, $sms_result);

            $que3 = "UPDATE today_will_make_num_chk SET  ";
            $que3 .= "today_send_sms_yn = 'Y', ";
            $que3 .= "update_date = NOW() ";
            $que3 .= " WHERE today_will_make_id = '{$pay['mb_id']}' ";
            echo $que3;
            $res_que3 = sql_query($que3);
        }
    }
}

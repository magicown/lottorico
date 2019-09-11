<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/json.lib.php');

$mode = $_REQUEST['mode'];
switch($mode){
    case 'hpChk'://휴대폰 번호 사용중인지 확인한다.
        $hp = str_replace("-","",$_REQUEST['hp']);
        $que = "SELECT * FROM g5_member WHERE REPLACE(mb_hp,'-','') = '{$hp}'";
        //echo $que."<br>";
        $row = sql_fetch($que);
        echo  $row['mb_level'];
        break;
    case 'yak'://약관동의 문자 발송
        if($_REQUEST['id']=='' || $_REQUEST['hp']==''){
            return false;
        } else {
            $hp = str_replace("-","",$_REQUEST['hp']);
            $hpMesg = "[로또리코] 회원동의 약관 페이지 링크를 첨부합니다.\n로그인 후 하단에 약관 동의하시고 제출버튼을 클릭해주세요.\nhttp://lottorico.co.kr/bbs/page.php?hid=guide&mb_id={$_REQUEST['id']} ";
            $sms_result = SendMesg($hp,$hpMesg);
            save_sms_log($_REQUEST['id'],"",$hpMesg,$hp,$sms_result);

            return $sms_result;

        }
        break;
    case 'smsAgreeYn'://sms수신동의
        if($_REQUEST['id']==''){
            return false;
        } else {
            $sql = "UPDATE g5_member SET mb_sms = 'Y' WHERE mb_id = '{$_REQUEST['id']}'";
            //echo $sql;
            $res = sql_query($sql);
            if($res){
                return true;
            } else {
                return false;
            }
        }
        break;
    case 'reSendSMS'://회차별 문자를 다시 발송한다.
        $i = 0;
        $sm = "";
        $mb = get_member($_REQUEST['id']);

        $que2 = "SELECT pay_name FROM g5_pay_type WHERE idx = '{$mb['mb_10']}'";
        $row2 = sql_fetch($que2);

        $que = "SELECT * FROM member_lotto_num WHERE mb_id = '{$_REQUEST['id']}' AND lotto_turn = '{$_REQUEST['turn']}' ";
        //echo $que;
        $res = sql_query($que);
        while($arr = sql_fetch_array($res)){
            $num = ($i<9)?'0'.($i+1):($i+1);
            $sm .= "[".$num."] ".$arr['lotto_num']."\n";
            $i++;
        }

        $hp = str_replace("-","",$mb['mb_hp']);
        $hpMesg = "{$_REQUEST['turn']}회차 1등 예상번호 로또리코 {$row2['pay_name']}\n{$sm}\n\n무료거부 (080-855-6398)";
        $sms_result = SendMesg($hp,$hpMesg);
        save_sms_log($_REQUEST['id'],"",$hpMesg,$hp,$sms_result);
        if($sms_result == 'R000'){
            echo true;
        } else {
            echo false;
        }
        break;
    case 'changeID':
        //사용중인 아이디 인지를 확인한다.
        $que = "SELECT COUNT(*) AS cnt FROM g5_member WHERE mb_id = '{$_POST['mb_id']}'";
        $row = sql_fetch($que);
        if(!$row['cnt']){

        }
        break;

}

?>
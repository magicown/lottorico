<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2019-04-02
 * Time: 오전 10:21
 */


    $sub_menu = "200100";
    include_once("./_common.php");
    include_once(G5_LIB_PATH."/register.lib.php");
    include_once(G5_LIB_PATH.'/thumbnail.lib.php');

    $mode = $_REQUEST['mode'];
    switch($mode){
        case 'writeMemo':
            $result = array();
            $etc = "";
            if($etc_sms == 1){
                $etc .= "문자";
            } else if($etc_msg == 1){
                $etc .= " / 쪽지";
            }

            $flg = false;
            $sql = "INSERT INTO g5_member_memo SET ";
            $sql .= "writer_id      = '{$_SESSION['ss_mb_id']}', ";
            $sql .= "mb_id          = '{$mb_id}', ";
            $sql .= "pay_money      = '{$pay_money}', ";
            $sql .= "take_pay_type  = '{$take_pay_type}', ";
            $sql .= "use_pay_type   = '{$use_pay_type}', ";
            $sql .= "miss_pay       = '{$miss_pay}', ";
            $sql .= "miss_pay_date  = '{$miss_pay_date}', ";
            $sql .= "alarm_date     = '{$alarm_date}', ";
            $sql .= "alarm_hour     = '{$alarm_hour}', ";
            $sql .= "alarm_min      = '{$alarm_min}', ";
            $sql .= "alarm_type      = '{$alarm_type}', ";
            $sql .= "other_type     = '{$etc}', ";
            $sql .= "fav            = '{$fav}', ";
            $sql .= "memo_pay_date  = '{$pay_date}', ";
            $sql .= "memo_content   = '".sql_real_escape_string($mb_memo)."', ";
            $sql .= "memo_regdate   = NOW() ";
            //echo $sql;
            $res = sql_query($sql);
            if($res){
                $flg = true;
            }

            //알람은 시간과 구분값이 있어야만 등록된다.
            $alarm = $alarm_date." ".$alarm_hour.":".$alarm_min.":00";
            if($alarm_date!='' && $alarm_type != '') {
                $sql_id = sql_insert_id();

                //알람등록
                $que = "INSERT INTO g5_alarm_schedule SET ";
                $que .= "memo_idx       = '{$sql_id}', ";
                $que .= "reg_mb_id      = '{$_SESSION['ss_mb_id']}', ";
                $que .= "mb_id          = '{$mb_id}', ";
                $que .= "alarm_type     = '{$alarm_type}', ";
                $que .= "alarm_fav      = '{$fav}', ";
                $que .= "alarm_datetime = '{$alarm}', ";
                $que .= "alarm_content   = '".sql_real_escape_string($mb_memo)."', ";
                $que .= "alarm_regdate     = NOW() ";
                //echo $que;
                $que_res = sql_query($que);
                if ($que_res) {
                    $flg = true;
                }
            }

            $result['flag'] = $flg;
            echo json_encode($result);
            break;

        case 'memberMemoDel':
            $flg = false;
            for($i=0;$i<count($idx);$i++) {
                $sql = "DELETE FROM g5_member_memo WHERE memo_idx = {$idx[$i]}";
                //echo $sql."<br>";
                sql_query($sql);
            }
            echo json_encode(array("error" => false, "result" => "메모가 정상적으로 삭제되었습니다."));
            break;

        case 'reSendSms':
            $sql = "SELECT * FROM g5_sms_log WHERE idx = {$idx}";
            $row = sql_fetch($sql);

            $hpMesg         = $row['sms_content'];

            // 한줄로 이어쓰기 하세요.
            $sms_result = SendMesg($row[sms_hp],$hpMesg);

            $msg = $row['sms_content'];
            save_sms_log($row['mb_id'],$row['sms_turn'],$msg,$row['sms_hp'],$sms_result);
            echo json_encode(array("error"=>false, "result"=>$sms_result));
            break;

        case 'alarmOff'://메모 알람끄기
            $idx = $_REQUEST['no'];
            $sql = "UPDATE g5_alarm_schedule SET alarm_chk_yn  = 'Y', alarm_close_date = NOW() WHERE alarm_idx = '{$idx}' ";
            //echo $sql;
            $res = sql_query($sql);
            if($res){
                echo true;
            } else {
                echo false;
            }
            break;

        case 'sendMemberSms'://회원검색 문자 메세지 전송

            if($_REQUEST['message']=='' || $_REQUEST['mb_hp']==''){
                echo json_encode(array("error"=>true, "result"=>'입력값 미전송'));
            } else {
                $hpMesg = urldecode($_REQUEST['message']);
                $mb_hp = $_REQUEST['mb_hp'];
                $mb_id = $_REQUEST['mb_id'];

                // 한줄로 이어쓰기 하세요.
                $sms_result = SendMesg($mb_hp, $hpMesg);

                save_sms_log($mb_id, '', $hpMesg, $mb_hp, $sms_result);
                echo json_encode(array("error" => false, "result" => $sms_result));
            }
            break;

    }
?>
<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/json.lib.php');

$mode = $_REQUEST['mode'];
$type = $_REQUEST['type'];
$nam = $_REQUEST['name'];
switch($mode){
    case 'freeCounselor': //무료번호 받기 상담 요청
        if($type=='L'){
            //$hp = $_REQUEST['hp'];
            $hp = str_replace("-","",$_REQUEST['hp']);
        } else {
            $hp = $_REQUEST['hp1'].$_REQUEST['hp2'].$_REQUEST['hp3'];
        }

        if($hp == ''){
            echo json_encode(array("error" => true, "result" => "휴대폰 번호가 정상적으로 넘어오지 않았습니다."));
        } else {

            $que = "SELECT COUNT(*) AS hp_cnt FROM g5_member WHERE REPLACE(mb_hp,'-','') = '{$hp}' ";
            //echo $que;
            $row1 = sql_fetch($que);
            if($row1[hp_cnt]>0){
                echo json_encode(array("error" => true, "result" => "이미 사용중인 휴대폰 번호입니다."));
            } else {
                $sql = "SELECT COUNT(*) AS cnt FROM g5_member WHERE mb_id LIKE 'rico%' ";
                //echo $sql;
                $row = sql_fetch($sql);

                $new_id = 'rico_'.($row[cnt] + 1);
                $new_pw = substr($hp,-4);
                if($type == 'L'){
                    $new_name = "상담요청(랜딩페이지)";
                } else {
                    $new_name = "상담요청(1등번호받기)";
                }

                //print_r($_POST);
                $que1 = "INSERT INTO g5_member SET ";
                $que1 .= "mb_id          = '{$hp}', ";
                $que1 .= "mb_name        = '{$new_name}', ";
                $que1 .= "mb_password    = '" . get_encrypt_string($new_pw) . "', ";
                $que1 .= "mb_hp          = '{$hp}', ";
                $que1 .= "mb_level       = '2', ";
                $que1 .= "mb_10         = '1', ";
                $que1 .= "member_grade_date = NOW(), ";
                $que1 .= "mb_datetime    = NOW() ";

                //echo $que1;
                $res = sql_query($que1);
                if ($res) {
                    //랜딩 페이지 신청시 문자를 발송한다.
                    if($type == 'L') {
                        $msg = "";
                        //makeFreeLottoNum($new_id, $hp);
                    }
                    regCounselor($hp, $hp, $nam, $type);
                    echo json_encode(array("error" => false, "result" => "정상적으로 신청되었습니다."));
                } else {
                    echo json_encode(array("error" => true, "result" => "무료 상담 신청등록시 오류가 발생했습니다.\\n잠시 후 다시 시도해주세요."));
                }
            }
        }
    break;
}

?>
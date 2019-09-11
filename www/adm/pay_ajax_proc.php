<?php
    include_once('./_common.php');
    include_once(G5_LIB_PATH.'/json.lib.php');

    $mode = $_REQUEST['mode'];
    switch($mode){
        case 'payReg':
            sql_query("START TRANSACTION");
            $sql = "SELECT COUNT(*) AS cnt FROM g5_pay_type WHERE pay_name = '{$pay_name}' AND pay_money = '{$pay_money}'";
            //echo $sql;
            $row = sql_fetch($sql);
            if (!$row[cnt]) {
                $que = "INSERT INTO g5_pay_type SET ";
                $que .= "pay_name = '{$pay_name}', ";
                $que .= "pay_money = '{$pay_money}', ";
                $que .= "pay_date = '{$pay_date}', ";
                $que .= "pay_memo = '{$pay_memo}', ";
                $que .= "pay_use_yn = '{$pay_use}', ";
                $que .= "pay_regdate = NOW() ";
                //echo $que . "<br>";
                $res = sql_query($que);
                if ($res) {
                    $id = sql_insert_id();
                    $que1 = "INSERT INTO g5_pay_type_log SET ";
                    $que1 .= "pay_idx = {$id}, ";
                    $que1 .= "change_id = '{$_SESSION['ss_mb_id']}', ";
                    $que1 .= "org_money = {$pay_money}, ";
                    $que1 .= "chg_money = NULL, ";
                    $que1 .= "reg_date = NOW() ";
                    //echo $que1;
                    $res1 = sql_query($que1);
                    if($res1){
                        sql_query("COMMIT");
                        echo json_encode(array("error" => false, "result" => "정상적을 등록되었습니다."));
                    } else {
                        sql_query("ROLLBACK");
                        echo json_encode(array("error" => true, "result" => "로그 등록시 오류 발생."));
                    }
                } else {
                    sql_query("ROLLBACK");
                    echo json_encode(array("error" => true, "result" => "디비 등록오류"));
                }
            } else {
                sql_query("ROLLBACK");
                echo json_encode(array("error" => true, "result" => "이미 등록된 결제타입입니다."));
            }
            break;
        case 'payUpdateChk':
            $sql = "SELECT * FROM g5_pay_type WHERE idx = {$idx}";
            //echo $sql;
            $row = sql_fetch($sql);
            if ($row[idx]) {
                echo json_encode(array("error" => false, "result" => "","rs"=>$row));
            } else {
                echo json_encode(array("error" => true, "result" => "상품검색시 오류가 발생했습니다."));
            }
            break;
        case 'payUpdate':
            sql_query("START TRANSACTION");
            //원래 등록된 금액을 가져온다.
            $sql = "SELECT pay_money FROM g5_pay_type WHERE idx = {$idx}";
            $row = sql_fetch($sql);
            if($row[pay_money]) {
                $que = "UPDATE g5_pay_type SET ";
                $que .= "pay_name = '{$pay_name}', ";
                $que .= "pay_money = '{$pay_money}', ";
                $que .= "pay_date = '{$pay_date}', ";
                $que .= "pay_memo = '{$pay_memo}', ";
                $que .= "pay_use_yn = '{$pay_use}' ";
                $que .= " WHERE idx = {$idx}";
                //echo $que;
                $res = sql_query($que);
                if ($res) {
                    if($row[pay_money]!=$pay_money) {
                        $que1 = "INSERT INTO g5_pay_type_log SET ";
                        $que1 .= "pay_idx = {$idx}, ";
                        $que1 .= "change_id = '{$_SESSION['ss_mb_id']}', ";
                        $que1 .= "org_money = {$row[pay_money]}, ";
                        $que1 .= "chg_money = {$pay_money}, ";
                        $que1 .= "reg_date = NOW() ";
                        echo $que1;
                        $res1 = sql_query($que1);
                        if ($res1) {
                            sql_query("COMMIT");
                            echo json_encode(array("error" => false, "result" => "정상적으로 수정 되었습니다."));
                        } else {
                            sql_query("ROLLBACK");
                            echo json_encode(array("error" => true, "result" => "결제타입 로그 입력시 오류가 발생했습니다."));
                        }
                    } else {
                        sql_query("COMMIT");
                        echo json_encode(array("error" => false, "result" => "정상적으로 수정 되었습니다."));
                    }
                }
            } else {
                sql_query("ROLLBACK");
                echo json_encode(array("error" => true, "result" => "결제타입 변경시 오류가 발생했습니다."));
            }
            break;
        case 'payUpdatePrice':
            sql_query("START TRANSACTION");
            //원래 등록된 금액을 가져온다.
            $sql = "SELECT pay_money FROM g5_pay_type WHERE idx = {$idx}";
            $row = sql_fetch($sql);
            if($row[pay_money]) {
                $que = "UPDATE g5_pay_type SET ";
                $que .= "pay_money = '{$pay_money}', ";
                $que .= "pay_use_yn = '{$pay_use}' ";
                $que .= " WHERE idx = {$idx}";
                $res = sql_query($que);
                if ($res) {
                    if($row[pay_money]!=$pay_money) {
                        $que1 = "INSERT INTO g5_pay_type_log SET ";
                        $que1 .= "pay_idx = {$idx}, ";
                        $que1 .= "change_id = '{$_SESSION['ss_mb_id']}', ";
                        $que1 .= "org_money = {$row[pay_money]}, ";
                        $que1 .= "chg_money = {$pay_money}, ";
                        $que1 .= "reg_date = NOW() ";
                        //echo $que1;
                        $res1 = sql_query($que1);
                        if ($res1) {
                            sql_query("COMMIT");
                            echo json_encode(array("error" => false, "result" => "정상적으로 수정 되었습니다."));
                        } else {
                            sql_query("ROLLBACK");
                            echo json_encode(array("error" => true, "result" => "결제금액 로그 입력시 오류가 발생했습니다."));
                        }
                    }
                }
            } else {
                sql_query("ROLLBACK");
                echo json_encode(array("error" => true, "result" => "결제금액 수정시 오류가 발생했습니다."));
            }
            break;
        case 'memUpdateGrade':
            $ex_date = makeGradeExpireDate($pay_idx);

            //이전 회원정보 등급을 구한다.
            $sql = "SELECT mb_10 FROM g5_member WHERE mb_id = '{$mb_id}'";
            $org = sql_fetch($sql);
            unset($sql);

            if($ex_date || !$pay_idx || !$mb_id) {
                sql_query("START TRANSACTION");
                if($pay_idx == 'n'){//회원 초기화일 경우
                    $sql = "UPDATE g5_member SET mb_10 = '', mb_2 = '' WHERE mb_id = '{$mb_id}'";
                    //echo $sql;
                    $res = sql_query($sql);
                    if ($res) {
                        $que = "INSERT INTO g5_member_grade_log SET ";
                        $que .= "log_mb_id = '{$mb_id}', ";
                        $que .= "log_org_grade = '{$org[mb_10]}', ";
                        $que .= "log_chg_grade = '0', ";
                        $que .= "log_change_id = '{$_SESSION['ss_mb_id']}', ";
                        $que .= "log_regdate = NOW() ";
                        $res1 = sql_query($que);
                        if ($res1) {
                            sql_query("COMMIT");
                            echo json_encode(array("error" => false, "result" => "정상적으로 등급이 초기화 되었습니다."));
                        } else {
                            sql_query("ROLLBACK");
                            echo json_encode(array("error" => true, "result" => "등급변경 로그 수정시 오류가 발생했습니다."));
                        }
                    } else {
                        sql_query("ROLLBACK");
                        echo json_encode(array("error" => true, "result" => "등급변경 초기화시 오류가 발생했습니다."));
                    }
                } else {
                    $sql = "UPDATE g5_member SET mb_10 = '{$pay_idx}', mb_2 = '{$ex_date}' WHERE mb_id = '{$mb_id}'";
                    //echo $sql;
                    $res = sql_query($sql);
                    if ($res) {
                        $que = "INSERT INTO g5_member_grade_log SET ";
                        $que .= "log_mb_id = '{$mb_id}', ";
                        $que .= "log_org_grade = '{$org[mb_10]}', ";
                        $que .= "log_chg_grade = '{$pay_idx}', ";
                        $que .= "log_change_id = '{$_SESSION['ss_mb_id']}', ";
                        $que .= "log_regdate = NOW() ";
                        $res1 = sql_query($que);
                        if ($res1) {
                            sql_query("COMMIT");
                            echo json_encode(array("error" => false, "result" => "정상적으로 등급이 변경 되었습니다."));
                        } else {
                            sql_query("ROLLBACK");
                            echo json_encode(array("error" => true, "result" => "등급변경 로그 수정시 오류가 발생했습니다."));
                        }
                    } else {
                        sql_query("ROLLBACK");
                        echo json_encode(array("error" => true, "result" => "등급변경 수정시 오류가 발생했습니다."));
                    }
                }
            } else {
                sql_query("ROLLBACK");
                echo json_encode(array("error" => true, "result" => "데이터가 정상적으로 넘어오지 않았습니다."));
            }
            break;
            //제외수 등록하기
        case 'exceptNum':

            if($idx!=''){
                $que = "UPDATE g5_except_num SET ";
                $que .= "except_num     = '{$exp_num}', ";
                $que .= "turn           = '{$_POST['turn']}' ";
                $que .= " WHERE idx = {$idx}";
                //echo $que;
                $res = sql_query($que);
                if ($res) {
                    echo json_encode(array("error" => false, "result" => "정상적으로 제외수가 수정 되었습니다."));
                } else {
                    echo json_encode(array("error" => true, "result" => "제외수 수정시 오류가 발생했습니다."));
                }
            } else {
                $que = "INSERT INTO g5_except_num SET ";
                $que .= "pay_idx        = '{$pay_idx}', ";
                $que .= "turn           = '{$_POST['turn']}',";
                $que .= "except_num     = '{$exp_num}', ";
                $que .= "except_regdate = NOW() ";
                //echo $que;
                $res = sql_query($que);
                if ($res) {
                    echo json_encode(array("error" => false, "result" => "정상적으로 제외수가 등록 되었습니다."));
                } else {
                    echo json_encode(array("error" => true, "result" => "제외수 등록시 오류가 발생했습니다."));
                }
            }
            break;

            //무통장 계좌번호 전송
        case 'bankSms':
            $hp     = $_REQUEST['hp'];
            $bank   = $_REQUEST['bank'];
            $name   = $_REQUEST['name'];
            $id     = $_REQUEST['mb_id'];
            $money  = $_REQUEST['money'];
            $msg = "[로또리코] 요청하신 입금계좌 {$bank}";

            $sms_result = SendMesg($hp,$msg);

            save_sms_log($id,$turn,$msg,$hp,$sms_result);

            if($sms_result == 'R000') {
                echo json_encode(array("error" => false, "result" => "무통장 계좌가 정상적으로 발송되었습니다."));
            } else {
                echo json_encode(array("error" => true, "result" => "무통장 계좌가 발송이 실패했습니다."));
            }


            break;
            //관리자 당첨번호 전송
        case 'lottoSms':
            $hp = $_REQUEST['hp'];
            $id = $_REQUEST['mb_id'];

            //금주에 회차를 구한다.
            $sql = "SELECT hit_turn FROM lotto_hit_result WHERE 1 ORDER BY idx DESC LIMIT 1";
            //echo $sql."<br>";
            $rs = sql_fetch($sql);
            $turn = $rs['hit_turn']+1;


            $fail = 0;
            $que = "SELECT * FROM g5_member WHERE mb_id = '{$id}'  ";
            //echo $que."<br>";
            $pay = sql_fetch($que);
            if($pay['mb_10'] != '') {

                //회원정보와 회차로 등록된 정보가 있는지 확인 한다.
                $already = alreadyUpdateLottoNumber($pay['mb_id'], $turn);
                if (!$already) {

                    $pay_class = getPayType($pay[mb_10]);
                    //제외수를 가져온다.
                    $except = getExceptNumCron($turn, $pay[mb_10]);

                    //로또번호를 생성한다.
                    $lotto = makeLottoNumPay($except, $pay[mb_3]);

                    $sm = $hpMesg = "";
                    sql_query("SET AUTOCOMMIT=0");
                    sql_query("START TRANSACTION");
                    for ($i = 0; $i < count($lotto); $i++) {
                        //생성된 번호는 사용으로 만든다.
                        $que = "UPDATE lotto_num SET use_yn = 'Y', mb_id = '{$pay[mb_id]}', regdate = NOW() WHERE idx = {$lotto[$i][idx]}";
                        //echo $que . "<br>";
                        $res = sql_query($que);
                        if (!$res) {
                            $fail++;
                        }

                        //사용된 번호를 회원정보에 업데이트 한다.
                        //$data = explode(",", $lotto);

                        //print_r($lotto);
                        $lnum[$i] = $lotto[$i][no1] . "," . $lotto[$i][no2] . "," . $lotto[$i][no3] . "," . $lotto[$i][no4] . "," . $lotto[$i][no5] . "," . $lotto[$i][no6];
                        $que = "INSERT INTO member_lotto_num SET ";
                        $que .= "mb_id          = '{$pay[mb_id]}', ";
                        $que .= "lotto_num      = '{$lnum[$i]}', ";
                        $que .= "lotto_turn     = '{$turn}', ";
                        $que .= "lotto_result   = '', ";
                        $que .= "reg_date       = NOW() ";
                        //echo $que . "<br>";
                        $res_cnt = sql_query($que);
                        if (!$res_cnt) {
                            $fail++;
                        }
                    }


                    if ($fail > 0) {
                        sql_query("ROLLBACK");
                    } else {
                        for ($k = 0; $k < count($lnum); $k++) {
                            $num = ($k < 9) ? '0' . ($k + 1) : ($k + 1);
                            $sm .= "[" . $num . "] " . $lnum[$k] . "\n";
                        }

                        //메세지 전송 회원 휴대폰 번호가 있을때만 보낸다.
                        if ($pay['mb_hp']) {


                            unset($hpReceiver);
                            unset($hpMesg);



                            $que2 = "SELECT pay_name FROM g5_pay_type WHERE idx = '{$pay[mb_10]}'";
                            $row2 = sql_fetch($que2);

                            $hpMesg = "{$turn}회차 1등 예상번호 로또리코 {$row2['pay_name']}\n{$sm}\n\n무료거부 (080-855-6398)";




                            // 한줄로 이어쓰기 하세요.
                            $sms_result = SendMesg($pay['mb_hp'], $hpMesg);
                            save_sms_log($pay['mb_id'], $turn, $hpMesg, $pay[mb_hp], $sms_result);
                            if($sms_result == 'R000') {
                                echo json_encode(array("error" => false, "result" => "당첨번호가 정상적으로 발송되었습니다."));
                            } else {
                                echo json_encode(array("error" => true, "result" => "당첨번호 발송이 실패했습니다."));
                            }
                        }
                        sql_query("COMMIT");

                    }
                } else {
                    echo json_encode(array("error" => true, "result" => "금주당첨 번호가 이미 발송되었습니다."));
                }


            }// if mb_10


        break;

        case 'getExpireDate':
            $que = "SELECT pay_date FROM g5_pay_type WHERE idx = '{$pay_idx}'";
            //echo $que;
            $row = sql_fetch($que);
            if($row['pay_date']>0){
                $expire_date = date("Y-m-d",strtotime("-1 day",strtotime("+{$row['pay_date']} months")));
            } else {
                $expire_date = "";
            }
            echo json_encode(array("error" => false, "result" => $expire_date));
            break;

    }

?>
<?php

    include_once("./_common.php");
    include_once('./admin.head.php');


    if($_POST['pay_chk1']==''){
        alert('상품정보가 넘어오지 않았습니다..','./member_pay_form.php');
    }

    if($_POST['pay_money']==''){
        alert('상품금액이 넘어오지 않았습니다..','./member_pay_form.php');
    }

    if($_POST['pay_name']==''){
        alert('상품명이 넘어오지 않았습니다..','./member_pay_form.php');
    }

    if($_POST['mb_name1']==''){
        alert('구매자 성명이 넘어오지 않았습니다..','./member_pay_form.php');
    }

    if($_POST['mb_hp']=='') {
        alert('휴대폰 번호가 넘어오지 않았습니다.');
    }
    if($_POST['pay_money']=='') {
        alert('상품금액이 넘어오지 않았습니다.');
    }
    if($_POST['bank_num']=='') {
        alert('계좌정보가 넘어오지 않았습니다.');
    }

    $pay_money = str_replace(",","",$_POST['pay_money']);
    $bank_info = $_POST['bank_num'];
    $pay_idx = $_POST['pay_chk1'];
    $order = $_POST['orderNumber1'];
    $pay_info = $_POST['mb_name1'];

    $que  = "INSERT INTO g5_pay_report SET ";
    $que .= "mb_id          = '{$mb_id}', ";
    $que .= "pay_type       = 'BANK', ";
    $que .= "pay_idx        = '{$pay_idx}', ";
    $que .= "order_numer    = '{$order}', ";
    $que .= "order_money    = {$pay_money}, ";
    $que .= "bank_name      = '{$bank_info}', ";
    $que .= "pay_info       = '{$pay_info}', ";
    $que .= "card_name      = '', ";
    $que .= "auth_number    = '', ";
    $que .= "auth_datetime  = '', ";
    $que .= "kakao_result   = '', ";
    $que .= "transaction_id = '', ";
    $que .= "response_code  = '', ";
    $que .= "pay_gubun      = '무통장입금', ";
    $que .= "response_msg   = '입금대기', ";
    $que .= "reg_date       = NOW()";
    //echo $que."<br>";
    $res = sql_query($que);
    if($res) {
        $hpMesg = "[로또리코] 요청하신 입금계좌 {$bank_info}\n(주)더블에이치컴퍼니 {$_POST['pay_money']}원 입니다.";
        //$sql = "SELECT COUNT(*) FROM g5_pay_report WHERE reg_date >= DATE_ADD(NOW(),INTERVAL 1 MINUTE) AND mb_id = '{$mb_id}'";
        $sms_result = SendMesg($_POST['mb_hp'], $hpMesg);
        save_sms_log($_POST['mb_id'], '', $hpMesg, $_POST['mb_hp'], $sms_result);
    }
?>

<script>
    parent.call_back('<?php echo $sms_result; ?>');
</script>

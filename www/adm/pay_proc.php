<?php

include_once("./_common.php");
include_once('./admin.head.php');
//$url = 'http://dev.payup.co.kr/v2/api/payment/pluginTest/keyin2.do'; //접속할 url 입력
$url = 'https://cp.payup.co.kr/v2/api/payment/lotto645/keyin2.do'; //접속할 url 입력

if($_POST['cardNo1']=='' || $_POST['cardNo2']=='' || $_POST['cardNo3']=='' || $_POST['cardNo4']==''){
    alert('카드정보가 정상적으로 넘어오지 않았습니다.','./member_pay_form.php');
}

if($_POST['expireYear']==''||$_POST['expireYear']==''){
    alert('카드정보가 정상적으로 넘어오지 않았습니다.','./member_pay_form.php');
}

if($_POST['birthday']==''){
    alert('생년월일이 넘어오지 않았습니다..','./member_pay_form.php');
}

if($_POST['cardPw']==''){
    alert('카드비밀번호가 넘어오지 않았습니다..','./member_pay_form.php');
}


if($_POST['pay_money']==''){
    alert('상품금액이 넘어오지 않았습니다..','./member_pay_form.php');
}


if($_POST['pay_name']==''){
    alert('상품명이 넘어오지 않았습니다..','./member_pay_form.php');
}

if($_POST['mb_name']==''){
    alert('구매자 성명이 넘어오지 않았습니다..','./member_pay_form.php');
}

if($_POST['mb_hp']==''){
    alert('휴대폰 번호가 넘어오지 않았습니다.');
}




$cardNo = $_POST['cardNo1'].$_POST['cardNo2'].$_POST['cardNo3'].$_POST['cardNo4'];
$pay_money = str_replace(",","",$_POST['pay_money']);

$id = "lotto645";
$pkey = "d4da0e9fba2549f5a98c0977d23f5128";
$post_data["orderNumber"]   = $_POST['orderNumber'];
$post_data["cardNo"]        = $cardNo;
$post_data["expireMonth"]   = $_POST['expireMonth'];
$post_data["expireYear"]    = $_POST['expireYear'];
$post_data["birthday"]      = $_POST['birthday'];
$post_data["cardPw"]        = $_POST['cardPw'];
$post_data["amount"]        = $pay_money;
$post_data["quota"]         = $_POST['quota'];
$post_data["itemName"]      = $_POST['pay_name'];
$post_data["userName"]      = $_POST['mb_name'];
$post_data["mobileNumber"]  = $_POST['mb_hp'];
$post_data["kakaoSend"]     = "Y";
$post_data["userEmail"]     = "";
$post_data["timestamp"]     = date("YmdHis");
//echo "<br>";

$sig = hash('sha256',$id.'|'.$post_data["orderNumber"].'|'.(int)$post_data["amount"].'|'.$pkey.'|'.$post_data["timestamp"]);
//echo strlen($sig);
$post_data["signature"]     = $sig;

//print_r($post_data);
$ch = curl_init(); //curl 사용 전 초기화 필수(curl handle)

$t = json_encode($post_data);
curl_setopt($ch, CURLOPT_URL, $url); //URL 지정하기
curl_setopt($ch, CURLOPT_POST, 1); //0이 default 값이며 POST 통신을 위해 1로 설정해야 함
curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($post_data)); //POST로 보낼 데이터 지정하기
curl_setopt ($ch, CURLOPT_POSTFIELDSIZE, 0); //이 값을 0으로 해야 알아서 &post_data 크기를 측정하는듯

curl_setopt($ch, CURLOPT_HEADER, true);//헤더 정보를 보내도록 함(*필수)
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json')); //header 지정하기
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); //이 옵션이 0으로 지정되면 curl_exec의 결과값을 브라우저에 바로 보여줌. 이 값을 1로 하면 결과값을 return하게 되어 변수에 저장 가능(테스트 시 기본값은 1인듯?)
$response = curl_exec ($ch);

//print_r($response);//결과값 확인하기
//$result = json_decode($response, true);
//var_dump($result);
curl_close($ch);
//print_r($t);
//echo json_decode($post_data);

//$str = '{"amount":"1000","orderNumber":"phpprogram1557730916","cardName":"KB국민","authNumber":"30000896","authDateTime":"20190513160315","kakaoResultCode":"0000","transactionId":"20190513155900LE6375","responseCode":"0000","responseMsg":"성공"}';

$str = explode(",",str_replace("{","",str_replace("\"","",str_replace("}","",$response))));
//print_r($str);

$order = explode(":",$str[6]);
$card_name = explode(":",$str[7]);
$auth_number = explode(":",$str[8]);
$authDateTime = explode(":",$str[9]);
$kakaoResultCode = explode(":",$str[10]);
$transactionId = explode(":",$str[11]);
$responseCode = explode(":",$str[12]);
$responseMsg = explode(":",$str[13]);

/*print_r($_POST);
$_POST['mb_id'] = 'phpprogram';
$_POST['pay_idx'] = '999';*/

$mb_id = trim($_POST['mb_id']);
$pay_idx = trim($_POST['pay_chk']);


//print_r($_POST);
$que  = "INSERT INTO g5_pay_report SET ";
$que .= "mb_id          = '{$mb_id}', ";
$que .= "pay_type       = 'CARD', ";
//$que .= "pay_info       = '{$pay_chk}', ";
$que .= "pay_idx        = '{$pay_chk}', ";
$que .= "order_numer    = '{$order[1]}', ";
$que .= "order_money    = {$pay_money}, ";
$que .= "card_name      = '{$card_name[1]}', ";
$que .= "auth_number    = '{$auth_number[1]}', ";
$que .= "auth_datetime  = '{$authDateTime[1]}', ";
$que .= "kakao_result   = '{$kakaoResultCode[1]}', ";
$que .= "transaction_id = '{$transactionId[1]}', ";
$que .= "response_code  = '{$responseCode[1]}', ";
$que .= "pay_gubun      = '페이업', ";
$que .= "response_msg   = '{$responseMsg[1]}', ";
$que .= "reg_date       = NOW()";
echo $que."<br>";
$res = sql_query($que);
if($res){
    if($responseCode[1] == '0000') {
        echo "성공";
        changeMemberGrade($mb_id,$pay_chk,$pay_money);
        //alert('결제가 정상적으로 완료되었습니다.','./pay_report_list.php');
    } else {
        echo "실패";
        //alert('결제가 실패했습니다.');
    }
} else {
    echo "디비입력실패";
    //alert('디비 입력 실패했습니다.');
}
?>
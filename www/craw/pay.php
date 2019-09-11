<?php
    $url = 'http://dev.payup.co.kr/v2/api/payment/pluginTest/keyin2.do'; //접속할 url 입력

    $id = "pluginTest";
    $pkey = "2498049d60574814af6ac627891d82c7";
    $post_data["orderNumber"]   = "phpprogram_test_pay05";
    $post_data["cardNo"]        = "5181850002113304";
    $post_data["expireMonth"]   = "06";
    $post_data["expireYear"]    = "23";
    $post_data["birthday"]      = "750713";
    $post_data["cardPw"]        = "11";
    $post_data["amount"]        = "1000";
    $post_data["quota"]         = "0";
    $post_data["itemName"]      = "S플랜";
    $post_data["userName"]      = "윤혜성";
    $post_data["mobileNumber"]  = "01036638877";
    $post_data["kakaoSend"]     = "Y";
    $post_data["userEmail"]     = "phpprogram47@gmail.com";
    $post_data["timestamp"]     = date("YmdHis");
    //echo "<br>";

    $sig = hash('sha256',$id.'|'.$post_data["orderNumber"].'|'.(int)$post_data["amount"].'|'.$pkey.'|'.$post_data["timestamp"]);
    //echo strlen($sig);
    $post_data["signature"]     = $sig;


    $ch = curl_init(); //curl 사용 전 초기화 필수(curl handle)

    curl_setopt($ch, CURLOPT_URL, $url); //URL 지정하기
    curl_setopt($ch, CURLOPT_POST, 1); //0이 default 값이며 POST 통신을 위해 1로 설정해야 함
    curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($post_data)); //POST로 보낼 데이터 지정하기
    curl_setopt ($ch, CURLOPT_POSTFIELDSIZE, 0); //이 값을 0으로 해야 알아서 &post_data 크기를 측정하는듯

    curl_setopt($ch, CURLOPT_HEADER, true);//헤더 정보를 보내도록 함(*필수)
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json')); //header 지정하기
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); //이 옵션이 0으로 지정되면 curl_exec의 결과값을 브라우저에 바로 보여줌. 이 값을 1로 하면 결과값을 return하게 되어 변수에 저장 가능(테스트 시 기본값은 1인듯?)
    $response = curl_exec ($ch);

    var_dump($response);//결과값 확인하기
    $result = json_decode($response);
    print_r($result);
    curl_close($ch);







?>
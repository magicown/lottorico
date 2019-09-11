<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2019-04-09
 * Time: 오전 10:51
 */
    // 메시지발송
    //$rev_hp = '01036638877';
    //$rev_msg = "로또리코에서 메세지 발송합니다.\n\n이번주 당첨번호는 12345678910 입니다.";
    $query = array(
        'id' => 'lotto645_http',
        'pwd' => 'ZCD26TSMAZ74465WBHH1',
        'from' => '0327107988',
        'to_country' => '82',
        'to' => $rev_hp,
        'message' => $rev_msg,
        'report_req' => '1'
    );

    $url = 'http://rest.supersms.co:6200/sms/xml?'.http_build_query($query);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    $xml = simplexml_load_string($response);
    if ($xml === false) {
        echo "Failed loading XML: ";
    } else {
        echo("response code : " . $xml->messages->message->err_code);
    }
?>
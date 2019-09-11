<?php
    include "./common.php";

    /*if(!$_SESSION['ss_mb_id']){
        echo "로그인 후 이용해주세요.";
    }*/

    $que = "UPDATE g5_member SET mb_certify = 'Y' WHERE mb_id = '{$_REQUEST['mb_id']}'";
    $res = sql_query($que);
    if(!$res){
        echo "상품약관 업데이트시 오류가 발생했습니다.";
    } else {
        echo "상품약관 동의가 완료되었습니다.";
    }
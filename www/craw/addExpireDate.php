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
$root_url = "http://www.lottorico.co.kr"; //그누보드가 설치된 위치의 url, 끝에 "/"을 붙이지 않음

//===========================================================================
// 이하 수정금지
//===========================================================================


include($root_path."/common.php");

$que = "SELECT * FROM g5_member WHERE mb_10 > 0 AND mb_5 = 'Y' ";
echo $que;
$res = sql_query($que);
while($rows = sql_fetch_array($res)){
    $expire_date = date("Y-m-d",strtotime("+1 day",strtotime($rows['mb_2'])));
    $sql = "UPDATE g5_member SET mb_2 = '{$expire_date}' WHERE mb_id = '{$rows['mb_id']}' ";
    echo $sql;
    sql_query($sql);
}
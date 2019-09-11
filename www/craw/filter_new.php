<?php

$root_path = "/home/lotto/www"; //그누보드 설치된 물리적 위치, 끝에 "/"을 붙이지 않음
$root_url = "http://www.lottorico.co.kr"; //그누보드가 설치된 위치의 url, 끝에 "/"을 붙이지 않음

//===========================================================================
// 이하 수정금지
//===========================================================================


include($root_path."/common.php");

ini_set('memory_limit',-1);
$search_query = setFilter();


$num_cnt = 0;
$array_idx = array();
$que = "SELECT idx FROM lotto_num WHERE 1  AND chain_pair_yn = 'N' {$search_query} ";
echo $que."<br>";
$res = sql_query($que);
while($arr = sql_fetch_array($res)){
    $que = "UPDATE lotto_num SET set_filter_yn = 'Y' WHERE idx = '{$arr['idx']}'";
    echo $que."<br>";
    sql_query($que);

}
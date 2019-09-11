<?php

$root_path = "/home/lotto/www"; //그누보드 설치된 물리적 위치, 끝에 "/"을 붙이지 않음
$root_url = "http://www.lottorico.co.kr"; //그누보드가 설치된 위치의 url, 끝에 "/"을 붙이지 않음

//===========================================================================
// 이하 수정금지
//===========================================================================


include($root_path."/common.php");

ini_set('memory_limit',-1);
$cnt = $cnt2 = $cnt3 = $cnt4 = 0;


//당첨볼 합계
/*$que = "SELECT idx,no1,no2,no3,no4,no5 FROM lotto_num WHERE 1 ";
$res = sql_query($que);
while($row = sql_fetch_array($res)){
    unset($sum);
    $sum = $row['no1']+$row['no2']+$row['no3']+$row['no4']+$row['no5'];
    $sql = "UPDATE lotto_num SET num_sum = '{$sum}' WHERE idx = '{$row['idx']}'";
    //echo $sql."<br>";
    sql_query($sql);
}*/


//연번 만들기
$que = "SELECT idx,no1,no2,no3,no4,no5,no6 FROM lotto_num WHERE 1  ";
$res = sql_query($que);
while($rows = sql_fetch_array($res)) {
    $no = array($rows['no1'],$rows['no2'],$rows['no3'],$rows['no4'],$rows['no5'],$rows['no6']);
    chk($rows['idx'],$no);
}


function chk($idx, $no)
{
    //print_r($no);
    for ($i = 0; $i < 6; $i++) {

        $res = 0;
        $res = abs($no[$i] - $no[($i + 1)]) . "<br>";
        //echo $res . "<br>";
        if ($res == 1) {
            //1연번
            $sql = "UPDATE lotto_num SET chain_yn = 'y', chain_is_1 = 'Y' WHERE idx = '{$idx}'";
            //echo $sql."<br>";
            sql_query($sql);
            $cnt++;
        } else {
            $cnt = 0;
        }

        //echo $cnt;
        if ($cnt == 2) {
            $sql = "UPDATE lotto_num SET chain_yn = 'y', chain_is_2 = 'Y' WHERE idx = '{$idx}'";
            //echo $sql."<br>";
            sql_query($sql);
        }
        if ($cnt == 3) {
            $sql = "UPDATE lotto_num SET chain_yn = 'y', chain_is_3 = 'Y' WHERE idx = '{$idx}'";
            //echo $sql."<br>";
            sql_query($sql);
        }

        if ($cnt == 4) {
            $sql = "UPDATE lotto_num SET chain_yn = 'y', chain_is_4 = 'Y' WHERE idx = '{$idx}'";
            //echo $sql."<br>";
            sql_query($sql);
        }

        if ($cnt == 5) {
            $sql = "UPDATE lotto_num SET chain_yn = 'y', chain_is_5 = 'Y' WHERE idx = '{$idx}'";
            //echo $sql."<br>";
            sql_query($sql);
        }
        //echo $res."-".$cnt."<br>";
    }
}
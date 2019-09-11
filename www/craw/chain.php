<?php

$root_path = "/home/lotto/www"; //그누보드 설치된 물리적 위치, 끝에 "/"을 붙이지 않음
$root_url = "http://www.lottorico.co.kr"; //그누보드가 설치된 위치의 url, 끝에 "/"을 붙이지 않음

//===========================================================================
// 이하 수정금지
//===========================================================================


include($root_path."/common.php");

ini_set('memory_limit',-1);
$cnt = $cnt2 = $cnt3 = $cnt4 = 0;

$que = "SELECT idx,no1,no2,no3,no4,no5,no6 FROM lotto_num WHERE 1  ";
$res = sql_query($que);
while($rows = sql_fetch_array($res)) {
    $no = array($rows['no1'],$rows['no2'],$rows['no3'],$rows['no4'],$rows['no5'],$rows['no6']);
    chk($rows['idx'],$no);
}


function chk($idx, $no)
{
    //print_r($no);
    $one_chain_cnt = 0;
    for ($i = 0; $i < 6; $i++) {
        $res = 0;
        $res = abs($no[$i] - $no[($i + 1)]) . "<br>";
        //echo $res . "<br>";
        if ($res == 1) {
            //1연번
            $sql = "UPDATE lotto_num SET chain_yn = 'y', chain_is_1 = 'Y' WHERE idx = '{$idx}'";
            //echo $sql."<br>";
            //sql_query($sql);
            $cnt++;
            $one_chain_cnt++;
        } else {
            $cnt = 0;
        }

        if ($cnt == 2) {
            $sql = "UPDATE lotto_num SET chain_yn = 'y', chain_is_2 = 'Y' WHERE idx = '{$idx}'";
            //echo $sql."<br>";
            //sql_query($sql);
        }
        if ($cnt == 3) {
            $sql = "UPDATE lotto_num SET chain_yn = 'y', chain_is_3 = 'Y' WHERE idx = '{$idx}'";
            //echo $sql."<br>";
            //sql_query($sql);
        }

        if ($cnt == 4) {
            $sql = "UPDATE lotto_num SET chain_yn = 'y', chain_is_4 = 'Y' WHERE idx = '{$idx}'";
            //echo $sql."<br>";
            //sql_query($sql);
        }

        if ($cnt == 5) {
            $sql = "UPDATE lotto_num SET chain_yn = 'y', chain_is_5 = 'Y' WHERE idx = '{$idx}'";
            //echo $sql."<br>";
            //sql_query($sql);
        }

        if ($cnt == 6) {
            $sql = "UPDATE lotto_num SET chain_yn = 'y', chain_is_6 = 'Y' WHERE idx = '{$idx}'";
            //echo $sql."<br>";
            //sql_query($sql);
        }
        echo $res."-".$cnt."<br>";
    }

    if($one_chain_cnt>1){
        $sql = "UPDATE lotto_num SET chain_pair_yn = 'Y'WHERE idx = '{$idx}'";
        echo $sql."<br>";
        sql_query($sql);
    }
}
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
$root_url = "http://www.lottofirst.co.kr"; //그누보드가 설치된 위치의 url, 끝에 "/"을 붙이지 않음

//===========================================================================
// 이하 수정금지
//===========================================================================
define("BT_AUTOMODE", true);
define("_GNUBOARD_", true);
include($root_path."/common.php");
include("/home/lotto/Snoopy.class.php");

set_time_limit(0);


$snoopy = new Snoopy;

$snoopy->fetch("https://dhlottery.co.kr/gameResult.do?method=byWin");
$content = $snoopy->results;

preg_match_all('/<strong>([0-9]{3,10})/isx',$content,$hit_turn);
//print_r($hit_turn);

preg_match_all('/<span\sclass="[^>]+>([0-9]{1,2})<\/span>/isx',$content,$ball);
//print_r($ball);

preg_match_all('/<strong\sclass="color_key1">([0-9]{1,3}(,[0-9]{3})+)/isx',$content,$hit_money);
//print_r($hit_money);

preg_match_all('/<td>([0-9]{1,3}((,[0-9]{3})+)?)/isx',$content,$hit_person);
//print_r($hit_person);

preg_match_all('/<td\sclass="tar">([0-9]{1,3}(,[0-9]{3})+)/isx',$content,$etc);
//print_r($etc);

$nor_ball = $ball[1][0]."|".$ball[1][1]."|".$ball[1][2]."|".$ball[1][3]."|".$ball[1][4]."|".$ball[1][5]."|".$ball[1][6];
$money = $hit_money[1][0]."|".$hit_money[1][1]."|".$hit_money[1][2]."|".$hit_money[1][3]."|".$hit_money[1][4];
$person = $hit_person[1][1]."|".$hit_person[1][3]."|".$hit_person[1][5]."|".$hit_person[1][7]."|".$hit_person[1][9];
$each_money = $etc[1][0]."|".$etc[1][1]."|".$etc[1][2]."|".$etc[1][3]."|".$etc[1][4];

$sql  = "UPDATE lotto_hit_result SET ";
$sql .= "hit_money_money = '{$money}', ";
$sql .= "hit_money_person = '{$person}', ";
$sql .= "hit_get_money = '{$each_money}' ";
$sql .= "WHERE hit_turn = '{$hit_turn[1][0]}'";
//echo $sql."<br>";
sql_query($sql);








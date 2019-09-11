<?php
/**
 * Created by PhpStorm.
 * User: 김명준(phpprogram47@gmail.com)
 * Date: 2019-03-31
 * Time: 오후 4:45
 */

include("./Snoopy.class.php");

$snoopy = new Snoopy;

$snoopy->fetch("https://dhlottery.co.kr/gameResult.do?method=byWin");
$content = $snoopy->results;

preg_match_all('/<strong>([0-9]{3,10})/isx',$content,$hit_turn);
print_r($hit_turn);

preg_match_all('/<span\sclass="[^>]+>([0-9]{1,2})<\/span>/isx',$content,$ball);
print_r($ball);

preg_match_all('/<strong\sclass="color_key1">([0-9]{1,3}(,[0-9]{3})+)/isx',$content,$hit_money);
print_r($hit_money);

preg_match_all('/<td>([0-9]{1,3}((,[0-9]{3})+)?)/isx',$content,$hit_person);
print_r($hit_person);

preg_match_all('/<td\sclass="tar">([0-9]{1,3}(,[0-9]{3})+)/isx',$content,$etc);
print_r($etc);



$nor_ball = $ball[1][0]."|".$ball[1][1]."|".$ball[1][2]."|".$ball[1][3]."|".$ball[1][4]."|".$ball[1][5]."|".$ball[1][6];
$money = $hit_money[1][0]."|".$hit_money[1][1]."|".$hit_money[1][2]."|".$hit_money[1][3]."|".$hit_money[1][4];
$person = $hit_person[1][1]."|".$hit_person[1][3]."|".$hit_person[1][5]."|".$hit_person[1][7]."|".$hit_person[1][9];
$each_money = $etc[1][0]."|".$etc[1][1]."|".$etc[1][2]."|".$etc[1][3]."|".$etc[1][4];

$que = "SELECT COUNT(*) FROM lotto_hit_result WHERE hit_turn = '{$hit_turn[1][0]}'";
$row = sql_fetch($que);
if(!$row){
    $sql  = "INSERT INTO lotto_hit_result SET ";
    $sql .= "hit_turn = '{$hit_turn[1][0]}', ";
    $sql .= "hit_date = NOW(), ";
    $sql .= "hit_num = '{$nor_ball}', ";
    $sql .= "hit_money_money = '{$money}', ";
    $sql .= "hit_money_person = '{$person}', ";
    $sql .= "hit_get_money = '{$each_money}' ";
    //echo $sql;
    sql_query($sql);
}





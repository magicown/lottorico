<?php
/**
 * Created by PhpStorm.
 * User: 김명준 (phpprogram47@gmail.com)
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

set_time_limit(0);
ini_set("memory_limit", -1);

$que = "UPDATE lotto_num SET use_yn = 'N', mb_id = NULL, regdate = '' WHERE 1";
sql_query($que);



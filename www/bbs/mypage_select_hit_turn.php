<?php
include_once('./_common.php');

if (!$is_member)
    goto_url(G5_BBS_URL."/login.php?url=".urlencode(G5_BBS_URL."/mypage.php"));

$mb_homepage = set_http(clean_xss_tags($member['mb_homepage']));
$mb_profile = ($member['mb_profile']) ? conv_content($member['mb_profile'],0) : '';
$mb_signature = ($member['mb_signature']) ? apms_content(conv_content($member['mb_signature'], 1)) : '';

// Page ID
$pid = ($pid) ? $pid : 'mypage';
$at = apms_page_thema($pid);
include_once(G5_LIB_PATH.'/apms.thema.lib.php');

$hit_turn = $_REQUEST['hit_turn'];
$lotto_turn = $_REQUEST['select_turn'];

if($hit_turn == '1'){
    $select_hit_turn = " AND lotto_result > 0 ";
} else {
    $select_hit_turn = "";
}

if($lotto_turn){
    $st = " AND lotto_turn = '{$lotto_turn}' ";
} else {
    $st = "";
}

//echo $hit_turn .'_'.$select_turn;
$que = "SELECT * FROM member_lotto_num WHERE mb_id = '{$_SESSION[ss_mb_id]}' {$select_hit_turn} {$st} ";
//echo $que;
$res = sql_query($que);
while($row = sql_fetch_array($res)){
    $rs[] = $row;
}

$skin_path = $member_skin_path;
$skin_url = $member_skin_url;



include_once($skin_path.'/mypage_select_turn.skin.php');

?>
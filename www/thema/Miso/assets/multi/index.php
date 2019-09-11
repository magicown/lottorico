<?php
// 멀티/서브도메인 인덱스 설정 --------------------------------------------
define('_INDEX_', true);
include_once('../../common.php');
include_once('./setup.php');

$sql = " as_thema = '{$multiset['thema']}' and as_color = '{$multiset['colorset']}'";

if(IS_YC && $multiset['shop']) {
	define('IS_SHOP', true);
	apms_check_reserve_end(); // 예약체크
	$row = sql_fetch(" select ca_id from {$g5['g5_shop_category_table']} where $sql ");
	$at = apms_ca_thema($row['ca_id'],'',1);
} else {
	define('IS_SHOP', false);
	$row = sql_fetch(" select gr_id from {$g5['group_table']} where $sql ");
	$at = apms_gr_thema($row['gr_id']); 
}

$at['gid'] = '';
include_once(G5_LIB_PATH.'/apms.thema.lib.php');
$is_main = true;
include_once(G5_PATH.'/head.php');
include_once(THEMA_PATH.'/index.php');
include_once(G5_PATH.'/tail.php'); 
// ------------------------------------------------------------------------
?>

<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(IS_YC && IS_SHOP) {
	echo apms_widget('miso-misc-title', 'miso-idx-shop-title'); // 쇼핑몰 타이틀 위젯
} else {
	echo apms_widget('miso-misc-title', 'miso-idx-title'); // 커뮤니티 타이틀 위젯
}

?>

<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

if($header_skin)
	include_once('./header.php');

?>
<style>
    .mypage-skin .btn-group { width: 10%; margin-left:20px;  }
    .price-btn .btn-div { width:24%; float:left; margin-top:30px; margin-left:5px; marign-right:5px; }
    .price-btn .btn-div:nth-child(0) { margin-left:10px; }
    .price-btn .btn-default:hover{ background:#505050 !important; color:#fff !important;}

</style>
<div class="mypage-skin">
    <img src="/img/guide.jpg" width="100%" />
</div>
<div class="price-btn">
    <div class="btn-div">
        <button type="button" class="btn btn-info btn-lg btn-block" disabled="disabled" title="판매가 마감되었습니다.">판매마감</button>
    </div>
    <div class="btn-div">
        <button type="button" class="btn btn-primary btn-lg btn-block" disabled="disabled">구매예약</button>
    </div>
    <div class="btn-div">
        <button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='/bbs/510.php?type=a'">판매</button>
    </div>
    <div class="btn-div">
        <button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='/bbs/510.php?type=b'">판매</button>
    </div>
</div>
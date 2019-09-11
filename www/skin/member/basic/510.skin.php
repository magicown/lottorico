<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

if($header_skin)
	include_once('./header.php');

?>
<style>
    .price-btn .btn-div { width:32.5%; float:left; margin-top:30px; margin-left:5px; marign-right:5px; }
    .price-btn .btn-div:nth-child(0) { margin-left:10px; }
    .price-btn .btn-default:hover { background:#505050 !important; color:#fff !important;}
    .price-btn:nth-child(1) { margin-bottom:100px; margin-top:50px;}
</style>
<div class="mypage-skin">
    <img src="/img/pay_a.png" width="100%" />
</div>
<div class="price-btn">
    <div class="btn-div">
        <img src="/img/bank.png" title="무통장입금" style="width:100%;">
        <button type="button" class="btn btn-default btn-lg btn-block" >무통장입금</button>
    </div>
    <div class="btn-div">
        <img src="/img/card.png" title="신용카드결제" style="width:100%;">
        <button type="button" class="btn btn-default btn-lg btn-block" >신용카드</button>
    </div>
    <div class="btn-div">
        <img src="/img/hp.png" title="휴대폰결제" style="width:100%;">
        <button type="button" class="btn btn-default btn-lg btn-block">휴대폰결제</button>
    </div>    
</div>

<div class="price-btn">
    <div class="btn-div" style="margin-bottom:100px; margin-top:100px;">
        <button type="button" class="btn btn-danger btn-lg btn-block" >결제완료</button>
    </div>
    
</div>
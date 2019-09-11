<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2019-05-01
 * Time: 오후 2:16
 */
?>
<style>
    .mypage-skin .btn-group { width: 10%; margin-left:20px;  }
    .price-btn .btn-div { width:24%; float:left; margin-top:30px; margin-left:5px; marign-right:5px; }
    .price-btn .btn-div:nth-child(0) { margin-left:10px; }
    .price-btn .btn-default:hover { background:#505050 !important; color:#fff !important;}
</style>
<div class="mypage-skin">
    <img src="/img/guide.jpg" width="100%" />
</div>
<div class="price-btn">
    <div class="btn-div">
        <button type="button" class="btn btn-info btn-lg btn-block" disabled="disabled">판매마감</button>
    </div>
    <div class="btn-div">
        <button type="button" class="btn btn-primary btn-lg btn-block" disabled="disabled">구매예약</button>
    </div>
    <div class="btn-div">
        <button type="button" class="btn btn-default btn-lg btn-block">판매</button>
    </div>
    <div class="btn-div">
        <button type="button" class="btn btn-default btn-lg btn-block">판매</button>
    </div>
</div>

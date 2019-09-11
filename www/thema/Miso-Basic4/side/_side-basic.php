<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wid = 'mbt-sb';

?>
<div class="col-lg-3 col-md-3 col-sm-3 col-lg-pull-9 col-md-pull-9 col-sm-pull-9">

    <!-- CATEGORIES -->
    <div class="side-nav margin-bottom-60">

        <div class="side-nav-head">
            <button class="fa fa-bars"></button>
            <h4>CATEGORIES</h4>
        </div>

        <ul class="list-group list-group-bordered list-group-noicon uppercase">
            <li class="list-group-item active">
                <a class="dropdown-toggle" href="#">WOMEN</a>
                <ul>
                    <li><a href="#"><span class="size-11 text-muted pull-right">(123)</span> Shoes &amp; Boots</a></li>
                    <li class="active"><a href="#"><span class="size-11 text-muted pull-right">(331)</span> Top &amp; Blouses</a></li>
                    <li><a href="#"><span class="size-11 text-muted pull-right">(234)</span> Dresses &amp; Skirts</a></li>
                </ul>
            </li>
            <li class="list-group-item">
                <a class="dropdown-toggle" href="#">MEN</a>
                <ul>
                    <li><a href="#"><span class="size-11 text-muted pull-right">(88)</span> Accessories</a></li>
                    <li><a href="#"><span class="size-11 text-muted pull-right">(67)</span> Shoes &amp; Boots</a></li>
                    <li><a href="#"><span class="size-11 text-muted pull-right">(32)</span> Dresses &amp; Skirts</a></li>
                    <li class="active"><a href="#"><span class="size-11 text-muted pull-right">(78)</span> Top &amp; Blouses</a></li>
                </ul>
            </li>
            <li class="list-group-item">
                <a class="dropdown-toggle" href="#">JEWELLERY</a>
                <ul>
                    <li><a href="#"><span class="size-11 text-muted pull-right">(23)</span> Dresses &amp; Skirts</a></li>
                    <li><a href="#"><span class="size-11 text-muted pull-right">(34)</span> Shoes &amp; Boots</a></li>
                    <li class="active"><a href="#"><span class="size-11 text-muted pull-right">(21)</span> Top &amp; Blouses</a></li>
                    <li><a href="#"><span class="size-11 text-muted pull-right">(88)</span> Accessories</a></li>
                </ul>
            </li>
            <li class="list-group-item">
                <a class="dropdown-toggle" href="#">KIDS</a>
                <ul>
                    <li><a href="#"><span class="size-11 text-muted pull-right">(88)</span> Shoes &amp; Boots</a></li>
                    <li><a href="#"><span class="size-11 text-muted pull-right">(22)</span> Dresses &amp; Skirts</a></li>
                    <li><a href="#"><span class="size-11 text-muted pull-right">(31)</span> Accessories</a></li>
                    <li class="active"><a href="#"><span class="size-11 text-muted pull-right">(18)</span> Top &amp; Blouses</a></li>
                </ul>
            </li>
            <li class="list-group-item"><a href="#"><span class="size-11 text-muted pull-right">(189)</span> ACCESSORIES</a></li>
            <li class="list-group-item"><a href="#"><span class="size-11 text-muted pull-right">(61)</span> GLASSES</a></li>

        </ul>

    </div>
    <!-- /CATEGORIES -->

    <!-- BANNER ROTATOR -->
    <div class="owl-carousel buttons-autohide controlls-over margin-bottom-60 text-center" data-plugin-options='{"singleItem": true, "autoPlay": 4000, "navigation": true, "pagination": false, "transitionStyle":"goDown"}'>
        <a href="#">
            <img class="img-responsive" src="demo_files/images/shop/banners/off_2.png" width="270" height="350" alt="">
        </a>
        <a href="#">
            <img class="img-responsive" src="demo_files/images/shop/banners/off_1.png" width="270" height="350" alt="">
        </a>
    </div>
    <!-- /BANNER ROTATOR -->


    <!-- HTML BLOCK -->
    <div class="margin-bottom-60">
        <h4>HTML BLOCK</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras non placerat mi. Etiam non tellus eunit.</p>

        <form action="#".box-shadow- method="post">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" id="email" name="email" class="form-control required" placeholder="Enter your Email">
                <span class="input-group-btn">
											<button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-send"></i></button>
										</span>
            </div>
        </form>

    </div>
    <!-- /HTML BLOCK -->


</div>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>

</div>



<!-- LEFT -->
<div class="col-lg-3 col-md-3 col-sm-3 col-lg-pull-9 col-md-pull-9 col-sm-pull-9">

    <!-- CATEGORIES -->
    <div class="side-nav margin-bottom-60">

        <style>
            .w-side .div-title-underbar { margin-bottom:15px; }
            .w-side .div-title-underbar span { padding-bottom:4px; }
            .w-side .w-more { font-weight:normal; color:#888; letter-spacing:-1px; font-size:11px; }
            .w-side .w-img img { display:block; max-width:100%; /* 배너 이미지 */ }
            .w-side .w-empty { margin-bottom:20px; }
            .w-side .w-box { margin-bottom:20px; background:#fff; }
            .w-side .w-p10 { padding:10px; }
            .w-side .tabs.div-tab ul.nav-tabs li.active a { font-weight:bold; color:#333 !important; }
            .w-side .main-tab .tab-more { margin-top:-28px; margin-right:10px; font-size:11px; letter-spacing:-1px; color:#888 !important; }
            .w-side .tabs { margin-bottom:30px !important; }
            .w-side .tab-content { border:0px !important; padding:15px 0px 0px !important; }
        </style>
        <div class="w-side hidden-sm hidden-xs">

            <!-- Start //-->
            <?php
            //카테고리
            $side_category = apms_widget('miso-category');
            if($side_category) {
                ?>
                <div class="w-box">
                    <?php echo $side_category; // 카테고리 ?>
                </div>
            <?php } ?>


            <!-- //End -->

            <!-- Start //-->
            <!--<div class="div-title-underbar">
		<a href="<?php /*echo $at_href['new'];*/?>?view=v">
			<span class="pull-right w-more">
				+ 더보기
			</span>
			<span class="div-title-underbar-bold border-color">
				<b>새글</b>
			</span>
		</a>
	</div>
	<div class="w-box">
		<?php /*echo apms_widget('miso-post-list', $wid.'-newpost', 'icon={아이콘:pencil}'); */?>
	</div>-->
            <!--// End -->

            <!-- Start //-->
            <!--<div class="div-title-underbar">
		<a href="<?php /*echo $at_href['new'];*/?>?view=c">
			<span class="pull-right w-more">
				+ 더보기
			</span>
			<span class="div-title-underbar-bold border-color">
				<b>새댓글</b>
			</span>
		</a>
	</div>
	<div class="w-box">
		<?php /*echo apms_widget('miso-post-list', $wid.'-newcomment', 'comment=1 icon={아이콘:commenting}'); */?>
	</div>-->
            <!--// End -->

            <!-- 광고 시작 -->
            <!--<div class="w-box">
                <div style="width:100%; min-height:280px; line-height:280px; text-align:center; background:#f5f5f5;">
                    반응형 구글광고 등
                </div>
            </div>-->
            <!-- 광고 끝 -->

            <!-- SNS아이콘 시작 -->
            <!--<div class="w-empty text-center">
		<?php /*echo $sns_share_icon; // SNS 공유아이콘 */?>
	</div>-->
            <!-- SNS아이콘 끝 -->

        </div>
        <!--<div class="side-nav-head">
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

        </ul>-->

    </div>
    <!-- /CATEGORIES -->


</div>

</div>

</div>
</section>


<!-- CALLOUT -->
<section class="callout-dark heading-title heading-arrow-bottom">
    <div class="container">

        <div class="text-center">
            <h3 class="size-30">LOTTORICO</h3>

        </div>

    </div>
</section>
<!-- /CALLOUT -->

<!-- CALLOUT -->
<div class="alert alert-transparent bordered-bottom nomargin">
    <div class="container">

        <div class="row">

            <div class="col-md-9 col-sm-12 text-center"><!-- left text -->
                <h3>고객센터 <span><strong>+032-710-7988</strong></span> 빠르게 해결해 드리겠습니다.!</h3>
                <!--<p class="font-lato weight-300 size-20 nomargin-bottom">
                    We truly care about our users and our product.
                </p>-->
            </div><!-- /left text -->




        </div>

    </div>
</div>
<!-- /CALLOUT -->






<!-- FOOTER -->
<footer id="footer">

    <div class="container hidden-xs">
        <div class="row">

            <div class="col-md-8">
                <!-- Latest Blog Post -->
                <h4 class="letter-spacing-1"><a href="/bbs/page.php?hid=privacy">개인정보처리방침</a> | <a href="/bbs/page.php?hid=provision">서비스이용약관</a> | <a href="/bbs/500.php">이용가이드</a> | <a href="/bbs/board.php?bo_table=4100">고객센터</a> </h4>
            </div>

        </div>
        <div class="row">

            <div class="col-md-6">
                <!-- Latest Blog Post 1-->
                <h4 class="letter-spacing-1">회사명 : (주)더블에이치컴퍼니</h4>
                <h4 class="letter-spacing-1">대표자 : 안태환</h4>
                <h4 class="letter-spacing-1">사업자등록번호 : 404-87-01366</h4>
                <h4 class="letter-spacing-1">고객센터 이메일: lottorico1@gmail.com</h4>
            </div>
            <div class="col-md-6">
                <!-- Latest Blog Post -->
                <h4 class="letter-spacing-1">주소 : 인천광역시 미추홀구 주안로213번길 15, 404호(주안동)</h4>
                <h4 class="letter-spacing-1">전화 : 032-710-7988 팩스 : 032-710-7989</h4>
                <h4 class="letter-spacing-1">통신판매신고번호 : 제2019-인천미추홀-0461호</h4>
                <h4 class="letter-spacing-1">개인정보관리책임자 : 이길호</h4>
            </div>

        </div>

    </div>

    <div class="container hidden-lg hidden-md hidden-sm">

        <div class="row">

            <div class="col-md-6">
                <!-- Latest Blog Post 1-->
                <h4 class="letter-spacing-1" style="margin-top:10px; font-size:0.8em;">회사명 : (주)더블에이치컴퍼니</h4>
                <h4 class="letter-spacing-1" style="margin-top:10px; font-size:0.8em;">대표자 : 안태환</h4>
                <h4 class="letter-spacing-1" style="margin-top:10px; font-size:0.8em;">사업자등록번호 : 404-87-01366</h4>
                <h4 class="letter-spacing-1" style="margin-top:10px; font-size:0.8em;">고객센터 이메일: lottorico1@gmail.com</h4>
            </div>
            <div class="col-md-6">
                <!-- Latest Blog Post -->
                <h4 class="letter-spacing-1" style="margin-top:10px; font-size:0.8em;">주소 : 인천광역시 미추홀구 주안로213번길 15, 404호(주안동)</h4>
                <h4 class="letter-spacing-1" style="margin-top:10px; font-size:0.8em;">전화 : 032-710-7988 팩스 : 032-710-7989</h4>
                <h4 class="letter-spacing-1" style="margin-top:10px; font-size:0.8em;">통신판매신고번호 : 제2019-인천미추홀-0461호</h4>
                <h4 class="letter-spacing-1" style="margin-top:10px; font-size:0.8em;">개인정보관리책임자 : 이길호</h4>
            </div>

        </div>

    </div>

    <div class="copyright">
        <div class="container">

            &copy; All Rights Reserved, doublehcompany
        </div>
    </div>
</footer>
<!-- /FOOTER -->

</div>

<!-- SCROLL TO TOP -->
<a href="#" id="toTop"></a>


<!-- PRELOADER -->
<div id="preloader">
    <div class="inner">
        <span class="loader"></span>
    </div>
</div><!-- /PRELOADER -->

<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/js/respond.js"></script>
<![endif]-->

<!-- JavaScript -->
<script>
var sub_show = "<?php echo $at_set['subv'];?>";
var sub_hide = "<?php echo $at_set['subh'];?>";
var menu_startAt = "<?php echo ($m_sat) ? $m_sat : 0;?>";
var menu_sub = "<?php echo $m_sub;?>";
var menu_subAt = "<?php echo ($m_subsat) ? $m_subsat : 0;?>";
</script>
<script>
    $(document).ready(function(){
       $('#mobile-close-btn').on('click',function(){
          if($(this).parent().parent().find('.submenu-dark').hasClass('in')==true){
              setTimeout(
                  function(){
                      $('#mobile-close-btn').parent().parent().find('.submenu-dark').removeClass('in');
                      $(this).removeClass('in');
                  }
                  ,500);
          }
       });
    });
</script>
<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/bs3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/js/sly.min.js"></script>
<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/js/custom.js"></script>
<?php if($is_sticky_nav) { ?>
<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/js/sticky.js"></script>
<?php } ?>

<?php //echo apms_widget('miso-sidebar'); //사이드바 및 모바일 메뉴(UI) ?>

<?php //if($is_designer || $is_demo) include_once(THEMA_PATH.'/assets/switcher.php'); //Style Switcher ?>

<!-- JAVASCRIPT FILES -->
<script type="text/javascript">
    var plugin_path = '/html/assets/plugins/';
</script>
<script type="text/javascript" src="/html/assets/plugins/jquery/jquery-2.2.3.min.js"></script>

<script type="text/javascript" src="/html/assets/js/scripts.js"></script>

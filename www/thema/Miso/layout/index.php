<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<style>
	.sp-idx { height:30px; }
</style>
<div class="row">
	<div class="col-md-8">

		<?php echo apms_widget('miso-board-blog', 'miso-idx-board-blog'); // 블로그형 캐러셀 위젯 ?>

		<div class="sp-idx"></div>

		<!-- // Start Bottom Multi-Board Carousel -->
		<?php $carousel_id = apms_id(); // 랜덤아이디 생성 ?>
		<div class="carousel slide miso-carousel-bottom" id="<?php echo $carousel_id;?>" data-ride="carousel">
			<div class="miso-head">
				캐러셀 갤러리
			</div>
			<div class="miso-body">
				<div class="carousel-nav">
					<a class="right" href="#<?php echo $carousel_id;?>" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
				</div>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<?php echo apms_widget('miso-board-gallery', 'miso-idx-board-gallery1'); // 일반 갤러리형 위젯 ?>
					</div>
					<div class="item">
						<?php echo apms_widget('miso-board-gallery', 'miso-idx-board-gallery2'); // 일반 갤러리형 위젯 ?>
					</div>
					<div class="item">
						<?php echo apms_widget('miso-board-gallery', 'miso-idx-board-gallery3'); // 일반 갤러리형 위젯 ?>
					</div>
				</div>

				<!-- Indicators -->
				<ul class="<?php echo $carousel_id;?> miso-indicator">
					<li data-target="#<?php echo $carousel_id;?>" data-slide-to="0" class="active">하단</li>
					<li data-target="#<?php echo $carousel_id;?>" data-slide-to="1">캐러셀</li>
					<li data-target="#<?php echo $carousel_id;?>" data-slide-to="2">갤러리</li>
				</ul>
			</div>
		</div>

		<script>	
		$(document).ready(function(){
			var clickEvent = false;
			$('#<?php echo $carousel_id;?>').carousel({
				interval:   5000 // Speed
			}).on('click', '.<?php echo $carousel_id;?> li', function() {
				clickEvent = true;
				$('.<?php echo $carousel_id;?> li').removeClass('active');
				$(this).addClass('active');		
			}).on('slid.bs.carousel', function(e) {
				if(!clickEvent) {
					var count = $('.<?php echo $carousel_id;?>').children().length -1;
					var current = $('.<?php echo $carousel_id;?> li.active');
					current.removeClass('active').next().addClass('active');
					var id = parseInt(current.data('slide-to'));
					if(count == id) {
						$('.<?php echo $carousel_id;?> li').first().addClass('active');	
					}
				}
				clickEvent = false;
			});
		})
		</script>
		<!-- // End Bottom Multi-Board Carousel -->

		<div class="sp-idx"></div>
		
		<?php echo apms_widget('miso-board-gallery', 'miso-idx-board-gallery4'); // 일반 갤러리형 위젯 ?>

		<div class="sp-idx"></div>

		<?php echo apms_widget('miso-board-webzine', 'miso-idx-board-webzine1'); // 일반 웹진형 위젯 ?>

		<div class="sp-idx"></div>

	</div>
	<div class="col-md-4">

		<?php echo apms_widget('miso-board-gallery-box', 'miso-idx-board-gallery-box1'); // 일반 박스형 위젯 ?>

		<div class="sp-idx"></div>

		<!-- // Start Top Multi-Board Carousel -->
		<?php $carousel_id = apms_id(); // 랜덤아이디 생성 ?>
		<div class="carousel slide miso-carousel-top" id="<?php echo $carousel_id;?>" data-ride="carousel">
			<div class="miso-head">
				<!-- Indicators -->
				<ul class="<?php echo $carousel_id;?> miso-indicator">
					<li data-target="#<?php echo $carousel_id;?>" data-slide-to="0" class="active">상단</li>
					<li data-target="#<?php echo $carousel_id;?>" data-slide-to="1">캐러셀</li>
					<li data-target="#<?php echo $carousel_id;?>" data-slide-to="2">웹진</li>
				</ul>
			</div>
			<div class="miso-body">
				<div class="carousel-nav">
					<a class="right" href="#<?php echo $carousel_id;?>" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
				</div>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<?php echo apms_widget('miso-board-webzine', 'miso-idx-board-webzine2'); // 일반 웹진형 위젯 ?>
					</div>
					<div class="item">
						<?php echo apms_widget('miso-board-webzine', 'miso-idx-board-webzine3'); // 일반 웹진형 위젯 ?>
					</div>
					<div class="item">
						<?php echo apms_widget('miso-board-webzine', 'miso-idx-board-webzine4'); // 일반 웹진형 위젯 ?>
					</div>
				</div>
			</div>
		</div>

		<script>	
		$(document).ready(function(){
			var clickEvent = false;
			$('#<?php echo $carousel_id;?>').carousel({
				interval:   5000 // Speed
			}).on('click', '.<?php echo $carousel_id;?> li', function() {
				clickEvent = true;
				$('.<?php echo $carousel_id;?> li').removeClass('active');
				$(this).addClass('active');
			}).on('slid.bs.carousel', function(e) {
				if(!clickEvent) {
					var count = $('.<?php echo $carousel_id;?>').children().length -1;
					var current = $('.<?php echo $carousel_id;?> li.active');
					current.removeClass('active').next().addClass('active');
					var id = parseInt(current.data('slide-to'));
					if(count == id) {
						$('.<?php echo $carousel_id;?> li').first().addClass('active');	
					}
				}
				clickEvent = false;
			});
		})
		</script>
		<!-- // End Top Multi-Board Carousel -->

		<div class="sp-idx"></div>

		<?php echo apms_widget('miso-misc-ads', 'miso-idx-misc-ads1'); // 반응형 광고박스 위젯 ?>

		<div class="sp-idx"></div>

		<?php echo apms_widget('miso-misc-poll', 'miso-idx-misc-poll'); // 투표 위젯 ?>

		<div class="sp-idx"></div>

		<?php echo apms_widget('miso-board-list', 'miso-idx-board-list1'); // 일반 글/댓글 위젯 ?>

		<div class="sp-idx"></div>

		<?php echo apms_widget('miso-board-banner', 'miso-idx-board-banner1'); // 일반 배너형 위젯 ?>

		<div class="sp-idx"></div>

	</div>
</div>

<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 초기값
if(!$wset) {
	$wset['thumb_w'] = 640;
	$wset['thumb_h'] = 400;
	$wset['rows'] = 5;
}

// 노이미지 주소
$wset['no_img'] = $widget_url.'/img/no-img.jpg';

// 글추출
$list = apms_board_rows($wset);
$list_cnt = count($list);

// 효과
switch($wset['effect']) {
	case 'fade'		: $effect = ' slide at-fade'; break;
	case 'up'		: $effect = ' slide at-vertical'; break;
	case 'slide'	: $effect = ' slide'; break;
	default			: $effect = ''; break;
}

// 효과시간
$interval = ($wset['interval']) ? $wset['interval'] : 'false';

// Random Ticker Id
$carousel_id = apms_id();

// 이미지 비율
$img_height = ($wset['thumb_w'] > 0 && $wset['thumb_h'] > 0) ? round(($wset['thumb_h'] / $wset['thumb_w']) * 100, 2) : 56.25;

// 새글라벨표시
$label = ($wset['new']) ? $wset['new'] : 'red';

// 랭킹시작
$rank = ($wset['page'] > 1) ?  (($wset['page'] - 1) * $wset['rows'] + 1) : 1;

// 내용길이
if(!$wset['cut']) $wset['cut'] = 100;

?>
<div class="carousel<?php echo $effect;?>" id="<?php echo $carousel_id;?>" data-ride="carousel" data-interval="<?php echo $interval;?>">
	<div class="carousel-nav">
		<a class="left" href="#<?php echo $carousel_id;?>" role="button" data-slide="prev"><i class="fa fa-angle-left prev-fa"></i></a>
		<a class="right" href="#<?php echo $carousel_id;?>" role="button" data-slide="next"><i class="fa fa-angle-right next-fa"></i></a>
	</div>
	 <!-- Indicators -->
	<ol class="carousel-indicators indicators-height">
		<?php for($i=0; $i < $list_cnt; $i++) { ?>
			<li data-target="#<?php echo $carousel_id;?>" data-slide-to="<?php echo $i;?>"<?php echo (!$i) ? ' class="active"' : '';?>></li>
		<?php } ?>
	</ol>
	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<?php for ($i=0; $i < $list_cnt; $i++) { $date = getdate($list[$i]['date']); ?>
			<div class="item<?php echo (!$i) ? ' active' : '';?>">
				<div class="img" style="padding-bottom:<?php echo $img_height;?>%;">
					<a href="<?php echo $list[$i]['href'];?>">
						<img src="<?php echo $list[$i]['img']['src'];?>" alt="<?php echo $list[$i]['img']['alt'];?>">
					</a>
				</div>
				<div class="content">
					<b><?php echo $date['weekday'].', '.$date['mday'].' '.$date['month'].' '.$date['year'];?></b>
					<h2>
						<a href="<?php echo $list[$i]['href'];?>">
							<?php echo ($list[$i]['comment']) ? '<span class="pull-right cnt"><i class="fa fa-comment text-muted"></i> '.number_format($list[$i]['comment']).'</span>' : '';?>
							<?php if($wset['rank']) { ?>
								<span class="en rank-icon bg-<?php echo $wset['rank'];?>"><?php echo $rank; $rank++; ?></span>
							<?php } else if($list[$i]['new']) { ?>
								<span class="en rank-icon bg-<?php echo $wset['new'];?>">New</span>
							<?php } ?>
							<?php echo $list[$i]['subject'];?>
						</a>
					</h2>
					<p><?php echo apms_cut_text($list[$i]['content'], $wset['cut']);?></p>
				</div>
			</div>	
		<?php } ?>
		<?php if(!$list_cnt) { ?>
			<div class="item active">
				<p class="text-center text-muted">
					<a><?php echo $icon;?> 글이 없습니다</a>
				</p>
			</div>
		<?php } ?>
	</div>
</div>
<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css" media="screen">', 0);

// 초기값
if(!$wset) {
	$wset['thumb_w'] = 400;
	$wset['thumb_h'] = 225;
	$wset['garo'] = 4; // Grid Col 값
	$wset['sero'] = 2;
	$wset['title'] = '타이틀 입력';
	$wset['style'] = 'title';
}

?>

<div class="miso-board-gallery">
	<?php if($wset['style'] == 'title') { // Title Style ?>
		<div class="widget-head">
			<a<?php echo ($wset['tlink']) ? ' href="'.$wset['tlink'].'"' : '';?>>
				<?php if($wset['more']) { ?>
					<span class="pull-right widget-more">더보기</span>
				<?php } ?>
				<?php echo $wset['title'];?>
			</a>
		</div>
		<div class="widget-body">
		<?php 
			if($wset['cache'] > 0) { // 캐시적용시
				echo apms_widget_cache($widget_path.'/widget.rows.php', $wname, $wid, $wset);
			} else {
				include($widget_path.'/widget.rows.php');
			}
		?>
		</div>
	<?php } else { // List Style ?>
		<?php 
			if($wset['cache'] > 0) { // 캐시적용시
				echo apms_widget_cache($widget_path.'/widget.rows.php', $wname, $wid, $wset);
			} else {
				include($widget_path.'/widget.rows.php');
			}
		?>
	<?php } ?>

	<?php if($setup_href) { ?>
		<p class="btn-wset text-center">
			<a href="<?php echo $setup_href;?>" class="win_memo">
				<span class="text-muted font-12 en"><i class="fa fa-cog"></i> 위젯설정</span>
			</a>
		</p>
	<?php } ?>
</div>

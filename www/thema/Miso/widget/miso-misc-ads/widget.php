<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css" media="screen">', 0);

?>

<div class="miso-misc-ads">
	<div class="ads-box">
		<?php echo ($wset['ads']) ? $wset['ads'] : '<br><br>반응형 광고박스<br><br><br>';?>
	</div>
	<?php if($setup_href) { ?>
		<p class="btn-wset text-center">
			<a href="<?php echo $setup_href;?>" class="win_memo">
				<span class="text-muted font-12 en"><i class="fa fa-cog"></i> 위젯설정</span>
			</a>
		</p>
	<?php } ?>
</div>

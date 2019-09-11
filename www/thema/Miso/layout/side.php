<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<style>
	.sp-side { height:20px; }
</style>
<?php  //Side Category
	for ($i=0; $i < count($tmenu); $i++) {
		if($tmenu[$i]['on'] == "on" && $tmenu[$i]['is_sub']) {
?>
	<div class="widget-wrap">
		<ul class="side-menu highlight">
			<li class="side-menu-head">
				<div class="white font-13 en" style="padding:8px 15px;"><b><?php echo $tmenu[$i]['name'];?></b></div>
			</li>
			<?php for($j=0; $j < count($tmenu[$i]['sub']); $j++) { ?>
				<li>
					<a href="<?php echo $tmenu[$i]['sub'][$j]['href'];?>"<?php echo $tmenu[$i]['sub'][$j]['target'];?>>
						<span class="<?php echo $tmenu[$i]['sub'][$j]['on'];?>">
							<?php echo $tmenu[$i]['sub'][$j]['name'];?><i class="fa fa-circle <?php echo $tmenu[$i]['sub'][$j]['new'];?>"></i>
						</span>
					</a>
				</li>
				<?php if($tmenu[$i]['sub'][$j]['on'] == 'on') { // 선택메뉴이면 서브 출력 ?>
					<?php for($k=0; $k < count($tmenu[$i]['sub'][$j]['sub']); $k++) { ?>
						<li class="sub">
							<a href="<?php echo $tmenu[$i]['sub'][$j]['sub'][$k]['href'];?>"<?php echo $tmenu[$i]['sub'][$j]['sub'][$k]['target'];?>>
								<span class="<?php echo $tmenu[$i]['sub'][$j]['sub'][$k]['on'];?>">
									<i class="fa fa-caret-right"></i> <?php echo $tmenu[$i]['sub'][$j]['sub'][$k]['name'];?>
								</span>
							</a>
						</li>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</ul>
	</div>
<?php } } ?>

<?php echo apms_widget('miso-misc-ads', 'miso-side-misc-ads1'); // 반응형 광고박스 위젯 ?>

<div class="sp-side"></div>

<?php echo apms_widget('miso-board-list', 'miso-side-board-list1'); // 일반 글/댓글 위젯 - 최근글 ?>

<div class="sp-side"></div>

<?php echo apms_widget('miso-board-list', 'miso-side-board-list2'); // 일반 글/댓글 위젯 - 최근댓글 ?>

<div class="sp-side"></div>

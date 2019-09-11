<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

global $tmenu;

for ($i=1; $i < count($tmenu); $i++) {
	if($tmenu[$i]['on'] == "on" && $tmenu[$i]['is_sub']) {
		for($j=0; $j < count($tmenu[$i]['sub']); $j++) {
			if($tmenu[$i]['sub'][$j]['on'] == 'on' && $tmenu[$i]['sub'][$j]['is_sub']) { //현재 선택메뉴이고 서브메뉴가 있으면 출력

?>
	<div class="widget-wrap">
		<ul class="side-menu highlight">
			<li class="side-menu-head">
				<div class="white font-13 en" style="padding:8px 15px;"><b><?php echo $tmenu[$i]['sub'][$j]['name'];?></b></div>
			</li>
			<?php for($k=0; $k < count($tmenu[$i]['sub'][$j]['sub']); $k++) { ?>
				<li class="sub">
					<a href="<?php echo $tmenu[$i]['sub'][$j]['sub'][$k]['href'];?>"<?php echo $tmenu[$i]['sub'][$j]['sub'][$k]['target'];?>>
						<span class="<?php echo $tmenu[$i]['sub'][$j]['sub'][$k]['on'];?>">
							<i class="fa fa-caret-right"></i> <?php echo $tmenu[$i]['sub'][$j]['sub'][$k]['name'];?>
						</span>
					</a>
				</li>
			<?php } ?>
		</ul>
	</div>
<?php 
			}
		} 
	} 
} 
?>

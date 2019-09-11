<?php
if (!defined('_GNUBOARD_')) {
	// AJAX일 때
	include_once('../../../common.php');
	include_once(G5_BBS_PATH.'/list.rows.php');
}

switch($board['bo_gallery_cols']) {
	case '1'	: $grid = 100; break;
	case '2'	: $grid = 50; break;
	case '3'	: $grid = 33; break;
	case '4'	: $grid = 25; break;
	case '5'	: $grid = 20; break;
	default		: $grid = 33; break;
}

$font = (!G5_IS_MOBILE && $boset['font']) ? ' class="dotum"' : '';

$thumb_w = $board['bo_'.MOBILE_.'gallery_width'];
$thumb_h = $board['bo_'.MOBILE_.'gallery_height'];
$img_height = ($thumb_w > 0 && $thumb_h > 0) ? round(($thumb_h / $thumb_w) * 100, 2) : 0;

for ($i=0; $i<count($list); $i++) { 
	
	if($list[$i]['is_notice']) continue;

	$img = apms_wr_thumbnail($bo_table, $list[$i], $thumb_w, $thumb_h, false, true); // 썸네일

 ?>
	<div class="list-item grid-<?php echo $grid;?>">
		<div class="item-box">
			<div class="item-content<?php echo ($list[$i]['wr_id'] == $wr_id) ? ' now' : '';?>">
				<?php if(!$boset['subject']) { ?>
					<h2 class="font-14">
						<a href="<?php echo $list[$i]['href'];?>"<?php echo $font;?>>
							<?php echo $list[$i]['subject'];?>
						</a>
						<span class="text-muted font-11">
							<?php echo $list[$i]['ca_name']; //분류명 ?>
						</span>
					</h2>
				<?php } ?>
				<div class="img">
					<?php if($list[$i]['wr_id'] == $wr_id) { ?>
						<div class="label-band label-green">Now</div>
					<?php } else if($list[$i]['icon_new']) {?>
						<div class="label-band label-blue">New</div>
					<?php } else if($list[$i]['icon_hot']) {?>
						<div class="label-band label-red">Hot</div>
					<?php } ?>
					<?php if($img_height) { ?>
						<div class="img-fix" style="padding-bottom:<?php echo $img_height;?>%;">
							<a href="<?php echo $list[$i]['href'];?>">
								<?php if($img['src']) {?>
									<img src="<?php echo $img['src'];?>" alt="<?php echo $img['alt'];?>">
								<?php } else { ?>
									<div class="text">
										<?php if($boset['subject']) { ?>
											<h3<?php echo $font;?>><?php echo $list[$i]['subject'];?></h3>
										<?php } ?>
										<?php echo apms_cut_text($list[$i]['wr_content'], $boset['cont']); ?>
									</div>
								<?php } ?>
							</a>
						</div>
					<?php } else { ?>
						<a href="<?php echo $list[$i]['href'];?>">
							<?php if($img['src']) {?>
								<img src="<?php echo $img['src'];?>" alt="<?php echo $img['alt'];?>">
							<?php } else { ?>
								<div class="text">
									<?php if($boset['subject']) { ?>
										<h3<?php echo $font;?>><?php echo $list[$i]['subject'];?></h3>
									<?php } ?>
									<?php echo apms_cut_text($list[$i]['wr_content'], $boset['cont']); ?>
								</div>
							<?php } ?>
						</a>
					<?php } ?>
				</div>
				<div class="item-info en text-muted">
					<div class="pull-left en font-13">
						<?php if ($is_checkbox) { ?>
							<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>">
							&nbsp;
						<?php } ?>
						<i class="fa fa-comment"></i> <?php echo ($list[$i]['wr_comment']) ? '<span class="red">'.number_format($list[$i]['wr_comment']).'</span>' : 0;?>
					</div>
					<div class="pull-right font-11">
						<?php echo number_format($list[$i]['wr_hit']);?> hits
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

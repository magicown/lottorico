<?php
if (!defined('_GNUBOARD_')) {
	// AJAX일 때
	include_once('../../../common.php');
	include_once(G5_BBS_PATH.'/list.rows.php');
}

$icon = ($boset['ok']) ? apms_fa($boset['icon']) : '<i class="fa fa-comment"></i>';
$font = (!G5_IS_MOBILE && $boset['font']) ? ' class="dotum"' : '';
$n_icon = ($boset['notice']) ? apms_fa($boset['notice']) : '<img src="'.$board_skin_url.'/img/icon_notice.gif" alt="">';

$reply_depth = (G5_IS_MOBILE) ? 30 : 60;

for ($i=0; $i<count($list); $i++) { 
	
	if($page > 1 && $list[$i]['is_notice']) continue;

	$list_depth = strlen($list[$i]['wr_reply']) * $reply_depth;
	$img = apms_wr_thumbnail($bo_table, $list[$i], 50, 50, false, true); // 썸네일
	$img['src'] = (!$img['src'] && $boset['photo']) ? apms_photo_url($list[$i]['mb_id']) : $img['src']; // 회원사진

	if ($wr_id == $list[$i]['wr_id']) {
		$num = "<span class=\"red\">[열람중]</span> ";
		$div_css = ' list-now';
		$subject_css = ' now';
	} else if ($list[$i]['is_notice']) { // 공지사항
		$num = $n_icon;
		$div_css = ' list-notice';
		$subject_css = ' notice';
	} else {
		$num = (isset($list[$i]['icon_new']) && $list[$i]['icon_new']) ? '<i class="fa fa-circle red"></i>' : '';
		$div_css = $subject_css = '';
	}
 ?>
	<div class="list-item media<?php echo $div_css;?>"<?php echo ($list_depth) ? ' style="padding-left:'.$list_depth.'px;"' : ''; ?>>
		<?php if($img['src']) { ?>
			<div class="m-photo img-thumbnail pull-left">
				<a href="<?php echo $list[$i]['href'] ?>">
					<img src="<?php echo $img['src'];?>" alt="<?php echo $img['alt'];?>" class="media-object">
				</a>
			</div>
		<?php } else if($icon) { ?>
			<div class="m-photo img-thumbnail pull-left">
				<a href="<?php echo $list[$i]['href'] ?>">
					<div class="media-object"><?php echo $icon;?></div>
				</a>
			</div>
		<?php } ?>
		<div class="media-body">
			<h2 class="media-heading<?php echo $subject_css;?>">
				<?php if ($list[$i]['comment_cnt']) { ?>
					<span class="pull-right">
						<span class="sound_only">댓글</span>
						<i class="fa fa-comments-o"></i><span class="font-12<?php echo ($list[$i]['wr_comment']) ? ' red' : '';?>">
						<?php echo $list[$i]['wr_comment']; ?></span>
						<span class="sound_only">개</span>
					</span>
				<?php } ?>
				<a href="<?php echo $list[$i]['href'] ?>"<?php echo $font;?>>
					<?php if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'].PHP_EOL; ?>
					<?php echo $num; ?>
					<?php echo $list[$i]['wr_subject'] ?>
				</a>
			</h2>
			<?php if ($is_checkbox) { ?>
				<label class="pull-right">
					<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
				</label>
			<?php } ?>
			<div class="font-11 en text-muted media-info">
				<i class="fa fa-user"></i>
				<?php echo $list[$i]['name'] ?>

				<?php if ($is_category && $list[$i]['ca_name']) { ?>
					<i class="fa fa-tags"></i>
					<a href="<?php echo $list[$i]['ca_name_href'] ?>"><span class="text-muted font-11"><?php echo $list[$i]['ca_name'] ?></span></a>
				<?php } ?>

				<i class="fa fa-eye"></i>
				<?php echo $list[$i]['wr_hit'] ?>

				<?php if ($is_good) { ?>
					<i class="fa fa-thumbs-up"></i>
					<?php echo $list[$i]['wr_good'] ?>
				<?php } ?>

				<i class="fa fa-clock-o hidden-xs"></i>
				<time datetime="<?php echo date('Y-m-d\TH:i:s+09:00', $list[$i]['date']) ?>" class="hidden-xs"><?php echo apms_datetime($list[$i]['date'], 'Y.m.d');?></time>
			</div>
		</div>
	</div>
<?php } ?>

<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

//가로 아이템수에 따른 칼럼 계산
switch($list_mods) {
	case '1'	: $item_cols = 12; break;
	case '2'	: $item_cols = 6; break;
	case '3'	: $item_cols = 4; break;
	case '4'	: $item_cols = 3; break;
	case '6'	: $item_cols = 2; break;
	default		: $item_cols = 3; $list_mods = 4; break;
}

$img_height = ($thumb_w > 0 && $thumb_h > 0) ? round(($thumb_h / $thumb_w) * 100, 2) : '';
if(!$img_height) $img_height = 100;

?>

<aside>
	<div style="margin-bottom:15px;">
		<div class="btn-group btn-group-justified">
			<div class="btn-group">
				<a href="./listtype.php?type=1" class="btn btn-black<?php echo ($type == "1") ? ' active' : '';?>" role="button">히트</a>
			</div>
			<div class="btn-group">
				<a href="./listtype.php?type=2" class="btn btn-black<?php echo ($type == "2") ? ' active' : '';?>" role="button">추천</a>
			</div>
			<div class="btn-group">
				<a href="./listtype.php?type=3" class="btn btn-black<?php echo ($type == "3") ? ' active' : '';?>" role="button">신상</a>
			</div>
			<div class="btn-group">
				<a href="./listtype.php?type=4" class="btn btn-black<?php echo ($type == "4") ? ' active' : '';?>" role="button">인기</a>
			</div>
			<div class="btn-group">
				<a href="./listtype.php?type=5" class="btn btn-black<?php echo ($type == "5") ? ' active' : '';?>" role="button">할인</a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-3">
			<?php if($is_cate) { // 하위분류 ?>
				<div class="form-group input-group input-group-sm">
					<span class="input-group-addon"><i class="fa fa-tag"></i></span>
					<select name="sortodr" onchange="location='./listtype.php?type=<?php echo $type;?>&amp;ca_id=' + this.value;" class="form-control input-sm">
						<option value="<?php echo $ca_id;?>">카테고리</option>
						<?php for($i=0;$i < count($cate); $i++) { ?>
							<option value="<?php echo $cate[$i]['ca_id'];?>"<?php echo ($ca_id == $cate[$i]['ca_id']) ? ' selected' : '';?>><?php echo $cate[$i]['name'];?></option>
						<?php } ?>
					</select>
					<?php if($up_href) { ?>
						<span class="input-group-addon"><a href="<?php echo $up_href;?>" title="상위분류"><i class="fa fa-caret-up"></i></a></span>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<div class="col-sm-6">

		</div>
		<div class="col-sm-3">
			<div class="form-group input-group input-group-sm">
				<span class="input-group-addon"><i class="fa fa-sort"></i></span>
				<select name="sortodr" onchange="location='<?php echo $list_sort_href; ?>' + this.value;" class="form-control input-sm">
					<option value="">정렬하기</option>
					<option value="it_sum_qty&amp;sortodr=desc"<?php echo ($sort == 'it_sum_qty') ? ' selected' : '';?>>판매많은순</option>
					<option value="it_price&amp;sortodr=asc"<?php echo ($sort == 'it_price' && $sortodr == 'asc') ? ' selected' : '';?>>낮은가격순</option>
					<option value="it_price&amp;sortodr=desc"<?php echo ($sort == 'it_price' && $sortodr == 'desc') ? ' selected' : '';?>>높은가격순</option>
					<option value="it_use_avg&amp;sortodr=desc"<?php echo ($sort == 'it_use_avg') ? ' selected' : '';?>>평점높은순</option>
					<option value="it_use_cnt&amp;sortodr=desc"<?php echo ($sort == 'it_use_cnt') ? ' selected' : '';?>>후기많은순</option>
					<option value="pt_good&amp;sortodr=desc"<?php echo ($sort == 'pt_good') ? ' selected' : '';?>>추천많은순</option>
					<option value="pt_comment&amp;sortodr=desc"<?php echo ($sort == 'pt_comment') ? ' selected' : '';?>>댓글많은순</option>
					<option value="it_update_time&amp;sortodr=desc"<?php echo ($sort == 'it_update_time') ? ' selected' : '';?>>최근등록순</option>
				</select>
			</div>
		</div>
	</div>
</aside>

<section>
	<div class="item">
		<div class="row re-row">
		<?php for($i=0; $i < count($list); $i++) { 

			// 새글
			$list[$i]['new'] = ($list[$i]['pt_num'] >= (G5_SERVER_TIME - (24 * 3600))) ? true : false;

			// 이미지
			$list[$i]['img'] = apms_it_thumbnail($list[$i], $thumb_w, $thumb_h, false, true);

			// 가격
			$price = ($list[$i]['it_tel_inq']) ? '<i class="fa fa-phone"></i> Call' : '<span class="font-12"><i class="fa fa-krw"></i></span> '.number_format(get_price($list[$i]));

			$it_comment = $list[$i]['pt_comment'] + $list[$i]['it_use_cnt'];
		?>
			<?php if($i > 0 && $i%$list_mods == 0) { ?>
					</div>
				</div>
				<div class="item">
					<div class="row re-row">
			<?php } ?>
			<div class="col-sm-<?php echo $item_cols;?> col">
				<div class="list-item">
					<div class="figure">
						<?php if($list[$i]['it_id'] == $it_id) { ?>
							<div class="label-band label-red">Now</div>
						<?php } else { ?>
							<?php if($list[$i]['new']) {?>
								<div class="label-band label-blue">New</div>
							<?php } ?>
						<?php } ?>
						<div class="label-tack"><?php echo item_icon($list[$i]);?></div>
						<div class="img" style="padding-bottom:<?php echo $img_height;?>%;">
							<a href="<?php echo $list[$i]['href'];?>">
								<?php if($list[$i]['img']['src']) {?>
									<img src="<?php echo $list[$i]['img']['src'];?>" alt="<?php echo $list[$i]['img']['alt'];?>">
								<?php } else { ?>
									<span class="no-img-box">
										<span class="no-img"><i class="fa fa-camera"></i></span>
									</span>
								<?php } ?>
								<div class="figure-caption en font-11">
									<ul>
										<li><i class="fa fa-shopping-cart"></i> <?php echo $list[$i]['it_sum_qty']; //판매량 ?></li>
										<li><i class="fa fa-pencil"></i> <?php echo $list[$i]['it_use_cnt']; //후기수 ?></li>
										<li><i class="fa fa-thumbs-up"></i> <?php echo $list[$i]['pt_good']; //추천수 ?></li>
										<li><?php echo apms_get_star($list[$i]['it_use_avg']); ?></li>
									</ul>
								</div>
							</a>
						</div>
					</div>
					<h2>
						<a href="<?php echo $list[$i]['href'];?>">
							<?php echo $list[$i]['it_name'];?>
						</a>
					</h2>
					<div class="item-info en">
						<div class="pull-left en font-14 text-muted">
							<i class="fa fa-comment"></i> <?php echo ($it_comment) ? '<span class="red">'.number_format($it_comment).'</span>' : 0;?>
							&nbsp;
							<i class="fa fa-shopping-cart"></i> <?php echo ($list[$i]['it_sum_qty']) ? '<span class="black">'.number_format($list[$i]['it_sum_qty']).'</span>' : 0;?>
						</div>
						<div class="pull-right font-14">
							<b><?php echo $price;?></b>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="list-sns-icon">
					<?php // SNS
						$sns_url  = G5_SHOP_URL.'/item.php?it_id='.$list[$i]['it_id'];
						$sns_title = get_text($list[$i]['it_name']).' | '.get_text($config['cf_title']);
						$kakaotalk_href = get_sns_share_link('kakaotalk', $sns_url, $sns_title);
					?>
					<a class="btn btn-gray btn-xs" href="#" onclick="<?php echo get_sns_share_link('facebook', $sns_url, $sns_title);?>"><i class="fa fa-facebook fa-lg"></i></a>
					<a class="btn btn-gray btn-xs" href="#" onclick="<?php echo get_sns_share_link('twitter', $sns_url, $sns_title);?>"><i class="fa fa-twitter fa-lg"></i></a>
					<a class="btn btn-gray btn-xs" href="#" onclick="<?php echo get_sns_share_link('googleplus', $sns_url, $sns_title);?>"><i class="fa fa-google-plus fa-lg"></i></a>
					<?php if($kakaotalk_href) {	?>
						<a class="btn btn-gray btn-xs" href="#" onclick="<?php echo $kakaotalk_href;?>"><i class="fa fa-comment fa-lg"></i></a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</section>
<?php if($i == 0) {?>
	<div class="well bg-colorset text-center<?php echo (G5_IS_MOBILE) ? '' : ' list-none';?>">등록된 자료가 없습니다.</div>
<?php } ?>

<?php if($total_count > 0) { ?>
	<div class="text-center">
		<ul class="pagination pagination-sm">
			<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
		</ul>
	</div>
<?php } ?>

<div class="clearfix"></div>

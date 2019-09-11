<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 초기값
if(!$boset['ok']) {
	$boset['num'] = 1;
	$boset['name'] = 1;
	$boset['hit'] = 1;
	$boset['date'] = 1;
}

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 1;
if ($is_checkbox) $colspan++;
if ($boset['num']) $colspan++;
if ($boset['category']) $colspan++;
if ($boset['name']) $colspan++;
if ($boset['date']) $colspan++;
if ($boset['hit']) $colspan++;
if ($boset['good']) $colspan++;
if ($boset['nogood']) $colspan++;

$n_icon = ($boset['notice']) ? apms_fa($boset['notice']) : '<img src="'.$board_skin_url.'/img/icon_notice.gif" alt="">';

?>

<div class="table-responsive">
	<table class="table list-tbl bg-white">
	<thead>
	<tr>
		<?php if ($is_checkbox) { ?>
		<th scope="col">
			<label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
			<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
		</th>
		<?php } ?>
		<?php if ($boset['num']) { ?>
			<th scope="col">번호</th>
		<?php } ?>
		<?php if($boset['category']) { ?>
			<th scope="col">분류</th>
		<?php } ?>
		<th scope="col">제목</th>
		<?php if($boset['name']) { ?>
			<th scope="col">글쓴이</th>
		<?php } ?>
		<?php if($boset['date']) { ?>
			<th scope="col"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜</a></th>
		<?php } ?>
		<?php if($boset['hit']) { ?>
			<th scope="col"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?><nobr>조회</nobr></a></th>
		<?php } ?>
		<?php if($boset['good']) { ?>
			<th scope="col"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?><nobr>추천</nobr></a></th>
		<?php } ?>
		<?php if($boset['nogood']) { ?>
			<th scope="col"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?><nobr>비추</nobr></a></th>
		<?php } ?>
	</tr>
	</thead>
	<tbody>
	<?php for ($i=0; $i<count($list); $i++) { 

			// 공지, 현재글 스타일 체크
			if ($wr_id == $list[$i]['wr_id']) {
				$tr_css = ' class="list-now"';
				$subject_css = ' now';
				$num = "<span class=\"red\">열람중</span>";
			} else if ($list[$i]['is_notice']) { // 공지사항
				$tr_css = ' class="active"';
				$subject_css = ' notice';
				$num = $n_icon;
			} else {
				$tr_css = $subject_css = '';
				$num = '<span class="en">'.$list[$i]['num'].'</span>';
			}		
	
	?>
	<tr<?php echo $tr_css; ?>>
		<?php if ($is_checkbox) { ?>
			<td class="text-center">
				<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
				<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
			</td>
		<?php } ?>
		<?php if ($boset['num']) { ?>
			<td class="text-center font-11">
				<?php echo $num;?>
			</td>
		<?php } ?>
		<?php if ($boset['category']) { ?>
			<td class="text-center">
				<a href="<?php echo $list[$i]['ca_name_href'] ?>"><span class="text-muted font-11"><?php echo $list[$i]['ca_name'] ?></span></a>
			</td>
		<?php } ?>
		<td class="list-subject<?php echo $subject_css;?>">
			<a href="<?php echo $list[$i]['href'] ?>">
				<?php echo $list[$i]['icon_reply']; ?>
				<?php echo $list[$i]['subject'] ?>
				<?php if ($list[$i]['comment_cnt']) { ?>
					<span class="sound_only">댓글</span><span class="list-cnt"><?php echo $list[$i]['comment_cnt']; ?></span><span class="sound_only">개</span>
				<?php } ?>
				<?php
					if (isset($list[$i]['icon_secret'])) echo PHP_EOL.$list[$i]['icon_secret'];
					if (isset($list[$i]['icon_new'])) echo PHP_EOL.$list[$i]['icon_new'];
					if (isset($list[$i]['icon_hot'])) echo PHP_EOL.$list[$i]['icon_hot'];
					if (isset($list[$i]['icon_file'])) echo PHP_EOL.$list[$i]['icon_file'];
				 ?>
			</a>
		</td>
		<?php if ($boset['name']) { ?>
			<td><b><?php echo $list[$i]['name'] ?></b></td>
		<?php } ?>
		<?php if ($boset['date']) { ?>
			<td class="text-center en font-11"><?php echo apms_datetime($list[$i]['date']); ?></td>
		<?php } ?>
		<?php if ($boset['hit']) { ?>
			<td class="text-center en font-11"><?php echo $list[$i]['wr_hit'] ?></td>
		<?php } ?>
		<?php if ($boset['good']) { ?>
			<td class="text-center en font-11"><?php echo $list[$i]['wr_good'] ?></td>
		<?php } ?>
		<?php if ($boset['nogood']) { ?>
			<td class="text-center en font-11"><?php echo $list[$i]['wr_nogood'] ?></td>
		<?php } ?>
	</tr>
	<?php } ?>
	<?php if (!$i) { echo '<tr><td colspan="'.$colspan.'" class="text-center text-muted list-none">게시물이 없습니다.</td></tr>'; } ?>
	</tbody>
	</table>
</div>

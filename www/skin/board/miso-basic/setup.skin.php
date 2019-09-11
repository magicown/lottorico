<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 boset[배열키] 형태로 등록

// 초기값
if(!$boset['ok']) {
	$boset['num'] = 1;
	$boset['name'] = 1;
	$boset['hit'] = 1;
	$boset['date'] = 1;
	$boset['icon'] = '{아이콘:comment}';
	$boset['video'] = '800px';
}

?>
<div class="local_desc01 local_desc">
	<ul>
		<li>공지아이콘 미설정시 이미지 아이콘 출력, 색상은 색상 클래스(red 등) 아이콘에 추가
		<li>모바일 썸네일 50x50 크기 고정
	</ul>
</div>
<div class="tbl_head01 tbl_wrap">
	<input type="hidden" name="boset[ok]" value="1">
	<table>
	<caption>PC목록설정</caption>
	<colgroup>
		<col class="grid_2">
		<col>
	</colgroup>
	<thead>
	<tr>
		<th scope="col">구분</th>
		<th scope="col">번호</th>
		<th scope="col">분류</th>
		<th scope="col">이름</th>
		<th scope="col">날짜</th>
		<th scope="col">조회</th>
		<th scope="col">추천</th>
		<th scope="col">비추</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td align="center">PC목록출력</td>
		<td align="center">
			<label><input type="checkbox" name="boset[num]"<?php echo ($boset['num']) ? ' checked' : '';?>>
		</td>
		<td align="center">
			<label><input type="checkbox" name="boset[category]"<?php echo ($boset['category']) ? ' checked' : '';?>>
		</td>
		<td align="center">
			<label><input type="checkbox" name="boset[name]"<?php echo ($boset['name']) ? ' checked' : '';?>>
		</td>
		<td align="center">
			<label><input type="checkbox" name="boset[date]"<?php echo ($boset['date']) ? ' checked' : '';?>>
		</td>
		<td align="center">
			<label><input type="checkbox" name="boset[hit]"<?php echo ($boset['hit']) ? ' checked' : '';?>>
		</td>
		<td align="center">
			<label><input type="checkbox" name="boset[good]"<?php echo ($boset['good']) ? ' checked' : '';?>>
		</td>
		<td align="center">
			<label><input type="checkbox" name="boset[nogood]"<?php echo ($boset['nogood']) ? ' checked' : '';?>>
		</td>
	</tr>
	<tr>
		<td align="center">공지아이콘</td>
		<td colspan="7">
			<input type="text" name="boset[notice]" value="<?php echo ($boset['notice']);?>" size="30" class="frm_input"> 
			<a href="<?php echo G5_BBS_URL;?>/icon.php" class="btn_frmline win_scrap">아이콘 선택</a>
		</td>
	</tr>
	<tr>
		<td align="center">분류스타일</td>
		<td colspan="7">
			<label><input type="checkbox" name="boset[cate]"<?php echo ($boset['cate']) ? ' checked' : '';?>> Select 분류사용
		</td>
	</tr>
	<tr>
		<td align="center">글정렬버튼</td>
		<td colspan="7">
			<label><input type="checkbox" name="boset[sort]"<?php echo ($boset['sort']) ? ' checked' : '';?>> 목록헤드에 글정렬버튼 출력
		</td>
	</tr>
	<tr>
		<td align="center">모바일사용</td>
		<td colspan="7">
			<label><input type="checkbox" name="boset[mobile]"<?php echo ($boset['mobile']) ? ' checked' : '';?>> PC에서 모바일목록 사용
		</td>
	</tr>
	<tr>
		<td align="center">모바일제목</td>
		<td colspan="7">
			<label><input type="checkbox" name="boset[font]"<?php echo ($boset['font']) ? ' checked' : '';?>> PC에서 모바일목록 제목 돋움체 적용
		</td>
	</tr>
	<tr>
		<td align="center">모바일목록</td>
		<td colspan="7">
			<select name="boset[mode]">
				<option value="">일반목록</option>
				<option value="1"<?php echo ($boset['mode'] == "1") ? ' selected' : '';?>>무한스크롤 목록</option>
				<option value="2"<?php echo ($boset['mode'] == "2") ? ' selected' : '';?>>더보기 목록</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">이미지출력</td>
		<td colspan="7">
			<label><input type="checkbox" name="boset[photo]"<?php echo ($boset['photo']) ? ' checked' : '';?>> 모바일목록에서 이미지가 없으면 회원사진 출력
		</td>
	</tr>
	<tr>
		<td align="center">이미지없음</td>
		<td colspan="7">
			<input type="text" name="boset[icon]" value="<?php echo ($boset['icon']);?>" size="30" class="frm_input"> 
			<a href="<?php echo G5_BBS_URL;?>/icon.php" class="btn_frmline win_scrap">아이콘 선택</a>
		</td>
	</tr>
	<tr>
		<td align="center">본문동영상</td>
		<td colspan="7">
			<input type="text" name="boset[video]" value="<?php echo ($boset['video']);?>" size="8" class="frm_input"> 최대 크기(% 또는 px) - 미설정시 APMS 기본 적용
		</td>
	</tr>
	</tbody>
	</table>
</div>
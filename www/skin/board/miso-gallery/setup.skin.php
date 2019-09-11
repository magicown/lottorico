<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 boset[배열키] 형태로 등록

// 초기값
if(!$boset['ok']) {
	$boset['video'] = '800px';
	$boset['cont'] = '100';
}

?>

<div class="local_desc01 local_desc">
	<ul>
		<li>공지아이콘 미설정시 이미지 아이콘 출력, 색상은 색상 클래스(red 등) 아이콘에 추가
		<li>이미지는 썸네일 비율대로 출력, 썸네일 높이값을 지정하지 않으면 원본 비율대로 출력
		<li>썸네일 크기나 가로수 등은 보드 관리자 > 갤러리 항목 설정
	</ul>
</div>

<div class="tbl_head01 tbl_wrap">
	<input type="hidden" name="boset[ok]" value="1">
	<table>
	<caption>목록설정</caption>
	<colgroup>
		<col class="grid_2">
		<col>
	</colgroup>
	<thead>
	<tr>
		<th scope="col">구분</th>
		<th scope="col">설정</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td align="center">공지아이콘</td>
		<td>
			<input type="text" name="boset[notice]" value="<?php echo ($boset['notice']);?>" size="30" class="frm_input"> 
			<a href="<?php echo G5_BBS_URL;?>/icon.php" class="btn_frmline win_scrap">아이콘 선택</a>
		</td>
	</tr>
	<tr>
		<td align="center">분류스타일</td>
		<td>
			<label><input type="checkbox" name="boset[cate]"<?php echo ($boset['cate']) ? ' checked' : '';?>> Select 분류사용
		</td>
	</tr>
	<tr>
		<td align="center">글정렬버튼</td>
		<td>
			<label><input type="checkbox" name="boset[sort]"<?php echo ($boset['sort']) ? ' checked' : '';?>> 목록헤드에 글정렬버튼 출력
		</td>
	</tr>
	<tr>
		<td align="center">목록스타일</td>
		<td>
			<select name="boset[mode]">
				<option value="">일반목록</option>
				<option value="1"<?php echo ($boset['mode'] == "1") ? ' selected' : '';?>>무한스크롤 목록</option>
				<option value="2"<?php echo ($boset['mode'] == "2") ? ' selected' : '';?>>더보기 목록</option>
			</select>
			&nbsp;
			<label><input type="checkbox" name="boset[fade]"<?php echo ($boset['fade']) ? ' checked' : '';?>> 페이드 효과
		</td>
	</tr>
	<tr>
		<td align="center">목록제목</td>
		<td>
			<label><input type="checkbox" name="boset[subject]"<?php echo ($boset['subject']) ? ' checked' : '';?>> 출력안함
		</td>
	</tr>
	<tr>
		<td align="center">제목폰트</td>
		<td>
			<label><input type="checkbox" name="boset[font]"<?php echo ($boset['font']) ? ' checked' : '';?>> PC에서 돋움체 적용
		</td>
	</tr>
	<tr>
		<td align="center">내용글수</td>
		<td>
			<input type="text" name="boset[cont]" value="<?php echo ($boset['cont']);?>" size="8" class="frm_input"> 자
		</td>
	</tr>
	<tr>
		<td align="center">본문동영상</td>
		<td>
			<input type="text" name="boset[video]" value="<?php echo ($boset['video']);?>" size="8" class="frm_input"> 최대 크기(% 또는 px) - 미설정시 APMS 기본 적용
		</td>
	</tr>
	</tbody>
	</table>
</div>
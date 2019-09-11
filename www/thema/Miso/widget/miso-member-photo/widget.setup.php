<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

if(!$wset['rows']) $wset['rows'] = 12; 

?>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>위젯설정</caption>
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
		<td align="center">스타일</td>
		<td>
			<select name="wset[style]">
				<option value="list"<?php echo get_selected('list', $wset['style']); ?>>리스트형</option>
				<option value="title"<?php echo get_selected('title', $wset['style']); ?>>타이틀형</option>
			</select>
			스타일
		</td>
	</tr>
	<tr>
		<td align="center">타이틀</td>
		<td>
			<input type="text" name="wset[title]" value="<?php echo $wset['title']; ?>" size="40" class="frm_input">
			&nbsp;
			<label><input type="checkbox" name="wset[more]" value="1"<?php echo get_checked('1', $wset['more']); ?>> 더보기 출력</label>
		</td>
	</tr>
	<tr>
		<td align="center">링크주소</td>
		<td>
			<?php echo help('설정에 따라 보드아이디, 분류코드, URL 직접 입력');?>
			<input type="text" name="wset[thid]" value="<?php echo $wset['thid']; ?>" size="40" class="frm_input">
			&nbsp;
			<select name="wset[tlink]">
				<option value="link"<?php echo get_selected('link', $wset['tlink']); ?>>직접입력</option>
				<option value="board"<?php echo get_selected('board', $wset['tlink']); ?>>보드아이디</option>
				<option value="shop"<?php echo get_selected('shop', $wset['tlink']); ?>>분류코드</option>
				<option value=""<?php echo get_selected('', $wset['tlink']); ?>>링크없음</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">추출회원수</td>
		<td>
			<input type="text" name="wset[rows]" value="<?php echo $wset['rows']; ?>" class="frm_input" size="3"> 명 PC 출력
			&nbsp;
			<input type="text" name="wmset[rows]" value="<?php echo $wmset['rows']; ?>" class="frm_input" size="3"> 명 모바일 출력
		</td>
	</tr>
	<tr>
		<td align="center">제외회원</td>
		<td>
			<?php echo help('회원아이디를 콤마(,)로 구분해서 복수 등록 가능');?>
			<input type="text" name="wset[ex_mb]" value="<?php echo $wset['ex_mb']; ?>" size="60" class="frm_input">
			<input type="hidden" name="wset[photo]" value="1" class="frm_input">
			<input type="hidden" name="wset[mode]" value="recent" class="frm_input">
		</td>
	</tr>
	<tr>
		<td align="center">캐시사용</td>
		<td>
			<input type="text" name="wset[cache]" value="<?php echo $wset['cache']; ?>" class="frm_input" size="4"> 초 간격으로 캐싱 - 본인자료 추출설정시 캐시사용하면 안됩니다.
		</td>
	</tr>
	</tbody>
	</table>
</div>
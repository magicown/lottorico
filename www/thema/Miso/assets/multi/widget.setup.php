<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

// 컬러셋 체크
function widget_multi_colorset($cid, $cval) {

	$arr = array();
	$skin_path = G5_PATH.'/thema/'.THEMA.'/colorset/';
	$str = '<select name="'.$cid.'">'."\n";
	$str .= '<option value="">컬러셋 선택</option>'."\n";
	$handle = opendir($skin_path);
	while ($file = readdir($handle)) {
		if($file == "."||$file == "..") continue;
		if (is_dir($skin_path.$file)) $arr[] = $file;
	}
	closedir($handle);
	sort($arr);

	foreach($arr as $key=>$value) {
		$str .= '<option value="'.$arr[$key].'"'.get_selected($arr[$key], $cval).'>'.$arr[$key].'</option>'."\n";
	}
	$str .= '</select>'."\n";
	return $str;
}

// 설정값 저장
function widget_multi_file($dir, $set) {

	if(!$dir) return;

	// 인덱스 생성
	$idxpath = G5_PATH.'/s/'.$dir;
	if(!is_dir($idxpath)) {
		@mkdir($idxpath, G5_DIR_PERMISSION);
	}
	@chmod($idxpath, G5_DIR_PERMISSION);

	// 인덱스 파일 복사
	$idxfile = G5_PATH.'/thema/'.$set['thema'].'/assets/multi/index.php';
	if(!file_exists($idxpath.'/index.php')) {
		@copy($idxfile, $idxpath.'/index.php');
		@chmod($idxpath.'/index.php', G5_FILE_PERMISSION);
	}

	// 셋업파일 생성
	$setfile = $idxpath.'/setup.php';
	@unlink($setfile);

	$handle = fopen($setfile, 'w');
	$set_content = "<?php\nif (!defined('_GNUBOARD_')) exit;\n\$multiset=".var_export($set, true)."?>";
	fwrite($handle, $set_content);
	fclose($handle);

	// 레이아웃 복사
	if($set['thema'] && $set['colorset']) {
		$layoutpath = G5_PATH.'/thema/'.$set['thema'].'/layout';
		$subpath = $layoutpath.'/'.$set['colorset'];
		if(!is_dir($subpath)) {
			@mkdir($subpath, G5_DIR_PERMISSION);
			@chmod($subpath, G5_DIR_PERMISSION);
		}

		// 파일복사
		$subfile = array('index.head.php', 'index.php', 'side.php', 'tail.php', 'wing.php');
		for($i = 0; $i < count($subfile); $i++) {
			if(!file_exists($subpath.'/'.$subfile[$i])) {
				@copy($layoutpath.'/'.$subfile[$i], $subpath.'/'.$subfile[$i]);
				@chmod($subpath.'/'.$subfile[$i], G5_FILE_PERMISSION);
			}
		}

	}

	return;
}

// 멀티사이트
$wset['multi'] = ($wset['multi'] > 0) ? $wset['multi'] : 0;

if($wset['multi'] > 0) {
	//퍼미션 변경
	@chmod(G5_PATH.'/thema', G5_DIR_PERMISSION);
	@chmod(G5_PATH.'/thema/'.$thema, G5_DIR_PERMISSION);
	@chmod(G5_PATH.'/thema/'.$thema.'/layout', G5_DIR_PERMISSION);
	@chmod(G5_PATH.'/thema/'.$thema.'/colorset', G5_DIR_PERMISSION);

	//도메인 폴더생성
	$mdpath = G5_PATH.'/s';
	if(!is_dir($mdpath)) {
		@mkdir($mdpath, G5_DIR_PERMISSION);
	}
	@chmod($mdpath, G5_DIR_PERMISSION);

	//인덱스파일생성 및 파일이동시키기
	$mtset = array();
	for($i=1; $i <= $wset['multi']; $i++) { 
		$mtset['thema'] = $thema;
		$mtset['colorset'] = $wset['c'.$i];
		$mtset['shop'] = $wset['st'.$i];
		widget_multi_file($wset['s'.$i], $mtset);
		unset($mtset);
	}
}

?>

<div class="local_desc01 local_desc">
	<ul>
		<li>미소테마 기본홈 및 멀티사이트 설정위젯입니다.</li>
	</ul>
</div>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>위젯설정</caption>
	<colgroup>
		<col class="grid_2">
		<col>
	</colgroup>
	<thead>
	<tr>
		<th colspan="2" align="center"><b>기본홈 설정</b></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td align="center">사이트로고</td>
		<td>
			<?php echo help('HTML 태그 및 IMG 태그를 이용해서 이미지 등록가능');?>
			<textarea name="wset[ln0]"><?php echo $wset['ln0']; ?></textarea>
		</td>
	</tr>
	<tr>
		<td align="center">로고URL</td>
		<td>
			<?php echo help('사이트로고 클릭시 이동주소로 미등록시 G5 루트로 자동지정됨');?>
			<input type="text" name="wset[lu0]" value="<?php echo $wset['lu0']; ?>" size="58" class="frm_input">		
		</td>
	</tr>	
	<tr>
		<td align="center">홈메뉴명</td>
		<td>
			<?php echo help('홈으로, 메인 등 상단 주메뉴의 첫번째 메뉴명으로 미등록시 "메인"으로 자동지정됨');?>
			<textarea name="wset[in0]"><?php echo $wset['in0']; ?></textarea>
		</td>
	</tr>
	<tr>
		<td align="center">홈메뉴URL</td>
		<td>
			<?php echo help('주메뉴의 첫번째 메뉴명 클릭시 이동주소로 미등록시 G5 루트로 자동지정됨');?>
			<input type="text" name="wset[iu0]" value="<?php echo $wset['iu0']; ?>" size="58" class="frm_input">
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding:10px 15px 0px;">
			<?php echo help('멀티사이트 미사용시 자동메뉴가 출력되며, 멀티사이트 적용시 아래 등록한 메뉴만 출력됩니다.<br>관리자 > 테마관리 > 메뉴설정에서 <b>메뉴보임은 모두보임으로 설정</b>해 주세요.');?>
		</td>
	</tr>		
	<tr>
		<td align="center">메뉴 #01</td>
		<td>
			<?php echo help('홈메뉴 다음 메뉴로 보드그룹아이디, 상품분류코드를 콤마(,)로 구분해서 등록');?>
			<input type="text" name="wset[ma0]" value="<?php echo $wset['ma0']; ?>" size="58" class="frm_input">
		</td>
	</tr>		
	<tr>
		<td align="center">메뉴 #02</td>
		<td>
			<?php echo help('메뉴 #01 다음 메뉴로 서브메뉴가 주메뉴 자리로 이동됨');?>
			<input type="text" name="wset[mb0]" value="<?php echo $wset['mb0']; ?>" size="20" class="frm_input"> (그룹아이디/상품분류코드 1개만 등록가능)
		</td>
	</tr>		
	<tr>
		<td align="center">메뉴 #03</td>
		<td>
			<?php echo help('메뉴 #02 다음 메뉴로 보드그룹아이디, 상품분류코드를 콤마(,)로 구분해서 등록');?>
			<input type="text" name="wset[mc0]" value="<?php echo $wset['mc0']; ?>" size="58" class="frm_input">
		</td>
	</tr>
	</tbody>
	<thead>
	<tr>
		<th colspan="2">멀티사이트 설정</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td align="center">사이트수</td>
		<td>
			<input type="text" name="wset[multi]" value="<?php echo $wset['multi']; ?>" size="4" class="frm_input"> 개 (멀티사이트수를 등록하고 저장하면 멀티설정탭이 하단에 출력됨)
		</td>
	</tr>
	</tbody>
	</table>
</div>

<?php if($wset['multi'] > 0) { ?>
	<ul class="anchor">
		<?php for($i=1; $i <= $wset['multi']; $i++) { ?>
			<li><a href="javascript:apms_show('multi<?php echo $i;?>');"><?php echo ($wset['m'.$i]) ? $wset['m'.$i] : '멀티 #'.$i;?> 설정</a></li>
		<?php } ?>
	</ul>
	<br>
<?php } ?>

<?php for($i=1; $i <= $wset['multi']; $i++) { 
	$name = ($wset['m'.$i]) ? $wset['m'.$i] : '멀티 #'.$i;
?>
	<div id="multi<?php echo $i;?>" class="anc tbl_head01 tbl_wrap" style="display:none;">
		<table>
		<caption><?php echo $name;?> 설정</caption>
		<colgroup>
			<col class="grid_2">
			<col>
		</colgroup>
		<thead>
		<tr>
			<th colspan="2"><?php echo $name;?> 설정하기</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td align="center">사용여부</td>
			<td>
				<label><input type="checkbox" name="wset[u<?php echo $i;?>]" value="1"<?php echo get_checked('1', $wset['u'.$i]);?>> 사용하기 (체크안하면 설정해도 출력안됨)</label>
			</td>
		</tr>
		<tr>
			<td align="center">컬러셋</td>
			<td>
				<?php echo help('선택한 컬러셋으로 테마 내 /layout 폴더에 폴더 자동생성후 사용할 파일(index.php, tail.php 등)들이 복사됩니다. 선택한 컬러셋과 동일한 컬러셋을 가진 보드그룹과 분류는 본 멀티설정이 적용됩니다.');?>
				<?php echo widget_multi_colorset('wset[c'.$i.']', $wset['c'.$i]);?>
				<a href="<?php echo G5_URL;?>/thema/<?php echo THEMA;?>/assets/multi/widget.colorset.php?thema=<?php echo urlencode(THEMA);?>&amp;wdemo=<?php echo ($is_demo) ? '1' : '';?>" class="btn_frmline win_point"><nobr>컬러셋 만들기</nobr>
			</td>
		</tr>
		<tr>
			<td align="center">멀티명</td>
			<td>
				<?php echo help('등록된 멀티사이트 구분명으로 미입력시 멀티 #번호 형태로 표기');?>
				<input type="text" name="wset[m<?php echo $i;?>]" value="<?php echo $wset['m'.$i]; ?>" size="58" class="frm_input">		
			</td>
		</tr>
		<tr>
			<td align="center">서브도메인</td>
			<td>
				<?php echo help('서브도메인 폴더명으로 G5 Root/s/ 폴더에 입력한 폴더 및 index.php 파일을 자동생성하고, 홈메뉴 URL 미등록시 입력한 폴더 주소가 홈메뉴 URL로 자동 등록');?>
				<?php if(IS_YC) { ?>
					<input type="text" name="wset[s<?php echo $i;?>]" value="<?php echo $wset['s'.$i]; ?>" size="40" class="frm_input">
					&nbsp;
					<label><input type="checkbox" name="wset[st<?php echo $i;?>]" value="1"<?php echo get_checked('1', $wset['st'.$i]);?>> 상품분류 테마 적용</label>
				<?php } else { ?>
					<input type="text" name="wset[s<?php echo $i;?>]" value="<?php echo $wset['s'.$i]; ?>" size="58" class="frm_input">
					<input type="hidden" name="wset[st<?php echo $i;?>]" value="">
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td align="center">사이트로고</td>
			<td>
				<?php echo help('HTML 태그 및 IMG 태그를 이용해서 이미지 등록가능');?>
				<textarea name="wset[ln<?php echo $i;?>]"><?php echo $wset['ln'.$i]; ?></textarea>
			</td>
		</tr>
		<tr>
			<td align="center">로고URL</td>
			<td>
				<?php echo help('사이트로고 클릭시 이동주소로 미등록시 G5 루트로 자동지정됨');?>
				<input type="text" name="wset[lu<?php echo $i;?>]" value="<?php echo $wset['lu'.$i]; ?>" size="58" class="frm_input">		
			</td>
		</tr>	
		<tr>
			<td align="center">홈메뉴명</td>
			<td>
				<?php echo help('홈으로, 메인 등 상단 주메뉴의 첫번째 메뉴명으로 미등록시 "메인"으로 자동지정됨');?>
				<textarea name="wset[in<?php echo $i;?>]"><?php echo $wset['in'.$i]; ?></textarea>
			</td>
		</tr>
		<tr>
			<td align="center">홈메뉴URL</td>
			<td>
				<?php echo help('주메뉴의 첫번째 메뉴명 클릭시 이동주소로 미등록시 서브도메인으로 자동지정됨');?>
				<input type="text" name="wset[iu<?php echo $i;?>]" value="<?php echo $wset['iu'.$i]; ?>" size="58" class="frm_input">
			</td>
		</tr>
		<tr>
			<td align="center">멀티탭명</td>
			<td>
				<?php echo help('상단 사이트로고 아래 멀티 버튼에 표시될 탭메뉴명');?>
				<input type="text" name="wset[tn<?php echo $i;?>]" value="<?php echo $wset['tn'.$i]; ?>" size="58" class="frm_input">
			</td>
		</tr>
		<tr>
			<td align="center">툴팁표시</td>
			<td>
				<?php echo help('멀티탭에 마우스 오버시 출력될 툴팁 내용');?>
				<input type="text" name="wset[tt<?php echo $i;?>]" value="<?php echo $wset['tt'.$i]; ?>" size="58" class="frm_input">
			</td>
		</tr>
		<tr>
			<td colspan="2" style="padding:10px 15px 0px;">
				<?php echo help('아래 메뉴등록에서 등록한 메뉴만 사이트에 출력됩니다.<br>관리자 > 테마관리 > 메뉴설정에서 <b>메뉴보임은 모두보임으로 설정</b>해 주세요.');?>
			</td>
		</tr>		
		<tr>
			<td align="center">메뉴 #01</td>
			<td>
				<?php echo help('홈메뉴 다음 메뉴로 보드그룹아이디, 상품분류코드를 콤마(,)로 구분해서 등록');?>
				<input type="text" name="wset[ma<?php echo $i;?>]" value="<?php echo $wset['ma'.$i]; ?>" size="58" class="frm_input">
			</td>
		</tr>		
		<tr>
			<td align="center">메뉴 #02</td>
			<td>
				<?php echo help('메뉴 #01 다음 메뉴로 서브메뉴가 주메뉴 자리로 이동됨');?>
				<input type="text" name="wset[mb<?php echo $i;?>]" value="<?php echo $wset['mb'.$i]; ?>" size="20" class="frm_input"> (그룹아이디/상품분류코드 1개만 등록가능)
			</td>
		</tr>		
		<tr>
			<td align="center">메뉴 #03</td>
			<td>
				<?php echo help('메뉴 #02 다음 메뉴로 보드그룹아이디, 상품분류코드를 콤마(,)로 구분해서 등록');?>
				<input type="text" name="wset[mc<?php echo $i;?>]" value="<?php echo $wset['mc'.$i]; ?>" size="58" class="frm_input">
			</td>
		</tr>
		</tbody>
		</table>
	</div>
<?php } ?>

<p></p>

<script>
function apms_show(id) {
	$(".anc").hide();
	$("#" + id).show();
}

//apms_show('multi1');
</script>

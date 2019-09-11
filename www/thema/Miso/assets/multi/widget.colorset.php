<?php
define('G5_IS_ADMIN', true);
include_once('./_common.php');

if (!$thema && !$wdemo && $is_admin != 'super') {
    alert_close("최고관리자만 가능합니다.");
}

if($mode == "save") {

	if ($is_admin != 'super') {
		alert("최고관리자만 가능합니다.");
	}

	$colorset = trim(apms_escape_string($_POST['colorset']));

	if(!$colorset) {
		alert("생성할 컬러셋명을 등록해 주세요.");
	}

	if(!ctype_alpha($colorset)) {
		alert("컬러셋명은 영문자만 가능합니다.");
	}

	// 폴더생성
	$basicfile = G5_PATH.'/thema/'.$thema.'/colorset/Basic/colorset.css';
	$filepath = G5_PATH.'/thema/'.$thema.'/colorset/'.$colorset;
	if(is_dir($filepath)) {
		alert("이미 등록된 컬러셋입니다.");
	}

	@mkdir($filepath, G5_DIR_PERMISSION);
	@chmod($filepath, G5_DIR_PERMISSION);

	@copy($basicfile, $filepath.'/colorset.css');
	@chmod($filepath.'/colorset.css', G5_FILE_PERMISSION);

	alert_close("생성완료! Basic 컬러셋이 복사되었습니다.\\n\\n위젯설정창을 새로고침하면 만든 컬러셋이 출력됩니다.");
}

// 입력 폼 안내문
if (!function_exists('help')) {
	function help($help="")	{
		global $g5;

		$str  = '<span class="frm_info">'.str_replace("\n", "<br>", $help).'</span>';

		return $str;
	}
}

$g5['title'] = '컬러셋 만들기';
include_once(G5_PATH.'/head.sub.php');
?>
<style>
 .local_desc01 ul, .local_desc01 ol { padding-bottom:0px; }
</style>
<div id="sch_widget_frm" class="new_win bsp_new_win">
    <h1 style="margin-bottom:0px;">
		컬러셋 만들기
	</h1>
	<div class="local_ov01 local_ov" style="border-top:1px solid #e9e9e9;">
		컬러셋명은 영문자만 가능하며, 생성후 Basic 컬러셋의 colorset.css 파일을 복사합니다.
	</div>
	<form id="fileForm" name="fileForm" method="post">
	<input type="hidden" name="mode" value="save">
	<input type="hidden" name="thema" value="<?php echo $thema;?>">
	<input type="hidden" name="wdemo" value="<?php echo $wdemo;?>">
	<div class="tbl_head01 tbl_wrap">
		<table>
		<caption>컬러셋 생성</caption>
		<colgroup>
			<col class="grid_2">
			<col>
		</colgroup>
		<thead>
		<tr>
			<th>구분</th>
			<th>설정하기</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td align="center">컬러셋명</td>
			<td>
				<?php echo help('테마 내 /colorset 폴더에 생성될 하위폴더명으로 영문자만 등록가능합니다.');?>
				<input type="text" required name="colorset" value="" size="60" class="frm_input">
			</td>
		</tr>
		</body>
	</table>
	<br><br>
    <div class="btn_confirm01 btn_confirm">
		<input type="submit" value="만들기" class="btn_submit" accesskey="s">
		<button type="button" onclick="window.close();">닫기</button>
    </div>
	</form>
</div>
<br>
<?php include_once(G5_PATH.'/tail.sub.php'); ?>
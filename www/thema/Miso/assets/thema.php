<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// ---------------------------------------------------------
// 경고! 이하 내용은 수정하지 마세요!
// ---------------------------------------------------------

$marr = array();
$mtms = array();

// 멀티셋업
$mtms = apms_widget_config(THEMA.'-multi-setup');
$is_multi = ($mtms['multi'] > 0) ? $mtms['multi'] : 0;

// 기본값
$logo = ($mtms['ln0']) ? $mtms['ln0'] : 'MISO THEMA';

$j = 0;
for($i=0; $i <= $is_multi; $i++) {

	if($i > 0 && !$mtms['u'.$i]) continue; //사용하지 않으면 체크하지 않음

	$marr[$j]['colorset'] = $mtms['c'.$i];
	$marr[$j]['logo_url'] = ($mtms['lu'.$i]) ? $mtms['lu'.$i] : G5_URL;
	$marr[$j]['logo_name'] = ($mtms['ln'.$i]) ? $mtms['ln'.$i] : $logo;
	if($i > 0) {
		$marr[$j]['idx_url'] = ($mtms['iu'.$i]) ? $mtms['iu'.$i] : G5_URL.'/s/'.$mtms['s'.$i];
	} else {
		$marr[$j]['idx_url'] = ($mtms['iu'.$i]) ? $mtms['iu'.$i] : G5_URL;
	}
	$marr[$j]['idx_name'] = ($mtms['in'.$i]) ? $mtms['in'.$i] : '메인';
	$marr[$j]['tab_name'] = $mtms['tn'.$i];
	$marr[$j]['tooltip'] = $mtms['tt'.$i];
	$marr[$j]['menu1'] = $mtms['ma'.$i];
	$marr[$j]['menu2'] = $mtms['mb'.$i];
	$marr[$j]['menu3'] = $mtms['mc'.$i];
	$j++;
}

unset($mtms); //값지움

// 멀티사이트
$layout_path = '';
if($is_multi) {
	$miso_id = strtolower(COLORSET); // 컬러셋값 소문자로 변경후 체크
	$marr_cnt = count($marr);
	for($i=0; $i < $marr_cnt; $i++) {
		if($miso_id == strtolower($marr[$i]['colorset'])) {
			$logo_url = $marr[$i]['logo_url'];	
			$logo_name = $marr[$i]['logo_name'];
			$idx_url = $marr[$i]['idx_url'];
			$idx_name = $marr[$i]['idx_name'];
			$menu1 = $marr[$i]['menu1'];
			$menu2 = $marr[$i]['menu2'];
			$menu3 = $marr[$i]['menu3'];
			$layout_path = THEMA_PATH.'/layout/'.COLORSET;
			break;
		} 
	}
} 

if(!$layout_path) {
	$logo_url = $marr[0]['logo_url'];	
	$logo_name = $marr[0]['logo_name'];
	$idx_url = $marr[0]['idx_url'];
	$idx_name = $marr[0]['idx_name'];
	$menu1 = $marr[0]['menu1'];
	$menu2 = $marr[0]['menu2'];
	$menu3 = $marr[0]['menu3'];
	$layout_path = THEMA_PATH.'/layout';
}

$mtmp = array();
$atmp = array();
$tmenu = array();

if($is_multi) {
	$menu_cnt = count($menu);
	for($i=1; $i < $menu_cnt; $i++) {
		if($menu[$i]['gr_id']) {
			$j = $menu[$i]['gr_id'];
			$mtmp[$j] = $menu[$i];
		}
	}

	$z = 0;
	if($menu1) { // 1차 메뉴
		$atmp = explode(",", $menu1);
		$atmp_cnt = count($atmp);
		if($atmp_cnt > 0) {
			for($i=0; $i < $atmp_cnt; $i++) {
				$j = $atmp[$i];
				if($mtmp[$j]['gr_id']) {
					$tmenu[$z] = $mtmp[$j];
					$z++;
				}
			}
		}
	}

	if($menu2) { // 2차 메뉴
		$j = $menu2;
		if($mtmp[$j]['gr_id'] && $mtmp[$j]['is_sub']) {
			for($k=0; $k < count($mtmp[$j]['sub']);$k++) {
				$tmenu[$z] = $mtmp[$j]['sub'][$k];
				$z++;
			}
		}
	}

	if($menu3) { // 3차 메뉴
		$atmp = explode(",", $menu3);
		$atmp_cnt = count($atmp);
		if($atmp_cnt > 0) {
			for($i=0; $i < $atmp_cnt; $i++) {
				$j = $atmp[$i];
				if($mtmp[$j]['gr_id']) {
					$tmenu[$z] = $mtmp[$j];
					$z++;
				}
			}
		}
	}
} else {
	$tmenu = $menu;
}

unset($mtmp);
unset($atmp);

// 테마 설치 또는 변경시 초기값
if($at_set['thema'] != THEMA) {
	unset($at_set);
	$at_set['main'] = 12;
	$at_set['page'] = 9;
}

//Setup Column
if($is_main) {
	$col_content = ($at_set['main']) ? $at_set['main'] : 13;
} else {
	$col_content = ($at_set['page']) ? $at_set['page'] : 9;
}

$col_content = (int)$col_content;

$container = 'container';
if($col_content == 13) { // Full Wide
	$col_name = '';
} else if($col_content == 12) { // One Column
	$col_name = 'one';
} else { // Two Column
	$container = '';
	$col_name = 'two';
	$col_side = 12 - $col_content;
}

$at_set['background'] = ($at_set['background']) ? $at_set['background'] : 'none';

?>
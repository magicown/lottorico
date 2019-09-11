<?php
$sub_menu = "200600";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

/*include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

if (empty($fr_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = G5_TIME_YMD;*/


/*$qstr = "fr_date=".$fr_date."&amp;to_date=".$to_date."&amp;lotto_turn=".$lotto_turn;
$query_string = $qstr ? '?'.$qstr : '';*/


$today = date("Y-m-d");
$sql_common = " from today_will_make_num_chk a left join g5_member b ON a.today_will_make_id = b.mb_id ";

$sql_search = " where make_date = '{$today}' ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'today_will_make_id' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "today_will_make_id";
    $sod = "desc";
}
//$sql_order = " order by today_do_make_num ASC, today_send_sms_yn ASC ";
$sql_order = " order by mb_id ASC ";

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search}
            {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 100;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
            {$sql_common}
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$mb = array();
if ($sfl == 'mb_id' && $stx)
    $mb = get_member($stx);

$g5['title'] = '금일 발송해야 할 회원 목록';
include_once ('./admin.head.php');

$colspan = 9;

$po_expire_term = '';
if($config['cf_point_term'] > 0) {
    $po_expire_term = $config['cf_point_term'];
}

if (strstr($sfl, "mb_id"))
    $mb_id = $stx;
else
    $mb_id = "";


$today = date("N");
//$today = 1;
$week = array(1=>"mon_sms_cnt",2=>"tue_sms_cnt",3=>"wed_sms_cnt",4=>"thu_sms_cnt",5=>"fri_sms_cnt",6=>"sat_sms_cnt");
?>
<style>
    .bg3{background-color: #ffd70e !important;}
</style>
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">전체 </span><span class="ov_num"> <?php echo number_format($total_count) ?> 건 </span></span>
</div>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
    <option value="po_content"<?php echo get_selected($_GET['sfl'], "po_content"); ?>>내용</option>
</select>
    <input type="text" name="fr_date" value="<?php echo $fr_date ?>" id="fr_date" class="frm_input" size="11" maxlength="10">
    <label for="fr_date" class="sound_only">시작일</label>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">
</form>

<form name="fpointlist" id="fpointlist" method="post" action="./point_list_delete.php" onsubmit="return fpointlist_submit(this);">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>        
        <th scope="col">회원아이디</a></th>
        <th scope="col">이름</th>
        <th scope="col">회차</th>
        <th scope="col">전체갯수/남은갯수/생성갯수</th>
        <th scope="col">번호생성여부</th>
        <th scope="col">생성일시</th>
        <th scope="col">문자발송여부</a></th>
        <th scope="col">발송일시</th>
        <th scope="col">만료일</th>

    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        if ($i==0 || ($row2['mb_id'] != $row['mb_id'])) {
            $sql2 = " select * from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
            $row2 = sql_fetch($sql2);
        }

        $mb_nick = get_sideview($row['mb_id'], $row2['mb_nick'], $row2['mb_email'], $row2['mb_homepage']);

        $link1 = $link2 = '';
        if (!preg_match("/^\@/", $row['po_rel_table']) && $row['po_rel_table']) {
            $link1 = '<a href="'.G5_BBS_URL.'/board.php?bo_table='.$row['po_rel_table'].'&amp;wr_id='.$row['po_rel_id'].'" target="_blank">';
            $link2 = '</a>';
        }

        $expr = '';
        if($row['po_expired'] == 1)
            $expr = ' txt_expired';

        if($row['today_send_sms_yn']=='N' && $row['mb_5']!='Y') {
            $bg = 'bg3';
        } else {
            $bg = '';
        }

        $rem_num = remind_take_num($row2['mb_id'], $row['mb_3']);
        $make_num = make_lotto_num($row2['mb_id'], $row['mb_3']);

    ?>

    <tr class="<?php echo $bg; ?>">        
        <td class="td_center"><a href="./member_list.php?sfl=&stx=<?php echo $row['mb_id']; ?>&fr_date=&to_date=&member_grade1="><?php echo $row['mb_id'] ?></a></td>
        <td class="td_center"><?php echo get_text($row['mb_name']); ?></td>
        <td class="td_center"><?php echo $row['week_turn']; ?></td>
        <td class="td_center"><?php echo $row2['mb_3']; ?> / <?php echo $rem_num; ?> / <?php echo $make_num; ?></td>
        <td class="td_center"><div><?php echo ($row['today_do_make_num']=='Y')?'생성완료':'미생성' ?></div></td>
        <td class="td_center"><div><?php echo $row['reg_date']; ?></div></td>
        <td class="td_center">
		
		<?php echo ($row['today_send_sms_yn']=='Y')?'발송완료':'<a href="./member_list.php?sfl=&stx='.$row['mb_id'].'&fr_date=&to_date=&member_grade1=">미발송</a>' ?>
        <?php if($row['mb_5']=='Y'){ echo "(<span style=color:red>일시정시</span>)"; } ?>
        </td>
        <td class="td_center"><div><?php echo $row['update_date']; ?></div></td>
        <td class="td_center"><?php echo $row['mb_2'] ?></td>

    </tr>

    <?php

    }

    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>



<script>
    $(document).ready(function(){
        $(".btn_change_grade").on("click", function() {
            var idx = $(this).data('select');
            var mb_id = $(this).data('id');
            if(idx == 'n'){
                var sidx = 'n';
            } else {
                var sidx = $('#pay_type'+idx+' option:selected').val();
            }

            if(idx == 'n'){
                if(confirm('회원등급을 초기화 하시겠습니까?\n초기화를 진행하시면 등급이 없어짐니다.')==false){
                    return false;
                }
            }
            mode = 'memUpdateGrade';

            $.ajax({
                type: "POST",
                url: "./pay_ajax_proc.php",
                cache: false,
                async: false,
                data: { mode : mode, pay_idx : sidx, mb_id : mb_id },
                dataType: "json",
                success: function(data) {
                    alert(data.result);
                    location.reload(true);
                    return false;
                }
            });
        });
    });
</script>

<?php
include_once ('./admin.tail.php');
?>

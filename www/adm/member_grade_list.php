<?php
$sub_menu = "200120";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_member ";

$sql_search = " where mb_level < 8 ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_id' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "mb_id";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search}
            {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
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

$g5['title'] = '회원등급관리';
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
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">전체 </span><span class="ov_num"> <?php echo number_format($total_count) ?> 건 </span></span>
    <?php
    if (isset($mb['mb_id']) && $mb['mb_id']) {
        echo '&nbsp;<span class="btn_ov01"><span class="ov_txt">' . $mb['mb_id'] .' 님 포인트 합계 </span><span class="ov_num"> ' . number_format($mb['mb_point']) . '점</span></span>';
    } else {
        $row2 = sql_fetch(" select sum(po_point) as sum_point from {$g5['point_table']} ");
        echo '&nbsp;<span class="btn_ov01"><span class="ov_txt">전체 합계</span><span class="ov_num">'.number_format($row2['sum_point']).'점 </span></span>';
    }
    ?>
</div>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
    <option value="po_content"<?php echo get_selected($_GET['sfl'], "po_content"); ?>>내용</option>
</select>
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
        <th scope="col">닉네임</th>
        <th scope="col">회원등급</a></th>
        <th scope="col">만료일</th>
        <th scope="col" style="width:200px;">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        if ($i==0 || ($row2['mb_id'] != $row['mb_id'])) {
            $sql2 = " select mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
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

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">        
        <td class="td_left"><?php echo $row['mb_id'] ?></td>
        <td class="td_left"><?php echo get_text($row2['mb_name']); ?></td>
        <td class="td_left sv_use"><div><?php echo $mb_nick ?></div></td>
        <td class="td_left"><?php echo get_pay_type_select_change($i, $row['mb_10']) ?></td>
        <td class="td_datetime2"><?php echo $row['mb_2'] ?></td>
        <td class="td_num td_pt">
            <input type="button" value="변경" data-id="<?php echo $row['mb_id']; ?>" data-select="<?php echo $i; ?>" class="btn_submit btn btn_change_grade">
            <input type="button" value="초기화" data-id="<?php echo $row['mb_id']; ?>" data-select="n" class="btn_03 btn btn_change_grade" title="초기화 버튼을 누르시면 등급 및 만료일이 초기화 됩니다." <?php echo ($row['mb_2']!='')?'':'disabled';?>>

        </td>
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

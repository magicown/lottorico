<?php
$sub_menu = "250500";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
$sql_common = " from g5_pay_report a LEFT JOIN g5_pay_type b ON a.pay_idx = b.idx LEFT JOIN g5_member c ON a.mb_id = c.mb_id ";



$sql_search = " where pay_type = 'BANK'  ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " (a.mb_id like '%{$stx}%' OR pay_info LIKE '%{$stx}%' OR pay_idx LIKE '%{$stx}%' ) ";
            break;
    }
    $sql_search .= " ) ";
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "reg_date";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
//echo $sql."<br>";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '무통장입금관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$colspan = 16;




include_once ('./admin.head.php');

?>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <!--<input type="radio" name="pay_result" value="" checked> 전체
    <input type="radio" name="pay_result" value="1"> 처리완료
    <input type="radio" name="pay_result" value="2"> 미처리
    | <input type="text" name="start_date" value="" class="date frm_input" size="15"> - <input type="text" name="end_date" value="" class="date frm_input" size="15">
    |-->
    <select name="sfl" id="sfl">
        <option value="all"<?php echo get_selected($_GET['sfl'], "all"); ?>>전체</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>회원명</option>
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
        <option value="writer_id"<?php echo get_selected($_GET['sfl'], "writer_id"); ?>>관리아이디</option>
        <option value="po_content"<?php echo get_selected($_GET['sfl'], "po_content"); ?>>내용</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
    <input type="submit" class="btn_submit" value="검색">
</form>

<input type="hidden" name="token" value="" id="token">

<section id="anc_pay_reg">   
    <section id="anc_pay_list">
        <h2 class="h2_frm">무통장입금 목록</h2>
        <?php echo $pg_anchor ?>

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <caption>등록된 결제타입 목록</caption>
                <colgroup>
                    <col class="grid_4">
                    <col>
                    <col class="grid_4">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="cf_new_skin">번호</label></th>
                    <th scope="row"><label for="cf_new_skin">회원정보</label></th>
                    <th scope="row"><label for="cf_new_skin">회원아이디</label></th>
                    <th scope="row"><label for="cf_new_skin">입금자명</label></th>
                    <th scope="row"><label for="cf_new_skin">신청종류</label></th>
                    <th scope="row"><label for="cf_new_skin">입금액</label></th>
                    <th scope="row"><label for="cf_new_skin">신청일</label></th>
                    <th scope="row"><label for="cf_new_skin">입금처리일</label></th>
                </tr>
                <?php
                $i = 0;
                $pay_status = "";
                while($pay = sql_fetch_array($result)){
                    $mb_info = get_member_info($pay['mb_id']);
                    if($pay[response_code]=='0000'){
                        $pay_status = "성공";
                    } else if($pay[response_code]==''){
                        if($pay['pay_type']=='BANK')    $pay_status = "입금대기";
                    }
                    ?>
                    <tr>
                        <td scope="row"><label for="cf_new_skin"><?php echo $total_count-$i; ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo $mb_info['mb_name']; ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><a href="./member_memo_list.php?mb_id=<?php echo $mb_info['mb_id']; ?>&mb_name=<?php echo $mb_info['mb_name']; ?>&sfl=mb_id&stx=<?php echo $mb_info['mb_id']; ?>" ><?php echo $mb_info['mb_id']; ?></a></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo $pay['pay_info']; ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo $pay['pay_name']; ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo number_format($pay['order_money']); ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo $pay['reg_date']; ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo ($pay['pay_end_date']=='0000-00-00 00:00:00')?'':$pay['pay_end_date']; ?></label></td>
                    </tr>
                    <?php
                    $i++;
                    $cnt++;
                }
                if(!$cnt){
                    ?>
                    <tr><td colspan="6" style="text-align:center; font-weight: bold;">등록된 결제목록이 없습니다.</td></tr>
                    <?php
                }
                ?>

                </tbody>
            </table>
        </div>



        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" />
        <script>
            $.datepicker.setDefaults({
                dateFormat: 'yymmdd',
                prevText: '이전 달',
                nextText: '다음 달',
                monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                dayNames: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
                showMonthAfterYear: true,
                yearSuffix: '년'
            });
            $(function(){
                $('input[name="start_date"], input[name="end_date"]').datepicker();
            });

        </script>
        <?php
        include_once ('./admin.tail.php');
        ?>

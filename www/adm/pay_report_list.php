<?php
$sub_menu = "250000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
$sql_common = " from g5_pay_report a LEFT JOIN g5_pay_type b ON a.pay_idx = b.idx ";



$sql_search = " where 1  ";
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
            $sql_search .= " ({$sfl} like '{$stx}%') ";
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

$g5['title'] = '결제관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$colspan = 16;



$g5['title'] = '결제타입 변경 및 이력확인';
include_once ('./admin.head.php');







?>


<input type="hidden" name="token" value="" id="token">

<section id="anc_pay_reg">   
    <section id="anc_pay_list">
        <h2 class="h2_frm">결제 목록</h2>
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
                    <th scope="row"><label for="cf_new_skin">상품명</label></th>
                    <th scope="row"><label for="cf_new_skin">상품가격</label></th>
                    <th scope="row"><label for="cf_new_skin">주문번호</label></th>
                    <th scope="row"><label for="cf_new_skin">승인번호</label></th>
                    <th scope="row"><label for="cf_new_skin">승인일자</label></th>
                    <th scope="row"><label for="cf_new_skin">트랜잭션코드</label></th>
                    <th scope="row"><label for="cf_new_skin">결제결과</label></th>
                    <th scope="row"><label for="cf_new_skin">결제사구분</label></th>
                    <th scope="row"><label for="cf_new_skin">등록일자</label></th>
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
                        <td scope="row"><label for="cf_new_skin"><?php echo $mb_info['mb_id'].'('.$mb_info['mb_name'].')'; ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo $pay[pay_name]; ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo number_format($pay[order_money]); ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo $pay[order_numer]; ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo $pay[auth_number]; ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo $pay[auth_datetime]; ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo $pay[transaction_id]; ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo $pay_status; ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo $pay[pay_gubun]; ?></label></td>
                        <td scope="row"><label for="cf_new_skin"><?php echo $pay[reg_date]; ?></label></td>
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
        
        <?php
        include_once ('./admin.tail.php');
        ?>

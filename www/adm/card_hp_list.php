<?php
$sub_menu = "250400";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '결재관리 (카드/휴대폰 일반)';
include_once('./member.log.sub.php');

$colspan = 6;

$sql_common = " from g5_member_grade_log ";
$sql_search = " where DATE_FORMAT(log_regdate,'%Y-%m-%d') between '{$fr_date}' and '{$to_date}' ";
if (isset($mb_id))
    $sql_search .= " and (log_mb_id like '%{$mb_id}%' ) ";

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
            {$sql_common}
            {$sql_search}
            order by log_regdate desc
            limit {$from_record}, {$rows} ";

$result = sql_query($sql);
?>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>

    <tr>
        <th scope="col">번호</th>
        <th scope="col" style="width:200px;">주문번호</th>
        <th scope="col" style="width:200px;">회원아이디</th>
        <th scope="col" style="width:200px;">상품명</th>
        <th scope="col" style="width:200px;">이메일</th>
        <th scope="col" style="width:200px;">연락처1</th>
        <th scope="col" style="width:200px;">연락처2</th>
        <th scope="col" style="width:200px;">캬드종류</th>
        <th scope="col" style="width:200px;">결제종류</th>
        <th scope="col" style="width:200px;">걸제금액</th>
        <th scope="col" style="width:200px;">승인번호</th>
        <th scope="col" style="width:200px;">할부개월</th>
        <th scope="col" style="width:200px;">통신사</th>        
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        if($row['log_org_grade']>0){
            $gr1 = getGrade($row['log_org_grade']);
        }

        $gr2 = getGrade($row['log_chg_grade']);
        $mb = get_member_info($row['log_mb_id']);
        $mb2 = get_member_info($row['log_change_id']);
        $bg = 'bg'.($i%2);
    ?>
    <tr class="<?php echo $bg; ?>">
        <td class="td_category"><?php echo $row['log_mb_id'] ?></td>
        <td><?php echo $row['log_mb_id'] ?></td>
        <td><?php echo $mb['mb_name']; ?></td>
        <td class="td_category td_category1"><?php echo $gr1['pay_name']; ?></td>
        <td class="td_category td_category3"><?php echo $gr2['pay_name'] ?></td>
        <td class="td_category td_category3"><?php echo $gr2['pay_name'] ?></td>
        <td class="td_category td_category3"><?php echo $gr2['pay_name'] ?></td>
        <td class="td_category td_category3"><?php echo $gr2['pay_name'] ?></td>
        <td class="td_category td_category3"><?php echo $gr2['pay_name'] ?></td>
        <td class="td_category td_category3"><?php echo $gr2['pay_name'] ?></td>
        <td class="td_category td_category3"><?php echo $gr2['pay_name'] ?></td>
        <td class="td_category td_category3"><?php echo $gr2['pay_name'] ?></td>
        <td class="td_category td_category2"><?php echo $row['log_change_id']; ?>(<?php echo $mb2['mb_name']; ?>)</td>
        <td class="td_datetime"><?php echo $row['log_regdate'] ?></td>
    </tr>

    <?php
    }
    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없거나 관리자에 의해 삭제되었습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

<?php
if (isset($domain))
    $qstr .= "&amp;domain=$domain";
$qstr .= "&amp;page=";

$pagelist = get_paging($config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr");
echo $pagelist;

include_once('./admin.tail.php');
?>

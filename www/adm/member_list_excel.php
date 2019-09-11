<?php
$sub_menu = "200100";
include_once('./_common.php');

header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 회원정보.xls" );
header( "Content-Description: PHP4 Generated Data" );


$sql_common = " from {$g5['member_table']} ";

$sql_search = " where 1 and mb_memo NOT LIKE '%삭제함%' ";
if ($stx) {
    $stx = str_replace("-","",$stx);
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
            //$sql_search .= " ({$sfl} like '{$stx}%') ";
            $sql_search .= "( REPLACE(mb_id,'-','') LIKE '%{$stx}%' OR REPLACE(mb_hp,'-','') LIKE '%{$stx}%' OR mb_name LIKE '%{$stx}%' OR mb_nick LIKE '%{$stx}%')";
            break;
    }
    $sql_search .= " ) ";
} else {
    if($_SESSION['ss_mb_level']<=9) {
        $sql_search .= " and mb_id = '999999999999999999' ";
    } else {
        $sql_search .= "  ";
    }
}

//날짜검색
if($fr_date || $to_date){
    $sql_search .= " and member_grade_date BETWEEN '{$fr_date}' AND '{$to_date}' ";
}
//등급검색
$member_grade1 = $_REQUEST['member_grade1'];
if($member_grade1){
    if($member_grade1 == '1'){
        $sql_search .= " and mb_10 = '1' ";
    } else {
        $sql_search .= " and mb_10 = '{$member_grade1}' ";
    }

}
if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

if($fr_date || $to_date){
    $sst = "member_grade_date";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';



$sql = " select * {$sql_common} {$sql_search} {$sql_order}  ";
//echo $sql;
$result = sql_query($sql);

//회원검색을 사용해서 검색된 회원이 있다면

if($total_count == 1){
    //echo $sql;
    $sm = sql_fetch($sql);

    $search_hp = str_replace("-","",$sm['mb_hp']);
    $search_id = $sm['mb_id'];
}

$colspan = 16;
?>

        <table border="1">
            <caption>회원검색 목록</caption>
            <thead>
            <tr>
                <th scope="col" id="mb_list_id" >회원명</th>
                <th scope="col" id="mb_list_id">연락처</th>
                <th scope="col" id="mb_list_id">회원등급</th>
                <th scope="col" id="mb_list_id">가입일자</th>
                <th scope="col" id="mb_list_id">등급변경일자</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                // 접근가능한 그룹수
                $sql2 = " select count(*) as cnt from {$g5['group_member_table']} where mb_id = '{$row['mb_id']}' ";
                $row2 = sql_fetch($sql2);
                $group = '';
                if ($row2['cnt'])
                    $group = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">'.$row2['cnt'].'</a>';

                if ($is_admin == 'group') {
                    $s_mod = '';
                } else {
                    $s_mod = '<a href="./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'" class="btn btn_03">수정</a>';
                }
                $s_grp = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'" class="btn btn_02">그룹</a>';

                $leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date('Ymd', G5_SERVER_TIME);
                $intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date('Ymd', G5_SERVER_TIME);

                $mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);

                $mb_id = $row['mb_id'];
                $leave_msg = '';
                $intercept_msg = '';
                $intercept_title = '';
                if ($row['mb_leave_date']) {
                    $mb_id = $mb_id;
                    $leave_msg = '<span class="mb_leave_msg">탈퇴함</span>';
                }
                else if ($row['mb_intercept_date']) {
                    $mb_id = $mb_id;
                    $intercept_msg = '<span class="mb_intercept_msg">차단됨</span>';
                    $intercept_title = '차단해제';
                }
                if ($intercept_title == '')
                    $intercept_title = '차단하기';

                $address = $row['mb_zip1'] ? print_address($row['mb_addr1'], $row['mb_addr2'], $row['mb_addr3'], $row['mb_addr_jibeon']) : '';

                $member_grade = "";
                $bg = 'bg'.($i%2);
                $que = "SELECT * FROM g5_pay_type WHERE pay_use_yn = 'y' ORDER BY idx ";
                $res = sql_query($que);
                while($arr = sql_fetch_array($res)){
                    if($_REQUEST['member_grade1'] == $arr['idx']){
                        $member_grade = $arr['pay_name'];
                    }
                }
                ?>

                <tr class="<?php echo $bg; ?>">
                    <td headers="mb_list_id" class="td_name sv_use"><?php echo $row['mb_name']; ?></td>
                    <td headers="mb_list_id" class="td_name sv_use"><?php echo $row['mb_hp']; ?></td>
                    <td headers="mb_list_id" class="td_name sv_use"><?php echo $member_grade; ?></td>
                    <td headers="mb_list_id" class="td_name sv_use"><?php echo $row['mb_datetime']; ?></td>
                    <td headers="mb_list_id" class="td_name sv_use"><?php echo $row['member_grade_date'] ?></td>
                </tr>

                <?php
            }
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>




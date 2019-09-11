<?php
$sub_menu = "200500";
include_once('./_common.php');


header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 광고리스트.xls" );
header( "Content-Description: PHP4 Generated Data" );


if($fr_date == ''){
    $fr_date = date("Y-m-d",strtotime("-7 days"));
}

$sql_common = " from g5_counselor ";
$sql_search = " where DATE_FORMAT(c_regdate,'%Y-%m-%d') between '{$fr_date}' and '{$to_date}' ";
if (isset($mb_id))
    $sql_search .= " and (c_mb_id like '%{$mb_id}%' ) ";

if($answer_yn){
    $sql_search .= " and c_answer_yn = '{$answer_yn}' ";
}

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
            order by c_regdate desc
             ";
//echo $sql;
$result = sql_query($sql);
$colspan = 6;
?>

<section>
    <h2>상담신청 내역 및 랜딩페이지 신청 내역</h2>
    <div class="local_desc02 local_desc">
        전체 <?php echo number_format($total_count) ?> 건 중 <?php echo $new_point_rows ?>건 목록
    </div>

    <div class="tbl_head01 tbl_wrap">
        <table border="1">
            <thead>
            <tr>
                <th scope="col">번호</th>
                <th scope="col">유입구분</th>
                <th scope="col">회원아이디</th>
                <th scope="col">휴대폰번호</th>
                <th scope="col" style="width:200px;">등록일시</th>
                <th scope="col">내용</th>
                <th scope="col">상담여부</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $row2['mb_id'] = '';
            for ($i=0; $row=sql_fetch_array($result); $i++)
            {
                if($row['c_reg_type']=='L'){
                    $type = "랜딩";
                    $msg = "랜딩광고 페이지에서 들어온 요청 입니다.";
                } else if($row['c_reg_type']=='O'){
                    $type = "애드인";
                    $msg = "애드인광고.";
                } else {
                    $type = "메인";
                    $msg = "메인 페이지 1등번호 받기에서 들어온 요청 입니다.";
                }
                ?>

                <tr>
                    <td class="td_category"><?php echo $total_count-$i; ?></td>
                    <td class="td_category"><?php echo $type; ?></td>
                    <td class="td_mbid"><?php echo $row['c_mb_id'] ?></td>
                    <td class="td_mbname"><?php echo $row['c_mb_hp']; ?></td>
                    <td class="td_datetime"><?php echo $row['c_regdate'] ?></td>
                    <td><?php echo $msg ?></td>
                    <td class="" style="text-align: center;"><?php echo ($row['c_answer_yn']=='n')?'상담예정':'상담완료' ?></td>
                </tr>

                <?php
            }

            if ($i == 0)
                echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
            ?>
            </tbody>
        </table>
    </div>

    <!--<div class="btn_list03 btn_list">
        <a href="./point_list.php">포인트내역 전체보기</a>
    </div>-->
</section>

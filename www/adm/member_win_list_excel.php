<?php
$sub_menu = "200140";
include_once('./_common.php');

header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 당첨통계.xls" );
header( "Content-Description: PHP4 Generated Data" );

$g5['title'] = '회원 당첨 통계';


$colspan = 7;


if($_GET['mb_id']){
    $search_q .= " AND mb_id = '{$mb_id}' ";
}

if($_GET['lotto_turn']){
    $search_q .= " AND lotto_turn = '{$lotto_turn}' ";
} else {
    if($_GET['fr_date'] || $_GET['to_date']){
        $search_q .= " AND reg_date >= '{$fr_date}' AND reg_date <= '{$to_date}' ";
    }
}




?>

<div class="tbl_head01 tbl_wrap" style="width:49%; float:left; margin-right:20px;">
    <?php
        for($i=1;$i<=5;$i++){
    ?>
            <table style="border:#222 solid 1px;" border="1">
                <caption><?php echo $g5['title']; ?> 목록</caption>
                <thead>
                <tr><td colspan="<?php echo $colspan; ?>" style="font-size:15px; font-weight: bold; text-align: center;"><?php echo $i; ?>등 당첨 회원</td></tr>
                <tr>
                    <th scope="col">회차</th>
                    <th scope="col" style="width:100px;">등수</th>
                    <th scope="col" style="width:200px;">회원아이디</th>
                    <th scope="col" style="width:200px;">회원명</th>
                    <th scope="col" style="width:200px;">상품명</th>
                    <th scope="col" style="width:200px;">가입일자</th>
                    <th scope="col" style="width:200px;">등급변경일자</th>
                </tr>
                </thead>
                <tbody>
                <?php

                    $sql = "SELECT COUNT(*) AS cnt FROM lotto_hit_result_view WHERE lotto_result = '{$i}' {$search_q}";
                    //echo $sql."<br>";
                    $row = sql_fetch($sql);
                    if($row[cnt]>0){
                    $sql = "SELECT * FROM lotto_hit_result_view WHERE lotto_result = '{$i}' {$search_q} ORDER BY lotto_turn DESC, lotto_result ASC, pay_name ASC" ;
                    //echo $sql;
                    $res = sql_query($sql);
                    while($rows = sql_fetch_array($res)){
                        if($rows['pay_name']==''){
                            $pay_name = "무료 {$i}등";
                        } else {
                            $pay_name = $rows['pay_name'];
                        }
                ?>
                    <tr style="background-color: #fff;">
                        <td class="td_category"><?php echo $rows['lotto_turn'] ?></td>
                        <td><?php echo $rows['lotto_result'] ?></td>
                        <td><?php echo $rows['mb_id']; ?></td>
                        <td><?php echo $rows['mb_name']; ?></td>
                        <td class="td_category td_category1"><?php echo $pay_name; ?></td>
                        <td class="td_category td_category3"><?php echo $rows['mb_datetime'] ?></td>
                        <td class="td_category td_category3"><?php echo $rows['member_grade_date'] ?></td>
                    </tr>
                <?php }} else {
                    echo '<tr style="background-color:#fff;"><td colspan="' . $colspan . '" >당첨된 자료가 없습니다.</td></tr>';
                    }
                ?>
                </tbody>
            </table>
            <br>
    <?php
        }
    ?>
</div>





<div class="tbl_head01 tbl_wrap"  style="width:49%; float:left;">
    <?php
    $que = "SELECT * FROM g5_pay_type WHERE idx > 1 ORDER BY pay_money DESC";
    //echo $que;
    $res1 = sql_query($que);
    while($arr = sql_fetch_array($res1)){

        if($rows['pay_name']==''){
            $pay_name = "무료회원";
        } else {
            $pay_name = $rows['pay_name'];
        }
        ?>
        <table style="border:#222 solid 1px;" border="1">
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
            <tr><td colspan="<?php echo $colspan; ?>" style="font-size:15px; font-weight: bold; text-align: center;"><?php echo $arr['pay_name']; ?> 회원</td></tr>
            <tr>
                <th scope="col">회차</th>
                <th scope="col" style="width:100px;">등수</th>
                <th scope="col" style="width:200px;">회원아이디</th>
                <th scope="col" style="width:200px;">회원명</th>
                <th scope="col" style="width:200px;">상품명</th>
                <th scope="col" style="width:200px;">가입일자</th>
                <th scope="col" style="width:200px;">등급변경일자</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT COUNT(*) AS cnt FROM lotto_hit_result_view WHERE pay_name = '{$arr['pay_name']}' {$search_q}";
            $row = sql_fetch($sql);
            if($row[cnt]>0){
                $sql = "SELECT * FROM lotto_hit_result_view WHERE pay_name = '{$arr['pay_name']}' {$search_q} ORDER BY lotto_turn DESC, lotto_result ASC";
                //echo $sql;
                $res = sql_query($sql);
                while($rows = sql_fetch_array($res)){
                    ?>
                    <tr style="background-color: #fff;">
                        <td class="td_category"><?php echo $rows['lotto_turn'] ?></td>
                        <td><?php echo $rows['lotto_result'] ?></td>
                        <td><?php echo $rows['mb_id']; ?></td>
                        <td><?php echo $rows['mb_name']; ?></td>
                        <td class="td_category td_category1"><?php echo $rows['pay_name']; ?></td>
                        <td class="td_category td_category3"><?php echo $rows['mb_datetime'] ?></td>
                        <td class="td_category td_category3"><?php echo $rows['member_grade_date'] ?></td>
                    </tr>
                <?php } ?>
                <?php
            } else {
                echo '<tr style="background-color:#fff;"><td colspan="' . $colspan . '" >당첨된 자료가 없습니다.</td></tr>';

            }
            ?>
            </tbody>
        </table>
        <br>
        <?php
    }
    ?>
    <table style="border:#222 solid 1px;" border="1">
        <thead>
        <tr><td colspan="5" style="font-size:15px; font-weight: bold; text-align: center;">무료회원(문자발송안함) 회원</td></tr>
        <tr>
            <th scope="col">회차</th>
            <th scope="col" style="width:100px;">등수</th>
            <th scope="col" style="width:200px;">회원아이디</th>
            <th scope="col" style="width:200px;">회원명</th>
            <th scope="col" style="width:200px;">상품명</th>
            <th scope="col" style="width:200px;">당첨일자</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT COUNT(*) AS cnt FROM lotto_hit_result_view WHERE (pay_name = '무료회원(문자발송안함)' OR pay_name IS NULL) {$search_q}";
        $row = sql_fetch($sql);
        if($row[cnt]>0){
            $sql = "SELECT * FROM lotto_hit_result_view WHERE (pay_name = '무료회원(문자발송안함)' OR pay_name IS NULL) {$search_q} ORDER BY lotto_turn DESC, lotto_result ASC";
            //echo $sql;
            $res = sql_query($sql);
            while($rows = sql_fetch_array($res)){
                ?>
                <tr style="background-color: #fff;">
                    <td class="td_category"><?php echo $rows['lotto_turn'] ?></td>
                    <td><?php echo $rows['lotto_result'] ?></td>
                    <td><?php echo $rows['mb_id']; ?></td>
                    <td><?php echo $rows['mb_name']; ?></td>
                    <td class="td_category td_category1"><?php echo $rows['pay_name']; ?></td>
                    <td class="td_category td_category1">무료 <?php echo $rows['lotto_result'] ?>등</td>
                    <td class="td_category td_category3"><?php echo $rows['reg_date'] ?></td>
                </tr>
            <?php } ?>
            <?php
        } else {
            echo '<tr style="background-color:#fff;"><td colspan="' . $colspan . '" >당첨된 자료가 없습니다.</td></tr>';

        }
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


?>

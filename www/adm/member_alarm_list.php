<?php
$sub_menu = "200150";
include_once('./_common.php');
include_once('./admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_alarm_schedule ";
$today = date("Y-m-d");
$sql_search = " where (1) AND NOW() > alarm_datetime  AND alarm_chk_yn = 'N' ";

if ($stx && $sfl) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_id' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'reg_mb_id' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";


} else {

    $sql_search .= " and ( mb_id LIKE '%{$stx}%' OR reg_mb_id LIKE '%{$stx}%' OR alarm_content LIKE '%{$stx}%' )";
}

if($_SESSION['ss_mb_id']!='admin') {
    $sql_search .= " AND reg_mb_id = '{$_SESSION['ss_mb_id']}' ";
}


if (!$sst) {
    $sst  = "alarm_datetime";
    $sod = "asc";
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
//echo $sql;
$result = sql_query($sql);

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";

$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함



$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$mb = array();
if ($sfl == 'mb_id' && $stx)
    $mb = get_member($stx);

$g5['title'] = '회원알람관리 (확인전 알람 목록)';
include_once ('./admin.head.php');

$colspan = 12;

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

</div>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="">전체</option>
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
        <option value="reg_mb_id"<?php echo get_selected($_GET['sfl'], "writer_id"); ?>>관리아이디</option>
        <option value="alarm_content"<?php echo get_selected($_GET['sfl'], "alarm_content"); ?>>내용</option>
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
                <th scope="col" style="width:3%;">
                    <label for="chkall" class="sound_only">회원 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th scope="col" style="width:5%;">번호</a></th>
                <th scope="col" style="width:10%;">상담일자</th>
                <th scope="col" style="width:8%;">아아디</th>
                <th scope="col" style="width:5%;">이름</th>
                <th scope="col" style="width:5%;">코드</th>
                <th scope="col" style="width:5%;">추가사항</th>
                <th scope="col" style="width:5%;">종류</th>
                <th scope="col" style="width:5%;">관심</th>
                <th scope="col">메모내용</a></th>
                <th scope="col" style="width:10%;">알람시간</th>
                <th scope="col" style="width:5%;">내용확인</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                if ($i==0 || ($row2['mb_id'] != $row['mb_id'])) {
                    $sql2 = " select mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
                    $row2 = sql_fetch($sql2);
                }

                //$mb_nick = get_sideview($row['mb_id'], $row2['mb_nick'], $row2['mb_email'], $row2['mb_homepage']);
                $mb = getMemberInfo($row['writer_id']);
                $link1 = $link2 = '';
                $expr = '';
                if($row['po_expired'] == 1)
                    $expr = ' txt_expired';

                $bg = 'bg'.($i%2);

                //알람시간1
                if($row['alarm_date']!='0000-00-00'){
                    $alarm_date = date("Y/m/d ").$row['alarm_hour'].":".$row['alarm_min'];
                } else {
                    $alarm_date = "";
                }
                $arr_alarm_type = array(1=>"예약",2=>"재통",3=>"부재",4=>"캐어");

                $mb1 = sql_fetch("SELECT mb_name FROM g5_member WHERE mb_id = '{$row['mb_id']}'");
                ?>

                <tr class="<?php echo $bg; ?>">
                    <td class="td_center">
                        <input type="checkbox" name="chk[]" value="<?php echo $row[memo_idx] ?>" id="chk_<?php echo $i ?>">
                    </td>
                    <td class="td_center"><?php echo $total_count-$i;  ?></td>
                    <td class="td_datetime2"><?php echo $row['alarm_regdate'] ?></td>
                    <?php
                    if($_SESSION['ss_mb_level']>9){
                        ?>
                        <td class="td_center"><a href="./member_memo_list.php?mb_id=<?php echo $row['mb_id']; ?>&mb_name=<?php echo $mb1['mb_name']; ?>&sfl=mb_id&stx=<?php echo $row['mb_id']; ?>" title="회원 메모 페이지로 이동합니다."><?php echo $row['mb_id']; ?></a></td>
                    <?php } else { ?>
                        <td class="td_center"><?php echo $row['mb_id']; ?></td>
                    <?php } ?>
                    <td class="td_center"><?php echo $mb1['mb_name']; ?></td>
                    <td class="td_center"></td>
                    <td class="td_center"></td>
                    <td class="td_center"><?php echo $arr_alarm_type[$row['alarm_type']]; ?></td>
                    <td class="td_center"><?php echo $row['alarm_fav']; ?>%</td>
                    <td class="td_left"><?php echo nl2br($row['alarm_content']); ?></td>
                    <td class="td_center"><?php echo $row['alarm_datetime']; ?></td>

                    <td class="td_datetime2">
                        <?php
                        if($row['alarm_chk_yn']=='N'){
                            ?>
                            <input type="button" data-idx="<?php echo $row['alarm_idx']; ?>" data-mb_name="<?php echo $mb1['mb_name'];?>" data-mb_id="<?php echo $row['mb_id'];?>" name="act_button" value="알람끄기" style="cursor: pointer;" class="btn btn_submit alarm_off">
                        <?php }  ?>

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
    <?php
    if($_SESSION['ss_mb_id'] == 'admin'){
        ?>
        <div class="btn_confirm01 btn_confirm">
            <input type="button" value="선택삭제" class="btn_submit btn" id="del_select">
        </div>
    <?php } ?>

    <div class="tbl_head01 tbl_wrap">
        <table>
            <h4>예정 알람 목록</h4>
            <thead>
            <tr>
                <th scope="col" style="width:3%;">
                    <label for="chkall" class="sound_only">회원 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th scope="col" style="width:5%;">번호</a></th>
                <th scope="col" style="width:10%;">상담일자</th>
                <th scope="col" style="width:8%;">아아디</th>
                <th scope="col" style="width:5%;">이름</th>
                <th scope="col" style="width:5%;">코드</th>
                <th scope="col" style="width:5%;">추가사항</th>
                <th scope="col" style="width:5%;">종류</th>
                <th scope="col" style="width:5%;">관심</th>
                <th scope="col">메모내용</a></th>
                <th scope="col" style="width:10%;">알람시간</th>
                <th scope="col" style="width:5%;">내용확인</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql_search = "";
            if($_SESSION['ss_mb_id']!='admin' ) {
                $sql_search .= " AND reg_mb_id = '{$_SESSION['ss_mb_id']}' ";
            }
            $que = "SELECT COUNT(*) as total FROM g5_alarm_schedule WHERE (1) AND NOW() < alarm_datetime  AND reg_mb_id = '{$_SESSION['ss_mb_id']}' AND alarm_chk_yn = 'N' {$sql_search}";
            //echo $que."<br>";
            $tt = sql_fetch($que);

            $total_count = $tt['total'];
            $que = "SELECT * FROM g5_alarm_schedule WHERE (1) AND NOW() < alarm_datetime AND alarm_chk_yn = 'N' {$sql_search} ORDER BY alarm_datetime ASC";
            //echo $que."<br>";
            $result = sql_query($que);
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                if ($i==0 || ($row2['mb_id'] != $row['mb_id'])) {
                    $sql2 = " select mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
                    $row2 = sql_fetch($sql2);
                }

                //$mb_nick = get_sideview($row['mb_id'], $row2['mb_nick'], $row2['mb_email'], $row2['mb_homepage']);
                $mb = getMemberInfo($row['writer_id']);
                $link1 = $link2 = '';
                $expr = '';
                if($row['po_expired'] == 1)
                    $expr = ' txt_expired';

                $bg = 'bg'.($i%2);

                //알람시간1
                if($row['alarm_date']!='0000-00-00'){
                    $alarm_date = date("Y/m/d ").$row['alarm_hour'].":".$row['alarm_min'];
                } else {
                    $alarm_date = "";
                }
                $arr_alarm_type = array(1=>"예약",2=>"재통",3=>"부재",4=>"캐어");

                $mb1 = sql_fetch("SELECT mb_name FROM g5_member WHERE mb_id = '{$row['mb_id']}'");
                ?>

                <tr class="<?php echo $bg; ?>">
                    <td class="td_center">
                        <input type="checkbox" name="chk[]" value="<?php echo $row[memo_idx] ?>" id="chk_<?php echo $i ?>">
                    </td>
                    <td class="td_center"><?php echo $total_count-$i;  ?></td>
                    <td class="td_datetime2"><?php echo $row['alarm_regdate'] ?></td>
                    <?php
                    if($_SESSION['ss_mb_level']>9){
                        ?>
                        <td class="td_center"><a href="./member_memo_list.php?mb_id=<?php echo $row['mb_id']; ?>&mb_name=<?php echo $mb1['mb_name']; ?>&sfl=mb_id&stx=<?php echo $row['mb_id']; ?>" title="회원 메모 페이지로 이동합니다."><?php echo $row['mb_id']; ?></a></td>
                    <?php } else { ?>
                        <td class="td_center"><?php echo $row['mb_id']; ?></td>
                    <?php } ?>
                    <td class="td_center"><?php echo $mb1['mb_name']; ?></td>
                    <td class="td_center"></td>
                    <td class="td_center"></td>
                    <td class="td_center"><?php echo $arr_alarm_type[$row['alarm_type']]; ?></td>
                    <td class="td_center"><?php echo $row['alarm_fav']; ?>%</td>
                    <td class="td_left"><?php echo nl2br($row['alarm_content']); ?></td>
                    <td class="td_center"><?php echo $row['alarm_datetime']; ?></td>

                    <td class="td_datetime2">


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

    <div class="tbl_head01 tbl_wrap">
        <table>
            <h4>확인된 알람 목록(3일전까지 확인됨)</h4>
            <thead>
            <tr>
                <th scope="col" style="width:3%;">
                    <label for="chkall" class="sound_only">회원 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th scope="col" style="width:5%;">번호</a></th>
                <th scope="col" style="width:10%;">상담일자</th>
                <th scope="col" style="width:8%;">아아디</th>
                <th scope="col" style="width:5%;">이름</th>
                <th scope="col" style="width:5%;">코드</th>
                <th scope="col" style="width:5%;">추가사항</th>
                <th scope="col" style="width:5%;">종류</th>
                <th scope="col" style="width:5%;">관심</th>
                <th scope="col">메모내용</a></th>
                <th scope="col" style="width:10%;">알람시간</th>
                <th scope="col" style="width:5%;">내용확인</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql_search = "";
            if($_SESSION['ss_mb_id']!='admin' ) {
                $sql_search .= " AND reg_mb_id = '{$_SESSION['ss_mb_id']}' ";
            }
            $que = "SELECT COUNT(*) as total FROM g5_alarm_schedule WHERE (1) AND DATE_FORMAT(alarm_datetime,'%Y-%m-%d') <= DATE_FORMAT(NOW(),'%Y-%m-%d') AND DATE_FORMAT(alarm_regdate,'%Y-%m-%d') BETWEEN DATE_ADD(DATE_FORMAT(NOW(),'%Y-%m-%d'), INTERVAL -3 DAY) AND DATE_FORMAT(NOW(),'%Y-%m-%d') {$sql_search} AND alarm_chk_yn = 'Y'";
            //echo $que."<br>";
            $tt = sql_fetch($que);
            $total_count = $tt['total'];
            $que = "SELECT * FROM g5_alarm_schedule WHERE (1) AND DATE_FORMAT(alarm_datetime,'%Y-%m-%d') <= DATE_FORMAT(NOW(),'%Y-%m-%d') AND DATE_FORMAT(alarm_regdate,'%Y-%m-%d') BETWEEN DATE_ADD(DATE_FORMAT(NOW(),'%Y-%m-%d'), INTERVAL -3 DAY) AND DATE_FORMAT(NOW(),'%Y-%m-%d')  {$sql_search} AND alarm_chk_yn = 'Y' ORDER BY alarm_datetime DESC";
            //echo $que."<br>";
            $result = sql_query($que);
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                if ($i==0 || ($row2['mb_id'] != $row['mb_id'])) {
                    $sql2 = " select mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
                    $row2 = sql_fetch($sql2);
                }

                //$mb_nick = get_sideview($row['mb_id'], $row2['mb_nick'], $row2['mb_email'], $row2['mb_homepage']);
                $mb = getMemberInfo($row['writer_id']);
                $link1 = $link2 = '';
                $expr = '';
                if($row['po_expired'] == 1)
                    $expr = ' txt_expired';

                $bg = 'bg'.($i%2);

                //알람시간1
                if($row['alarm_date']!='0000-00-00'){
                    $alarm_date = date("Y/m/d ").$row['alarm_hour'].":".$row['alarm_min'];
                } else {
                    $alarm_date = "";
                }
                $arr_alarm_type = array(1=>"예약",2=>"재통",3=>"부재",4=>"캐어");

                $mb1 = sql_fetch("SELECT mb_name FROM g5_member WHERE mb_id = '{$row['mb_id']}'");
                ?>

                <tr class="<?php echo $bg; ?>">
                    <td class="td_center">
                        <input type="checkbox" name="chk[]" value="<?php echo $row[memo_idx] ?>" id="chk_<?php echo $i ?>">
                    </td>
                    <td class="td_center"><?php echo $total_count-$i;  ?></td>
                    <td class="td_datetime2"><?php echo $row['alarm_regdate'] ?></td>
                    <?php
                    if($_SESSION['ss_mb_level']>9){
                        ?>
                        <td class="td_center"><a href="./member_memo_list.php?mb_id=<?php echo $row['mb_id']; ?>&mb_name=<?php echo $mb1['mb_name']; ?>&sfl=mb_id&stx=<?php echo $row['mb_id']; ?>" title="회원 메모 페이지로 이동합니다."><?php echo $row['mb_id']; ?></a></td>
                    <?php } else { ?>
                        <td class="td_center"><?php echo $row['mb_id']; ?></td>
                    <?php } ?>
                    <td class="td_center"><?php echo $mb1['mb_name']; ?></td>
                    <td class="td_center"></td>
                    <td class="td_center"></td>
                    <td class="td_center"><?php echo $arr_alarm_type[$row['alarm_type']]; ?></td>
                    <td class="td_center"><?php echo $row['alarm_fav']; ?>%</td>
                    <td class="td_left"><?php echo nl2br($row['alarm_content']); ?></td>
                    <td class="td_center"><?php //echo $row['alarm_datetime']; ?></td>

                    <td class="td_datetime2">
                        <?php
                        if($row['alarm_chk_yn']=='N'){
                            ?>
                            <input type="button" data-idx="<?php echo $row['alarm_idx']; ?>" data-mb_name="<?php echo $mb1['mb_name'];?>" data-mb_id="<?php echo $row['mb_id'];?>" name="act_button" value="알람끄기" style="cursor: pointer;" class="btn btn_submit alarm_off">
                        <?php }  ?>

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

        $("#del_select").on("click", function() {
            var idx = new Array();

            var cnt = 0;
            $("input[type='checkbox']").each(function(){
                if($(this).is(':checked')==true){
                    idx[cnt] = $(this).val();
                    cnt++;
                }
            });

            $.ajax({
                type: "POST",
                url: "./member_proc.php",
                cache: false,
                async: false,
                data: { mode : 'memberMemoDel', idx : idx },
                dataType: "json",
                success: function(data) {
                    alert(data.result);
                    location.reload(true);
                    return false;
                }
            });
        });


        $('.save-memo').on('click',function(){
            var mb_id = $(this).data("mb_id"),
                mb_memo = $('#message-text').val(),
                pay_date = $('#pay_date').val(),
                take_pay_type = $('#take_pay_type option:selected').val(),
                use_pay_type = $('#use_pay_type option:selected').val(),
                miss_pay = $('#miss_pay').val(),
                miss_pay_date = $('#miss_pay_date').val(),
                take_pay_type = $('#take_pay_type option:selected').val(),
                alarm_date = $('#alarm_date').val(),
                alarm_hour = $('#alarm_hour option:selected').val(),
                alarm_min = $('#alarm_min option:selected').val(),
                etc_sms = $('#etc_sms').val(),
                etc_msg = $('#etc_msg').val(),
                fav = $('#fav option:selected').val(),
                alarm_type = $('#alarm_type option:selected').val(),
                pay_money = $('#pay_money').val(),
                jsonurl =  "./member_proc.php";


            if(mb_id && mb_memo) {
                $.ajax({
                    type: "POST",
                    url: jsonurl,
                    dataType: "JSON",
                    data: {"mode": "writeMemo", "mb_id": mb_id, "mb_memo": mb_memo, "pay_date" : pay_date, "take_pay_type" : take_pay_type,
                        "miss_pay":miss_pay,"use_pay_type":use_pay_type,"miss_pay_date":miss_pay_date,"alarm_date":alarm_date,
                        "alarm_type":alarm_type, "alarm_hour":alarm_hour,"alarm_min":alarm_min,"etc_sms":etc_sms,"etc_msg":etc_msg,"fav":fav, "pay_money":pay_money,
                    },
                    success: function (data) {
                        console.log(data);
                        //if (data.flag) {
                        $('.btn-default').trigger('click');
                        $('#message-text').val('');
                        swal('','메모가 정상적으로 등록되었습니다.','success');
                        setTimeout(function(){ location.reload();},3000);
                        /*} else {
                        }*/
                    },
                    complete: function (data) {
                    },
                    error: function (xhr, status, error) {
                        var err = status + ' \r\n' + error;
                    }
                });
            } else {
                alert('회원 아이디 또는 내용이 입력되지 않았습니다.');
                return false;
            }
        })



        $('.alarm_off').on('click',function(){
            var no = $(this).data('idx');
            var mb_name = $(this).data('mb_name');
            var mb_id = $(this).data('mb_id');

            swal({
                text: '알람을 끄시겠습니까?',
                type : "warning",
                showCancelButton : true,
                cancelButtonText : '취소',
                confirmButtonText: "확인",
            })
                .then((isConfirm)=>{
                    if(isConfirm){
                        $.ajax({
                            type : 'POST',
                            url : './member_proc.php',
                            data : 'mode=alarmOff&no='+no,
                            success : function(res){
                                if(res == true) {
                                    swal('', '알람이 꺼졌습니다.', 'success');
                                    location.href = './member_memo_list.php?mb_id='+mb_id+'&mb_name='+mb_name+'&sfl=mb_id&stx='+mb_id;
                                    //setTimeout(function(){ location.reload(true);},3000);
                                } else {
                                    swal('', '알람이 꺼짐 실행시 오류가 발생했습니다.', 'warning');
                                }
                            }
                        });
                    }
                });

        })

        $('#container_title').text('<?php echo $g5['title'];?>');

    });
    $("#pay_date, #miss_pay_date, #alarm_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", yearRange: "c-99:c+99" });

</script>

<?php
include_once ('./admin.tail.php');
?>

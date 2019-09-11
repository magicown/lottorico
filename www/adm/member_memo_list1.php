<?php
$sub_menu = "200150";
include_once('./_common.php');
include_once('./admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_member_memo  ";

$sql_search = " where (1) ";

if ($stx && $sfl) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_id' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'writer_id' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";

    /* if($_SESSION['ss_mb_id']!='admin') {
         $sql_search .= " AND writer_id = '{$_SESSION['ss_mb_id']}' ";
     }*/
} else {
    $sql_search .= " and ( mb_id LIKE '%{$stx}%' OR writer_id LIKE '%{$stx}%' OR memo_content LIKE '%{$stx}%' )";
}
/*if($_SESSION['ss_mb_id']!='admin') {
    $sql_search .= " AND writer_id = '{$_SESSION['ss_mb_id']}' ";
}*/

if (!$sst) {
    $sst  = "memo_regdate";
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
echo $sql;
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

$g5['title'] = '회원메모관리';
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

<section id="anc_bo_design">
    <h2 class="h2_frm"><?php echo $_REQUEST['mb_name']; ?>(<?php echo $_REQUEST['mb_id']; ?>)님에 대한 메모 남기기</h2>
    <?php echo $pg_anchor ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption>게시판 디자인/양식</caption>
            <colgroup>
                <col class="grid_4">
                <col>
                <col class="grid_3">
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="bo_skin">메모내용<strong class="sound_only">필수</strong></label></th>
                <td>
                    <textarea name="memo" id="message-text" rows="20"></textarea>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bo_mobile_skin">결제금액<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="pay_money" id="pay_money" value="" class="frm_input" >원
                    결제일 : <input type="text" name="pay_date" id="pay_date" value="" class="frm_input" >
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bo_mobile_skin">결제방법<strong class="sound_only">필수</strong></label></th>
                <td>
                    <select name="take_pay_type" id="take_pay_type">
                        <option value="">결제방법선택</option>
                        <option value="card">신용카드</option>
                        <option value="bank">무통장입금</option>
                        <option value="hp">휴대폰</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bo_mobile_skin">결제용도<strong class="sound_only">필수</strong></label></th>
                <td>
                    <select name="use_pay_type" id="use_pay_type">
                        <option value="">결제용도선택</option>
                        <option value="1">구매</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bo_mobile_skin">미수금<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="miss_pay" id="miss_pay" value="" class="frm_input" >원
                    미수금일 : <input type="text" name="miss_pay_date" id="miss_pay_date"  value="" class="frm_input" >
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bo_mobile_skin">알림설정<strong class="sound_only">필수</strong></label></th>
                <td>
                    알림구분
                    <select name="alarm_type" id="alarm_type" class="form-group">
                        <option value="">알림선택</option>
                        <option value="1">예약</option>
                        <option value="2">재통</option>
                        <option value="3">부재</option>
                        <option value="4">캐어</option>
                        <option value="5">거절</option>
                    </select>
                    날짜
                    <input type="text" name="alarm_date" id="alarm_date" placeholder="날짜선택" class="frm_input" value="">
                    시간 :
                    <select name="alarm_hour" id="alarm_hour" class="form-group">
                        <option value="">시간선택</option>
                        <?php
                        for($i=0;$i<=23;$i++){
                            ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php } ?>
                    </select>
                    분 :
                    <select name="alarm_min" id="alarm_min" class="form-group">
                        <option value="">분선택</option>
                        <?php
                        for($i=1;$i<60;$i++){
                            ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bo_mobile_skin">추가사항<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="checkbox" name="etc_sms" id="etc_sms" value="1"> 문자
                    <input type="checkbox" name="etc_msg" id="etc_msg" value="1"> 쪽지

                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bo_mobile_skin">관심도<strong class="sound_only">필수</strong></label></th>
                <td>
                    <select name="fav" id="fav" class="form-group">
                        <option value="">관심도선택</option>
                        <?php
                        for($i=1;$i<=100;$i++){
                            ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?>%</option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bo_mobile_skin">관리<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="button" name="act_button" value="회원정보로 이동" onclick="location.href='./member_list.php?sfl=mb_id&stx=<?php echo $_REQUEST['mb_id']; ?>';" class="btn btn_02">
                    <input type="button" value="메모저장" class="btn_submit btn save-memo" data-mb_id="<?php echo $_REQUEST['mb_id']; ?>">
                </td>
            </tr>
        </table>
    </div>
    <?php if(USE_G5_THEME) { ?>
        <button type="button" class="get_theme_galc btn btn_02" >테마 이미지설정 가져오기</button>
    <?php } ?>
</section>

<div class="local_ov01 local_ov">
    <?php
    if($_SESSION['ss_mb_id']=='admin') {
        echo $listall;
    }
    ?>
    <span class="btn_ov01"><span class="ov_txt">전체 </span><span class="ov_num"> <?php echo number_format($total_count) ?> 건 </span></span>

</div>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="">전체</option>
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
        <option value="writer_id"<?php echo get_selected($_GET['sfl'], "writer_id"); ?>>관리아이디</option>
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
                <th scope="col" style="width:3%;">
                    <label for="chkall" class="sound_only">회원 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th scope="col">번호</a></th>
                <th scope="col" style="width:5%;">작성자</th>
                <th scope="col" style="width:8%;">고객정보</th>
                <th scope="col" style="width:5%;">추가사항</th>
                <th scope="col" style="width:5%;">관심</th>
                <th scope="col" style="width:5%;">결제금액</th>
                <th scope="col" style="width:5%;">결제방법</th>
                <th scope="col" style="width:5%;">결제용도</th>
                <th scope="col" style="width:5%;">미수금</th>
                <th scope="col">메모내용</a></th>
                <th scope="col" style="width:5%;">결제예정일</a></th>
                <th scope="col" style="width:10%;">알람구분</th>
                <th scope="col" style="width:10%;">알람시간</th>
                <th scope="col" style="width:5%;">기록일시</th>

            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                $que1 = "SELECT alarm_chk_yn FROM g5_alarm_schedule WHERE memo_idx = '{$row['memo_idx']}'";
                //echo $que1."<br>";
                $al = sql_fetch($que1);

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

                //알람시간
                if($row['alarm_date']!='0000-00-00'){
                    $alarm_date = $row['alarm_date']."<br>".$row['alarm_hour']."시".$row['alarm_min']."분";
                } else {
                    $alarm_date = "";
                }

                unset($at);
                unset($alarm_gubun);
                /*if($row['alarm_date']==''){
                    $at = "거절";
                } else {}
                if($row['alarm_type']=='') {
                    $que = "SELECT alarm_type FROM g5_alarm_schedule WHERE reg_mb_id = '{$row['writer_id']}' AND mb_id = '{$row['mb_id']}' AND alarm_datetime = '{$row['alarm_date']} {$row['alarm_hour']}:{$row['alarm_min']}:00' ";
                    //echo $que."<br>";
                    $alarm_gubun = sql_fetch($que);
                } else {*/
                $alarm_gubun = $row['alarm_type'];
                //}

                switch($alarm_gubun){
                    case '1':
                        $at = "예약";
                        break;
                    case '2':
                        $at = "재통";
                        break;
                    case '3':
                        $at = "부통";
                        break;
                    case '4':
                        $at = "캐어";
                        break;
                    case '5':
                        $at = "거절";
                        break;
                }
                ?>

                <tr class="<?php echo $bg; ?>">
                    <td class="td_center">
                        <input type="checkbox" name="chk[]" value="<?php echo $row[memo_idx] ?>" id="chk_<?php echo $i ?>">
                    </td>
                    <td class="td_center"><?php echo $total_count-$i;  ?></td>
                    <td class="td_center"><?php echo $mb['mb_name']; ?></td>
                    <td class="td_center"><a href="/adm/member_form.php?sst=&sod=&sfl=&stx=&page=&w=u&mb_id=<?php echo $row['mb_id'];?>"><?php echo $row['mb_id']."<br> (".get_text($row2['mb_name']).")"; ?></a></td>
                    <td class="td_center"><?php echo $row['other_type']; ?></td>
                    <td class="td_center"><?php echo $row['fav']; ?></td>
                    <td class="td_center"><?php echo number_format($row['pay_money']); ?></td>
                    <td class="td_center"><?php echo $row['take_pay_type']; ?></td>
                    <td class="td_center"><?php echo $row['use_pay_type']; ?></td>
                    <td class="td_center"><?php echo number_format($row['miss_pay']); ?></td>
                    <td class="td_left"><?php echo nl2br($row['memo_content']); ?></td>
                    <td class="td_datetime2"><?php echo ($row['memo_pay_date']!='0000-00-00')?$row['memo_pay_date']:''; ?></td>
                    <td class="td_left"><?php echo $at; ?></td>
                    <td class="td_center"><?php //echo $alarm_date; ?><?php echo ($al['alarm_chk_yn']=='N')?$alarm_date:''; ?></td>
                    <td class="td_datetime2"><?php echo $row['memo_regdate'] ?></td>
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

            if(alarm_type != ''){
                if(alarm_type != '5') {
                    if (alarm_date == '' || alarm_hour == '' || alarm_min == '') {
                        swal('', '알람시간을 선택해주세요.', 'warning');
                        return false;
                    }
                }
            }


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
                        if (data.flag) {
                            $('.btn-default').trigger('click');
                            $('#message-text').val('');
                            swal('','메모가 정상적으로 등록되었습니다.','success');
                            setTimeout(function(){ location.reload();},3000);
                        } else {
                        }
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
                                    setTimeout(function(){ location.reload(true);},3000);
                                } else {
                                    swal('', '알람이 꺼짐 실행시 오류가 발생했습니다.', 'warning');
                                }
                            }
                        });
                    }
                });

        })

    });
    $("#pay_date, #miss_pay_date, #alarm_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", yearRange: "c-99:c+99" });

</script>

<?php
include_once ('./admin.tail.php');
?>

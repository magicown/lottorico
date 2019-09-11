<?php
$sub_menu = "200150";
include_once('./_common.php');

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
/*auth_check($auth[$sub_menu], 'r');*/
$sql_common = " from {$g5['member_table']} ";

$sql_search = " where mb_memo NOT LIKE '%삭제함%' ";
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
    $sst = "mb_datetime";
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

$g5['title'] = '회원관리';
include_once('./admin.head.popup.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit 1, 1 ";
//echo $sql;
$result = sql_query($sql);

//회원검색을 사용해서 검색된 회원이 있다면
if($total_count == 1){
    $sm = sql_fetch($sql);
    $search_hp = str_replace("-","",$sm['mb_hp']);
    $search_id = $sm['mb_id'];
}

$colspan = 7;

?>





<section style="margin:10px 10px;">
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
                    <th scope="col" style="width:5%;">아이디</a></th>
                    <th scope="col" style="width:10%;">회원명<br>핸드폰번호</th>
                    <th scope="col" style="width:8%;">등급</th>
                    <th scope="col" style="width:5%;">배출요일</th>
                    <th scope="col" style="width:5%;">전체남은<br>조합수</th>
                    <th scope="col" style="width:5%;">발송할<br>조합수</th>
                    <th scope="col" style="width:5%;">발송하기</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $que = "SELECT * FROM g5_member WHERE mb_id = '{$_REQUEST['mb_id']}' ";
                    $row = sql_fetch($que);



                    //남은 번호 갯수
                    $now_turn = get_current_turn();
                    $remind_lotto_cnt = cur_remind_lotto_cnt($row['mb_id'], $now_turn, $row['mb_3']);

                    //발송요일
                    $cnt = 0;
                    $week = array(1=>"mon_sms_cnt",2=>"tue_sms_cnt",3=>"wed_sms_cnt",4=>"thu_sms_cnt",5=>"fri_sms_cnt",6=>"sat_sms_cnt");
                    $week_text = array(1=>"월",2=>"화",3=>"수",4=>"목",5=>"금",6=>"토");
                    $send_week = array();
                    $str = "";
                    for($i=1;$i<=count($week);$i++){
                        if($row[$week[$i]]>0) {
                            $str .= "(".$week_text[$i].") ".$row[$week[$i]]."<br>";
                            $cnt++;
                        }
                    }
                    if($row['mb_10']=='1'){
                        $str = "(금요일)";
                    }
                    $pay_type = getPayType($row['mb_10']);
                    ?>

                    <tr class="<?php echo $bg; ?>">

                        <td class="td_center"><?php echo $row['mb_id'];  ?></td>
                        <td class="td_datetime2"><?php echo $row['mb_name'] ?><br><?php echo $row['mb_hp']; ?></td>
                        <td class="td_center"><?php echo $pay_type['pay_name']; ?></td>
                        <td class="td_center"><?php echo $str; ?></td>
                        <td class="td_center"><?php if($row['mb_10']>'1'){ echo $remind_lotto_cnt; }?></td>
                        <td class="td_center">
                            <select name="send_yet" id="send_yet" style="width:50px;">
                                <optin value="">조합선택</optin>
                                <?php
                                    for($j=1;$j<=100;$j++){
                                ?>
                                <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td class="td_center">
                            <a class="btn btn_03 member_send_now" data-mb_id="<?php echo $row['mb_id']; ?>" data-mb_name="<?php echo $row['mb_name']; ?>">즉시전송</a>
                            <a class="btn btn_02" data-dismiss="modal" href="javascript:;" onclick="location.reload();">닫기</a>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

    </form>
    <iframe src="./member_lotto_show.php?mb_id=<?php echo $_REQUEST['mb_id']; ?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="600"></iframe>
</section>


<script>
    //남은번호 즉시 전송 클릭시
    $('.member_send_now').on('click',function(){
        var mb_id = $(this).data('mb_id');
        var name = $(this).data('mb_name');
        var sel_cnt = $('#send_yet option:selected').val();
        console.log(sel_cnt);
        swal({
            text: name+"님에게 금일발송될 번호를 즉시 전송하시겠습니까?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: '확인',
            cancelButtonText: "취소",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type : 'POST',
                    url : './member_send_now.php',
                    data : 'mb_id='+mb_id+'&sel_cnt='+sel_cnt,
                    success : function(res){
                        console.log(res);
                        if(res == true){
                            swal('','당첨번호가 발송 완료되었습니다.','success');
                            setTimeout(function(){location.reload(true)},2000);
                        } else {
                            swal('','당첨번호 즉시 발송시 오류가 있습니다.','warning');
                        }

                    }
                })
            } else {

            }
        });
    });
</script>



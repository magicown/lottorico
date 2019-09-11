<?php
$sub_menu = "200110";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');


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
            //$sql_search .= " ({$sfl} like '{$stx}%') ";
            $sql_search .= "( mb_id LIKE '%{$stx}%' OR mb_hp LIKE '%{$stx}%' OR mb_name LIKE '%{$stx}%' OR mb_nick LIKE '%{$stx}%')";
            break;
    }
    $sql_search .= " ) ";
} else {
    $sql_search .= " and mb_id = '999999999999999999' ";
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
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

//회원검색을 사용해서 검색된 회원이 있다면
if($total_count == 1){
    $sm = sql_fetch($sql);
    $search_hp = str_replace("-","",$sm['mb_hp']);
    $search_id = $sm['mb_id'];
}

$colspan = 16;
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    body{ font-size:12px;}
</style>

<div class="local_ov01 local_ov">
    <?php
        if($_SESSION['ss_mb_id']=='admin') {
            echo $listall;
        }
    ?>
    <span class="btn_ov01"><span class="ov_txt">총회원수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>명 </span></span>
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> <span class="ov_txt">차단 </span><span class="ov_num"><?php echo number_format($intercept_count) ?>명</span></a>
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> <span class="ov_txt">탈퇴  </span><span class="ov_num"><?php echo number_format($leave_count) ?>명</span></a>
</div>

<!-- 회원추가 팝업 -->
<div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
    <!--<a href="./member_form.php" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal">Launch Demo Modal</a>-->

    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
        </div>
    </div>
</div>
<!-- 회원추가 팝업 끝 -->

<!--문자전송팝업-->
<div class="bs-example">
    <!-- Modal HTML -->
    <div id="send_sms" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
        </div>
    </div>
</div>
<!--문자전송팝업끝-->

<!--즉시전송팝업-->
<div class="bs-example">
    <!-- Modal HTML -->
    <div id="send_sms_now" class="modal fade">
        <div class="modal-dialog" style="margin:30px 100px;">
            <div class="modal-content" style="width:1100px;">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
        </div>
    </div>
</div>
<!--즉시전송팝업끝-->

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value=""<?php echo get_selected($_GET['sfl'], ""); ?>>전체</option>
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
        <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
        <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
        <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
        <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
        <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
        <option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
        <option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
        <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
        <option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
    <input type="submit" class="btn_submit" value="검색">

</form>

<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>

<?php if($total_count==1){ ?>
    <div class="local_desc01 local_desc">
        검색결과 : 총 [<span id="total_personal"><?php echo $total_count; ?></span>] 명 <a href="./send_member_sms.php?hp=<?php echo $search_hp; ?>&mb_id=<?php echo $search_id; ?>" id="member_add" class="btn btn_01" data-toggle="modal" data-target="#send_sms" style="text-decoration: none;">문자전송</a>
    </div>
<?php } ?>
<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
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
                <th scope="col" id="mb_list_chk" rowspan="2" >
                    <label for="chkall" class="sound_only">회원 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th scope="col" id="mb_list_id" colspan="2"><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
                <th scope="col" rowspan="2" id="mb_list_id"><?php echo subject_sort_link('mb_id') ?>회원상태</a></th>
                <th scope="col" rowspan="2" id="mb_list_id"><?php echo subject_sort_link('mb_id') ?>약관동의</a></th>
                <th scope="col" rowspan="2" id="mb_list_cert"><?php echo subject_sort_link('mb_certify', '', 'desc') ?>결제</a></th>
                <th scope="col" rowspan="2" id="mb_list_cert">남은번호수<br>발송일</a></th>
                <th scope="col" id="mb_list_mailc" rowspan="2">계좌번호발송</th>
                <!--<th scope="col" id="mb_list_open"><?php /*echo subject_sort_link('mb_open', '', 'desc') */?>정보공개</a></th>
                <th scope="col" id="mb_list_mailr"><?php /*echo subject_sort_link('mb_mailling', '', 'desc') */?>메일수신</a></th>-->
                <th scope="col" id="mb_list_auth">상태</th>
                <th scope="col" id="mb_list_mobile">휴대폰</th>
                <th scope="col" id="mb_list_lastcall"><?php echo subject_sort_link('mb_today_login', '', 'desc') ?>최종접속</a></th>
                <th scope="col" id="mb_list_grp">접근그룹</th>
                <th scope="col" rowspan="2" id="mb_list_mng">관리</th>
            </tr>
            <tr>
                <th scope="col" id="mb_list_name"><?php echo subject_sort_link('mb_name') ?>이름</a></th>
                <th scope="col" id="mb_list_nick"><?php echo subject_sort_link('mb_nick') ?>닉네임</a></th>


                <!--<th scope="col" id="mb_list_adultc"><?php /*echo subject_sort_link('mb_adult', '', 'desc') */?>성인인증</a></th>
                <th scope="col" id="mb_list_auth"><?php /*echo subject_sort_link('mb_intercept_date', '', 'desc') */?>접근차단</a></th>-->
                <th scope="col" id="mb_list_deny"><?php echo subject_sort_link('mb_level', '', 'desc') ?>권한</a></th>
                <th scope="col" id="mb_list_tel">전화번호</th>
                <th scope="col" id="mb_list_join"><?php echo subject_sort_link('mb_datetime', '', 'desc') ?>가입일</a></th>
                <th scope="col" id="mb_list_point"><?php echo subject_sort_link('mb_point', '', 'desc') ?> 포인트</a></th>
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

                $bg = 'bg'.($i%2);


                //남은 번호 갯수
                $now_turn = get_current_turn();
                $que = "SELECT COUNT(*) as cnt FROM member_lotto_num WHERE lotto_turn = '{$now_turn}' AND mb_id = '{$row['mb_id']}' ";
                //echo $que."<br>";
                $send_lotto_num = sql_fetch($que);
                $remind_lotto_cnt = $row['mb_3']-$send_lotto_num['cnt'];
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



                ?>

                <tr class="<?php echo $bg; ?>">
                    <td headers="mb_list_chk" class="td_chk" rowspan="2">
                        <input type="hidden" name="mb_id" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
                        <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
                        <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                    </td>
                    <td headers="mb_list_id" colspan="2" class="td_name sv_use">
                        <?php echo $mb_id ?> <a href="./member_memo_list.php?mb_id=<?php echo $row['mb_id']; ?>&mb_name=<?php echo urlencode($row['mb_name']); ?>&sfl=mb_id&stx=<?php echo $row['mb_id']; ?>" id="member_add" class="btn btn_01">메모</a>

                    </td>
                    <td headers="mb_list_cert"  rowspan="2" class="td_mbcert">
                        <span class="sms_agree_yn" style="cursor: pointer" data-mb_id="<?php echo $row['mb_id']; ?>" data-mb_name="<?php echo $row['mb_name']; ?>">SMS수신(<?php echo( $row['mb_sms']=='Y')?'<span style="color:#f00;">Y</span>':'N'; ?>)</span>
                        <br>
                        약관동의(<?php echo ($row['mb_certify']=='Y')?'<span style="color:#f00;">Y</span>':'N'; ?>)
                    </td>
                    <td headers="mb_list_cert"  rowspan="2" class="td_mbcert">
                        <?php

                        if($row['mb_certify']=='N' || $row['mb_certify']==''){
                            ?>
                            <a href="#none"  class="btn btn_03 yak" data-mb_id="<?php echo $row['mb_id']; ?>" data-mb_name="<?php echo $row['mb_name']; ?>" data-hp = "<?php echo $row['mb_hp']; ?>" >약관동의 요청</a>
                        <?php } else { ?>
                            <a href="javascript:;" onclick="swal('','이미 약관에 동의 하셨습니다.','info')"  class="btn btn_03" >약관동의 완료</a>
                        <?php } ?>
                    </td>
                    <td headers="mb_list_cert"  rowspan="2" class="td_mbcert">
                        <a href="./member_pay_form.php?mb_id=<?php echo $row['mb_id']; ?>&sfl=<?php echo $_REQUEST['sfl']; ?>&stx=<?php echo $_REQUEST['stx']; ?>"  class="btn btn_03" >결제하기</a>
                    </td>
                    <td headers="mb_list_cert"  rowspan="2" class="td_mbcert">
                        <a href="./member_send_now_form.php?mb_id=<?php echo $row['mb_id']; ?>" data-mb_name="<?php echo $row['mb_name']; ?>" data-mb_id="<?php echo $row['mb_id']; ?>" class="btn btn_03 member_send_now" data-backdrop="static" data-toggle="modal" data-target="#send_sms_now"  >즉시전송</a><span style="color:#000;"><br>(<?php echo $remind_lotto_cnt;?>조합)<br><?php echo $str; ?></span>
                    </td>
                    <td headers="mb_list_mailc">
                        <select name="pay[]" id="pay_money<?php echo $i;?>" class="pay_money" style="width:150px;">
                            <option value="">금액선택</option>
                            <?php
                            $que = "SELECT * FROM g5_pay_type WHERE pay_use_yn = 'Y' AND idx NOT IN (1,2)";
                            $que_res = sql_query($que);
                            while($arr = sql_fetch_array($que_res)){
                                ?>
                                <option value="<?php echo $arr['idx']; ?>"><?php echo $arr['pay_name'].''.number_format($arr['pay_money']);?>원 </option>
                            <?php } ?>
                        </select>
                        <a href="#"  class="btn btn_03 member_bank_sms" data-mb_id = "<?php echo $row['mb_id']; ?>" data-mb_name = "<?php echo $row['mb_name'];?>" data-hp = "<?php echo $row['mb_hp']; ?>" data-no="<?php echo $i; ?>" >계좌전송</a>
                    </td>

                    <td headers="mb_list_auth" class="td_mbstat">
                        <?php
                        if ($leave_msg || $intercept_msg) echo $leave_msg.' '.$intercept_msg;
                        else echo "정상";
                        ?>
                    </td>
                    <td headers="mb_list_mobile" class="td_tel"><?php echo get_text($row['mb_hp']); ?></td>
                    <td headers="mb_list_lastcall" class="td_date"><?php echo substr($row['mb_today_login'],2,8); ?></td>
                    <td headers="mb_list_grp" class="td_numsmall"><?php echo $group ?></td>
                    <td headers="mb_list_mng" rowspan="2" class="td_mng td_mng_s"><?php echo $s_mod ?><?php echo $s_grp ?></td>
                </tr>
                <tr class="<?php echo $bg; ?>">
                    <td headers="mb_list_name" class="td_mbname"><?php echo get_text($row['mb_name']); ?></td>
                    <td headers="mb_list_nick" class="td_name sv_use"><div><?php echo $mb_nick ?></div></td>

                    <td headers="mb_list_sms">
                        <!--<a href="#"  class="btn btn_03 member_quick_sms" data-mb_id = "<?php /*echo $row['mb_id']; */?>" data-hp = "<?php /*echo $row['mb_hp']; */?>">번호발송</a>-->
                    </td>

                    <td headers="mb_list_auth" class="td_mbstat">
                        <select name="member_grade" id="member_grade">
                            <?php
                            $que = "SELECT * FROM g5_pay_type WHERE pay_use_yn = 'y' ORDER BY idx ";
                            $res = sql_query($que);
                            while($arr = sql_fetch_array($res)){
                                ?>
                                <option value="<?php echo $arr['idx']; ?>" <?php echo ($arr['idx']==$row['mb_10'])?'selected':''; ?>><?php echo $arr['pay_name']; ?>(<?php echo number_format($arr['pay_money']); ?>)</option>
                            <?php } ?>
                        </select>
                    </td>
                    <td headers="mb_list_tel" class="td_tel"><?php echo get_text($row['mb_tel']); ?></td>
                    <td headers="mb_list_join" class="td_date"><?php echo substr($row['mb_datetime'],2,8); ?></td>
                    <td headers="mb_list_point" class="td_num"><a href="point_list.php?sfl=mb_id&amp;stx=<?php echo $row['mb_id'] ?>"><?php echo number_format($row['mb_point']) ?></a></td>

                </tr>

                <?php
            }
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

    <div class="btn_fixed_top">
        <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02">
        <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
        <?php// if ($is_admin == 'super') { ?>
        <a href="./member_add_popup.php" id="member_add" class="btn btn_01" data-toggle="modal" data-target="#myModal">회원추가</a>
        <?php// } ?>

    </div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
    function fmemberlist_submit(f)
    {
        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        if(document.pressed == "선택삭제") {
            if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
                return false;
            }
        }

        return true;
    }

    $(document).ready(function(){

        //계좌문자 전송
        $('.member_bank_sms').on('click',function(){
            if(confirm('해당 회원에게 계좌문자를 발송 하시겠습니까?')){
                var no = $(this).data('no');
                var money_idx = $('#pay_money'+no+' option:selected').val();
                var money = $('#pay_money'+no+' option:selected').text();
                var bank = 'KB국민은행 224601-04-228351 (주)더블에이치컴퍼니 '+money;
                var hp = $(this).data('hp');
                var id = $(this).data('mb_id');

                if(hp == ''){
                    alert('등록된 휴대폰 번호가 없습니다.');
                    return false;
                }

                if(id == ''){
                    alert('등록된 아이디가 없습니다.');
                    return false;
                }

                if(bank == ''){
                    alert('등록된 은행계좌가 없습니다.');
                    return false;
                }

                /*if(no == ''){
                    alert('결제 타입을 선택해주세요.');
                    return false;
                }*/
                $.ajax({
                    type: "POST",
                    url: "./pay_ajax_proc.php",
                    data: { mode : 'bankSms', bank : bank, hp:hp, mb_id:id, pay_idx : money_idx, money : money },
                    dataType: "json",
                    success: function(data) {
                        //alert(data.result);
                        swal('',data_result,'success');
                    }
                });
            }
        });

        //당첨번호 즉시 발급
        $('.member_quick_sms').on('click',function(){
            if(confirm('해당 회원에게 금주의 당첨번호를 발송 하시겠습니까?')){
                var hp = $(this).data('hp');
                var id = $(this).data('mb_id');

                if(hp == ''){
                    alert('등록된 휴대폰 번호가 없습니다.');
                    return false;
                }

                if(id == ''){
                    alert('등록된 아이디가 없습니다.');
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: "./pay_ajax_proc.php",
                    data: { mode : 'lottoSms', hp:hp, mb_id:id },
                    dataType: "json",
                    success: function(data) {
                        alert(data.result);
                    }
                });
            }
        });



        $('.yak').on('click',function(){
            var mb_id = $(this).data('mb_id');
            var name = $(this).data('mb_name');
            var hp = $(this).data('hp');
            swal({
                text: name+"님에게 약관동의 문자를 보내시겠습니까?",
                type: "info",
                showCancelButton: true,
                confirmButtonText: '확인',
                cancelButtonText: "취소",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type : 'POST',
                        url : './member_ajax.php',
                        data : 'mode=yak&id='+mb_id+'&hp='+hp,
                        success : function(res){
                            //if(res == true){
                            swal('','약관동의 문자가 전송되었습니다.','success');
                            //} else {
                            //swal('','약관동의 문자가 전송되지 않았습니다..','warning');
                            //}

                        }
                    })
                } else {

                }
            });
        });

        $('.sms_agree_yn').on('click',function(){
            var mb_id = $(this).data('mb_id');
            var name = $(this).data('mb_name');
            swal({
                text: name+"님 SMS수신 동의 하시겠습니까?",
                type: "info",
                showCancelButton: true,
                confirmButtonText: '확인',
                cancelButtonText: "취소",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type : 'POST',
                        url : './member_ajax.php',
                        data : 'mode=smsAgreeYn&id='+mb_id,
                        success : function(res){
                            if(res == true){
                                swal('','SMS수신 동의가 완료되었습니다.','success');
                                location.reload(true);
                            } else {
                                swal('','sms수신 동의에 오류가 있습니다.','warning');
                            }

                        }
                    })
                } else {

                }
            });
        });



    });


</script>

<?php
include_once ('./admin.tail.php');
?>

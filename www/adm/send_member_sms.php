<?php
include_once('./_common.php');
if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $mb['mb_mailling'] = 1;
    $mb['mb_open'] = 1;
    $mb['mb_level'] = $config['cf_register_level'];
    $html_title = '추가';
}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    /*if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');*/

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $mb['mb_name'] = get_text($mb['mb_name']);
    $mb['mb_nick'] = get_text($mb['mb_nick']);
    $mb['mb_email'] = get_text($mb['mb_email']);
    $mb['mb_homepage'] = get_text($mb['mb_homepage']);
    $mb['mb_birth'] = get_text($mb['mb_birth']);
    $mb['mb_tel'] = get_text($mb['mb_tel']);
    $mb['mb_hp'] = get_text($mb['mb_hp']);
    $mb['mb_addr1'] = get_text($mb['mb_addr1']);
    $mb['mb_addr2'] = get_text($mb['mb_addr2']);
    $mb['mb_addr3'] = get_text($mb['mb_addr3']);
    $mb['mb_signature'] = get_text($mb['mb_signature']);
    $mb['mb_recommend'] = get_text($mb['mb_recommend']);
    $mb['mb_profile'] = get_text($mb['mb_profile']);
    $mb['mb_1'] = get_text($mb['mb_1']);
    $mb['mb_2'] = get_text($mb['mb_2']);
    $mb['mb_3'] = get_text($mb['mb_3']);
    $mb['mb_4'] = get_text($mb['mb_4']);
    $mb['mb_5'] = get_text($mb['mb_5']);
    $mb['mb_6'] = get_text($mb['mb_6']);
    $mb['mb_7'] = get_text($mb['mb_7']);
    $mb['mb_8'] = get_text($mb['mb_8']);
    $mb['mb_9'] = get_text($mb['mb_9']);
    $mb['mb_10'] = get_text($mb['mb_10']);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

// 본인확인방법
switch($mb['mb_certify']) {
    case 'hp':
        $mb_certify_case = '휴대폰';
        $mb_certify_val = 'hp';
        break;
    case 'ipin':
        $mb_certify_case = '아이핀';
        $mb_certify_val = 'ipin';
        break;
    case 'admin':
        $mb_certify_case = '관리자 수정';
        $mb_certify_val = 'admin';
        break;
    default:
        $mb_certify_case = '';
        $mb_certify_val = 'admin';
        break;
}

// 본인확인
$mb_certify_yes  =  $mb['mb_certify'] ? 'checked="checked"' : '';
$mb_certify_no   = !$mb['mb_certify'] ? 'checked="checked"' : '';

// 성인인증
$mb_adult_yes       =  $mb['mb_adult']      ? 'checked="checked"' : '';
$mb_adult_no        = !$mb['mb_adult']      ? 'checked="checked"' : '';

//메일수신
$mb_mailling_yes    =  $mb['mb_mailling']   ? 'checked="checked"' : '';
$mb_mailling_no     = !$mb['mb_mailling']   ? 'checked="checked"' : '';

// SMS 수신
$mb_sms_yes         =  $mb['mb_sms']        ? 'checked="checked"' : '';
$mb_sms_no          = !$mb['mb_sms']        ? 'checked="checked"' : '';

// 정보 공개
$mb_open_yes        =  $mb['mb_open']       ? 'checked="checked"' : '';
$mb_open_no         = !$mb['mb_open']       ? 'checked="checked"' : '';


if (isset($mb['mb_certify'])) {
    // 날짜시간형이라면 drop 시킴
    if (preg_match("/-/", $mb['mb_certify'])) {
        sql_query(" ALTER TABLE `{$g5['member_table']}` DROP `mb_certify` ", false);
    }
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_certify` TINYINT(4) NOT NULL DEFAULT '0' AFTER `mb_hp` ", false);
}

if(isset($mb['mb_adult'])) {
    sql_query(" ALTER TABLE `{$g5['member_table']}` CHANGE `mb_adult` `mb_adult` TINYINT(4) NOT NULL DEFAULT '0' ", false);
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_adult` TINYINT NOT NULL DEFAULT '0' AFTER `mb_certify` ", false);
}

// 지번주소 필드추가
if(!isset($mb['mb_addr_jibeon'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr_jibeon` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 건물명필드추가
if(!isset($mb['mb_addr3'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr3` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 중복가입 확인필드 추가
if(!isset($mb['mb_dupinfo'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_dupinfo` varchar(255) NOT NULL DEFAULT '' AFTER `mb_adult` ", false);
}

// 이메일인증 체크 필드추가
if(!isset($mb['mb_email_certify2'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_email_certify2` varchar(255) NOT NULL DEFAULT '' AFTER `mb_email_certify` ", false);
}

if ($mb['mb_intercept_date']) $g5['title'] = "차단된 ";
else $g5['title'] .= "";
$g5['title'] .= '회원 '.$html_title;
include_once('./admin.head.popup.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>


    <input type="hidden" name="mb_id" id="mb_id" value="<?php echo $_REQUEST['mb_id']; ?>">
    <div class="tbl_frm01 tbl_wrap" style="margin:30px;">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col class="grid_4">
                <col>
                <col class="grid_4">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>문자내용</th>
                <th colspan="3">
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                </th>                
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_id">받는사람번호<?php echo $sound_only ?></label></th>
                <td colspan="2">
                    <input type="text" name="mb_hp" value="<?php echo $_REQUEST['hp'] ?>" required id="mb_hp" class="frm_input <?php echo $required_mb_id_class ?>" readonly size="15" minlength="3" maxlength="20">
                </td>                
            </tr>
            <tr>
                <th scope="row"><label for="mb_name">보내는사람<strong class="sound_only">필수</strong></label></th>
                <td colspan="2"><input type="text" name="mb_name" value="032-710-7988" id="mb_name" required class="required frm_input" readonly size="15" maxlength="20"></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td><a href="./member_list.php?<?php echo $qstr ?>" class="btn btn_02">닫기</a></td>
                <td colspan="2"><input type="button" value="문자발송" class="btn_submit btn" accesskey='s'></td>
            </tr>

            </tbody>
        </table>
    </div>




<script>
    $('.btn_submit.btn').on('click',function(){
        if($('#message').val() == ''){
            swal('','문자 메세지 내용을 입력해주세요.','warning');
            $(this).focus();
            return false;
        }
        if($('#mb_hp').val()==''){
            swal('','받는 사람 번호가 없습니다.','warning');
            $('#mb_hp').focus();
            return false;
        }
        if($('#mb_id').val()==''){
            swal('','받는 사람 아이디가 없습니다.','warning');
            return false;
        }

        var mb_id = $('#mb_id').val(),
            mb_hp = $('#mb_hp').val(),
            message = $('#message').val();
        swal({
            text : '해당 회원에게 문자메세지를 보내시겠습니까?',
            type: "info",
            cancelButtonText : '취소',
            confirmButtonText : '문자발송',
            showCancelButton : true
        }).then(function (isConfirm) {
            if(isConfirm){
                $.ajax({
                    type : 'POST',
                    url : './member_proc.php',
                    dataType : "json",
                    data : {mode: "sendMemberSms", mb_id:mb_id, mb_hp:mb_hp, message:encodeURIComponent(message)},
                    success : function(data){
                        console.log(data);
                        if(data.error == false){
                            swal('','문자가 정상적으로 발송되었습니다.','success');
                            setTimeout(function(){location.reload(true)},2000);
                        } else {
                            swal('','문자발송시 오류가 발생했습니다.('+data.result+')','warning');
                        }
                    }
                })
            }
        })
    });

</script>


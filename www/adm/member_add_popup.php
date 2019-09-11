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

<form name="fmember" id="fmember" action="./member_form_update_popup.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
    <input type="hidden" name="w" value="">
    <input type="hidden" name="token" value="">
    <input type="hidden" name="hp_yn" id="hp_yn" value="n">
    <input type="hidden" name="already_mb" id="already_mb" value="n">
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
                <th>핸드번번호 검색</th>
                <th colspan="3">
                    <select name="hp1" id="hp1">
                        <option value="010">010</option>
                    </select>
                    -
                    <input type="text" name="hp2" id="hp2" value="" class="required frm_input" placeholder="" size="7">
                    -
                    <input type="text" name="hp3" id="hp3" value="" class="required frm_input" placeholder="" size="7">
                </th>
                <th><a href="javascript:;" id="search_hp" class="btn btn_02">검색</a></th>
            </tr>

            </thead>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="mb_id" value="" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="15" minlength="3" maxlength="20">
                    <?php if ($w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>">접근가능그룹보기</a><?php } ?>
                </td>
                <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
                <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20" value=""></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_name">이름(실명)<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="15" maxlength="20"></td>
                <th scope="row"><label for="mb_hp"></label></th>
                <td><input type="hidden" name="mb_hp" value="" id="mb_hp" class="frm_input" size="15" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_level">휴대폰번호</label></th>
                <td colspan="3">
                    <span class="hp_text" style="display:block"></span>
                    <span class="hp_status" style="display:block">상태(가입가능,가입 대기회원, 가입완료회원)</span>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_level">회원 권한</label></th>
                <td colspan="3">
                    <select name="grade" id="grade">
                        <option value="">등급선택</option>
                        <option value="99">가입대기</option>
                        <option value="2">일반</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td><a href="./member_list.php?<?php echo $qstr ?>" class="btn btn_02">닫기</a></td>
                <td colspan="2"><input type="submit" value="등록" class="btn_submit btn" accesskey='s'></td>
            </tr>

            </tbody>
        </table>
    </div>


</form>

<script>
    function fmember_submit(f)
    {
        var lv = $('#grade option:selected').val();
        if($('#hp_yn').val() == 'n'){
            swal('','상담에서 휴대폰 번호를 먼저 검색해주세요.','warning');
            return false;
        }
        if($('#already_mb').val() == 'y'){
            swal('','이미 가입된 회원입니다. 다른 핸드폰 번호를 입력해주세요.','warning');
            return false;
        }
        if(!lv) {
            swal('','변경할 회원권한을 선택해주세요.','warning');
            return false;
        }
        if(confirm('회원을 추가(변경) 하시겠습니까?')){
            return true;
        } else {
            location.reload(true);
            return false;
        }

    }

    $(document).ready(function(){
        $('#search_hp').on('click',function(){
            var hp1 = $('#hp1 option:selected').val(),
                hp2 = $('#hp2').val(),
                hp3 = $('#hp3').val()
            hp = '';
            if(hp1 =='' || hp2 == '' || hp3 == ''){
                alert('정상적인 휴대폰 번호를 입력하세요.');
                return false;
            }
            hp = hp1+hp2+hp3;
            $.ajax({
                type : 'POST',
                url : './member_ajax.php',
                data : 'mode=hpChk&hp='+hp,
                success : function(res){
                    var chk = $.trim(res);
                    if(chk > 1 && chk != 99){
                        $('.hp_status').text('가입완료 회원');
                        $('#already_mb').val('y');
                    } else if(chk == 99){
                        $('.hp_status').text('가입대기 회원');
                    } else {
                        $('#mb_hp').val(hp);
                        $('.hp_status').text('가입가능');
                    }
                    $('#hp_yn').val('y');
                    $('.hp_text').text(hp1+'-'+hp2+'-'+hp3);

                }
            });
        })

    });
</script>

<?php
//include_once('./admin.tail.php');
?>

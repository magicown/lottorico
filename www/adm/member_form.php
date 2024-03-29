<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

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
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col class="grid_4">
                <col>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" readonly  class="frm_input <?php echo $required_mb_id_class ?>" size="15" minlength="3" maxlength="20">
                    <!--<input type="button" value="아이디 변경" class="btn_submit btn" accesskey="s" id="id_change">-->
                    <?php /*if ($w=='u'){ */?><!--<a href="./boardgroupmember_form.php?mb_id=<?php /*echo $mb['mb_id'] */?>">접근가능그룹보기</a>--><?php /*} */?>
                </td>
                <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
                <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_name">이름(실명)<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="15" maxlength="20"></td>
                <th scope="row"><label for="mb_nick">닉네임<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_nick" value="<?php echo $mb['mb_nick'] ?>" id="mb_nick" class="frm_input" size="15" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_level">회원 권한</label></th>
                <td><?php echo get_member_level_select('mb_level', 1, $member['mb_level'], $mb['mb_level']) ?></td>
                <th scope="row">포인트</th>
                <td><a href="./point_list.php?sfl=mb_id&amp;stx=<?php echo $mb['mb_id'] ?>" target="_blank"><?php echo number_format($mb['mb_point']) ?></a> 점</td>
            </tr>
            <?php if($mb['as_date']) { ?>
                <tr>
                    <th scope="row"><label for="mb_level">이용 기간</label></th>
                    <td colspan="3">
                        <?php echo date("Y년 m월 d일 H시 i분 s초", $mb['as_date']);?>까지
                        :
                        ± <input type="text" name="as_date_plus" value="" id="as_date_plus" maxlength="20" class="frm_input" size="4"> 일 증감하기
                        &nbsp;
                        <label><input type="checkbox" value="1" name="as_leave" id="as_leave"> 멤버쉽 해제하기(※주의! 체크시 이용기간이 초기화됨)</label>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <th scope="row"><label for="mb_email">E-mail<!--<strong class="sound_only">필수</strong>--></label></th>
                <td><input type="text" name="mb_email" value="<?php echo $mb['mb_email'] ?>" id="mb_email" maxlength="100"  class="frm_input email" size="30"></td>
                <th scope="row"><label for="mb_homepage">홈페이지</label></th>
                <td><input type="text" name="mb_homepage" value="<?php echo $mb['mb_homepage'] ?>" id="mb_homepage" class="frm_input" maxlength="255" size="15"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_hp">휴대폰번호</label></th>
                <td><input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input" size="15" maxlength="20"></td>
                <th scope="row"><label for="mb_tel">전화번호</label></th>
                <td><input type="text" name="mb_tel" value="<?php echo $mb['mb_tel'] ?>" id="mb_tel" class="frm_input" size="15" maxlength="20"></td>
            </tr>

            <tr>
                <th scope="row">주소</th>
                <td colspan="3" class="td_addr_line">
                    <label for="mb_zip" class="sound_only">우편번호</label>
                    <input type="text" name="mb_zip" value="<?php echo $mb['mb_zip1'].$mb['mb_zip2']; ?>" id="mb_zip" class="frm_input readonly" size="5" maxlength="6">
                    <button type="button" class="btn_frmline" onclick="win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
                    <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1'] ?>" id="mb_addr1" class="frm_input readonly" size="60">
                    <label for="mb_addr1">기본주소</label><br>
                    <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="60">
                    <label for="mb_addr2">상세주소</label>
                    <br>
                    <input type="text" name="mb_addr3" value="<?php echo $mb['mb_addr3'] ?>" id="mb_addr3" class="frm_input" size="60">
                    <label for="mb_addr3">참고항목</label>
                    <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>"><br>
                </td>
            </tr>

            <?php
            /*$que = "SELECT * FROM g5_auth WHERE 1";
            //echo $que;
            $res = sql_query($que);
            while($row = sql_fetch_array($res)){
                $id[] = $row['mb_id'];
            }

            if(!in_array($mb['mb_id'],$id)){*/
                ?>
                <tr>
                    <th scope="row"><label for="mb_1">문자 받을 요일 설정</label></th>
                    <td colspan="3">
                        <label class="radio-inline">
                            <table  style="width: 500px;">
                                <tr>
                                    <?php
                                    for($i=1;$i<=6;$i++){
                                        switch($i){
                                            /*case '7':
                                                $day_name = "일";
                                                break;*/
                                            case '1':
                                                $day_name = "월";
                                                break;
                                            case '2':
                                                $day_name = "화";
                                                break;
                                            case '3':
                                                $day_name = "수";
                                                break;
                                            case '4':
                                                $day_name = "목";
                                                break;
                                            case '5':
                                                $day_name = "금";
                                                break;
                                            case '6':
                                                $day_name = "토";
                                                break;
                                        }
                                        ?>
                                        <td><?php echo $day_name; ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <?php
                                    for($i=1;$i<=6;$i++){
                                        switch($i){
                                            /*case '7':
                                                $day_name = "일";
                                                break;*/
                                            case '1':
                                                $day_name1 = "mon";
                                                break;
                                            case '2':
                                                $day_name1 = "tue";
                                                break;
                                            case '3':
                                                $day_name1 = "wed";
                                                break;
                                            case '4':
                                                $day_name1 = "thu";
                                                break;
                                            case '5':
                                                $day_name1 = "fri";
                                                break;
                                            case '6':
                                                $day_name1 = "sat";
                                                break;
                                        }

                                        ?>
                                        <td>
                                            <select name="<?php echo $day_name1; ?>" id="<?php echo $day_name1; ?>">
                                                <?php
                                                for($k=0;$k<=100;$k++){
                                                    ?>
                                                    <option value="<?php echo $k;?>" <?php echo ($k==$mb[$day_name1.'_sms_cnt'])?'selected':''; ?>><?php echo $k;?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </label>
                    </td>
                    <td><!--<input type="button" value="요일변경적용" class="btn_03 btn" id="member_week_change" data-id="<?php /*echo $mb[mb_id]; */?>" accesskey="s" title="요일변경 적용">--></td>
                </tr>
            <?php //} ?>
            <tr>
                <th scope="row"><label for="mb_3">남은 문자 갯수</label></th>
                <td colspan="3">
                    <select name="mb_3" id="remind_num">
                        <?php
                        for($k=1;$k<=100;$k++){
                            ?>
                            <option value="<?php echo $k;?>" <?php echo ($mb['mb_3']==$k)?'selected':''; ?>><?php echo $k;?></option>
                            <?php
                        }
                        ?>
                    </select>
                    (회원에게 전송할 문자의 총 갯수 입니다.)
                </td>
            </tr>
            <!--<tr>
                <th scope="row"><label for="mb_2">남은번호갯수</label></th>
                <td colspan="3"><?php /*echo $rn = remind_take_num($mb['mb_id'],$mb['mb_3']);; */?> (남은 갯수 확인용)</td>
            </tr>-->
            <tr>
                <th scope="row"><label for="mb_10">유료 회원등급 분류</label></th>
                <td colspan="3">
                    <select name="mb_10" id="mb_10">
                        <option value="">분류를 선택해주세요.</option>
                        <?php
                        $que = "SELECT * FROM g5_pay_type WHERE pay_use_yn = 'y' ORDER BY pay_money ASC";
                        $res = sql_query($que);
                        while($arr = sql_fetch_array($res)){
                            ?>
                            <option value="<?php echo $arr[idx]; ?>" <?php echo ($arr[idx]==$mb['mb_10'])?'selected':''; ?>><?php echo $arr[pay_name]; ?>(<?php echo $arr[pay_money]; ?>)</option>
                            <?php
                        }
                        ?>
                    </select>
                    (유료 회원등급분류를 선택하시면 해당 등급에 맞는 종료일자가 자동으로 변경됩니다.)
                    <!--<input type="button" value="등급변경적용" class="btn_03 btn" id="member_grade_change" data-id="<?php /*echo $mb[mb_id]; */?>" accesskey="s" title="버튼을 눌러 회원등급을 유료 회원으로 변경하시면 금액이 포함되지 않는 회원정보가 유료 회원 및 기간으로 변경됨을 유의해주세요.">-->
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_2">유료 결제 종료일자</label></th>
                <td colspan="3"><input type="text" name="mb_2" value="<?php echo $mb['mb_2'] ?>" id="mb_2" class="frm_input" size="30" maxlength="255" > (무료회원 2개월도 포함됩니다.)
                    </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_2">종료일자 일시정지</label></th>
                <td colspan="3">
                    <input type="checkbox" name="mb_5" value="Y" <?php echo ($mb['mb_5']=='Y')?'checked':''; ?>>결제일자 일시정지 (체크하시면 유료 결제 종료일자가 자동적으로 하루씩 늘어납니다.)
                </td>
            </tr>
            <tr>
                <th scope="row">메일 수신</th>
                <td>
                    <input type="radio" name="mb_mailling" value="1" id="mb_mailling_yes" <?php echo $mb_mailling_yes; ?>>
                    <label for="mb_mailling_yes">예</label>
                    <input type="radio" name="mb_mailling" value="0" id="mb_mailling_no" <?php echo $mb_mailling_no; ?>>
                    <label for="mb_mailling_no">아니오</label>
                </td>
                <th scope="row"><label for="mb_sms_yes">SMS 수신</label></th>
                <td>
                    <input type="radio" name="mb_sms" value="Y" id="mb_sms_yes" <?php echo $mb_sms_yes; ?>>
                    <label for="mb_sms_yes">예</label>
                    <input type="radio" name="mb_sms" value="N" id="mb_sms_no" <?php echo $mb_sms_no; ?>>
                    <label for="mb_sms_no">아니오</label>
                </td>
            </tr>


            <?php if ($w == 'u') { ?>
                <tr>
                    <th scope="row">회원가입일</th>
                    <td><?php echo $mb['mb_datetime'] ?></td>
                    <th scope="row">최근접속일</th>
                    <td><?php echo $mb['mb_today_login'] ?></td>
                </tr>
                <tr>
                    <th scope="row">IP</th>
                    <td colspan="3"><?php echo $mb['mb_ip'] ?></td>
                </tr>
                <?php if ($config['cf_use_email_certify']) { ?>
                    <tr>
                        <th scope="row">인증일시</th>
                        <td colspan="3">
                            <?php if ($mb['mb_email_certify'] == '0000-00-00 00:00:00') { ?>
                                <?php echo help('회원님이 메일을 수신할 수 없는 경우 등에 직접 인증처리를 하실 수 있습니다.') ?>
                                <input type="checkbox" name="passive_certify" id="passive_certify">
                                <label for="passive_certify">수동인증</label>
                            <?php } else { ?>
                                <?php echo $mb['mb_email_certify'] ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>

            <?php if ($config['cf_use_recommend']) { // 추천인 사용 ?>
                <tr>
                    <th scope="row">추천인</th>
                    <td colspan="3"><?php echo ($mb['mb_recommend'] ? get_text($mb['mb_recommend']) : '없음'); // 081022 : CSRF 보안 결함으로 인한 코드 수정 ?></td>
                </tr>
            <?php } ?>

            <tr>
                <th scope="row"><label for="mb_leave_date">탈퇴일자</label></th>
                <td>
                    <input type="text" name="mb_leave_date" value="<?php echo $mb['mb_leave_date'] ?>" id="mb_leave_date" class="frm_input" maxlength="8">
                    <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_leave_date_set_today" onclick="if (this.form.mb_leave_date.value==this.form.mb_leave_date.defaultValue) {
this.form.mb_leave_date.value=this.value; } else { this.form.mb_leave_date.value=this.form.mb_leave_date.defaultValue; }">
                    <label for="mb_leave_date_set_today">탈퇴일을 오늘로 지정</label>
                </td>
                <th scope="row">접근차단일자</th>
                <td>
                    <input type="text" name="mb_intercept_date" value="<?php echo $mb['mb_intercept_date'] ?>" id="mb_intercept_date" class="frm_input" maxlength="8">
                    <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_intercept_date_set_today" onclick="if
(this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else {
this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; }">
                    <label for="mb_intercept_date_set_today">접근차단일을 오늘로 지정</label>
                </td>
            </tr>

            <?php
            //소셜계정이 있다면
            if(function_exists('social_login_link_account') && $mb['mb_id'] ){
                if( $my_social_accounts = social_login_link_account($mb['mb_id'], false, 'get_data') ){ ?>

                    <tr>
                        <th>소셜계정목록</th>
                        <td colspan="3">
                            <ul class="social_link_box">
                                <li class="social_login_container">
                                    <h4>연결된 소셜 계정 목록</h4>
                                    <?php foreach($my_social_accounts as $account){     //반복문
                                        if( empty($account) ) continue;

                                        $provider = strtolower($account['provider']);
                                        $provider_name = social_get_provider_service_name($provider);
                                        ?>
                                        <div class="account_provider" data-mpno="social_<?php echo $account['mp_no'];?>" >
                                            <div class="sns-wrap-32 sns-wrap-over">
                        <span class="sns-icon sns-<?php echo $provider; ?>" title="<?php echo $provider_name; ?>">
                            <span class="ico"></span>
                            <span class="txt"><?php echo $provider_name; ?></span>
                        </span>

                                                <span class="provider_name"><?php echo $provider_name;   //서비스이름?> ( <?php echo $account['displayname']; ?> )</span>
                                                <span class="account_hidden" style="display:none"><?php echo $account['mb_id']; ?></span>
                                            </div>
                                            <div class="btn_info"><a href="<?php echo G5_SOCIAL_LOGIN_URL.'/unlink.php?mp_no='.$account['mp_no'] ?>" class="social_unlink" data-provider="<?php echo $account['mp_no'];?>" >연동해제</a> <span class="sound_only"><?php echo substr($account['mp_register_day'], 2, 14); ?></span></div>
                                        </div>
                                    <?php } //end foreach ?>
                                </li>
                            </ul>
                            <script>
                                jQuery(function($){
                                    $(".account_provider").on("click", ".social_unlink", function(e){
                                        e.preventDefault();

                                        if (!confirm('정말 이 계정 연결을 삭제하시겠습니까?')) {
                                            return false;
                                        }

                                        var ajax_url = "<?php echo G5_SOCIAL_LOGIN_URL.'/unlink.php' ?>";
                                        var mb_id = '',
                                            mp_no = $(this).attr("data-provider"),
                                            $mp_el = $(this).parents(".account_provider");

                                        mb_id = $mp_el.find(".account_hidden").text();

                                        if( ! mp_no ){
                                            alert('잘못된 요청! mp_no 값이 없습니다.');
                                            return;
                                        }

                                        $.ajax({
                                            url: ajax_url,
                                            type: 'POST',
                                            data: {
                                                'mp_no': mp_no,
                                                'mb_id': mb_id
                                            },
                                            dataType: 'json',
                                            async: false,
                                            success: function(data, textStatus) {
                                                if (data.error) {
                                                    alert(data.error);
                                                    return false;
                                                } else {
                                                    alert("연결이 해제 되었습니다.");
                                                    $mp_el.fadeOut("normal", function() {
                                                        $(this).remove();
                                                    });
                                                }
                                            }
                                        });

                                        return;
                                    });
                                });
                            </script>

                        </td>
                    </tr>

                    <?php
                }   //end if
            }   //end if
            ?>




            <?php for ($i=1; $i<=10; $i++) { ?>
                <!--<tr>
        <th scope="row"><label for="mb_<?php /*echo $i */?>">여분 필드 <?php /*echo $i */?></label></th>
        <td colspan="3"><input type="text" name="mb_<?php /*echo $i */?>" value="<?php /*echo $mb['mb_'.$i] */?>" id="mb_<?php /*echo $i */?>" class="frm_input" size="30" maxlength="255"></td>
    </tr>-->
            <?php } ?>

            </tbody>
        </table>
    </div>

    <div class="btn_fixed_top">
        <a href="./member_memo_list.php?mb_id=<?php echo $mb['mb_id']; ?>&mb_name=<?php echo $mb['name']; ?>&sfl=mb_id&stx=<?php echo $mb['mb_id']; ?>" class="btn btn_03">메모보기</a>
        <a href="./member_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
        <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
    </div>
</form>

<script>
    function fmember_submit(f)
    {
        if (!f.mb_icon.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_icon.value) {
            alert('아이콘은 이미지 파일만 가능합니다.');
            return false;
        }

        if (!f.mb_img.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_img.value) {
            alert('회원이미지는 이미지 파일만 가능합니다.');
            return false;
        }


        return false;
    }

    $(document).ready(function(){
        $( document ).tooltip();

        //회원등급변경 적용하기
        $('#change_mem_grade').on('click',function(){
            if(confirm('회원등급을 변경하시면 기간 및 금액이 변경됩니다.\n\n정말로 변경하시겠습니까?')){

            }
        });

        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd',
            prevText: '이전 달',
            nextText: '다음 달',
            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            dayNames: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            showMonthAfterYear: true,
            yearSuffix: '년'
        });
        $( "#mb_2" ).datepicker();


        //회원등급변경
        $("#member_grade_change").on("change", function() {
            var sidx = $('#mb_10 option:selected').val(),
                mb_id = $(this).data('id');

            mode = 'memUpdateGrade';

            $.ajax({
                type: "POST",
                url: "./pay_ajax_proc.php",
                cache: false,
                async: false,
                data: { mode : mode, pay_idx : sidx, mb_id : mb_id },
                dataType: "json",
                success: function(data) {
                    alert(data.result);
                    location.reload(true);
                    return false;
                }
            });
        });

        //회원등급변경시 종료일자 변경
        $("#mb_10").on("change", function() {
            var sidx = $('#mb_10 option:selected').val();

            mode = 'getExpireDate';

            $.ajax({
                type: "POST",
                url: "./pay_ajax_proc.php",
                data: { mode : mode, pay_idx : sidx },
                dataType: "json",
                success: function(data) {
                    $('#mb_2').val(data.result);
                    return false;
                }
            });
        });
        /* 요일 변경 */
        $('#member_week_change').on('click',function(){
            var mon = $('#mon option:selected').val(),
                tue = $('#tue option:selected').val(),
                wed = $('#wed option:selected').val(),
                thu = $('#thu option:selected').val(),
                fri = $('#fri option:selected').val(),
                sat = $('#sat option:selected').val(),
                mb_id = '<?php echo $_REQUEST['mb_id'];?>';

            swal({
                text: name+"님 요일별 문자 발송갯수를 수정 하시겠습니까?",
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
                        data : 'mode=weekChange&id='+mb_id+'&mon='+mon+'&tue='+tue+'&wed='+wed+'&thu='+thu+'&fri='+fri+'&sat='+sat,
                        success : function(res){
                            if(res == true){
                                swal('','요일별 문자 발송갯수가 수정되었습니다.','success');
                            } else {
                                swal('','요일별 문자 발송갯수가 수정시 오류가 있습니다.','warning');
                            }

                        }
                    })
                } else {

                }
            });
        });

        $('#id_change').on('click',function(){
            var cur_id = $('#mb_id').val();
            console.log(cur_id);
            if(cur_id == '' || !cur_id){
                swal('','변경할 아이디를 입력해주세요.','warning');
                return false;
            }
            swal({
                text: "아이디를 변경 하시겠습니까?",
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
                        url : './member_ajax.php',
                        data : 'mode=weekChange&id='+mb_id+'&mon='+mon+'&tue='+tue+'&wed='+wed+'&thu='+thu+'&fri='+fri+'&sat='+sat,
                        success : function(res){
                            if(res == true){
                                swal('','요일별 문자 발송갯수가 수정되었습니다.','success');
                            } else {
                                swal('','요일별 문자 발송갯수가 수정시 오류가 있습니다.','warning');
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
include_once('./admin.tail.php');
?>

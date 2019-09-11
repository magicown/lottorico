<?php
$sub_menu = "200100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');



//auth_check($auth[$sub_menu], 'w');

//check_admin_token();

$mb_id = trim($_POST['mb_id']);

$mb_hp = str_replace("-","",$mb_hp);

$sql_common = "  mb_name = '{$_POST['mb_name']}',                 
                 mb_hp = '{$mb_hp}',
                 mb_level = '{$grade}', 
                 mb_open = NOW()
                 ";


$mb = get_member($mb_id);
if ($mb['mb_id'])
    alert('이미 존재하는 회원아이디입니다.\\nＩＤ : '.$mb['mb_id'].'\\n이름 : '.$mb['mb_name'].'\\n닉네임 : '.$mb['mb_nick'].'\\n메일 : '.$mb['mb_email']);

sql_query(" insert into {$g5['member_table']} set mb_id = '{$mb_id}', mb_password = '".get_encrypt_string($mb_password)."', mb_datetime = '".G5_TIME_YMDHIS."', member_grade_date = '".G5_TIME_YMDHIS."', mb_ip = '{$_SERVER['REMOTE_ADDR']}', mb_email_certify = '".G5_TIME_YMDHIS."', {$sql_common} ");



/*goto_url('./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$mb_id, false);*/
?>
<script>
    alert('회원이 추가(변경)되었습니다.');
    location.href = './member_list.php?sfl=mb_id&stx=<?php echo $mb_id;?>';
</script>

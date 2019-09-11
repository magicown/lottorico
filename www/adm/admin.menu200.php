<?php
$menu['menu200'] = array (
    array('200000', '회원관리', G5_ADMIN_URL.'/member_list.php', 'member'),
    array('200100', '회원관리', G5_ADMIN_URL.'/member_list.php', 'mb_list'),
    array('200120', '회원등급변경', G5_ADMIN_URL.'/member_grade_list.php', 'mb_list'),
    array('200110', '회원등급변경 로그', G5_ADMIN_URL.'/member_log_list.php', 'mb_list'),
    array('200150', '알람리스트', G5_ADMIN_URL.'/member_alarm_list.php', 'mb_list'),
    array('200140', '회원당첨통계', G5_ADMIN_URL.'/member_win_list.php', 'mb_search', 1),
    array('200130', '제외수관리', G5_ADMIN_URL.'/except_num.php', 'mb_list'),
    array('200900', '필터링관리', G5_ADMIN_URL.'/filter_conf.php', 'mb_list'),
    array('200400', '회원문자발송이력', G5_ADMIN_URL.'/sms_send_log.php', 'mb_delete', 1),
    array('200500', '광고 리스트', G5_ADMIN_URL.'/landing_list.php', 'mb_delete', 1),
    array('200600', '금일발송할회원목록', G5_ADMIN_URL.'/today_send_member_list.php', 'mb_delete', 1),
    array('200300', '회원메일발송', G5_ADMIN_URL.'/mail_list.php', 'mb_mail'),
    array('200800', '접속자집계', G5_ADMIN_URL.'/visit_list.php', 'mb_visit', 1),
    array('200810', '접속자검색', G5_ADMIN_URL.'/visit_search.php', 'mb_search', 1),
    array('200820', '접속자로그삭제', G5_ADMIN_URL.'/visit_delete.php', 'mb_delete', 1)/*,
    array('200200', '포인트관리', G5_ADMIN_URL.'/point_list.php', 'mb_point'),
    array('200900', '투표관리', G5_ADMIN_URL.'/poll_list.php', 'mb_poll')*/
);
?>
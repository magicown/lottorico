<?php
$menu['menu250'] = array (
    array('250000', '결제관리', G5_ADMIN_URL.'/pay_report_list.php', 'member'),
    array('250000', '결제관리', G5_ADMIN_URL.'/pay_report_list.php', 'mb_list'),
    array('250500', '무통장입금', G5_ADMIN_URL.'/pay_bank_list.php', 'mb_mail'),
    array('250100', '상품타입 생성/수정', G5_ADMIN_URL.'/pay_config_form.php', 'cf_basic'),
    array('250200', '상품타입 변경/이력확인', G5_ADMIN_URL.'/pay_change_form.php', 'cf_basic'),
    /*array('250300', '입금상황통계', G5_ADMIN_URL.'/mail_list.php', 'mb_mail'),*/

    /*array('250400', '카드/핸드폰', G5_ADMIN_URL.'/card_hp_list.php', 'mb_mail'),
    array('250410', '카드/핸드폰(TPAY)', G5_ADMIN_URL.'/card_hp_tpay_list.php', 'mb_mail'),*/
    array('250420', '핸드폰(빌게이트)', G5_ADMIN_URL.'/hp_billgate_list.php', 'mb_mail')
    /*,
    array('200200', '포인트관리', G5_ADMIN_URL.'/point_list.php', 'mb_point'),
    array('200900', '투표관리', G5_ADMIN_URL.'/poll_list.php', 'mb_poll')*/
);
?>
<?php
$sub_menu = "200130";
include_once('./_common.php');

if($_SESSION['ss_mb_level']<10){
    alert('메뉴를 볼 권한이 없습니다.');
}
auth_check($auth[$sub_menu], 'r');

//아미나빌더 설치체크
if(!isset($config['as_thema'])) {
    goto_url('./apms_admin/apms.admin.php');
}



if(!$config['cf_faq_skin']) $config['cf_faq_skin'] = "basic";
if(!$config['cf_mobile_faq_skin']) $config['cf_mobile_faq_skin'] = "basic";
if(!$config['as_tag_skin']) $config['as_tag_skin'] = "basic";
if(!$config['as_mobile_tag_skin']) $config['as_mobile_tag_skin'] = "basic";

$g5['title'] = '제외수 생성 및 수정 설정';
include_once ('./admin.head.php');

$pg_anchor = '<ul class="anchor">
    <li><a href="#anc_pay_reg">제외수 등록/수정</a></li>
    <li><a href="#anc_pay_list">제외수 목록</a></li>    
</ul>';

if (!$config['cf_icode_server_ip'])   $config['cf_icode_server_ip'] = '211.172.232.124';
if (!$config['cf_icode_server_port']) $config['cf_icode_server_port'] = '7295';

$que = "SELECT idx, hit_turn FROM lotto_hit_result WHERE 1 ORDER BY hit_turn ASC";
//echo $que;
$res = sql_query($que);
while($row = sql_fetch_array($res)) {
    $rs[] = $row;
}


$rs_cnt = count($rs)-1;

if($_REQUEST[turn]){
    $turn = $_REQUEST[turn];
}

?>


<input type="hidden" name="token" value="" id="token">

<section id="anc_pay_reg">
    <h2 class="h2_frm">제외수 설정</h2>
    <form name="f" method="get" action="/adm/except_num.php">
        <select name="turn" style="margin-bottom:10px;" onchange="document.f.submit();">
            <option value="<?php echo $rs['cnt']; ?>">::회차선택::</option>
            <option value="<?php echo $rs[$rs_cnt]['hit_turn']+1; ?>" <?php echo ($turn == $rs[$rs_cnt]['hit_turn']+1)?'selected':''; ?>><?php echo $rs[$rs_cnt]['hit_turn']+1; ?></option>
            <?php
            for($i=count($rs)-1;$i>=0;$i--){
                ?>
                <option value="<?php echo $rs[$i][hit_turn]; ?>" <?php echo ($turn == $rs[$i]['hit_turn'])?'selected':''; ?>><?php echo $rs[$i][hit_turn]; ?></option>
            <?php } ?>
        </select>

    </form>
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption>제외수 기본 설정</caption>
            <colgroup>
                <col class="grid_8">
                <col>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <?php
            if($turn){
                $cnt = 0;
                $que = "SELECT a.idx as pidx, a.pay_name, a.pay_money, a.pay_memo, b.idx, b.except_num FROM g5_pay_type a LEFT JOIN g5_except_num b ON a.idx = b.pay_idx WHERE 1";
                $res = sql_query($que);
                while($arr = sql_fetch_array($res)){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $arr[pay_name]; ?> - <?php echo number_format($arr[pay_money]); ?> [ <?php echo $arr['pay_memo']; ?> ]</th>
                        <td>
                            <input type="hidden" name="idx" value="">
                            <input type="text" class="required frm_input grid_16" name="except_num" id="except_num<?php echo $cnt; ?>" value="<?php echo getExceptNum($turn,$arr[pidx]); ?>" placeholder="제외수 입력하세요. 제외수가 여러개일때는 콤마로 구분해주세요.">
                            <input type="button" value="<?php echo ($arr[idx])?'수정':'등록'; ?>" class="btn_03 btn reg-btn" data-idx="<?php echo $arr[idx]; ?>" data-num="<?php echo $cnt; ?>" data-pidx="<?php echo $arr[pidx]; ?>" accesskey="s">
                        </td>
                    </tr>
                    <?php $cnt++; }} else { ?>
                <tr><td colspan="2"> 등록된 정보가 없습니다. 회차를 선택해주세요.</td></tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <script>
        $(function(){

            $(".reg-btn").on("click", function() {
                var idx = $(this).data('idx'),
                    pay_idx = $(this).data('pidx'),
                    num = $(this).data('num'),
                    turn = '<?php echo $turn; ?>',
                    exp_num = $('#except_num'+num).val();

                /*if(!pay_idx || !exp_num || !turn){
                    swal('','정보가 정상적으로 넘어오지 않았습니다.','warning');
                    return false;
                }*/

                $.ajax({
                    type: "POST",
                    url: "./pay_ajax_proc.php",
                    cache: false,
                    async: false,
                    data: { mode : 'exceptNum', exp_num : exp_num, pay_idx : pay_idx, idx : idx, turn : turn },
                    dataType: "json",
                    success: function(data) {
                        swal('',data.result,'info');
                        setTimeout(function(){ location.reload(); },2000);
                        return false;
                    }
                });
            });

        });
    </script>


    <?php
    include_once ('./admin.tail.php');
    ?>



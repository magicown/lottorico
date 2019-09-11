<?php
$sub_menu = "250200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

//아미나빌더 설치체크
if(!isset($config['as_thema'])) {
    goto_url('./apms_admin/apms.admin.php');
}



if(!$config['cf_faq_skin']) $config['cf_faq_skin'] = "basic";
if(!$config['cf_mobile_faq_skin']) $config['cf_mobile_faq_skin'] = "basic";
if(!$config['as_tag_skin']) $config['as_tag_skin'] = "basic";
if(!$config['as_mobile_tag_skin']) $config['as_mobile_tag_skin'] = "basic";

$g5['title'] = '결제타입 변경 및 이력확인';
include_once ('./admin.head.php');

$pg_anchor = '<ul class="anchor">
    <li><a href="#anc_pay_reg">결제 수정</a></li>
    <li><a href="#anc_pay_list">결제 목록</a></li>    
</ul>';

if (!$config['cf_icode_server_ip'])   $config['cf_icode_server_ip'] = '211.172.232.124';
if (!$config['cf_icode_server_port']) $config['cf_icode_server_port'] = '7295';



?>


    <input type="hidden" name="token" value="" id="token">

    <section id="anc_pay_reg">
        <h2 class="h2_frm">결제타입 가격 수정</h2>
        <?php echo $pg_anchor ?>

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <caption>결제 기본환경 설정</caption>
                <colgroup>
                    <col class="grid_4">
                    <col>
                    <col class="grid_4">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="cf_new_skin">결제타입 선택</label></th>
                    <td>
                        <?php echo get_pay_type_select() ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="cf_new_skin">결제 항목<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input type="hidden" name="idx" value="">
                        <input type="text" name="pay_name" class="required frm_input" value="" style="width:200px;" readonly placeholder="">
                        <input type="text" name="pay_money" class="required frm_input" value="" style="width:100px;" placeholder="결제금액입력">
                        <select name="use_yn">
                            <option value="y" <?php echo ($pay['pay_use_yn']=='y')?'selected':''; ?>>사용</option>
                            <option value="n" <?php echo ($pay['pay_use_yn']=='n')?'selected':''; ?>>미사용</option>
                        </select>

                        <input type="button" value="금액수정" class="btn_03 btn" id="pay_reg" accesskey="s"> (결제금액만 수정가능합니다.)
                    </td>
                </tr>

                </tbody>
            </table>
        </div>


<section id="anc_pay_list">
    <h2 class="h2_frm">등록된 결제방법 목록</h2>
    <?php echo $pg_anchor ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption>등록된 결제타입 목록</caption>
            <colgroup>
                <col class="grid_4">
                <col>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="cf_new_skin">변경일시</label></th>
                <th scope="row"><label for="cf_new_skin">작성자</label></th>
                <th scope="row"><label for="cf_new_skin">상품명</label></th>
                <th scope="row"><label for="cf_new_skin">변경전 가격</label></th>
                <th scope="row"><label for="cf_new_skin">변경후 가격</label></th>
                <th scope="row"><label for="cf_new_skin">사용여부</label></th>
            </tr>
            <?php
            $cnt = 0;
            $que = "SELECT * FROM g5_pay_type_log a LEFT JOIN g5_pay_type b ON a.pay_idx = b.idx WHERE a.org_money != a.chg_money OR a.chg_money  IS NULL ORDER BY reg_date DESC";
            $res = sql_query($que);
            while($pay = sql_fetch_array($res)){
                $mb_info = get_member_info($pay[change_id]);
                ?>
                <tr>
                    <td scope="row"><label for="cf_new_skin"><?php echo $pay[reg_date]; ?></label></td>
                    <td scope="row"><label for="cf_new_skin"><?php echo $mb_info['mb_name']; ?></label></td>
                    <td scope="row"><label for="cf_new_skin"><?php echo $pay[pay_name]; ?></label></td>
                    <td scope="row"><label for="cf_new_skin"><?php echo number_format($pay[org_money]); ?></label></td>
                    <td scope="row"><label for="cf_new_skin"><?php echo number_format($pay[chg_money]); ?></label></td>
                    <td scope="row"><label for="cf_new_skin"><?php echo $pay[reg_date]; ?></label></td>
                </tr>
                <?php
                $cnt++;
            }
            if(!$cnt){
            ?>
                <tr><td colspan="6" style="text-align:center; font-weight: bold;">등록된 상품명이 없습니다.</td></tr>
            <?php
            }
            ?>

            </tbody>
        </table>
    </div>

    <div class="btn_fixed_top btn_confirm">
        <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
    </div>

<script>
    $(function(){

        $("#pay_reg").on("click", function() {
            var pay_name = $("input[name='pay_name']").val(),
                pay_money = $("input[name='pay_money']").val(),
                pay_memo = $("input[name='pay_memo']").val(),
                pay_use = $("select[name='use_yn'] option:selected").val();

            if(!pay_name || !pay_money){
                alert('결제항목 및 결제금액을 입력해주세요.');
                return false;
            }

            idx = $("input[name='idx']").val();
            mode = 'payUpdatePirce';

            $.ajax({
                type: "POST",
                url: "./pay_ajax_proc.php",
                data: { mode : mode, pay_name : pay_name, pay_money : pay_money, pay_use : pay_use, idx : idx },
                dataType: "json",
                success: function(data) {
                    alert(data.result);
                    return false;

                }
            });
        });

        $('#pay_type').on('change',function(){

            var idx = $("option:selected",this).val();
            if(!idx){
                alert('선택된 상품타입이 없습니다. 다시 선택해주세요.');
                return false;
            } else if(idx == 'n'){
                $("input[name='idx']").val('');
                $("input[name='pay_name']").val('');
                $("input[name='pay_money']").val('');
                $("input[name='pay_memo']").val('');
                $("input[name='pay_use_yn'] option:eq(0)").attr('selected','selected');
                $("#pay_reg").val("등록");
                return false;
            }
            $.ajax({
                type: "POST",
                url: "./pay_ajax_proc.php",
                cache: false,
                async: false,
                data: { mode : "payUpdateChk", idx : idx },
                dataType: "json",
                success: function(data) {
                    if(data.error == true) {
                        alert(data.result);
                        return false;
                    } else {
                        $("input[name='idx']").val(idx);
                        $("input[name='pay_name']").val(data.rs['pay_name']);
                        $("input[name='pay_money']").val(data.rs['pay_money']);
                        $("input[name='pay_use_yn'] option:eq("+idx+")").attr('selected','selected');
                        $("#pay_reg").val("수정");
                    }
                }
            });
        });
    });
</script>

<?php
include_once ('./admin.tail.php');
?>

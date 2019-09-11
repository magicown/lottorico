<?php
$sub_menu = "250100";
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

$g5['title'] = '결제타입 생성 및 수정 설정 (최고관리자만 수정가능 및 접근가능)';
include_once ('./admin.head.php');

$pg_anchor = '<ul class="anchor">
    <li><a href="#anc_pay_reg">결제 등록/수정</a></li>
    <li><a href="#anc_pay_list">결제 목록</a></li>    
</ul>';

if (!$config['cf_icode_server_ip'])   $config['cf_icode_server_ip'] = '211.172.232.124';
if (!$config['cf_icode_server_port']) $config['cf_icode_server_port'] = '7295';



?>


    <input type="hidden" name="token" value="" id="token">

    <section id="anc_pay_reg">
        <h2 class="h2_frm">결제 기본환경 설정</h2>
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
                    <th scope="row"><label for="cf_new_skin">결제 항목 추가 및 수정<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <?php echo get_pay_type_select() ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="cf_new_skin">결제 항목<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input type="hidden" name="idx" value="">
                        <input type="text" name="pay_name" class="required frm_input" value="" style="width:200px;" placeholder="결제항목입력">
                        <input type="text" name="pay_money" class="required frm_input" value="" style="width:100px;" placeholder="결제금액입력">
                        <?php echo get_pay_date_select(); ?>
                        <input type="text" class="required frm_input" name="pay_memo" value="" style="width:300px;" placeholder="설명">
                        <select name="use_yn" id="use_yn">
                            <option value="y" <?php echo ($pay['pay_use_yn']=='y')?'selected':''; ?>>사용</option>
                            <option value="n" <?php echo ($pay['pay_use_yn']=='n')?'selected':''; ?>>미사용</option>
                        </select>

                        <input type="button" value="등록" class="btn_03 btn" id="pay_reg" accesskey="s">
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
                <th scope="row"><label for="cf_new_skin">번호</label></th>
                <th scope="row"><label for="cf_new_skin">상품명</label></th>
                <th scope="row"><label for="cf_new_skin">상품 가격</label></th>
                <th scope="row"><label for="cf_new_skin">상품기간(개월)</label></th>
                <th scope="row"><label for="cf_new_skin">상품설명</label></th>
                <th scope="row"><label for="cf_new_skin">사용여부</label></th>
                <th scope="row"><label for="cf_new_skin">등록/수정일</label></th>
            </tr>
            <?php
            $cnt = 0;
            $que = "SELECT * FROM g5_pay_type WHERE 1 ORDER BY pay_money DESC";
            $res = sql_query($que);
            while($pay = sql_fetch_array($res)){                
                
                ?>
                <tr>
                    <td scope="row"><label for="cf_new_skin"><?php echo $cnt+1; ?></label></td>
                    <td scope="row"><label for="cf_new_skin"><?php echo $pay[pay_name]; ?></label></td>
                    <td scope="row"><label for="cf_new_skin"><?php echo number_format($pay[pay_money]); ?></label></td>
                    <td scope="row"><label for="cf_new_skin"><?php echo $pay[pay_date]; ?>개월</label></td>
                    <td scope="row"><label for="cf_new_skin"><?php echo $pay[pay_memo]; ?></label></td>
                    <td scope="row"><label for="cf_new_skin"><?php echo ($pay[pay_use_yn]=='y')?'사용':'미사용'; ?></label></td>
                    <td scope="row"><label for="cf_new_skin"><?php echo $pay[pay_regdate]; ?></label></td>
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
                pay_date = $("select[name='pay_date'] option:selected").val();
                pay_use = $("select[name='use_yn'] option:selected").val();

            if(!pay_name || !pay_money || !pay_memo){
                alert('결제항목 및 결제금액 또는 설명을 입력해주세요.');
                return false;
            }

            if($(this).val() == '등록'){
                idx = null;
                mode = 'payReg';
            } else {
                idx = $("input[name='idx']").val();
                mode = 'payUpdate';
            }
            $.ajax({
                type: "POST",
                url: "./pay_ajax_proc.php",
                cache: false,
                async: false,
                data: { mode : mode, pay_name : pay_name, pay_money : pay_money, pay_use : pay_use, pay_memo : pay_memo, pay_date:pay_date, idx : idx },
                dataType: "json",
                success: function(data) {
                    alert(data.result);
                    location.reload(true);
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
                $("input[name='pay_date'] option:eq(0)").attr('selected','selected');
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
                        location.reload(true);
                        return false;
                    } else {

                        $("input[name='idx']").val(idx);
                        $("input[name='pay_name']").val(data.rs['pay_name']);
                        $("input[name='pay_money']").val(data.rs['pay_money']);
                        $("#pay_date").val(data.rs['pay_date']);
                        $("input[name='pay_memo']").val(data.rs['pay_memo']);
                        $("#use_yn").val(data.rs['pay_use_yn']);
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

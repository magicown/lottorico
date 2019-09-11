<?php
$sub_menu = "250100";
include_once('./_common.php');

//auth_check($auth[$sub_menu], 'w');

if($_GET['mb_id']==''){
    alert("아이디가 없습니다. 정상적인 방법으로 이용해주세요.");
}

$que = "SELECT * FROM g5_member WHERE mb_id = '{$_GET['mb_id']}'";
$mb = sql_fetch($que);


$ordernum = $mb['mb_id'].time();

$admin = get_admin_name();
$g5['title'] .= '상품결제 ';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>



<!--신용카드결제-->
    <div class="tbl_frm01 tbl_wrap" id="pay_type_card">
        <form name="fmember" id="fmember" action="./pay_proc.php"  onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
            <input type="hidden" name="orderNumber" value="<?php echo $ordernum ?>">
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
                <th scope="row"><label for="mb_id">성명<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name"class="frm_input <?php echo $required_mb_id_class ?>" size="15" minlength="3" maxlength="20">
                    <?php if ($w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>">접근가능그룹보기</a><?php } ?>
                </td>
                <th scope="row"><label for="mb_password">카드번호<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="cardNo1" id="cardNo" class="frm_input" size="10" required>
                    <input type="text" name="cardNo2" id="cardNo" class="frm_input" size="10" required >
                    <input type="text" name="cardNo3" id="cardNo" class="frm_input" size="10" required >
                    <input type="text" name="cardNo4" id="cardNo" class="frm_input" size="10" required >
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_name">핸드폰번호<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input" size="15" maxlength="20"></td>
                <th scope="row"><label for="mb_nick">유효기간<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="expireMonth" value="" id="expireMonth" required class="frm_input" size="5" maxlength="2"> /
                    <input type="text" name="expireYear" value="" id="expireMonth" required class="frm_input" size="5" maxlength="4">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="15" minlength="3" maxlength="20">
                </td>
                <th scope="row">비밀번호(앞2자리)</th>
                <td>
                    <input type="text" name="cardPw" value="" required id="cardPw" class="frm_input" size="5" minlength="2" maxlength="2">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_email">원하는 등급<!--<strong class="sound_only">필수</strong>--></label></th>
                <td>
                    <!--<input type="radio" name="pay_chk"  data-pay_name="테스트" data-pay_money="1000" value="999" > 테스트(1000) <br>-->
                    <?php
                        $que = "SELECT * FROM g5_pay_type  WHERE pay_use_yn = 'Y' AND idx NOT IN (1,2) ORDER BY pay_money ASC ";
                        $res_pay = sql_query($que);
                        while($pay = sql_fetch_array($res_pay)){
                    ?>
                    <input type="radio" name="pay_chk" data-pay_name="<?php echo $pay['pay_name']; ?>" data-pay_money="<?php echo number_format($pay['pay_money']); ?>" value="<?php echo $pay['idx'];?>"><?php echo $pay['pay_name']; ?>(<?php echo number_format($pay['pay_money']); ?>원)
                            <br>
                    <?php } ?>
                </td>
                <th scope="row"><label for="mb_homepage">생년월일</label></th>
                <td><input type="text" name="birthday" required value="" id="birthday" class="frm_input" maxlength="6" size="15"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_hp">결제정보</label></th>
                <td>
                        상품명 <input type="text" name="pay_name" required  id="pay_name" class="frm_input" size="15" maxlength="20" readonly>
                        금액 <input type="text" name="pay_money" required  id="pay_money" class="frm_input" size="15" maxlength="20" readonly>
                </td>
                <th scope="row"><label for="mb_tel">할부개월수</label></th>
                <td><input type="text" name="quota" required value="" class="frm_input" size="15" maxlength="20"></td>
            </tr>

            <tr>
                <th scope="row"><label for="mb_10">결제방식선택</label></th>
                <td colspan="3">
                    <input type="radio" name="pay_type" data-pay_type="bank" value="bank" onclick="show_type('bank');">무통장
                    <input type="radio" name="pay_type" data-pay_type="card" value="card" checked onclick="show_type('card');">신용카드
                    <input type="radio" name="pay_type" data-pay_type="hp" value="hp">휴대폰
                    <input type="radio" name="pay_type" data-pay_type="payup" value="payup">페이업
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <a href="./member_list.php?<?php echo $qstr ?>" class="btn btn_02">취소</a>
                    <input type="submit" value="결제하기" class="btn_submit btn" accesskey='s'>
                   
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>






<!--무통장 결제-->
<div class="tbl_frm01 tbl_wrap" id="pay_type_bank" style="display: ;">
    <form name="fmember2" id="fmember2" action="./pay_bank_proc.php"  onsubmit="return fmember_submit2(this);" target="hiddenFrm" method="post" enctype="multipart/form-data">
        <input type="hidden" name="orderNumber1" value="<?php echo $ordernum ?>">
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
                <th scope="row"><label for="mb_id">성명<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="mb_name1" value="<?php echo $mb['mb_name'] ?>/<?php echo $admin['mb_name'];?>" required id="mb_name"class="frm_input <?php echo $required_mb_id_class ?>" size="30" minlength="3" maxlength="20">
                </td>

            </tr>
            <tr>
                <th scope="row"><label for="mb_name">핸드폰번호<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" required id="mb_hp" class="frm_input" size="15" maxlength="20"></td>

            </tr>
            <tr>
                <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" readonly required id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="15" minlength="3" maxlength="20">
                </td>

            </tr>
            <tr>
                <th scope="row"><label for="mb_email">원하는 등급<!--<strong class="sound_only">필수</strong>--></label></th>
                <td>
                    <?php
                    $que = "SELECT * FROM g5_pay_type  WHERE pay_use_yn = 'Y' AND idx NOT IN (1,2) ORDER BY pay_money ASC ";
                    $res_pay = sql_query($que);
                    while($pay = sql_fetch_array($res_pay)){
                        ?>
                        <input type="radio" name="pay_chk1" data-pay_name="<?php echo $pay['pay_name']; ?>" data-pay_money="<?php echo number_format($pay['pay_money']); ?>" value="<?php echo $pay['idx'];?>"><?php echo $pay['pay_name']; ?>(<?php echo number_format($pay['pay_money']); ?>원)
                        <br>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_hp">은행정보</label></th>
                <td>
                    계좌정보
                    <select name="bank_num" id="bank_num">
                        <option value="국민은행 224601-04-228351">국민은행 224601-04-228351</option>
                        <option value="농협 355-0063-4331-53">농협 355-0063-4331-53</option>
                    </select>
                </td>

            </tr>
            <tr>
                <th scope="row"><label for="mb_hp">결제정보</label></th>
                <td>
                    상품명 <input type="text" name="pay_name" required  id="pay_name1" class="frm_input" size="30"ㄴ maxlength="20" >
                    금액 <input type="text" name="pay_money" required  id="pay_money1" class="frm_input" size="15" maxlength="20" >
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="mb_10">결제방식선택</label></th>
                <td colspan="3">
                    <input type="radio" name="pay_type" data-pay_type="bank" value="bank" onclick="show_type('bank');" checked>무통장
                    <input type="radio" name="pay_type" data-pay_type="card" value="card" onclick="show_type('card');">신용카드
                    <input type="radio" name="pay_type" data-pay_type="hp" value="hp">휴대폰
                    <input type="radio" name="pay_type" data-pay_type="payup" value="payup">페이업
                </td>
            </tr>
            <tr>
                <td colspan="5">

                    <a href="./member_list.php?sfl=<?php echo $_REQUEST['sfl']; ?>&stx=<?php echo $_REQUEST['stx']; ?>" class="btn btn_02">취소</a>
                    <input type="submit" value="결제하기" class="btn_submit btn" accesskey='s'>

                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

<iframe name="hiddenFrm" style="display:none;"></iframe>
<script>


    function fmember_submit2(f)
    {

        console.log('a');
        return true;
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
        $("#member_grade_change").on("click", function() {
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

        $('input[name="pay_chk"]').each(function(){
            $(this).on('click',function(){

                if($(this).is(':checked')==true){
                    $('#pay_name').val($(this).data('pay_name'));
                    $('#pay_money').val($(this).data('pay_money'));
                }
            });
        });

        $('input[name="pay_chk1"]').each(function(){
            $(this).on('click',function(){

                if($(this).is(':checked')==true){
                    $('#pay_name1').val($(this).data('pay_name'));
                    $('#pay_money1').val($(this).data('pay_money'));
                }
            });
        });

    });

    //결제방법 선택시

    $('input[name="pay_type"]').each(function(){
        var t = "";
        $(this).on('click',function(){
            t = $(this).val();
            $('input[name="pay_type"]').each(function(){
                console.log(t);
                if(this.value == t){
                    this.checked = true;
                }
            });
        });
    });
    function show_type(type){
        /*if(type == 'bank'){
            $('#pay_type_bank').show();
            $('#pay_type_card').hide();
        } else if(type == 'card'){
            $('#pay_type_bank').hide();
            $('#pay_type_card').show();
        }*/
    }

    function call_back(msg){
        if(msg == 'R000') {
            swal('','무통장 문자가 전송되었습니다.', 'success');
            $('input[name="pay_name"]').val('');
            $('input[name="pay_money"]').val('');
        } else {
            swal('전송에 문제가 있습니다.','sms로그'+msg, 'warning');
        }
    }


</script>

<?php
include_once('./admin.tail.php');
?>

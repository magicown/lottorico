<?php
$sub_menu = "200900";
include_once('./_common.php');

if($_SESSION['ss_mb_level']<10){
    alert('메뉴를 볼 권한이 없습니다.');
}
auth_check($auth[$sub_menu], 'r');


$g5['title'] = '필터링 설정 [필터링 수정시 실제 데이터 적용은 새벽3시에 실행되어 다음날 적용됩니다.]';
include_once ('./admin.head.php');

$pg_anchor = '<ul class="anchor">
    <li><a href="#anc_pay_reg">필터링 설정 [필터링 수정시 실제 데이터 적용은 새벽3시에 실행되어 다음날 적용됩니다.] </a></li>
        
</ul>';

$que = "SELECT * FROM filter_config WHERE 1 ";
//echo $que;
$row = sql_fetch($que);

/*쌍끝수*/
$chain_last = explode(",",$row['chain_last']);

//필터링 수정시 남은 번호 갯수

/*$que = "SELECT COUNT(idx) AS cnt FROM lotto_num WHERE 1 AND use_yn = 'n' AND set_filter_yn = 'Y' ";
$num_cnt = sql_fetch($que);*/

?>

<section >
    <h3>필터링 적용시 발송가능 번호 갯수 : <?php echo number_format($num_cnt['cnt']); ?>개</h3>
    <form name="f" method="post" action="./filter_config_action.php" enctype="multipart/form-data" target="ifrm">
        <div class="tbl_frm01 tbl_wrap">
            <table>
                <tbody>
                <tr>
                    <th>연번설정(선택시 제외)</th>
                    <td>
                        <input type="checkbox" name="serial_no_1" value="N" <?php echo ($row['chain_is_1']=='Y')?'checked':''; ?>> 2쌍(1연번)
                    </td>
                    <td>
                        <input type="checkbox" name="serial_no_2" value="N" <?php echo ($row['chain_is_2']=='Y')?'checked':''; ?> disabled> 3쌍(2연번)
                    </td>
                    <td>
                        <input type="checkbox" name="serial_no_3" value="N" <?php echo ($row['chain_is_3']=='Y')?'checked':''; ?> disabled> 4쌍(3연번)
                    </td>
                    <td>
                        <input type="checkbox" name="serial_no_4" value="N" <?php echo ($row['chain_is_4']=='Y')?'checked':''; ?> disabled> 5쌍(4연번)
                    </td>
                    <td colspan="4">
                        <input type="checkbox" name="serial_no_5" value="N" <?php echo ($row['chain_is_5']=='Y')?'checked':''; ?> disabled> 6쌍(5연번)
                    </td>
                </tr>
                <tr>
                    <th>쌍끝수(선택시 제외)</th>

                    <td>
                        <input type="checkbox" name="chain_last1" value="N" <?php echo ($row['chain_last1']=='N')?'checked':''; ?>> 2쌍
                    </td>
                    <td>
                        <input type="checkbox" name="chain_last2" value="N" <?php echo ($row['chain_last2']=='N')?'checked':''; ?> > 2쌍~2쌍
                    </td>
                    <td>
                        <input type="checkbox" name="chain_last3" value="N" <?php echo ($row['chain_last3']=='N')?'checked':''; ?> > 3쌍
                    </td>
                    <td>
                        <input type="checkbox" name="chain_last4" value="N" <?php echo ($row['chain_last4']=='N')?'checked':''; ?> > 2쌍~2쌍~2쌍
                    </td>
                    <td>
                        <input type="checkbox" name="chain_last5" value="N" <?php echo ($row['chain_last5']=='N')?'checked':''; ?> > 3쌍~2쌍
                    </td>
                    <td>
                        <input type="checkbox" name="chain_last6" value="N" <?php echo ($row['chain_last6']=='N')?'checked':''; ?> > 4쌍
                    </td>
                    <td>
                        <input type="checkbox" name="chain_last7" value="N" <?php echo ($row['chain_last7']=='N')?'checked':''; ?> > 3쌍~3쌍
                    </td>
                    <td>
                        <input type="checkbox" name="chain_last8" value="N" <?php echo ($row['chain_last8']=='N')?'checked':''; ?> > 4쌍~2쌍
                    </td>
                    <td>
                        <input type="checkbox" name="chain_last9" value="N" <?php echo ($row['chain_last9']=='N')?'checked':''; ?> > 5쌍
                    </td>
                </tr>
                <tr>
                    <th>홀/짝(선택시 제외)</th>

                    <td>
                        <input type="checkbox" name="odd6" value="6" <?php echo ($row['odd6']=='6')?'checked':''; ?>> 6:0
                    </td>
                    <td>
                        <input type="checkbox" name="odd5" value="5" <?php echo ($row['odd5']=='5')?'checked':''; ?> > 5:1
                    </td>
                    <td>
                        <input type="checkbox" name="odd4" value="4" <?php echo ($row['odd4']=='4')?'checked':''; ?> > 4:2
                    </td>
                    <td>
                        <input type="checkbox" name="odd3" value="3" <?php echo ($row['odd3']=='3')?'checked':''; ?> > 3:3
                    </td>
                    <td>
                        <input type="checkbox" name="odd2" value="2" <?php echo ($row['odd2']=='2')?'checked':''; ?> > 2:4
                    </td>
                    <td>
                        <input type="checkbox" name="odd1" value="1" <?php echo ($row['odd1']=='1')?'checked':''; ?> > 1:5
                    </td>
                    <td colspan="3">
                        <input type="checkbox" name="odd0" value="0" <?php echo ($row['odd0']=='0')?'checked':''; ?> > 0:6
                    </td>
                </tr>
                <tr>
                    <th>고저(선택시 제외)</th>

                    <td>
                        <input type="checkbox" name="high6" value="6" <?php echo ($row['high6']=='6')?'checked':''; ?>> 6:0
                    </td>
                    <td>
                        <input type="checkbox" name="high5" value="5" <?php echo ($row['high5']=='5')?'checked':''; ?> > 5:1
                    </td>
                    <td>
                        <input type="checkbox" name="high4" value="4" <?php echo ($row['high4']=='4')?'checked':''; ?> > 4:2
                    </td>
                    <td>
                        <input type="checkbox" name="high3" value="3" <?php echo ($row['high3']=='3')?'checked':''; ?> > 3:3
                    </td>
                    <td>
                        <input type="checkbox" name="high2" value="2" <?php echo ($row['high2']=='2')?'checked':''; ?> > 2:4
                    </td>
                    <td>
                        <input type="checkbox" name="high1" value="1" <?php echo ($row['high1']=='1')?'checked':''; ?> > 1:5
                    </td>
                    <td colspan="3">
                        <input type="checkbox" name="high0" value="0" <?php echo ($row['high0']=='0')?'checked':''; ?> > 0:6
                    </td>
                </tr>
                <tr>
                    <th>당번합계</th>

                    <td colspan="9">
                        <input type="checkbox" name="add_sum_yn" value="Y" <?php echo ($row['add_sum_yn']=='Y')?'checked':''; ?>> 사용
                        <input type="text" name="add_sum_start" value="<?php echo $row['add_sum_start']; ?>" size="2" > ~ <input type="text" name="add_sum_end" value="<?php echo $row['add_sum_end']; ?>" size="2" > 입력범위 포함
                    </td>

                </tr>
                <tr>
                    <th>끝수합</th>

                    <td colspan="9">
                        <input type="checkbox" name="last_sum_yn" value="Y" <?php echo ($row['last_sum_yn']=='Y')?'checked':''; ?>> 사용
                        <input type="text" name="last_sum_start" value="<?php echo $row['last_sum_start']; ?>" > ~ <input type="text" name="last_sum_end" value="<?php echo $row['last_sum_end']; ?>" > 입력범위 포함
                    </td>

                </tr>
                <tr>
                    <th>AC값</th>

                    <td colspan="9">
                        <input type="checkbox" name="ac_yn" value="Y" <?php echo ($row['ac_yn']=='Y')?'checked':''; ?>> 사용
                        <input type="text" name="ac_start" value="<?php echo $row['ac_start']; ?>" > ~ <input type="text" name="ac_end" value="<?php echo $row['ac_end']; ?>" > 입력범위 포함
                    </td>

                </tr>

                <tr>
                    <th>역대 1등 당첨번호</th>
                    <td colspan="9">
                        <input type="checkbox" name="before_hit_1" value="N" <?php echo ($row['before_hit_1']=='N')?'checked':''; ?>> 역대 1등 당첨번호 제외
                    </td>
                </tr>
                <tr>
                    <th>역대 2등 당첨번호</th>
                    <td colspan="6">
                        <input type="checkbox" name="before_hit_2" value="N" <?php echo ($row['before_hit_2']=='N')?'checked':''; ?>> 역대 2등 당첨번호 제외
                    </td>
                </tr>
                <tr>
                    <th>역대 3등 당첨번호</th>
                    <td colspan="9">
                        <input type="checkbox" name="before_hit_3" value="N" <?php echo ($row['before_hit_3']=='N')?'checked':''; ?>> 역대 3등 당첨번호 제외
                    </td>
                </tr>
                <?php for($i=1;$i<6;$i++){ ?>
                <tr>
                    <th>마방진<?php echo $i; ?> 구간</th>
                    <td colspan="9">
                        <input type="checkbox" name="ma<?php echo $i;?>_yn" value="Y" <?php echo ($row['ma'.$i.'_yn']=='Y')?'checked':''; ?>> 사용
                        <input type="text" name="ma<?php echo $i;?>_value" value="<?php echo $row['ma'.$i.'_value']; ?>" size="50" > / <input type="text" name="ma<?php echo $i;?>_start" value="<?php echo $row['ma'.$i.'_start']; ?>" size="1" style="text-align: center;" > ~  <input type="text" name="ma<?php echo $i;?>_end" value="<?php echo $row['ma'.$i.'_end']; ?>" size="1" style="text-align: center;" > 입력범위내에 번호 포함
                    </td>
                </tr>
                <?php } ?>
                <?php for($i=1;$i<=42;$i++){ ?>
                    <tr>
                        <th>패턴<?php echo $i; ?> 구간</th>
                        <td colspan="9">
                            <input type="checkbox" name="pattern<?php echo $i;?>_yn" value="Y" <?php echo ($row['pattern'.$i.'_yn']=='Y')?'checked':''; ?>> 사용
                            <input type="text" name="pattern<?php echo $i;?>_value" value="<?php echo $row['pattern'.$i.'_value']; ?>" size="70" > 입력범위내에 6번호 모두 포함 안됨
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="btn_fixed_top">
            <input type="submit" name="act_button" value="수정" class="btn btn_03">
        </div>



    </form>

    <?php
    include_once ('./admin.tail.php');
    ?>


    <iframe name="ifrm" width="500" height="500" style="display: none;"></iframe>
    <script>
        $(document).ready(function(){
            $('input[name="modify"]').on('click',function(){
                $('form[name="f"]').submit();
            });
        });
        function call_back(res){
            if(res == 'Y') {
                swal('', '정상적으로 수정되었습니다.', 'success');
                setTimeout(function(){ location.reload();}, 2000);
            } else {
                swal('', '수정시 오류가 발생 되었습니다. 계속해서 문제가 발생되면 개발자에게 문의해주세요.', 'success');
            }
        }
    </script>
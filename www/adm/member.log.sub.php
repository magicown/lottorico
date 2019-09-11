<?php
if (!defined('_GNUBOARD_')) exit;

include_once(G5_LIB_PATH.'/visit.lib.php');
include_once('./admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

if (empty($fr_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = G5_TIME_YMD;
if (empty($to_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = G5_TIME_YMD;

$qstr = "fr_date=".$fr_date."&amp;to_date=".$to_date."&amp;lotto_turn=".$lotto_turn;
$query_string = $qstr ? '?'.$qstr : '';
?>

<form name="fvisit" id="fvisit" class="local_sch03 local_sch" method="get">
<div class="sch_last">
    <strong>검색</strong>
    <select name="lotto_turn" id="">
        <option value="">회차선택</option>
        <?php
            $que = "SELECT * FROM  g5_sms_log WHERE sms_turn > 0 GROUP BY sms_turn ORDER BY sms_turn DESC";
            $res = sql_query($que);
            while($arr = sql_fetch_array($res)){
        ?>
                <option value="<?php echo $arr['sms_turn'];?>" <?php echo ($arr['sms_turn']==$_GET['lotto_turn'])?'selected':''; ?>><?php echo $arr['sms_turn'];?></option>
        <?php
            }
        ?>
    </select>
    <input type="text" name="fr_date" value="<?php echo $fr_date ?>" id="fr_date" class="frm_input" size="11" maxlength="10">
    <label for="fr_date" class="sound_only">시작일</label>
    ~
    <input type="text" name="to_date" value="<?php echo $to_date ?>" id="to_date" class="frm_input" size="11" maxlength="10">
    <label for="to_date" class="sound_only">종료일</label>
    <input type="text" name="mb_id" value="<?php echo $mb_id ?>" id="mb_id" class="frm_input" size="18" maxlength="50">
    <!--<input type="text" name="search_text" value="<?php /*echo $_REQUEST['search_text']; */?>" id="search_text" class="frm_input" size="18" maxlength="50">-->
    <input type="submit" value="검색" class="btn_submit">
    <?php
        if(strpos($_SERVER['PHP_SELF'],'member_win_list.php')!==false){
            echo "<span class='btn btn_03' style='margin-left:30px;'><a href='./member_win_list_excel.php?lotto_turn={$_REQUEST[lotto_turn]}&fr_date={$_REQUEST[fr_date]}&to_date={$_REQUEST[fr_date]}&mb_id={$_REQUEST['mb_id']}' target='hiddenFrm' style='color:#fff;'>통계자료 엑셀다운로드</a></span>";
        }
    ?>
</div>
</form>

<script>
$(function(){
    $("#fr_date, #to_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
});

function fvisit_submit(act)
{
    var f = document.fvisit;
    f.action = act;
    f.submit();
}
</script>

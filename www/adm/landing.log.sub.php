<?php
if (!defined('_GNUBOARD_')) exit;

include_once(G5_LIB_PATH.'/visit.lib.php');
include_once('./admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

if (empty($fr_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = G5_TIME_YMD;
if (empty($to_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = G5_TIME_YMD;

$qstr = "fr_date=".$fr_date."&amp;to_date=".$to_date;
$query_string = $qstr ? '?'.$qstr : '';
?>

<form name="fvisit" id="fvisit" class="local_sch03 local_sch" method="get">
<div class="sch_last">
    <strong>검색</strong>
    <select name="answer_yn" id="">
        <option value="">상담여부</option>
        <option value="y" <?php echo ('y'==$_GET['c_answer_yn'])?'selected':''; ?>>상담완료</option>
        <option value="n" <?php echo ('n'==$_GET['c_answer_yn'])?'selected':''; ?>>상담예정</option>
    </select>
    <input type="text" name="fr_date" value="<?php echo $fr_date ?>" id="fr_date" class="frm_input" size="11" maxlength="10">
    <label for="fr_date" class="sound_only">시작일</label>
    ~
    <input type="text" name="to_date" value="<?php echo $to_date ?>" id="to_date" class="frm_input" size="11" maxlength="10">
    <label for="to_date" class="sound_only">종료일</label>
    <input type="text" name="mb_id" value="<?php echo $mb_id ?>" id="mb_id" class="frm_input" size="18" maxlength="50">
    <input type="submit" value="검색" class="btn_submit">
    <?php
    if($_SESSION['ss_mb_level']>=9){
        ?>
        <div style="margin-left:30px; display: inline;">
            <a href="./landing_list_excel.php?stx=<?php echo $stx; ?>&sfl=<?php echo $sfl; ?>&fr_date=<?php echo $fr_date; ?>&to_date=<?php echo $to_date; ?>&answer_yn=<?php echo $answer_yn; ?>" class="btn btn_03">엑셀다운로드</a>
            (광고검색 후 엑셀다운로드 하세요.)
        </div>
    <?php } ?>
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

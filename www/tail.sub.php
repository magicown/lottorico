<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('_THEME_PREVIEW_') && _THEME_PREVIEW_ === true) {
	if(defined('G5_THEME_PATH') && is_file(G5_THEME_PATH.'/tail.sub.php')) {
	    require_once(G5_THEME_PATH.'/tail.sub.php');
		return;
	}
} else if(USE_G5_THEME) {
	if(!defined('G5_IS_ADMIN') && defined('G5_THEME_PATH') && is_file(G5_THEME_PATH.'/tail.sub.php')) {
	    require_once(G5_THEME_PATH.'/tail.sub.php');
		return;
	}
}

if(APMS_PRINT) {
	@include_once($print_skin_path.'/print.tail.php');
}
?>

<!-- <?php echo APMS_VERSION;?> -->
<?php if ($is_admin == 'super') {  ?>
<!-- RUN TIME : <?php echo get_microtime()-$begin_time; ?> -->
<?php }  ?>
<!-- ie6,7에서 사이드뷰가 게시판 목록에서 아래 사이드뷰에 가려지는 현상 수정 -->
<!--[if lte IE 7]>
<script>
$(function() {
    var $sv_use = $(".sv_use");
    var count = $sv_use.length;

    $sv_use.each(function() {
        $(this).css("z-index", count);
        $(this).css("position", "relative");
        count = count - 1;
    });
});
</script>
<![endif]-->

<!-- Enliple Common Tracker v3.5 [공용] start -->
<script type="text/javascript">
<!--
	function mobRf(){
        var rf = new EN();
		rf.setData("userid", "lottorico1");
        rf.setSSL(true);
        rf.sendRf();
    }
	function mobConv(){
        var cn = new EN();
        cn.setData("uid", "lottorico1");
        cn.setData("ordcode", "");
        cn.setData("qty", "1");
        cn.setData("price", "1"); 
        cn.setData("pnm", encodeURIComponent(encodeURIComponent("counsel")));
        cn.setSSL(true);
        cn.sendConv();
	}
//-->
</script>



<script src="https://cdn.megadata.co.kr/js/en_script/3.5/enliple_min3.5.js" defer="defer" onload="mobRf()"></script>
<!-- Enliple Common Tracker v3.5 [공용] end -->


</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>
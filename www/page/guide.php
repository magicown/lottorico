<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

/*if(!$_SESSION['ss_mb_id']){
    alert('로그인 후 이용해주세요.','/bbs/login.php?url=http%3A%2F%2Flottorico.co.kr%2Fbbs%2Fpage.php?hid=guide');

}*/
?>

<style>
	.page-content { line-height:22px; word-break: keep-all; word-wrap: break-word; }
	.page-content .article-title { color:#0083B9; font-weight:bold; padding-top:30px; padding-bottom:10px; }
	.page-content ul { list-style:none; padding:0px; margin:0px; font-weight:normal; }
	.page-content ol { margin-top:0px; margin-bottom:15px; }
	.page-content p { margin:0 0 15px; padding:0; }
	.page-content table { border-top:2px solid #999; border-bottom:1px solid #ddd; }
	.page-content th,
	.page-content td { line-height:1.6 !important; }
	.page-content table.tbl-center th,
	.page-content table.tbl-center td,
	.page-content th.text-center,
	.page-content td.text-center { text-align:center !important; }
</style>
<div class="page-content">

	<?php if(!$header_skin) { // 헤더 미사용시 출력 ?>
		<div class="text-center" style="margin:15px 0px;">
			<h3 class="div-title-underline-bold border-color" style="margin-top:15px; padding-top:10px;">
				로또리코 상품약관 동의서
			</h3>
            <h4>- 하단에 상품약관에 동의하셔야 합니다. -</h4>
		</div>
	<?php } ?>


	<div class="article-title" style="padding-top:0px;">
        <!--<img src="/img/yak/bfac0e07110c41d1df41f82d5a00eadb-0.jpg">
        <img src="/img/yak/bfac0e07110c41d1df41f82d5a00eadb-1.jpg">
        <img src="/img/yak/bfac0e07110c41d1df41f82d5a00eadb-2.jpg">
        <img src="/img/yak/bfac0e07110c41d1df41f82d5a00eadb-3.jpg">
        <img src="/img/yak/bfac0e07110c41d1df41f82d5a00eadb-4.jpg">
        <img src="/img/yak/bfac0e07110c41d1df41f82d5a00eadb-5.jpg">-->
        <img src="/img/yak/0001.jpg">
        <img src="/img/yak/0002.jpg">
        <img src="/img/yak/0003.jpg">
        <img src="/img/yak/0004.jpg">
        <img src="/img/yak/0005.jpg">



    </div>
    <div style="float:right; margin-bottom:15px;">
        <input type="checkbox" name="agree_y" value="y" id="yak_y" style="width:20px; height:20px;"><span style="font-size:1.7em; font-weight:bold;">상품약관에 동의합니다.</span>
    </div>

    <div class="list-btn-box" style="clear:both; margin-top:10px; margin:0 auto;">
        <div class="form-group  list-btn">
            <div class="btn-group dropup">
                <a href="#" class="btn btn-color btn-lg btn-primary" id="send_yak_y"><i class="fa fa-pencil"></i><span>제출하기</span></a>						</div>
        </div>

        <div class="clearfix"></div>
    </div>


<div class="h30"></div>
    <script>
        $('#send_yak_y').on('click',function(){
            if($('#yak_y').is(':checked')==false){
                alert('상품약관에 동의하셔야 합니다.');
                return false;
            }

            $.ajax({
               type : 'POST',
               url : './yak.php',
               data : 'mode=yak&mb_id=<?php echo $_REQUEST['mb_id']; ?>',
               success : function(res){
                   alert(res);
                   location.href = '/';
               }
            });
        });
    </script>

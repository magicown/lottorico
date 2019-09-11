<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wid = 'mbt-mcb';

$que = "SELECT * FROM lotto_hit_result WHERE 1 ORDER BY idx DESC LIMIT 1";
//echo $que;
$lotto = sql_fetch($que);

$turn = $lotto['hit_turn'];
$person = explode("|",$lotto['hit_money_person']);
$money = explode("|",$lotto['hit_money_money']);
$ball = explode("|",$lotto['hit_num']);


//상담내용 신청을 했다면 저장한다.
if(isset($_POST['hp1']) && isset($_POST['hp2']) && isset($_POST['hp3'])) {
    $hp = $_POST['hp1'].'-'.$_POST['hp2'].'-'.$_POST['hp3'];
    $que  = "INSERT INTO quick_memo SET ";
    $que .= "q_hp       = '{$hp}', ";
    $que .= "q_memo     = '".sql_real_escape_string($_POST['memo'])."', ";
    $que .= "q_regdate  = NOW() ";
    $res = sql_query($que);
    if($res){
        alert('빠른상담 신청이 완료되었습니다.');
        unset($_POST);
        unset($hp);
    } else {
        alert('신청시 오류가 발생했습니다. 다시 시도해주세요.');
    }
}
?>

<style>
	.at-body { background:#fff; }
	.w-main { padding-top:20px !important; }
	.w-main .w-box { border:1px solid #ddd; margin-bottom:20px; background:#fff; padding:12px 15px 15px; }

	.w-main .w-head { border-bottom:1px solid #ddd; margin:0px 0px 15px; font-weight:bold; padding-bottom:3px; }
	.w-main .w-more { font-weight:normal; color:#888; letter-spacing:-1px; font-size:11px; }
	.w-main .w-p10 { padding:10px; }
	.w-main .w-p15 { padding:15px; }
	.w-main .w-tab { border-right:1px solid #ddd; border-top:1px solid #ddd; }
	.w-main .w-tab .nav { margin-top:-1px !important; }
	.w-main .trans-top.tabs.div-tab .w-tab ul.nav-tabs li.active a { font-weight:bold; color:#333 !important; }
	.w-main .w-tab .tab-more { margin-top:-28px; margin-right:10px; font-size:11px; letter-spacing:-1px; color:#888 !important; }
	.w-main .tabs { margin-bottom:16px !important; }
	.w-main .tab-content { padding:15px !important; }
	.w-main .w-img img { display:block; max-width:100%; /* 배너 이미지 */ }
	.w-main .w-empty { margin-bottom:20px; }
	.w-main .at-main,
	.w-main .at-side { padding-top:0px; padding-bottom:0px; }
	.w-main .w-row,
	.w-main .at-row { margin-left:-10px; margin-right:-10px; }
	.w-main .w-col,
	.w-main .at-col { padding-left:10px; padding-right:10px; }

    a, body, button, div, html, ul, li{
        padding:0;
        margin:0;
    }

    body{
        position:relative;
        font-family:arial, sans-serif;
        font-size:12px;
        color:#555;
    }

    ul{
        list-style:none;
    }

    a{
        text-decoration:none;
        color:#8f7614;
    }

    a:hover{
        color:#8f7614;
    }
    .rollingContainer:after{
        display:block;
        clear:both;
        content:"";
    }

    .rollingContainer{
        margin-top:10px;
        position:relative;
        *zoom:1;
    }

    .rollingContainer .rollingList{
        width:810px;
        height:120px;
        border:none;
        float:left;
        position:relative;
        overflow:hidden;
    }

    .rollingContainer .rollingList ul{
        height:100%;
        margin:10px 0 0 0;
        position:absolute;
        left:0;
        top:0;
    }

    .rollingContainer .rollingList ul li{
        margin:0 5px 0 5px;
        float:left;
    }

    .rollingContainer .rollingList ul li a{
        display:block;
    }

    .rollingContainer .btnControl{
        margin-left:10px;
        float:left;
    }

    .rollingContainer .btnControl button{
        height:32px;
        padding:0 10px;
        border:1px solid #ccc;
        margin-right:3px;
        display:inline-block;
        cursor:pointer;
    }

    .rollingContainer .btnControl button.on, .rollingContainer .btnControl button:hover{
        color:#fc0303;
    }
</style>

<?php @include_once(THEMA_PATH.'/wing.php'); // Wing ?>

<script>
    function chk_form(obj){

        if(obj.hp1.value == ''){
            alert('휴대폰 첫번째 자리를 확인해주세요.');
            obj.hp1.focus();
            return false;
        }
        if(obj.hp2.value == ''){
            alert('휴대폰 두번째 자리를 확인해주세요.');
            obj.hp2.focus();
            return false;
        }
        if(obj.hp3.value == ''){
            alert('휴대폰 세번째 자리를 확인해주세요.');
            obj.hp3.focus();
            return false;
        }
        if(obj.memo.value == ''){
            alert('상담내용을 입력해주세요.');
            obj.memo.focus();
            return false;
        }

        if($('input[name="agree"]').is(':checked') == false){
            alert('전화상담을 위한 개인정보 수집 및 이용동의를 체크해주세요.');
            return false;
        }
        return true;
    }
</script>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="margin-top:20px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="font-size:20px;">&times;</span></button>
                <h2 class="modal-title text_center" style="text-align: center;">더 자세한 내용이</h2>
                <h2 class="modal-title text_center" style="text-align: center;">알고 싶으신가요?</h2>

                <h4 class="modal-title text_center" style="text-align: center;">아래의 정보를 입력 후 <span class="font-red strong">전화상담예약을</span> 누르시면</h4>
                <h4 class="modal-title text_center" style="text-align: center;">전문상담사가 고객님께 전화를 드립니다.</h4>
            </div>
            <div class="modal-body" style="background-color:#f7e7e7;">
                <form name="frm" method="post" onsubmit="return chk_form(this);" action="./">
                    <div class="row">
                        <div class="col-xs-3">
                            <h4>연락처</h4>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" name="hp1" class="form-control" placeholder="" maxlength="3">
                        </div>
                        <div class="col-xs-3">
                            <input type="text" name="hp2" class="form-control" placeholder="" maxlength="4">
                        </div>
                        <div class="col-xs-3">
                            <input type="text" name="hp3" class="form-control" placeholder="" maxlength="4">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <h4>상담내용</h4>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" name="memo" class="form-control" placeholder="">
                        </div>                       
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label" style="float: right;">*연락처를 상담 완료 후 즉시 삭제됩니다.</label>
                    </div>
                    <div class="form-group" style="clear:both; margin-bottom:0;">
                        <input type="checkbox" name="agree" value="y">
                        <label for="message-text" class="control-label" style="margin-bottom:0; margin-top:7px;">전화상담을 위한 개인정보 수집 및 이용동의</label>
                    </div>

            </div>
            <div class="modal-footer" style="background-color:#f7e7e7;">
                <button type="submit" class="btn btn-danger btn-block">전화상담예약</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="at-container w-main">

	<div class="row row-15">
        <div class="col-sm-6 col-md-4" style="padding-left:5px; padding-right:5px;">
            <div class="w-box w-img" style="padding-bottom: 10px; padding-top: 10px;">
                <a href="/bbs/register.php"><img src="/img/wing/1891270409_Yp7NcDQh_d4ceca5f0f42fe8bd0c42a2a26a22ca1afc5d764.png"></a>
            </div>
        </div>

        <div class="col-sm-6  col-md-4" style="padding-left:5px; padding-right:5px;">
            <div class="w-box" style="margin-bottom:12px; padding-bottom:0;">
                <span class="title-text">동행복권 <span class="font-red strong"><?php echo $turn; ?></span>회 당첨번호</span>
                <span class="hit-person-text">1등 당첨자 <span class="font-red"><?php echo $person[0]; ?></span>명 당첨금액 <span class="font-red strong"><?php echo $money[0]; ?></span>원</span>
                <div class="line"></div>
                <div class="hit-num">
                    <ul>
                        <li class="ball_645 lrg ball2"><?php echo $ball[0]; ?></li>
                        <li class="ball_645 lrg ball2"><?php echo $ball[1]; ?></li>
                        <li class="ball_645 lrg ball3"><?php echo $ball[2]; ?></li>
                        <li class="ball_645 lrg ball3"><?php echo $ball[3]; ?></li>
                        <li class="ball_645 lrg ball4"><?php echo $ball[4]; ?></li>
                        <li class="ball_645 lrg ball5"><?php echo $ball[5]; ?></li>
                        <li class="bonus">+</li>
                        <li class="ball_645 lrg ball1"><?php echo $ball[6]; ?></li>
                    </ul>
                </div>
            </div>
            <!--<div class="w-box" style="padding-bottom:16px;">
                <span class="title-text-sum"><span class="font-red strong">로또리코</span> 누적 당첨현황</span>
                <div class="line"></div>
                <span class="title-text-1">로또 1등 당첨자 : <span class="font-red strong">000</span>명</span>
                <span class="title-text-2">로또 2등 당첨자 : <span class="font-red strong">000</span>명</span>
            </div>-->
        </div>

        <div class="col-sm-6  col-md-4" style="padding-left:5px; padding-right:5px;">
            <div class="w-box" style="padding-top:90px; pdding-bottom:60px; min-height: 354px;">
                <?php echo apms_widget('miso-outlogin'); //외부로그인 ?>
            </div>
        </div>

	</div>

	<!-- Start //-->
	<div class="w-box-black">
        <div class="col-md-5">
            <span class="span-text-yellow">1등 당첨번호받기 무료 상담 요청</span>
            <span class="span-text-white">단한번의 신청이 여러분의 인생을 바꿉니다!</span>
        </div>
        <div class="col-md-7" id="free_counselor">
            <div class="col-xs-3">
                <input type="text" name="hp1" class="form-control" placeholder="">
            </div>
            <div class="col-xs-3">
                <input type="text" name="hp2"  class="form-control" placeholder="">
            </div>
            <div class="col-xs-3">
                <input type="text" name="hp3"  class="form-control" placeholder="">
            </div>
            <div class="col-xs-3">
                <button type="button" class="btn btn-danger" id="getFreeNum" onclick="if(typeof mobConv==='function')mobConv();">1등번호받기</button>
            </div>
            <div class="span-chk">
                <input type="checkbox" name="useinfo" value="1">
                <span class="agree-yn-text">로또리코 이용약관(자세히보기)</span>
            </div>
            <div class="span-chk">
                <input type="checkbox" name="private" value="1">
                <span class="agree-yn-text">로또리코 개인정보처리방침(자세히보기)</span>
            </div>
        </div>
	</div>
	<!--// End -->

	<!-- 베스트 product //-->

    <div class="w-box-product hidden-xs" style="padding-top:0px;">
        <div class="col-md-3">
            <h2 style="margin-top:36px !important;">베스트 <span class="font-red">PRODUCT</span></h2>
        </div>
        <div class="col-md-9">
            <div class="rollingContainer">
                <div class="rollingList">
                    <ul>
                        <li><a href="/bbs/500.php"><img src="/img/wing/pa.png" width="261" height="117" alt="로또리코 A플랜" /></a></li>
                        <li><a href="/bbs/500.php"><img src="/img/wing/pb.png" width="261" height="117" alt="로또리코 B플랜" /></a></li>
                        <li><a href="/bbs/500.php"><img src="/img/wing/pr.png" width="261" height="117" alt="로또리코 R플랜" /></a></li>
                        <li><a href="/bbs/500.php"><img src="/img/wing/ps.png" width="261" height="117" alt="로또리코 S플랜" /></a></li>

                    </ul>
                </div>
                <!--<div class="btnControl">
                    <button type="button" class="prev">이전 이미지 보기</button>
                    <button type="button" class="next">다음 이미지 보기</button>
                    <button type="button" class="play">재생하기</button>
                    <button type="button" class="stop">정지하기</button>
                </div>-->
            </div>
           <!-- <a href="/bbs/500.php"><img src="/img/wing/plana.png"></a>
            <a href="/bbs/500.php"><img src="/img/wing/planb.png"></a>
            <a href="/bbs/500.php"><img src="/img/wing/R.jpg"></a>
            <a href="/bbs/500.php"><img src="/img/wing/S.jpg"></a>-->
        </div>
    </div>

	<!--// 베스트 product -->


    <!-- 당첨 갤러리 //-->
    <!--<div class="w-box">1
        <div class="w-head">
            <a href="<?php /*echo G5_BBS_URL;*/?>/board.php?bo_table=보드아이디">
                <span class="pull-right w-more">+ 더보기</span>
                당첨 <span class="font-red"> 갤러리</span>
            </a>
        </div>
        <?php /*echo apms_widget('miso-post-gallery', 'hit-gallery',$wid.'-gallery1', 'caption=3'); */?>
    </div>-->
    <!--// 당첨갤러리 -->

	<div class="row at-row">
		<div class="col-md-12">
			<div class="row row-15">
				<div class="col-lg-4 w-col" style="padding-left:3px;">

					<!-- Start //-->
					<div class="w-box">
						<div class="w-head">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=4100">
								<span class="pull-right w-more">+ 더보기</span>
								공지사항
							</a>
						</div>
						<?php echo apms_widget('miso-post-mix', 'notice4100
						',$wid.'-mix31', 'idate=1 date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
					</div>
					<!--// End -->

				</div>
				<div class="col-lg-4 w-col">

					<!-- Start //-->
					<div class="w-box">
						<div class="w-head">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=2100">
								<span class="pull-right w-more">+ 더보기</span>
								회차별 당첨번호
							</a>
						</div>
						<?php echo apms_widget('miso-post-list', 'turn_gallery',$wid.'-mix32', 'idate=1 date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
					</div>
					<!--// End -->

				</div>
                <div class="col-lg-4 w-col" style="padding-right:3px;">

                    <!-- Start //-->
                    <div class="w-box">
                        <div class="w-head">
                            <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=2500">
                                <span class="pull-right w-more">+ 더보기</span>
                                명예의전당
                            </a>
                        </div>
                        <?php echo apms_widget('miso-post-list', 'hit_gallery',$wid.'-mix31', 'idate=1 date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
                    </div>
                    <!--// End -->

                </div>
			</div>
        </div>
	</div>
</div><!-- .at-container -->


<script>
    $('#getFreeNum').on('click',function(){
        var hp1 = $('input[name="hp1"]').val(),
            hp2 = $('input[name="hp2"]').val(),
            hp3 = $('input[name="hp3"]').val();

        if(hp1 == '' || hp2 == '' || hp3 == ''){
            alert('정상적인 휴대폰 번호를 입력해주세요.');
            return false;
        } else {
            if($("input[name='useinfo']").is(':checked') == false){
                alert('로또리코 이용약관에 동의하셔야 합니다.');
                return false;
            }
            if($("input[name='private']").is(':checked') == false){
                alert('로또리코개인정보처리방침에 동의하셔야 합니다.');
                return false;
            }
            $.ajax({
                type: "POST",
                url: "./ajax.php",
                data: {mode: "freeCounselor", hp1: hp1, hp2 : hp2, hp3 : hp3 , type : 'C'},
                dataType: "json",
                success: function (data) {
                    if (data.error == true) {
                        alert(data.result);
                        return false;
                    } else {
                        $("input[name='hp1']").val('');
                        $("input[name='hp2']").val('');
                        $("input[name='hp3']").val('');
                        $("input[name='useinfo']").attr('checked',false);
                        $("input[name='private']").attr('checked',false);
                        alert(data.result);
                    }
                }
            });
        }
    });
    var commonJS = {
        imgRolling : function (autoRollingClass, autoBoolean){
            var findElement = $("."+autoRollingClass).find(" > ul");
            var itemLength = findElement.find(" > li").length;
            var prev = $(".btnControl").find(".prev");
            var next = $(".btnControl").find(".next");
            var play = $(".btnControl").find(".play");
            var stop = $(".btnControl").find(".stop");
            var btnPlay = autoBoolean;
            var autoState = true;
            var timer = 0;
            var speed = 5000;
            var move = 261;

            if(findElement.children().length<= 4){
                play.hide();
                stop.hide();
                prev.hide();
                next.hide();
                findElement.css("width", "1100");
            } else {
                findElement.css({"left" : "0", "width" : itemLength * 301});
            }

            if(btnPlay){
                timer = setInterval(moveNextSlide, speed);
                play.addClass("on");
            } else {
                autoState = false;
                stop.addClass("on");
            }

            findElement.on({
                "mouseenter" : function(){
                    clearInterval(timer);
                    play.removeClass("on");
                },
                "mouseleave" : function(){
                    timer = setInterval(moveNextSlide,speed);
                    play.removeClass("on");
                }
            });

            play.click(function(){
                timer = setInterval(moveNextSlide,speed);
                $(this).addClass("on");
                stop.removeClass("on");
                autoState = true;
            });

            stop.click(function(){
                clearInterval(timer);
                $(this).addClass("on");
                play.removeClass("on");
            });

            prev.on({
                "click" : function(){
                    play.removeClass("on");
                    stop.removeClass("on");
                    movePrevSlide();
                    autoState = false;
                },
                "mouseenter" : function(){
                    clearInterval(timer);
                    play.removeClass("on");
                    stop.removeClass("on");
                },
                "mouseleave" : function(){
                    timer = setInterval(moveNextSlide,speed);
                    play.addClass("on");
                }
            });

            next.on({
                "click" : function(){
                    play.removeClass("on");
                    stop.removeClass("on");
                    moveNextSlide();
                    autoState = false;
                },
                "mouseenter" : function(){
                    clearInterval(timer);
                    play.removeClass("on");
                    stop.removeClass("on");
                },
                "mouseleave" : function(){
                    timer = setInterval(moveNextSlide,speed);
                    play.addClass("on");
                }
            });

            function movePrevSlide(){
                var lastChild = findElement.children().filter(":last-child").clone(true);
                lastChild.prependTo(findElement);
                findElement.css("left","-"+move+"px");
                findElement.children().filter(":last-child").remove();
                findElement.animate({"left":"0"},"normal");
            }

            function moveNextSlide(){
                var firstChild = findElement.children().filter(":first-child").clone(true);
                firstChild.appendTo(findElement);
                findElement.children().filter(":first-child").remove();
                findElement.css("left","0");
                findElement.animate({"left":"-"+move+"px"},"normal");
            }
        }
    }

    $(document).ready(function(){
        commonJS.imgRolling("rollingList", true);
    });
</script>
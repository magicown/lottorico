<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

if(G5_IS_MOBILE) return; // 모바일에서는 출력하지 않습니다.

?>
<style>
	.wing-wrap { position:relative; overflow:visible !important;}
	.wing-wrap img { display:block; max-width:100%; }
	.wing-left { position:absolute; width:160px; left:-162px; top:20px; }
	.wing-right { position:absolute; width:160px; right:-180px; top:20px; }
	.boxed .wing-left { left:-180px; }
	.boxed .wing-right { right:-180px; }
</style>
<script>
    $(document).ready(function(){
       $('#quick_btn').on('click',function(){
          $('#exampleModal').modal({
              backdrop : 'static'
          });
       });
    });
</script>



<div class="at-container wing-wrap">
	<div class="wing-left visible-lg">
		<a href="#">
			<img src="/img/wing/left_banner01.jpg">
		</a>
	</div>
    <div class="wing-left visible-lg" style="top:175px;>
        <a href="#">
            <img src="/img/wing/left_banner02.jpg">
        </a>
    </div>

    <div class="wing-right visible-lg">
        <div class="w-box">
            <div class="w-head font-red font-24" style="padding-left:30px;">
                <img src="/img/wing/right_banner01.png">
            </div>
            <span class="font-24" style="color:#385bc0; display:block; margin:20px 0 10px; 0; text-align:center;">무엇이</span>
            <span class="font-24" style="color:#385bc0; text-align:center;display:block; ">궁금하세요?</span>
            <span class="support-text" style="font-size:11px !important; padding-top:8px;">빠르게 해결해 드리겠습니다.</span>
            <div style="border-bottom:#eee solid 1px; height:1px; width:100%; margin:7px 0 10px 0"></div>
            <span class="support-text" style="text-align:center; font-weight:bold; cursor:pointer;" id="quick_btn">빠른상담예약 ></span>

        </div>
    </div>


	<div class="wing-right visible-lg" style="top:290px; display:none;">
        <div class="w-box">
            <div class="w-head font-red font-24">
                고객센터
            </div>
            <span class="support-text">빠른 상담을 원하시면 친절한 고객센터로 문의주세요.</span>
            <span class="font-red font-24">032.710.7988</span>

            <span class="support-text">평일 : 09:30~18:00</span>
            <span class="support-text">점심시간 : 12:30 ~13:30</span>
            <span class="support-text">주말/공휴일 휴무</span>
        </div>
	</div>
    <div class="wing-right-2 visible-lg" style="top:530px; display:none;">
        <div class="w-box">
            <div class="w-head font-20">
                계좌번호
            </div>
            <span class="font-red" style="font-size:17px;">KB국민은행</span>
            <span class="font-red" style="font-size:17px;">224601-04-228351</span>
            <span class="support-text">(주)더블에이치컴퍼니</span>

        </div>
    </div>
</div>
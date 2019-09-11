<?php
    include "./common.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"></meta>
    <meta http-equiv="content-type" content="text/html;charset=UTf-8"/>
    <link rel="stylesheet" href="css/common.css"/>
    <title></title>
    <script src="/js/jquery-1.11.3.min.js"></script>
</head>

<body style="background-color: #c11d21;">
<div id="wrap">
  <div class="landing_content_wrap">
      <img src="./images/ad2.png" />
      <div class="content3">
        <input type="text" name="name" placeholder="성함을 입력하세요!"  /><br />
        <input type="text" name="hp" placeholder="휴대폰번호를 입력하세요!"  onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="11" /><br />
          <input type="button" name="button" id="getFreeNum" />
      </div>
      <div class="go-home"><input type="button" name="button" id="getFreeNum" onclick="location.href='http://lottorico.co.kr/';" /></div>
  </div>
</div>
  <div class="footer" style="text-align: center; color:#fff;">
    <p>
      회사명 : (주)더블에이치컴퍼니 | 주소 : 인천광역시 미추홀구 주안로213번길 15, 404호(주안동)<br/>
      사업자 등록번호  404-87-01366 (사업자정보확인) | 대표 : 안태환 | 전화 : 032-710-7988 | 팩스 : 032-710-7989<br/>
      통신판매업신고번호 :  | 개인정보관리책임자 : 안태환<br/>
      Copyright © 2019 (주)더블에이치컴퍼니. All Rights Reserved.
    </p>
  </div>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#getFreeNum').on('click',function(){
            var hp = $('input[name="hp"]').val();
            var name = $('input[name="name"]').val();

            if(name == ''){
                alert('성함을 입력해주세요.');
                $('input[name="name"]').focus();
                return false;
            }

            if(hp == ''){
                alert('정상적인 휴대폰 번호를 입력해주세요.');
                $('input[name="hp"]').focus();
                return false;
            }

            $.ajax({
                type: "POST",
                url: "../ajax.php",
                data: {mode: "freeCounselor", hp: hp, type : 'L', name : name},
                dataType: "json",
                success: function (data) {
                    if (data.error == true) {
                        alert(data.result);
                        return false;
                    } else {
                        $("input[name='name']").val('');
                        $("input[name='hp']").val('');
                        alert(data.result);
                    }
                }
            });

        });
    });

</script>

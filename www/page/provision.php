<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

$name_company = 'OOOO 회사'; // 회사명 입력
$name_site = 'OOOO 쇼핑몰'; // 사이트 또는 쇼핑몰명 입력
$enforcement_date = 'OOOO년 OO월 OO일'; // 시행일

?>
<style>
	.page-content { line-height:22px; word-break: keep-all; word-wrap: break-word; }
	.page-content .article-title { color:#0083B9; font-weight:bold; padding-top:30px; padding-bottom:10px; }
	.page-content ul { list-style:none; padding:0px; margin:0px; font-weight:normal; }
	.page-content ol { margin-top:0px; margin-bottom:0px; }
	.page-content ol > li > ol > li {  list-style:disc; }
	.page-content p { margin:0 0 15px; padding:0; }
    table { font-size:14px !important;}
</style>
<div class="page-content">

	<?php if(!$is_register && !$header_skin) { // 회원가입폼이 아니고 헤더스킨이 없으면 출력 ?>
		<div class="text-center" style="margin:15px 0px;">
			<h3 class="div-title-underline-bold border-color">
				서비스 이용약관
			</h3>
		</div>
	<?php } ?>


    <table dir="ltr" cellspacing="0" cellpadding="0" style="color: #000000; font-size: 10pt; width: 0px; font-family: arial, sans, sans-serif; table-layout: fixed;">
        <colgroup><col width="100" /></colgroup>
        <tbody>
        <tr style="height: 40px;">
            <td style="font-family: Arial; font-size: 18px; padding: 2px 3px; overflow: hidden; height:50px; color:#0083B9">제 1장 총칙</td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left; font-size:14px;">로또리코의 회원약관은 다음과 같습니다. 본 회원약관은 제공되는 서비스 및 정책에 따라 내용이 변경될 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1004px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left; font-size:14px;">더블에이치컴퍼니는 로또리코 웹사이트(<a href="http://www.lottorico.co.kr/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=ko&amp;q=http://www.lottorico.co.kr&amp;source=gmail&amp;ust=1561794838728000&amp;usg=AFQjCNG1kiPrcdkXCdP7ha-1ANbnkJWH8g" style="color: #1155cc; text-decoration-line: none;">http://www.lottorico.co.<wbr />kr</a>)를 운영하고 있습니다. <br>본 페이지를 정기적으로 방문하여 추가 혹은 수정된 내용을 확인해 보시기 바랍니다.</div>
                </div>
            </td>
        </tr>
        <p>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: hidden; vertical-align: bottom;">제 1조 (목 적)</td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1711px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">이 약관은 더블에이치컴퍼니 (이하 총칭하여 '회사'라 합니다)가 제공하는 인터넷 웹사이트의 서비스(<a href="http://www.lottorico.co.kr/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=ko&amp;q=http://www.lottorico.co.kr&amp;source=gmail&amp;ust=1561794838728000&amp;usg=AFQjCNG1kiPrcdkXCdP7ha-1ANbnkJWH8g" style="color: #1155cc; text-decoration-line: none;">http://www.lottorico.co.kr</a>&nbsp;이하 '서비스'라 합니다)의 이용과 관련하여 회원과 회사간의 권리, 의무, 책임사항 및 이용에 관한 제반 사항과 기타 필요한 사항을 구체적으로 규정함을 목적으로 합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 2 조 (이용약관의 효력 및 변경)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 903px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 이 약관은 그 내용을 회사의 웹사이트에 게시하거나 기타의 방법으로 회원에게 공지하고, 이에 동의한 회원이 서비스에 가입함으로써 효력이 발생합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1004px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 회원은 정기적으로 사이트를 방문하여 약관의 변경사항을 확인하여야 합니다. 변경된 약관에 대한 정보를 알지 못해 발생하는 회원의 피해는 회사에서 책임지지 않습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1408px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 회사가 필요하다고 인정하는 경우에는 이 약관을 변경할 수 있으며, 약관이 변경된 경우에는 지체 없이 제1항과 같은 방법으로 공지합니다.다만, 회원의 권리 또는 의무에 관한 중요한 내용의 변경은 최소한 7일 이전에 공지합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">이 경우, 회사는 개정 전 내용과 개정 후 내용을 명확하게 비교하여 이용자가 알기 쉽게 표시합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1509px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(6) 제3항의 경우에 회원은 변경된 약관에 동의하지 않으면 언제든지 서비스 이용을 중단하고 이용계약을 해지할 수 있습니다. 회원이 변경된 약관의 효력발생일 이후 계속하여 서비스를 이용하는 경우에는 당해 회원은 약관의 변경사항에 동의한 것으로 간주됩니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 3 조 (약관외 준칙)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1307px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">회사는 필요한 경우 서비스 내의 개별항목에 대하여 개별약관 또는 운영원칙(이하 '서비스별 안내'라 합니다)를 정할 수 있으며, 이 약관과 서비스별 안내의 내용이 상충되는 경우에는 서비스별 안내의 내용을 우선하여 적용합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 4 조 (용어의 정의)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 398px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 이 약관에서 사용하는 용어의 정의는 다음과 같습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 499px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">① 회원: 회사와 서비스 이용에 관한 계약을 체결하고 이용자 아이디를 부여받은 자</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">② 이용계약: 이 약관을 포함하여 서비스 이용과 관련하여 회사와 회원 간에 체결하는 모든 계약</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">③ 아이디(ID): 회원의 식별 및 서비스 이용을 위하여 회원의 신청에 따라 회사가 회원별로 부여하는 고유의 문자와 숫자의 조합</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">④ 비밀번호: ID로 식별되는 회원의 본인 여부를 검증하기 위하여 회원이 설정하여 회사에 등록한 고유의 문자와 숫자의 조합</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 499px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">⑤ 운영자 : 서비스의 전반적인 관리와 원활한 운영을 위하여 회사에서 선정한 사람</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">⑥ 해지: 회사 또는 회원이 이용계약을 해약하는 것</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1004px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 이 약관에서 사용하는 용어 중 제1항에서 정하지 아니한 것은 관계 법령 및 서비스별 안내에서 정하는 바에 따르며, 그 외에는 거래 관행 및 관련 법령을 따릅니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 2 장 이용계약의 체결</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 5 조 (이용계약의 성립)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 이용계약은 이용자의 이용계약 내용에 대한 동의와 이용신청에 대하여 회사의 이용승낙으로 성립합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 이용계약에 대한 동의는 이용신청 당시 신청서 상의 동의버튼을 누름으로써 의사표시를 합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 499px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 회원가입을 함으로 제 14조항의 광고게제 약관의 동의가 이루어짐을 성립됩니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 6 조 (이용 신청)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1509px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 회원으로 가입하여 서비스를 이용하고자 하는 이용자는 회사 웹사이트(<a href="http://www.lottorico.co.kr/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=ko&amp;q=http://www.lottorico.co.kr&amp;source=gmail&amp;ust=1561794838728000&amp;usg=AFQjCNG1kiPrcdkXCdP7ha-1ANbnkJWH8g" style="color: #1155cc; text-decoration-line: none;">http://www.lottorico.co.<wbr />kr</a>)의 '회원가입' 메뉴에서 약관 동의 절차를 거친 후 회사 소정의 가입신청양식에 요구하는 사항을 기재하고 '가입' 버튼을 누름으로써 이용을 신청합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1610px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 온라인 가입신청양식에 기재하는 모든 회원정보는 실제와 일치하는 데이터인 것으로 간주됩니다. 고객이 가입신청양식에 실명이나 실제정보를 입력하지 않은 경우에는 법적인 보호를 받을 수 없으며, 회사는 당해 고객에 대하여 서비스의 이용을 제한할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 회사는 회원에 대하여 등급별로 구분하여 이용시간, 이용회수, 서비스 메뉴 등을 세분하여 이용에 차등을 둘 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 7 조 (이용 신청의 승낙)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 499px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">회사는 제6조의 규정에 의해 이용신청한 고객에 대하여 서비스 이용신청을 승낙합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 8 조 (이용 신청의 승낙의 제한 및 보류)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 499px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 회사는 아래사항에 해당하는 경우에 대해서 승낙을 보류할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">① 타인 명의로 신청하거나 주민등록상의 본인 실명이 아닌 다른 성명으로 신청하는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 499px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">② 이용신청시 가입신청양식상의 기재사항을 허위로 하여 신청한 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">③ 부정한 용도로 본 서비스를 이용하고자 하는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 398px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">④ 영리를 추구할 목적으로 본 서비스를 이용하고자 하는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 499px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">⑤ 법령 또는 약관을 위반하여 이용계약이 해지된 적이 있는 이용자가 신청하는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">⑥ 이용신청자가 선량한 풍속 기타 사회질서를 저해하거나 저해할 목적으로 신청한 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">⑦ 기타 규정한 제반 사항을 위반하며 신청하는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 회사는 서비스 이용신청이 다음 각 호에 해당하는 경우에는 그 신청에 대하여 승낙 제한사유가 해소될 때까지 승낙을 유보할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">① 회사가 설비의 여유가 없는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">② 회사의 기술상 또는 업무수행상 지장이 있는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">③ 기타 회사의 귀책사유로 이용승낙이 곤란한 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 회사는 이용신청고객이 관계 법령에서 규정하는 미성년자일 경우에 서비스별 안내에서 정하는 바에 따라 승낙을 보류할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(5) 회사는 회원 가입 절차 완료 이후 제2조 각 호에 따른 사유가 발견된 경우 이용 승낙을 철회할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 9 조 (이용계약 사항의 변경)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 회원은 이용신청시 기재한 사항이 변경되었을 경우에는 이를 웹사이트를 통해 수정하여야 합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 회원이 제1항의 수정을 하지 않음으로 인하여 발생되는 문제에 대한 책임은 회원 본인에게 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 아이디는 원칙적으로 변경이 불가하며 부득이한 사유로 인하여 변경 하고자 하는 경우에는 해당 아이디를 해지하고 재가입해야 합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3)사이트 아이디는 회원 본인의 동의 하에 회사 또는 자회사가 운영하는 사이트의 회원ID와 연결될 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(4) 아이디는 다음 각 호에 해당하는 경우에는 회원의 요청 또는 회사의 직권으로 변경 또는 이용을 정지할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 499px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">- 타인의 전화번호 또는 주민등록번호 등으로 등록되어 사생활 침해가 우려되는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 398px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">- 타인에게 혐오감을 주거나 미풍양속에 어긋나는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">- 회사, 회사의 서비스 또는 서비스 운영자 등의 명칭과 동일하거나 오인 등의 우려가 있는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">- 기타 합리적인 사유가 있는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1307px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(5) 아이디 및 비밀번호의 관리책임은 회원에게 있습니다. 이를 소홀이 관리하여 발생하는 서비스 이용상의 손해 또는 제3자에 의한 부정이용 등에 대한 책임은 회원에게 있으며 회사는 그에 대한 책임을 지지 않습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(6) 기타회원 개인정보 관리 및 변경 등에 관한 사항은 서비스별 안내에 정하는 바에 의합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 3 장 계약 당사자의 의무</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 10 조 (회사의 의무)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 회사는 이 약관이 정하는 바에 따라 지속적이고 안정적인 서비스를 제공하는 데 최선을 다해야 합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1004px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 회사는 계속적이고 안정적인 서비스의 제공을 위하여 설비에 장애가 생기거나 멸실된 때에는 부득이한 사유가 없는 한 지체 없이 이를 수리 또는 복구합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 회사는 개인정보 보호를 위해 보안시스템을 구축하며 개인정보 보호정책을 공시하고 준수합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 2014px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(4) 회사는 회원으로부터 제기되는 의견이나 불만이 정당하다고 객관적으로 인정될 경우에는 적절한 절차를 거쳐 즉시 처리하여야 합니다. 다만, 즉시 처리가 곤란한 경우는 회원에게 그 사유와 처리일정을 통보하여야 합니다. (5) 회사는 이용계약의 체결, 변경 및 해지 등 회원과의 계약 관련 절차에 있어 회원에게 편의를 제공하도록 노력합니다</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">. 제 11 조 (회원의 의무)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1206px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 회원은 회원가입 신청 또는 회원정보 변경 시 모든 사항을 사실에 근거하여 본인의 진정한 정보로 작성하여야 하며, 허위 또는 타인의 정보를 등록할 경우 이와 관련된 모든 권리를 주장할 수 없습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1509px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 회원은 약관에서 규정하는 사항과 기타 회사가 정한 제반 규정, 공지사항 등 회사가 공지하는 사항 및 관계 법령을 준수하여야 하며, 기타 회사의 업무에 방해가 되는 행위, 회사의 명예를 손상시키는 행위, 타인에게 피해를 주는 행위를 해서는 안됩니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 회원은 서비스를 이용하여 얻은 정보를 회사의 사전 승낙 없이 복제 또는 유통시키거나 상업적으로 이용하는 행위를 하여서는 안됩니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 903px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(4) 회원은 다량의 정보를 전송하거나 동일 또는 유사한 내용의 정보를 반복적으로 게시하여 서비스의 안정적인 운영을 방해하는 행위를 하여서는 안됩니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1610px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(5) 회원은 회사의 사전 서면동의 없이 서비스를 이용하여 영리적인 목적의 영업행위를 하여서는 안됩니다. 이를 위반한 영업행위의 결과에 대하여 회사는 책임을 지지 않으며, 이와 같은 영업행위의 결과로 회사에 손해가 발생한 경우 회원은 회사에 대하여 손해배상의 의무를 집니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 903px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(6) 회원은 회사의 명시적 동의가 없는 한 서비스의 이용권한, 기타 이용계약상의 지위를 타인에게 양도, 증여할 수 없으며 이를 담보로 제공할 수 없습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1913px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(7) 회원은 자신에게 부여된 아이디 및 비밀번호를 제3자가 이용하게 하여서는 안됩니다. 아이디 및 비밀번호의 관리소홀, 부정사용에 의하여 발생하는 결과에 대한 책임은 회사의 고의 또는 과실이 없는 한 회원에게 있습니다. 회원은 자신의 아이디 또는 비밀번호가 부정하게 사용된 경우 반드시 회사에 그 사실을 통보하여야 합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(8) 회사가 제공하는 방송 및 텍스트 정보는 투자판단의 참고자료이며, 투자판단의 최종책임은 본 정보를 열람하시는 이용자에게 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 4 장 서비스의 이용</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 12 조 (서비스의 이용 시간)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1812px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 서비스 이용은 회사의 업무상 또는 기술상 특별한 지장이 없는 한 연중무휴, 1일 24시간 운영을 원칙으로 합니다. 단, 회사는 시스템 정기점검, 증설 및 교체를 위해 회사가 정한 날이나 시간에 서비스를 일시 중단할 수 있으며, 예정되어 있는 작업으로 인한 서비스 일시 중단은 웹사이트를 통해 사전에 공지합니다</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1206px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 회사는 긴급한 시스템 점검, 증설 및 교체, 설비의 장애, 서비스 이용의 폭주, 국가비상사태, 정전 등 부득이한 사유가 발생한 경우 사전 예고 없이 일시적으로 서비스의 전부 또는 일부를 중단할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 회사는 서비스 개편 등 서비스 운영 상 필요한 경우 회원에게 사전 예고 후 서비스의 전부 또는 일부의 제공을 중단할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 13 조 (서비스의 이용 범위)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 회원은 회사를 통한 가입시 발급된 ID로 로또리코(<a href="http://www.lottorico.co.kr/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=ko&amp;q=http://www.lottorico.co.kr&amp;source=gmail&amp;ust=1561794838728000&amp;usg=AFQjCNG1kiPrcdkXCdP7ha-1ANbnkJWH8g" style="color: #1155cc; text-decoration-line: none;">http://www.lottorico.co.<wbr />kr</a>)서비스를 이용할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 14 조 (정보의 제공 및 광고의 게재)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 903px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 회사는 서비스를 운영함에 있어 각종 정보를 서비스 화면에 게재하거나 e-mail, SMS 및 서신우편, 전화상담 등의 방법으로 회원에게 제공할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 499px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">회원은 동 정보의 제공을 원하지 않는 경우 정보수신 거부를 할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 회사는 서비스의 운영과 관련하여 홈페이지, 서비스 화면, SMS, e-mail, 전화상담 등에 광고 등을 게재할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1307px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 회사는 전화상담 및 정보,광고성 문자를 수시 발송할 수 있으며, 이를 거부하고자 하는 경우 내정보&gt;회원정보수정 수신여부를 체크해제하시거나, 0808556398 수신거부전화로 요청을 하면 자동수신거부됩니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(4) 회사는 업무제휴로 인해 회사의 제휴사에 회원의 정보를 제공할 수 있습니다. 이 경우 기본적인 정보만 제공됩니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1206px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(5) 회원이 회사의 제휴사에서 제공하는 서비스를 이용할 경우, 회원은 제휴사에서 서비스 이용에 대하여 별도의 서비스 이용 절차를 필요로 하는 경우 서비스이용 신청을 하고 해당 서비스를 이용할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 398px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">① 서비스제공(각종 마케팅서비스를 포함합니다)과 회원관리</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 398px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">② 회사의 제휴 회사와의 업무제휴로 인한 회원의 정보 제공 및 활용</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1105px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(6) 회사는 본 서비스상에 게재되어 있거나 본 서비스를 통한 광고주의 판촉활동에 회원이 참여하거나 교신 또는 거래의 결과로서 발생하는 모든 손실 또는 손해에 대해 책임을 지지 않습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 15 조 (요금 및 유료정보 등)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 903px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1)회사가 제공하는 서비스는 기본적으로 무료입니다. 단, 별도의 유료정보에 대해서는 해당 정보에 명시된 요금을 지불하여야 사용 가능합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1105px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2)회사가 제공하는 무 기간 제한(평생회원) 유료서비스는 회사의 파산, 화의, 회사정리, 워크아웃 등 이와 유사한 사유가 발생하여 더이상 사이트를 유지할 수 없게되는 시점까지 유효합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1913px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3)회사에서 제공하는 유료서비스 이용회원은 특별한 사유가 없는한 서비스 중도 해지 또는 중지를 할수 없다. 만약, 부득이한 사정으로 인해 해지 또는 중지를 요청할 경우 회원은 명확한 근거서류를 FAX 또는 우편으로 회사에 서면 제출해야하며, 회사는 이를 검토후 승락 또는 자료가 명확하지 않을 경우 거부할수 있다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(4)회사의 웹사이트를 통해 회원이 획득한 마일리지(포인트)는 웹사이트내에서 현금처럼 사용할 수 있으나 현금으로 환불되지 않습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">또한 마일리지별 사용기간이 제한될 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1610px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(5)회사는 평생(5년회원 포함)유료회원 유치일로부터 3년이 지난 이후에, 정상적인 서비스 운영이 어려울 만큼 운영 비용 ( 시스템, 네트웍, 문자발송 비용 등)이 상승할 경우, 해당 유료회원에게 제공되는 서비스의 내용을 변경하거나 회원들에게 추가비용을 요청할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 2620px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(6)회사가 제공하는 추천번호-유료서비스에 대한 책임은 웹(로또리코웹사이트 ‘마이페이지’ 내조합내역)에서 제공하는 내용에 한하여 책임을 진다. 회원은 매주 복권구입 전 로또리코웹사이트에 본인 아이디로 접속하여 ‘마이페이지’에서 본인에게 부여된 추천조합을 확인하여야 하며, 특정 사유로 인한 부가서비스(SMS추천조합)를 수신하지 못했을 경우에는 로또리코웹사이트 ‘마이페이지’에서 추천조합을 확인할 수 있다. 추천조합 미확인으로 발생하는 상황에 대한 모든 책임은 회원 개인에게 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1812px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(7)로또리코의 문자발송서비스는 핸드폰기종/스팸설정/통신사사정 으로 문자 미전송될 수 있습니다. 본서비스 이용자는 매주 전송하는 번호에 대해 최종확인으로 월드로또-마이페이지에서 확인해야 할 의무가 있습니다. 문자 미전송으로 관련한 모든 문제발생대해 로또리코는 어떠한 법적책임도 지지 않습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1105px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(8)회사는 회원가입시 유료상품 가입 유치를 위해 광고성 전화를 하게 될 수 있으며, 이를 원하지 않을 시 마이로또&gt;회원정보수정에서 SMS수신여부에서 거부로 체크하시면 됩니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 16 조 (회원의 게시물 등)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 게시물이라 함은 회원이 서비스를 이용하면서 게시한 글, 사진, 각종 파일과 링크 등을 말합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1206px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 회원이 서비스에 등록하는 게시물 등으로 인하여 본인 또는 타인에게 손해나 기타 문제가 발생하는 경우 회원은 이에 대한 책임을 지게 되며, 회사는 특별한 사정이 없는 한 이에 대하여 책임을 지지 않습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 903px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 회사는 다음 각 호에 해당하는 게시물 등을 회원의 사전 동의 없이 임시게시 중단, 수정, 삭제, 이동 또는 등록 거부 등의 관련 조치를 취할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">① 회사, 회원 또는 제3자를 비방(인신공격, 모욕, 허위사실유포, 유언비어 등)하거나 명예를 손상시키는 게시물인 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 499px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">② 공공질서 및 미풍양속에 위반되는 내용을 유포하거나 링크시키는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">③ 불법복제 또는 해킹을 조장하는 내용인 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">④ 영리를 목적으로 하는 광고일 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 398px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">⑤ 범죄와 결부된다고 객관적으로 인정되는 내용일 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">⑥ 회사에서 제공하는 서비스와 관련 없는 내용(음란물, 사행심리를 조장하는 내용, 상품, 사이트 소개, 구인, 대출 등)의 게시물인 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">⑦ 타인의 아이디, 필명, 성명 등을 무단으로 도용하거나 타인의 정보를 무단으로 위·변조한 게시물인 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 398px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">⑧ 동일 또는 유사한 내용이 반복적으로 게시된 게시물인 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 398px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">⑨ 데이터의 손상으로 인하여 내용을 알아볼 수 없는 게시물인 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">⑩ 기타 관계법령에 위배된다고 판단되는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1812px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(4) 회사는 게시물 등에 대하여 제3자로부터 명예훼손, 지적재산권 등의 권리 침해를 이유로 게시중단 요청을 받은 경우 이를 임시로 게시중단(전송중단)할 수 있으며, 게시중단 요청자와 게시물 등록자 간에 소송, 합의 기타 이에 준하는 관련기관의 결정 등이 이루어져 회사에 접수된 경우 이에 따릅니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1307px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(5) 해당 게시물 등에 대해 임시게시 중단이 된 경우, 게시물을 등록한 회원은 재게시(전송재개)를 회사에 요청할 수 있으며, 게시 중단일로부터 3개월 내에 재게시를 요청하지 아니한 경우 회사는 이를 삭제할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 17 조 (게시물에 대한 저작권)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 회사가 작성한 게시물 또는 저작물에 대한 저작권 기타 지적재산권은 회사에 귀속합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 2014px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 회원이 서비스 내에 게시한 게시물의 저작권은 게시한 회원에게 귀속됩니다. 회사는 해당 게시물, 자료 등을 게재한 회원의 동의 없이 이를 영리적인 목적으로 사용하지 아니합니다. 단, 회사는 회원이 게재한 게시물, 자료 등에 대하여 서비스(회사와 업무 제휴관계에 있는 제3자의 인터넷 사이트를 포함) 내에 게재할 수 있는 권리를 가집니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1509px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 회원이 이용계약 해지를 한 경우 본인 계정에 기록된 게시물 일체는 삭제됩니다. 단, 타인에 의해 보관, 담기 등으로 재게시 되거나 복제된 게시물과 타인의 게시물과 결합되어 제공되는 게시물, 공용 게시판에 등록된 게시물 등은 그러하지 않습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 5 장 계약의 해지 및 이용제한</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 18 조 (계약해지)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 회사가 작성한 게시물 또는 저작물에 대한 저작권 기타 지적재산권은 회사에 귀속합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 2014px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 회원이 서비스 내에 게시한 게시물의 저작권은 게시한 회원에게 귀속됩니다. 회사는 해당 게시물, 자료 등을 게재한 회원의 동의 없이 이를 영리적인 목적으로 사용하지 아니합니다. 단, 회사는 회원이 게재한 게시물, 자료 등에 대하여 서비스(회사와 업무 제휴관계에 있는 제3자의 인터넷 사이트를 포함) 내에 게재할 수 있는 권리를 가집니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1509px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 회원이 이용계약 해지를 한 경우 본인 계정에 기록된 게시물 일체는 삭제됩니다. 단, 타인에 의해 보관, 담기 등으로 재게시 되거나 복제된 게시물과 타인의 게시물과 결합되어 제공되는 게시물, 공용 게시판에 등록된 게시물 등은 그러하지 않습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(4) 회사가 보유하고 있는 게시물과 컨텐츠 등 모든 정보는, 서버시스템의 원할한 운영을 위해 다음 보존기간동안 보관합니다</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">①회원 게시글 : 최소 1년간</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">②당첨자 정보 : 최소 5년간</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">③공지글 및 텍스트 컨텐츠 : 최소 1년간</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 19 조 (이용요금 등의 환불 및 기타)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1610px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">유료 서비스 가입 이후 유료 고정조합을 수령한 이후에는 환불이 불가하며, 유료 고정조합 수령 이전 서비스의 해지를 원하실 경우, 전화 등의 방법으로 해지 신청하실 수 있습니다. 단, 서비스를 정상 금액에서 차액으로 가입한 경우, 차액금에 대해서만 환불이 가능합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 398px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">[환불규정] 위 19조의 위배되지 않을 시에만 환불이 가능합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">환불액 = 결제금액 - (1일 사용요금 x 이용일수)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">서비스 환불 요청시 사용하신 기간의 이용요금(결제금액의 일할 계산)을 제외한 잔여분을 본인 확인 절차를 득한 후 처리해 드립니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 20 조 (서비스 이용제한)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1105px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">회사는 회원이 서비스 이용내용에 있어서 본 약관 제 11 조 내용을 위반하거나, 다음 각 호에 해당하는 경우 서비스 이용 제한, 초기화, 이용계약 해지 및 기타 해당 조치를 할 수 있습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 903px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 회원정보에 부정한 내용을 등록하거나 타인의 아이디, 비밀번호, 기타 개인정보를 도용하는 행위 또는 아이디를 타인과 거래하거나 제공하는 행위</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1307px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 공공질서 및 미풍양속에 위반되는 저속, 음란한 내용 또는 타인의 명예나 프라이버시를 침해할 수 있는 내용의 정보, 문장, 도형, 음향, 동영상을 전송, 게시, 전자우편 또는 기타의 방법으로 타인에게 유포하는 행위</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 600px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 다른 이용자를 희롱 또는 위협하거나, 특정 이용자에게 지속적으로 고통 또는 불편을 주는 행위</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1105px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(4) 회사로부터 특별한 권리를 부여 받지 않고 회사의 클라이언트 프로그램을 변경하거나, 회사의 서버를 해킹하거나, 웹사이트 또는 게시된 정보의 일부분 또는 전체를 임의로 변경하는 행위</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 903px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(5) 서비스를 통해 얻은 정보를 회사의 사전 승낙 없이 서비스 이용 외의 목적으로 복제하거나, 이를 출판 및 방송 등에 사용하거나, 제 3자에게 제공하는 행위</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(6) 회사의 운영진, 직원 또는 관계자를 사칭하거나 고의로 서비스를 방해하는 등 정상적인 서비스 운영에 방해가 될 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 398px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(7) 정보통신 윤리위원회 등 관련 공공기관의 시정 요구가 있는 경우</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 802px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(8) 약관을 포함하여 회사가 정한 제반 규정을 위반하거나 범죄와 결부된다고 객관적으로 판단되는 등 제반 법령을 위반하는 행위</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 6 장 손해배상 및 기타사항</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 21조 (손해배상)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 회사와 이용자는 서비스 이용과 관련하여 고의 또는 과실로 상대방에게 손해를 끼친 경우에는 이를 배상하여야 합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 903px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 단, 회사는 무료로 제공하는 서비스의 이용과 관련하여 개인정보보호정책에서 정하는 내용에 위반하지 않는 한 어떠한 손해도 책임을 지지 않습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: hidden; vertical-align: bottom;">제 22 조 (면책)</td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1004px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 회사는 천재지변, 전쟁, 기간통신사업자의 서비스 중지 및 기타 이에 준하는 불가항력으로 인하여 서비스를 제공할 수 없는 경우에는 서비스 제공에 대한책임이 면제됩니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 회사는 서비스용 설비의 보수, 교체, 정기점검, 공사 등 부득이한 사유로 발생한 손해에 대한 책임이 면제됩니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1004px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 회사는 회원의 컴퓨터 오류에 의해 손해가 발생한 경우, 또는 회원이 신상정보 및 전자우편 주소를 부실하게 기재하여 손해가 발생한 경우 책임을 지지 않습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1105px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(4) 회사는 회원이 서비스를 이용하여 기대하는 수익을 얻지 못하거나 상실한 것에 대하여 책임을 지지 않으며, 서비스를 이용하면서 얻은 자료로 인한 손해에 대하여 책임을 지지 않습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1509px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(5) 회사는 회원이 서비스에 게재한 각종 정보, 자료, 사실의 신뢰도, 정확성 등 내용에 대하여 책임을 지지 않으며, 회원 상호간 및 회원과 제 3자 상호 간에 서비스를 매개로 발생한 분쟁에 대해 개입할 의무가 없고, 이로 인한 손해를 배상할 책임도 없습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1004px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(6) 회사는 회원의 게시물을 등록 전에 사전심사 하거나 상시적으로 게시물의 내용을 확인 또는 검토하여야 할 의무가 없으며, 그 결과에 대한 책임을 지지 아니합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 1307px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(7) 회사는 회사의 사이트에 연결되거나 제휴한 업체(타 온라인사이트)에 포함되어 있는 내용의 유효성, 적합성, 법적 합리성, 저작권 준수 여부 등에 책임을 지지 않으며, 이로 인한 어떠한 손해에 대하여도 책임을 지지 않습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 196px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">제 23 조 (분쟁의 해결)</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 701px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(1) 회사와 회원은 서비스와 관련하여 발생한 분쟁을 원만하게 해결하기 위하여 필요한 모든 노력을 하여야 합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 903px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(2) 회사의 정액 서비스 회원 및 기타 유료 서비스 이용 회원의 경우 당해 서비스와 관련하여서는 회사가 별도로 정한 약관 및 정책에 따릅니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 903px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">(3) 제1항의 규정에도 불구하고 회사와 회원간에 소송이 제기될 경우, 소송은 더블에이치컴퍼니의 본사 소재지를 관할하는 법원을 관할 법원으로 합니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: arial, sans-serif; font-size: 13px; padding: 2px 3px; overflow: hidden; vertical-align: bottom;"></td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 903px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">* 서비스 이용시 문의 사항 있으시면&nbsp;<a href="http://www.lottorico.co.kr/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=ko&amp;q=http://www.lottorico.co.kr&amp;source=gmail&amp;ust=1561794838729000&amp;usg=AFQjCNHtxEHvuMJwz5yMB_-fQdJf2KE4Cg" style="color: #1155cc; text-decoration-line: none;">www.lottorico.co.kr</a>의 고객만족센터 1:1상담문의로 알려주시거나 고객센터로 연락주시면 바로 처리해 드리겠습니다.</div>
                </div>
            </td>
        </tr>
        <tr style="height: 21px;">
            <td style="font-family: Arial; font-size: 13px; padding: 2px 3px; overflow: visible; vertical-align: bottom; border-right-style: solid; border-right-color: transparent;">
                <div style="font-family: arial, sans-serif; width: 297px; overflow: hidden; white-space: nowrap;">
                    <div style="float: left;">* 본 약관은 2019년 05월 01일 부터 적용됩니다.</div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>


</div>

<div class="h30"></div>
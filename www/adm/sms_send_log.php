<?php
$sub_menu = "200400";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
include_once('./member.log.sub.php');
$g5['title'] = '문자전송내역';
$colspan = 8;
$code = array(
        'R000'=>"성공",
        'R002'=>'인증 실패',
        'R003'=>'수신자 번호 형식 오류',
        'R004'=>'발신자 번호 형식 오류',
        'R005'=>'메시지 형식 오류',
        'R006'=>'유효하지 않은 TTL',
        'R007'=>'유효하지 않은 파라미터 오류',
        'R008'=>'스팸 필터링',
        'R009'=>'서버 capacity 초과, 재시도 요망',
        'R010'=>'등록되지 않은 발신번호 사용',
        'R011'=>'발신번호 변작 방지 기준 위반 발신번호 사용',
        'R012'=>'해당 서비스유형 전송권한 없음',
        'R013'=>'발송 가능건수 초과',
        'R999'=>'알려지지 않은 에러');

$sql_common = " from g5_sms_log ";
$sql_search = " where sms_hp != '' AND DATE_FORMAT(sms_regdate,'%Y-%m-%d') between '{$fr_date}' and '{$to_date}' ";

if (isset($mb_id))
    $sql_search .= " and (mb_id like '%{$mb_id}%' ) ";
if (!empty($_GET['lotto_turn']))
    $sql_search .= " and (sms_turn = '{$_GET['lotto_turn']}' ) ";

/*if(!empty($_REQUEST['search_test']))
    $sql_search .= " and ()";*/
$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search} ";
//echo $sql."<br>";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
            {$sql_common}
            {$sql_search}
            order by sms_regdate desc
            limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);
?>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>

    <tr>
        <th scope="col" style="width:5%;">번호</th>
        <th scope="col" style="width:10%;">회원아이디</th>
        <th scope="col" style="width:10%;">회원명</th>
        <th scope="col" style="width:10%;">연락처</th>
        <th scope="col">전송메세지</th>
        <th scope="col" style="width:5%;">회차</th>
        <th scope="col" style="width:10%;">전송일자</th>
        <!--<th scope="col" style="width:5%;">남은금액</th>-->
        <th scope="col" style="width:5%;">전송결과</th>
        <th scope="col" style="width:5%;">재전송</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $mb = get_member_info($row['mb_id']);
        $bg = 'bg'.($i%2);

        $sms_res = explode("|",$row['sms_result']);

    ?>
    <tr class="<?php echo $bg; ?>">
        <td class="td_category"><?php echo $total_count-$i; ?></td>
        <td class="td_category td_category1"><a href="./member_memo_list.php?mb_id=<?php echo $row['mb_id']; ?>&mb_name=<?php echo $row['mb_name']; ?>&sfl=mb_id&stx=<?php echo $row['mb_id']; ?>" title="회원 메모 페이지로 이동합니다."><?php echo $row['mb_id']; ?></a></td>
        <td class="td_category td_category3"><?php echo $mb['mb_name'] ?></td>
        <td class="td_category td_category3"><a href="./member_memo_list.php?mb_id=<?php echo $row['mb_id']; ?>&mb_name=<?php echo $row['mb_name']; ?>&sfl=mb_id&stx=<?php echo $row['mb_id']; ?>" title="회원 메모 페이지로 이동합니다."><?php echo $row['sms_hp'] ?></a></td>
        <td class="td_category td_category3"><?php echo $row['sms_content'] ?></td>
        <td class="td_category td_category3"><?php echo $row['sms_turn'] ?>회차</td>
        <td class="td_category td_category3"><?php echo $row['sms_regdate'] ?></td>
        <!--<td class="td_category td_category3"><?php /*echo number_format($sms_res[1]); */?>원</td>-->
        <td class="td_datetime" title="<?php echo $row['sms_result'];?>"><?php echo $code[$sms_res[0]]; ?></td>
        <td class="td_datetime">
            <a class="btn btn_03" onclick="re_send_sms('<?php echo $row[idx];?>');" style="cursor: pointer;">재발송<br> <?php echo ($row[sms_re_cnt]>0)?$row[sms_re_cnt]:''; ?></a>
        </td>
    </tr>

    <?php
    }
    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없거나 관리자에 의해 삭제되었습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

<script>
    function re_send_sms(idx){
        if(idx) {
            $.ajax({
                type: "POST",
                url: "./member_proc.php",
                cache: false,
                async: false,
                data: {mode: 'reSendSms', idx: idx},
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    var str = data.result;
                    if(str=='R000'){
                        swal('','sms전송이 완료되었습니다.','success');
                        setTimeout(function(){location.reload();},2000);
                        return;
                    } else {
                        swal('',data.result[1],'warning');
                        setTimeout(function(){location.reload();},2000);
                        return;
                    }
                    return false;
                }
            });
        } else {
            alert('sms발송을 위한 정보가 넘어오지 않았습니다. 다시 시도해주세요.');
            return false;
        }
    }
</script>
<?php
if (isset($domain))
    $qstr .= "&amp;domain=$domain";
$qstr .= "&amp;page=";

$pagelist = get_paging($config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr");
echo $pagelist;

include_once('./admin.tail.php');
?>

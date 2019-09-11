<?php
$sub_menu = "200140";
include_once('./_common.php');

include_once('./admin.head.popup.php');

$colspan = 6;


if($_GET['mb_id']){
    $search_q .= " AND mb_id = '{$mb_id}' ";
}

if($_GET['lotto_turn']){
    $search_q .= " AND lotto_turn = '{$lotto_turn}' ";
} else {
    if($_GET['fr_date'] || $_GET['to_date']){
        $search_q .= " AND reg_date >= '{$fr_date}' AND reg_date <= '{$to_date}' ";
    }
}

$mb_id = $_REQUEST['mb_id'];

$que = "SELECT COUNT(*) as total_cnt FROM member_lotto_num WHERE mb_id = '{$mb_id}' ";
//echo $que;
$row = sql_fetch($que);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="http://lottorico.co.kr/skin/admin/basic/css/admin.css">
    <link rel="stylesheet" href="http://lottorico.co.kr/css/apms.css?ver=180820">
    <link rel="stylesheet" href="http://lottorico.co.kr/css/level/basic.css?ver=180820">
    <script src="http://lottorico.co.kr/js/jquery-1.11.3.min.js"></script>
    <script src="http://lottorico.co.kr/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="http://lottorico.co.kr/js/common.js?ver=180820"></script>
    <script src="http://lottorico.co.kr/js/placeholders.min.js"></script>
    <script src="http://lottorico.co.kr/js/apms.js?ver=180820"></script>
    <script src="http://lottorico.co.kr/js/sweetalert.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- 합쳐지고 최소화된 최신 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- 부가적인 테마 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>

</body>
</html>
<style>
    body, td { font-size:12px !important;}
    .hit_result{

        color:blue;
        font-weight:bold;
        font-size:15px;
    }
</style>
<div class="tbl_head01 tbl_wrap" >
    <form action="./member_lotto_show.php" method="get" name="frm">
        <input type="hidden" name="mb_id" value="<?php echo $mb_id; ?>">
        <table>            
            <thead>            
            <tr>
                <th scope="col" style="width:200px;">아이디</th>
                <th scope="col" style="width:100px;">1등</th>
                <th scope="col" style="width:200px;">2등</th>
                <th scope="col" style="width:200px;">3등</th>
                <th scope="col" style="width:200px;">4등</th>
                <th scope="col" style="width:200px;">5등</th>
                <th scope="col" style="width:200px;">마지막회차</th>
                <th scope="col" style="width:200px;">총조합수</th>
            </tr>
            </thead>
            <tbody>
                <tr style="background-color: #fff;">
                    <td><?php echo $mb_id; ?></td>
                    <?php
                    for($j=1;$j<=5;$j++){
                        $result_grade = get_id_hit_grade($j, $mb_id);
                    ?>
                    <td>
                        <?php echo $result_grade; ?>개
                    </td>
                    <?php } ?>
                    <td class="td_category td_category1"><?php echo get_current_turn(); ?></td>
                    <td class="td_category td_category3"><?php echo $row['total_cnt'] ?></td>
                </tr>
            <tr>
                <td>추천번호 검색 : </td>
                <td>
                    <input type="radio" value="all" name="gubun" <?php echo ($_REQUEST['gubun']=='all' || $_REQUEST['gubun']=='')?'checked':''; ?>> 전체
                </td>
                <td>
                    <input type="radio" value="1" name="gubun" <?php echo ($_REQUEST['gubun']=='1')?'checked':''; ?>> 당첨
                </td>
                <td>
                    <input type="radio" value="2" name="gubun" <?php echo ($_REQUEST['gubun']=='2')?'checked':''; ?>> 낙첨
                </td>
                <td>
                    <input type="radio" value="3" name="gubun" <?php echo ($_REQUEST['gubun']=='3')?'checked':''; ?>> 삭제
                </td>
                <td>
                    <select name="turn" id="turn">
                        <option value="">회차선택</option>
                        <?php
                            $sql = "SELECT lotto_turn FROM member_lotto_num WHERE 1 GROUP BY lotto_turn ORDER BY lotto_turn DESC ";
                            $r = sql_query($sql);
                            while($row = sql_fetch_array($r)){
                        ?>
                        <option value="<?php echo $row['lotto_turn']; ?>" <?php echo ($row['lotto_turn']==$_REQUEST['turn'])?'selected':''; ?>><?php echo $row['lotto_turn']; ?>회차</option>
                        <?php } ?>
                    </select>
                </td>
                <td >
                    <input type="submit" value="검색" class="btn btn_03">
                </td>
                <td>
                    <button class="btn btn_03" id="re_send_turn" onclick="return false;">문자전송</button>
                </td>
            </tr>
            </tbody>
        </table>
    <table>
        <thead>
            <tr>
                <th>회차</th>
                <th>발급일</th>
                <th>배분구분</th>
                <th>조합번호</th>
                <th>당첨순위</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if($_REQUEST['turn']!=''){
                $search_q = " AND lotto_turn = '{$_REQUEST['turn']}' ";
            }
            if($_REQUEST['gubun']!=''){
                switch($_REQUEST['gubun']){
                    case 'all':
                        $search_q .= " ";
                        break;
                    case '1':
                        $search_q .= " AND lotto_result > 0 ";
                        break;
                    case '2':
                        $search_q .= " AND lotto_result = 0";
                        break;
                    case '3':
                        $search_q .= " ";
                        break;
                }

            }
            $que = "SELECT * FROM member_lotto_num WHERE mb_id = '{$mb_id}' {$search_q}";
            //echo $que;
            $res = sql_query($que);
            while($rows = sql_fetch_array($res)){
                $result_text = "추첨전";
                $result_td_class = "";
                if($rows['lotto_result_yn']=='n' && $rows['lotto_result'] == ''){
                    $result_text = "추첨전";
                    $result_td_class = "";
                } else if($rows['lotto_result_yn']=='y' && $rows['lotto_result'] > 0){
                    $result_text = "당첨 : ".$rows['lotto_result']."등";
                    $result_td_class = "hit_result";
                } else if($rows['lotto_result_yn']=='y' && $rows['lotto_result'] == 0){
                    $result_text = "낙첨";
                    $result_td_class = "";
                }
        ?>
        <tr class="<?php echo $result_td_class; ?>">
            <td><?php echo $rows['lotto_turn']; ?></td>
            <td><?php echo $rows['reg_date']; ?></td>
            <td>
                <?php
                    /*$sql = "SELECT mb_10 FROM g5_member WHERE mb_id = '{$mb_id}'";
                    $rs = sql_fetch($sql);*/
                    if($rows['pay_yn']=='N'){
                        echo "무료배분";
                    } else {
                        echo "시스템배분";
                    }
                ?>
            </td>
            <td>
                <?php
                if(empty($_REQUEST['turn'])){
                    $turn = $rows['lotto_turn'];
                } else {
                    $turn = $_REQUEST['turn'];
                }
                $hit_ball_tmp = sql_fetch("SELECT hit_num FROM lotto_hit_result WHERE hit_turn = '{$turn}'");
                $hit_ball = explode("|",$hit_ball_tmp['hit_num']);

                $ball = explode(",",$rows[lotto_num]);

                ?>
                    <div class="" style="display:flex; justify-content: center; align-items: center; margin-top:10px;">
                        <ul>
                            <li class="ball_645 lrg  <?php echo makeLottoNumHItCss($ball[0],$hit_ball); ?>"><?php echo $ball[0]; ?></li>
                            <li class="ball_645 lrg  <?php echo makeLottoNumHItCss($ball[1],$hit_ball); ?>"><?php echo $ball[1]; ?></li>
                            <li class="ball_645 lrg  <?php echo makeLottoNumHItCss($ball[2],$hit_ball); ?>"><?php echo $ball[2]; ?></li>
                            <li class="ball_645 lrg  <?php echo makeLottoNumHItCss($ball[3],$hit_ball); ?>"><?php echo $ball[3]; ?></li>
                            <li class="ball_645 lrg  <?php echo makeLottoNumHItCss($ball[4],$hit_ball); ?>"><?php echo $ball[4]; ?></li>
                            <li class="ball_645 lrg  <?php echo makeLottoNumHItCss($ball[5],$hit_ball); ?>"><?php echo $ball[5]; ?></li>
                        </ul>
                    </div>

            </td>
            <td >
                <?php
                    if($rows['lotto_result_yn']=='n' && $rows['lotto_result'] == ''){
                        echo "추첨전";
                    } else if($rows['lotto_result_yn']=='y' && $rows['lotto_result'] > 0){
                        echo "당첨 : ".$rows['lotto_result']."등";
                    } else if($rows['lotto_result_yn']=='y' && $rows['lotto_result'] == 0){
                        echo "낙첨";
                    }
                ?>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    </form>
       
</div>







<?php
if (isset($domain))
    $qstr .= "&amp;domain=$domain";
$qstr .= "&amp;page=";

$pagelist = get_paging($config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr");
echo $pagelist;


?>
<link rel="stylesheet" href="/css/sweetalert.css">
<script src="/js/sweetalert.js"></script>
<script>
    $('#re_send_turn').on('click',function(){
       var turn = '<?php echo $_REQUEST['turn']; ?>';
       if(!turn){
           swal('문자전송','해당 회차를 검색해주세요.','warning');
           return false;
       }
       swal({
           text : '해당회차에 조합번호를 문자로 발송합니다. 이미 발송되었을 경우에도 무조건 발송됩니다.',
           type : 'warning',
           confirmButtonText : '확인',
           cancelButtonText : '취소',
           showCancelButton : true,
       }).then(function(isConfirm) {
           if (isConfirm) {
               $.ajax({
                   type : 'POST',
                   url : './member_ajax.php',
                   data : 'mode=reSendSMS&id=<?php echo $mb_id; ?>&turn='+turn,
                   success : function(res){
                       if(res == true){
                           swal('','해당회차에 문자가 발송되었습니다.','success');
                       } else {
                           swal('','문자 발송시 오류가 발생했습니다.','warning');
                       }

                   }
               })
           } else {

           }
       });
    });
</script>

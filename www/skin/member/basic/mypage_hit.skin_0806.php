<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

ini_set("display_errors",1);
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

if($header_skin)
    include_once('./header.php');


//이번주 번호할당 남은 갯수
$member_type = makeMemberGrade($_SESSION['ss_mb_id']);

?>

<div class="mypage-skin">

    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $member['name']; ?>님 My Page 입니다.</h3>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="pull-right"></span>
                        (이번주 번호할당 남은 갯수 : <?php echo getWeekRemindNumCnt($_SESSION['ss_mb_id']);?>개)
                    </li>
                    <li class="list-group-item">
                        <span class="pull-right"></span>
                        회원등급 : (<?php echo ($member_type['pay_name']!='')?$member_type['pay_name']:'무료회원'; ?>)
                    </li>
                    <li class="list-group-item">
                        <span class="pull-right"></span>
                        종료일(남은횟수) : <?php echo ($member_type['mb_2']!='')?$member_type['mb_2']:'10'; ?>
                    </li>
                </ul>
                <?php if($member['mb_profile']) { ?>
                    <div class="panel-body">
                        <?php echo conv_content($member['mb_profile'],0);?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="pull-right"></span>
                        <label class="radio-inline">
                            <input type="radio" name="hit_list" id="inlineRadio1" value="0" checked> 전체
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="hit_list" id="inlineRadio2" value="1"> 당첨
                        </label>
                    </li>
                    <li class="list-group-item" style="display:flex; justify-content: space-between;">
                        <div style="margin-top:8px;">이번주 1등 추천번호 받기</div>
                        <div>
                            <select class="form-control" name="iwantnum" id="iwantnum">
                                <option>받는 번호 갯수</option>
                                <option value="5" <?php echo ($member['mb_3'] == 5)?'selected':''; ?>>5개</option>
                                <option value="10" <?php echo ($member['mb_3'] == 10)?'selected':''; ?>>10개</option>
                                <option value="20" <?php echo ($member['mb_3'] == 20 || $member['mb_3'] == '')?'selected':''; ?>>20개</option>
                                <option value="30" <?php echo ($member['mb_3'] == 30)?'selected':''; ?>>30개</option>
                                <option value="40" <?php echo ($member['mb_3'] == 40)?'selected':''; ?>>40개</option>
                                <option value="50" <?php echo ($member['mb_3'] == 50)?'selected':''; ?>>50개</option>
                                <!--<option value="100" <?php /*echo ($member['mb_3'] == 100)?'selected':''; */?>>100개</option>-->
                            </select>
                        </div>
                        <button type="button" class="btn btn-danger" id="change_btn">변경</button>
                    </li>
                    <li class="list-group-item" style="display:flex; justify-content: space-between;">
                        <div style="margin-top:8px;">나의 조합내역 검색</div>
                        <div>
                            <select class="form-control" name="select_turn" style="width:95%; margin-left:20px;">
                                <?php
                                    $que = "SELECT * FROM member_lotto_num WHERE mb_id = '{$_SESSION['ss_mb_id']}' GROUP BY lotto_turn";
                                   // echo $que;
                                    $res = sql_query($que);
                                    while($row = sql_fetch_array($res)){
                                ?>
                                <option value="<?php echo $row['lotto_turn']; ?>" <?php echo ($row['lotto_turn']==$select_turn); ?>><?php echo $row['lotto_turn']; ?>회차검색</option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="button" class="btn btn-danger" id="turn_search">검색</button>
                    </li>
                    <li class="list-group-item">
                        <span class="pull-right"></span>
                        <label class="radio-inline" style="padding-left:0px;">
                            <table  style="width: 286px;">
                                <tr>
                                    <?php
                                    for($i=1;$i<=6;$i++){
                                        switch($i){
                                            /*case '7':
                                                $day_name = "일";
                                                break;*/
                                            case '1':
                                                $day_name = "월";
                                                break;
                                            case '2':
                                                $day_name = "화";
                                                break;
                                            case '3':
                                                $day_name = "수";
                                                break;
                                            case '4':
                                                $day_name = "목";
                                                break;
                                            case '5':
                                                $day_name = "금";
                                                break;
                                            case '6':
                                                $day_name = "토";
                                                break;
                                        }
                                        ?>
                                        <td><?php echo $day_name; ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <?php
                                    for($i=1;$i<=6;$i++){
                                        switch($i){
                                            /*case '7':
                                                $day_name = "일";
                                                break;*/
                                            case '1':
                                                $day_name1 = "mon";
                                                break;
                                            case '2':
                                                $day_name1 = "tue";
                                                break;
                                            case '3':
                                                $day_name1 = "wed";
                                                break;
                                            case '4':
                                                $day_name1 = "thu";
                                                break;
                                            case '5':
                                                $day_name1 = "fri";
                                                break;
                                            case '6':
                                                $day_name1 = "sat";
                                                break;
                                        }


                                        ?>
                                        <td>
                                            <select name="<?php echo $day_name1; ?>" id="<?php echo $day_name1; ?>">
                                                <?php
                                                for($k=0;$k<=20;$k++){
                                                    ?>
                                                    <option value="<?php echo $k;?>" <?php echo ($k==$member[$day_name1.'_sms_cnt'])?'selected':''; ?>><?php echo $k;?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </label>
                        <button type="button" class="btn btn-danger" id="change_week" style="margin-left:25px;">변경</button>
                    </li>
                </ul>
                <?php if($member['mb_profile']) { ?>
                    <div class="panel-body">
                        <?php echo conv_content($member['mb_profile'],0);?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>

                        <th scope="col" style="width:15%; text-align: center;">1등</th>
                        <th scope="col" style="width:15%; text-align: center;">2등</th>
                        <th scope="col" style="width:15%; text-align: center;">3등</th>
                        <th scope="col" style="width:15%; text-align: center;">4등</th>
                        <th scope="col" style="width:15%; text-align: center;">5등</th>
                        <th scope="col" style="width:15%; text-align: center;">마지막회차</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr style="background-color: #fff;">

                        <?php
                        for($j=1;$j<=5;$j++){
                            $result_grade = get_id_hit_grade($j, $member['mb_id']);
                            ?>
                            <td style=" text-align: center;">
                                <?php echo $result_grade; ?>개
                            </td>
                        <?php } ?>
                        <td class="td_category td_category1"><?php echo get_current_turn(); ?></td>

                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered" id="my_turn">
                    <thead>
                        <tr >
                            <th class="text-center">회차</th>
                            <th class="text-center">발급일(시간)</th>
                            <th class="text-center">발급조합번호</th>
                            <th class="text-center">당첨결과</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="text-center" colspan="4">원하시는 회차를 검색해주세요.</td>
                        </tr>



                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        $('#change_week').on('click',function(){
            var numDay = '',
                mb_id = "<?php echo $member['mb_id']; ?>",
                jsonurl =  "./ajax_mypage_proc.php";



            $('input[name="getNumDay"]').each(function(){
                if($(this).is(':checked')==true){
                    numDay = $(this).val();
                }
            });



            if(mb_id != '' && numDay != '' && typeof numDay != 'undefined') {
                $.ajax({
                    type: "POST",
                    url: jsonurl,
                    dataType: "JSON",
                    data: {"mode": "numWeekChange", "mb_id": mb_id, "numDay": numDay},
                    success: function (data) {
                        if (data.flag) {
                            alert('받는 요일이 정상적으로 변경되었습니다.');
                        } else {
                        }
                    },
                    complete: function (data) {
                    },
                    error: function (xhr, status, error) {
                        var err = status + ' \r\n' + error;
                    }
                });
            } else {
                alert('데이터가 정상적으로 넘어오지 않았습니다.');
                return;
            }
        })

        $('#turn_search').on('click',function(){
            var turn = $('select[name="select_turn"] option:selected').val();
            var hit_turn = $('input[name="hit_list"]:checked').val();

            $('input[name="hit_list"]').each(function(){
               if($(this).is(':checked')==true){
                   hit_turn = $(this).val();
               }
            });
            if(turn){
                $('#my_turn > tbody').load("/bbs/mypage_select_hit_turn.php?select_turn="+turn+'&hit_turn='+hit_turn);
            }
        });

        $('input[name="hit_list"]').on('click',function(){
            var turn = $('select[name="select_turn"] option:selected').val();
            $('#my_turn > tbody').load("/bbs/mypage_select_hit_turn.php?hit_turn="+$(this).val()+'&select_turn='+turn);
        });

        $('#change_btn').on('click',function(){
            var cnt = $('#iwantnum option:selected').val();
            var jsonurl =  "./ajax_mypage_proc.php";
            var mb_id = '<?php echo $_SESSION['ss_mb_id']; ?>';
            if(confirm('받는 추천번호 갯수를 수정하시겠습니까?')) {
                $.ajax({
                    type: "POST",
                    url: jsonurl,
                    dataType: "JSON",
                    data: {"mode": "getNumChange", "mb_id": mb_id, "cnt": cnt},
                    success: function (data) {
                        if (data.flag) {
                            alert('받는 추천번호 갯수가 변경되었습니다.');
                            location.reload(true);
                        }
                    },
                    complete: function (data) {
                    },
                    error: function (xhr, status, error) {
                        var err = status + ' \r\n' + error;
                    }
                });
            }

        });
    });
</script>
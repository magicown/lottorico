<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);


?>

<?php
if(count($rs)>0){
foreach($rs as $row){

?>
    <tr>
        <td class="text-center" style="line-height: 40px;"><?php echo $row[lotto_turn]; ?>회차</td>
        <td class="text-center" style="line-height: 40px;"><?php echo date("Y-m-d (H:i)",strtotime($row[reg_date])); ?> </td>
        <td class="hit-num" style="line-height: 30px;">
            <?php

                $ball = explode(",",$row[lotto_num]);

                ?>
                <div class="" style="display:flex; justify-content: space-between;">
                    <ul>
                        <li class="ball_645 lrg <?php echo makeLottoNumCss($ball[0]); ?>"><?php echo $ball[0]; ?></li>
                        <li class="ball_645 lrg <?php echo makeLottoNumCss($ball[1]); ?>"><?php echo $ball[1]; ?></li>
                        <li class="ball_645 lrg <?php echo makeLottoNumCss($ball[2]); ?>"><?php echo $ball[2]; ?></li>
                        <li class="ball_645 lrg <?php echo makeLottoNumCss($ball[3]); ?>"><?php echo $ball[3]; ?></li>
                        <li class="ball_645 lrg <?php echo makeLottoNumCss($ball[4]); ?>"><?php echo $ball[4]; ?></li>
                        <li class="ball_645 lrg <?php echo makeLottoNumCss($ball[5]); ?>"><?php echo $ball[5]; ?></li>
                        <!--<li class="bonus">+</li>
                                        <li class="ball_645 lrg ball1"><?php /*echo $ball[6]; */?></li>-->
                    </ul>
                </div>

        </td>
        <td class="text-center" style="line-height: 40px;"><?php echo ($row['lotto_result']>0)?$row['lotto_result']."등 당첨":''; ?></td>
    </tr>
<?php }} else { ?>
    <tr>
        <td class="text-center" colspan="4">검색된 내용이 없습니다.</td>
    </tr>
<?php } ?>

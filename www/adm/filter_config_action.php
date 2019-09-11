<?php
include_once('./_common.php');

/*if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');
print_r($_REQUEST);*/

$sql = "UPDATE filter_config SET ";
$sql .= "chain_is_1 = '{$_REQUEST['serial_no_1']}', ";
$sql .= "writer_id = '{$_SESSION['ss_mb_id']}', ";
$sql .= "update_date = NOW() ";


if(!isset($_REQUEST['serial_no_2'])){
    $sql = "UPDATE filter_config SET ";
    $sql .= "chain_is_1 = 'N', ";
    $sql .= "writer_id = '{$_SESSION['ss_mb_id']}', ";
    $sql .= "update_date = NOW() ";
}
print_r($_POST);
/*AC*/
$que = "UPDATE filter_config SET ac_yn = '{$_POST['ac_yn']}', ac_start = '{$_POST['ac_start']}', ac_end = '{$_POST['ac_end']}' WHERE idx = 1";
sql_query($que);

/*홀짝*/
if(isset($_POST['odd6'])){ $odd6 = $_POST[odd6]; } else { $odd6 = 9 ; }
if(isset($_POST['odd5'])){ $odd5 = $_POST[odd5]; } else { $odd5 = 9 ; }
if(isset($_POST['odd4'])){ $odd4 = $_POST[odd4]; } else { $odd4 = 9 ; }
if(isset($_POST['odd3'])){ $odd3 = $_POST[odd3]; } else { $odd3 = 9 ; }
if(isset($_POST['odd2'])){ $odd2 = $_POST[odd2]; } else { $odd2 = 9 ; }
if(isset($_POST['odd1'])){ $odd1 = $_POST[odd1]; } else { $odd1 = 9 ; }
if(isset($_POST['odd0'])){ $odd0 = $_POST[odd0]; } else { $odd0 = 9 ; }

$que = "UPDATE filter_config SET odd6= '{$odd6}', odd5 = '{$odd5}', odd4 = '{$odd4}', odd3 = '{$odd3}', odd2 = '{$odd2}', odd1 = '{$odd1}', odd0 = '{$odd0}' WHERE idx = 1";
echo $que."<br>";
sql_query($que);

/*고저*/
if(isset($_POST['high6'])){ $high6 = $_POST['high6']; } else { $high6 = 9; }
if(isset($_POST['high5'])){ $high5 = $_POST['high5']; } else { $high5 = 9; }
if(isset($_POST['high4'])){ $high4 = $_POST['high4']; } else { $high4 = 9; }
if(isset($_POST['high3'])){ $high3 = $_POST['high3']; } else { $high3 = 9; }
if(isset($_POST['high2'])){ $high2 = $_POST['high2']; } else { $high2 = 9; }
if(isset($_POST['high1'])){ $high1 = $_POST['high1']; } else { $high1 = 9; }
if(isset($_POST['high0'])){ $high0 = $_POST['high0']; } else { $high0 = 9; }

$que = "UPDATE filter_config SET high6= '{$high6}', high5 = '{$high5}', high4 = '{$high4}', high3 = '{$high3}', high2 = '{$high2}', high1 = '{$high1}', high0 = '{$high0}' WHERE idx = 1";
echo $que."<br>";
sql_query($que);

/*끝수합계*/
$que = "UPDATE filter_config SET last_sum_yn = '{$_POST['last_sum_yn']}', last_sum_start = '{$_POST['last_sum_start']}', last_sum_end = '{$_POST['last_sum_end']}' WHERE idx = 1";
echo $que."<br>";
sql_query($que);

/*당번합계*/
$que = "UPDATE filter_config SET add_sum_yn = '{$_POST['add_sum_yn']}', add_sum_start = '{$_POST['add_sum_start']}', add_sum_end = '{$_POST['add_sum_end']}' WHERE idx = 1";
sql_query($que);

/*쌍끝수*/
if(isset($_POST['chain_last9'])){ $chain_last9 = 'N'; } else { $chain_last9 = 'Y'; }
if(isset($_POST['chain_last8'])){ $chain_last8 = 'N'; } else { $chain_last8 = 'Y'; }
if(isset($_POST['chain_last7'])){ $chain_last7 = 'N'; } else { $chain_last7 = 'Y'; }
if(isset($_POST['chain_last6'])){ $chain_last6 = 'N'; } else { $chain_last6 = 'Y'; }
if(isset($_POST['chain_last5'])){ $chain_last5 = 'N'; } else { $chain_last5 = 'Y'; }
if(isset($_POST['chain_last4'])){ $chain_last4 = 'N'; } else { $chain_last4 = 'Y'; }
if(isset($_POST['chain_last3'])){ $chain_last3 = 'N'; } else { $chain_last3 = 'Y'; }
if(isset($_POST['chain_last2'])){ $chain_last2 = 'N'; } else { $chain_last2 = 'Y'; }
if(isset($_POST['chain_last1'])){ $chain_last1 = 'N'; } else { $chain_last1 = 'Y'; }

$que = "UPDATE filter_config SET chain_last6= '{$chain_last6}', chain_last5 = '{$chain_last5}', chain_last4 = '{$chain_last4}', chain_last3 = '{$chain_last3}', chain_last2 = '{$chain_last2}', chain_last1 = '{$chain_last1}', chain_last7 = '{$chain_last7}', chain_last8 = '{$chain_last8}', chain_last9 = '{$chain_last9}' WHERE idx = 1";
echo $que."<br>";
sql_query($que);
/*등번호제외*/
$que = "UPDATE filter_config SET before_hit_1 = '{$_POST['before_hit_1']}' WHERE idx = 1";
sql_query($que);

/*2등번호제외*/
$que = "UPDATE filter_config SET before_hit_2 = '{$_POST['before_hit_2']}' WHERE idx = 1";
sql_query($que);

/*3등번호제외*/
$que = "UPDATE filter_config SET before_hit_3 = '{$_POST['before_hit_3']}' WHERE idx = 1";
sql_query($que);

//echo $sql;
$res = sql_query($sql);

//필터를 적용한다.
$sql = "UPDATE filter_config SET filter_change_yn = 'Y', update_date = NOW() WHERE idx = 1";
sql_query($sql);

print_r($_POST);
$sql = "UPDATE filter_config SET ";
for($i=1;$i<6;$i++) {
    $sql .= "ma{$i}_yn = '{$_POST['ma'.$i.'_yn']}', ";
    $sql .= "ma{$i}_value = '{$_POST['ma'.$i.'_value']}', ";
    $sql .= "ma{$i}_start = '{$_POST['ma'.$i.'_start']}', ";
    $sql .= "ma{$i}_end = '{$_POST['ma'.$i.'_end']}', ";
}
$sql .= "update_date = NOW() ";
$sql .= " WHERE idx = 1 ";
echo $sql."<br>";
sql_query($sql);

$sql = "UPDATE filter_config SET ";
for($i=1;$i<=42;$i++) {
    $sql .= "pattern{$i}_yn = '{$_POST['pattern'.$i.'_yn']}', ";
    $sql .= "pattern{$i}_value = '{$_POST['pattern'.$i.'_value']}', ";
}
$sql .= "update_date = NOW() ";
$sql .= " WHERE idx = 1 ";
echo $sql."<br>";
sql_query($sql);


if($res){
    echo "
        <script>
            parent.call_back('Y');
        </script>
    ";
} else {
    echo "
        <script>
            parent.call_back('N');
        </script>
    ";
}


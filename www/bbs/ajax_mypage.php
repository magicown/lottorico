<?php
/**
 * Created by PhpStorm.
 * User: 김명준 (phpprogram47@gmail.com)
 * Date: 2019-04-03
 * Time: 오전 11:10
 */

    include_once('./_common.php');

    $mode = $_REQUEST['mode'];
    switch($mode){
        case 'numWeekChange':
            $flg = false;
            $sql = "UPDATE g5_member SET mb_memo = '".sql_real_escape_string($mb_memo)."' WHERE mb_id = '{$mb_id}'";
            //echo $sql;
            $res = sql_query($sql);
            if($res){
                $flg = true;
            }

            $result['flag'] = $flg;
            echo json_encode($result);
            break;
    }


?>

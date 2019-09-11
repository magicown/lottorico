<?php
if (!defined('_GNUBOARD_')) exit;


//알람 팝업 띄우기
?>
    <script>
        setInterval("chk_alarm()",600000);
        $(document).ready(function(){
            chk_alarm();
        });
        function chk_alarm() {
            console.log('start');
            $.ajax({
                type: 'POST',
                url: './admin_alarm.php',
                success: function (res) {
                    if (res == false) {

                    } else {
                        swal('', res, 'warning');
                    }

                }
            });
        }


    </script>
<?php
include_once(ADMIN_SKIN_PATH.'/tail.php');
include_once(G5_PATH.'/tail.sub.php');
?>
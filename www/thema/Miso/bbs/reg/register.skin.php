<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

?>

<div class="alert alert-info" role="alert">
	<strong><i class="fa fa-exclamation-circle"></i> 회원가입약관 및 개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.</strong>
</div>

<form  name="fregister" id="fregister" action="<?php echo $action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off" class="form" role="form">
	<div class="panel panel-default">
		<div class="panel-heading"><strong><i class="fa fa-file-text-o"></i> 회원가입약관</strong></div>
		<div class="panel-body">
			<?php if(file_exists(G5_DATA_PATH.'/apms/page/provision.php')) { ?>
				<div class="register-term">
					<?php include_once(G5_DATA_PATH.'/apms/page/provision.php'); ?>
				</div>
			<?php } else { ?>
				<textarea class="form-control input-sm" rows="10" readonly><?php echo get_text($config['cf_stipulation']) ?></textarea>
			<?php } ?>
		</div>
		<div class="panel-footer">
            <label><input type="checkbox" name="agree" value="1" id="agree11"> 회원가입약관의 내용에 동의합니다.</label>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading"><strong><i class="fa fa-user"></i> 개인정보처리방침안내</strong></div>
		<div class="panel-body">
			<?php if(file_exists(G5_DATA_PATH.'/apms/page/privacy.php')) { ?>
				<div class="register-term">
					<?php include_once(G5_DATA_PATH.'/apms/page/privacy.php'); ?>
				</div>
			<?php } else { ?>
				<textarea class="form-control input-sm" rows="10" readonly><?php echo get_text($config['cf_privacy']) ?></textarea>
			<?php } ?>
		</div>
		<div class="panel-footer">
            <label><input type="checkbox" name="agree2" value="1" id="agree21"> 개인정보처리방침안내의 내용에 동의합니다.</label>
		</div>
	</div>

    <div class="text-center">
        <button type="submit" class="btn btn-color">회원가입</button>
    </div>
</form>

<script>
    function fregister_submit(f) {
        if (!f.agree.checked) {
            alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree.focus();
            return false;
        }

        if (!f.agree2.checked) {
            alert("개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }

        return true;
    }
</script>

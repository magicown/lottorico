<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 추출
$list = apms_member_rows($wset);
$list_cnt = count($list);

?>
<ul>
<?php for ($i=0; $i < $list_cnt; $i++) { ?>
	<li><img src="<?php echo $list[$i]['photo'];?>" alt="<?php echo $list[$i]['mb_nick'];?>" class="at-tip" data-original-title="<nobr><?php echo $list[$i]['mb_nick'];?></nobr>" data-toggle="tooltip" data-placement="top" data-html="true"></li>
<?php } ?>
</ul>
<div class="clearfix"></div>
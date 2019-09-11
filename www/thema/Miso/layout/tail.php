<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>

<div class="row col">
	<div class="col-md-3">
		<h4>About</h4>
		<p>
		사이트 소개를 입력해 주세요.
		<br><br>
		<div class="miso-about-social-icons">
			<?php // 소셜 보내기
				$sns_url  = G5_URL;
				$sns_title = get_text($config['cf_title']);
				$kakaotalk_href = get_sns_share_link('kakaotalk', $sns_url, $sns_title);
			?>
			<a href="#" onclick="<?php echo get_sns_share_link('facebook', $sns_url, $sns_title);?>"><i class="fa fa-facebook"></i></a>
			<a href="#" onclick="<?php echo get_sns_share_link('twitter', $sns_url, $sns_title);?>"><i class="fa fa-twitter"></i></a>
			<a href="#" onclick="<?php echo get_sns_share_link('googleplus', $sns_url, $sns_title);?>"><i class="fa fa-google-plus"></i></a>
			<a href="#" onclick="<?php echo get_sns_share_link('kakaostory', $sns_url, $sns_title);?>"><i class="fa fa-quote-right"></i></a>
			<?php if($kakaotalk_href) { ?>
				<a href="#" onclick="<?php echo $kakaotalk_href;?>"><i class="fa fa-comment"></i></a>
			<?php } ?>
		 </div>
	</div>
	<div class="col-md-3">
		<h4>Information</h4>
		<ul>
			<li><a href="<?php echo G5_BBS_URL;?>/page.php?hid=intro">사이트 소개</a></li> 
			<li><a href="<?php echo G5_BBS_URL;?>/page.php?hid=provision">이용약관</a></li> 
			<li><a href="<?php echo G5_BBS_URL;?>/page.php?hid=privacy">개인정보 취급방침</a></li>
			<li><a href="<?php echo G5_BBS_URL;?>/page.php?hid=noemail">이메일 무단수집거부</a></li>
			<li><a href="<?php echo G5_BBS_URL;?>/page.php?hid=disclaimer">책임의 한계와 법적고지</a></li>
			<li><a href="<?php echo G5_BBS_URL;?>/page.php?hid=guide">이용안내</a></li>
			<li><a href="<?php echo G5_BBS_URL;?>/qalist.php">문의하기</a></li>
		</ul>
	</div>
	<div class="col-md-3">
		<h4>Recently</h4>
		<?php echo apms_widget('miso-member-photo', 'idx-miso-member-photo1'); // 최근접속회원 사진위젯 ?>
	</div>
	<div class="col-md-3">
		<h4>Statistics</h4>
		<ul>
			<li><a href="<?php echo $at_href['connect'];?>">
				현재 접속자 <span class="pull-right"><?php echo number_format($stats['now_total']); ?><?php echo ($stats['now_mb'] > 0) ? '('.number_format($stats['now_mb']).')' : ''; ?> 명</span></a>
			</li>
			<li>오늘 방문자 <span class="pull-right"><?php echo number_format($stats['visit_today']); ?> 명</span></li>
			<li>어제 방문자 <span class="pull-right"><?php echo number_format($stats['visit_yesterday']); ?> 명</span></li>
			<li>최대 방문자 <span class="pull-right"><?php echo number_format($stats['visit_max']); ?> 명</span></li>
			<li>전체 방문자 <span class="pull-right"><?php echo number_format($stats['visit_total']); ?> 명</span></li>
			<li>전체 회원수	<span class="pull-right at-tip" data-original-title="<nobr>오늘 <?php echo $stats['join_today'];?> 명 / 어제 <?php echo $stats['join_yesterday'];?> 명</nobr>" data-toggle="tooltip" data-placement="top" data-html="true"><?php echo number_format($stats['join_total']); ?> 명</span>
			</li>
			<li>전체 게시물	<span class="pull-right at-tip" data-original-title="<nobr>글 <?php echo number_format($menu[0]['count_write']);?> 개/ 댓글 <?php echo number_format($menu[0]['count_comment']);?> 개</nobr>" data-toggle="tooltip" data-placement="top" data-html="true"><?php echo number_format($menu[0]['count_write'] + $menu[0]['count_comment']); ?> 개</span>
			</li>
		</ul>
	</div>
</div>
	
<hr>

<!-- Copyright -->
<div class="copyright en">
	<?php if($as_href['pc_mobile']) { ?>
		<a href="<?php echo $as_href['pc_mobile'];?>" class="btn btn-black pull-right" title="<?php echo (G5_IS_MOBILE) ? 'PC버전 전환' : '모바일버전 전환';?>">
			<i class="fa fa-tablet fa-lg"></i> <span class="hidden-lg hidden-md hidden-sm"><?php echo (G5_IS_MOBILE) ? 'PC버전 전환' : '모바일버전 전환';?></span>
		</a>
	<?php } ?>	
	<ul>
		<li><?php echo $default['de_admin_company_name']; ?> (<?php echo $default['de_admin_company_owner']; ?>)</li>
		<li><?php echo $default['de_admin_company_addr']; ?></li>
		<li>전화 : <?php echo $default['de_admin_company_tel']; ?></li>
		<?php if($default['de_admin_company_fax']) echo '<li>팩스 : '.$default['de_admin_company_fax'].'</li>';?>
		<li>사업자등록번호 : <a href="http://www.ftc.go.kr/info/bizinfo/communicationList.jsp" target="_blank"><?php echo $default['de_admin_company_saupja_no']; ?></a></li>
		<li>개인정보관리책임자 : <?php echo $default['de_admin_info_name']; ?></li>
		<li>이메일 : <?php echo $default['de_admin_info_email']; ?></li>
		<?php if($default['de_admin_company_fax']) echo '<li>팩스 : '.$default['de_admin_company_fax'].'</li>';?>
		<li>통신판매업신고번호 : <?php echo $default['de_admin_tongsin_no']; ?></li>
		<?php if ($default['de_admin_buga_no']) echo '<li>부가통신사업신고번호 : '.$default['de_admin_buga_no'].'</li>'; ?>
	</ul>
	<div class="clearfix"></div>
</div>

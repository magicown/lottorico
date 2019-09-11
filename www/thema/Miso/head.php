<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
include_once(THEMA_PATH.'/assets/thema.php');

//Stylesheet
add_stylesheet('<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans%3A400%2C400italic%2C700&amp;v1&amp;subset=latin%2Clatin-ext">',0);
add_stylesheet('<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,300,500,500italic,700,900,400italic,700italic">',0);
add_stylesheet('<link rel="stylesheet" href="'.THEMA_URL.'/assets/bs3/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.COLORSET_URL.'/colorset.css" type="text/css" media="screen" class="thema-colorset">',0);
add_stylesheet('<link rel="stylesheet" href="'.THEMA_URL.'/widget/widget.css" type="text/css" media="screen">',0);

// 아래는 v1.5용으로 2.0만 사용하시는 분은 필요없으니 삭제해 또는 주석처리해 주세요.
add_stylesheet('<link rel="stylesheet" href="'.THEMA_URL.'/widget/widget-v1.5.css" type="text/css" media="screen">',0);
?>
<style> 
	body { 
		background-color: <?php echo $at_set['body_bgcolor'];?>;
		<?php if(G5_IS_MOBILE) { ?>
			background-repeat: no-repeat; background-position: 50% 50%; background-size:cover;
		<?php } else { ?>
			background-repeat: no-repeat; background-position: 50% 50%; background-attachment: fixed; background-size:cover;
		<?php } ?>
		background-image: <?php echo ($at_set['body_background'] && $at_set['body_background'] != 'none') ? "url('".$at_set['body_background']."')" : "none";?>; 
	}
</style>
<!-- Hidden Sidebar -->
<aside id="asideMenu" class="at-sidebar sidebar">
	<?php echo apms_widget('miso-misc-sidebar');?>
</aside>
<div class="wrapper <?php echo $at_set['layout'];?> <?php echo $at_set['font'];?><?php echo (G5_IS_MOBILE) ? ' font-14' : ''; //Mobile 14px?>">
	<!-- LNB -->
	<aside>
		<div class="<?php echo $at_set['lnb'];?> at-lnb">
			<div class="container">
				<nav class="at-lnb-icon hidden-xs">
					<ul class="menu">
						<li>
							<a href="javascript://" onclick="this.style.behavior = 'url(#default#homepage)'; this.setHomePage('<?php echo $at_href['home'];?>');" class="at-tip" data-original-title="<nobr>시작페이지</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true">
								<i class="fa fa-bug fa-lg"></i><span class="sound_only">시작페이지</span>
							</a>
						</li>
						<li>
							<a href="javascript://" onclick="window.external.AddFavorite(parent.location.href,document.title);" class="at-tip" data-original-title="<nobr>북마크</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true">
								<i class="fa fa-bookmark-o fa-lg"></i><span class="sound_only">북마크</span>
							</a>
						</li>
						<li>
							<a href="<?php echo $at_href['rss'];?>" target="_blank" data-original-title="<nobr>RSS 구독</nobr>" class="at-tip" data-toggle="tooltip" data-placement="bottom" data-html="true">
								<i class="fa fa-rss fa-lg"></i><span class="sound_only">RSS 구독</span>
							</a>
						</li>
					</ul>
				</nav>

				<nav class="at-lnb-menu">
					<ul class="menu">
						<?php if($is_member) { $alarm_cnt = $member['response'] + $member['memo']; ?>
							<li class="asideButton cursor"><a><i class="fa fa-user"></i><?php echo $member['mb_nick'];?><?php echo ($alarm_cnt > 0) ? ' <span class="count">('.$alarm_cnt.')</span>' : '';?></a></li>
							<?php if($member['admin']) {?>
								<li><a href="<?php echo G5_ADMIN_URL;?>"><i class="fa fa-cog"></i>관리자</a></li>
							<?php } ?>
							<li>
								<a href="<?php echo $at_href['logout'];?>">
									<i class="fa fa-power-off"></i><span class="hidden-xs">로그아웃</span>
								</a>
							</li>
						<?php } else { ?>
							<li  class="asideButton cursor"><a><i class="fa fa-power-off"></i>로그인</a></li>
							<li><a href="<?php echo $at_href['reg'];?>"><i class="fa fa-sign-in"></i><span class="hidden-xs">회원</span>가입</a></li>
							<li><a href="<?php echo $at_href['lost'];?>" class="win_password_lost"><i class="fa fa-search"></i>정보찾기</a></li>
						<?php } ?>
						<li class="hidden-xs"><a href="<?php echo $at_href['connect'];?>"><i class="fa fa-comments" title="현재 접속자"></i><?php echo number_format($stats['now_total']); ?><?php echo ($stats['now_mb'] > 0) ? '(<span class="count">'.number_format($stats['now_mb']).'</span>)' : ''; ?> 명</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</aside>

	<header>
		<!-- Logo -->
		<div class="navbar-logo">
			<div class="container">
				<h2>
					<a href="<?php echo $logo_url;?>"><?php echo $logo_name;?></a>
				</h2>
			</div>
		</div>
		<nav>
			<div class="navbar-menu-group">
				<?php if($is_multi) { ?>
					<div class="container">
						<div class="navbar-menu">
							<div class="btn-group btn-group-justified">
								<?php for($i = 0; $i < count($marr); $i++) { if(!$marr[$i]['tab_name']) continue; ?>
									<div class="btn-group">
										<a href="<?php echo $marr[$i]['idx_url'];?>" class="at-tip btn btn-menu multi<?php echo (strtolower($marr[$i]['colorset']) == $miso_id) ? ' on' : '';?>" data-original-title="<nobr><?php echo $marr[$i]['tooltip'];?></nobr>" data-toggle="tooltip" data-placement="top" data-html="true">
											<strong><?php echo $marr[$i]['tab_name'];?></strong>
										</a>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="no-multi"></div>
				<?php } ?>
			</div>
		</nav>

		<div class="modal fade" id="searchAll" tabindex="-1" role="dialog" aria-labelledby="searchAllModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-body">
						<div class="text-center">
							<h4 id="searchAllModalLabel"><i class="fa fa-search fa-lg"></i> Search</h4>
						</div>
						<form name="allsearch" method="get" onsubmit="return search_all_submit(this);" role="form" class="form" style="margin-top:20px;">
							<div class="form-group">
								<label for="opt" class="sound_only">검색대상</label>
								<select name="opt" class="form-control input-sm">
									<option value="<?php echo $at_href['isearch'];?>">아이템</option>
									<option value="<?php echo $at_href['iuse'];?>">후기</option>
									<option value="<?php echo $at_href['iqa'];?>">문의</option>
									<option value="<?php echo $at_href['search'];?>">게시물</option>
								</select>
							</div>

							<div class="form-group">
								<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
								<input type="text" name="stx" class="form-control input-sm" value="<?php echo $stx;?>" placeholder="검색어">
							</div>
						
							<div class="btn-group btn-group-justified">
								<div class="btn-group">
									<button type="submit" class="btn btn-color"><i class="fa fa-check"></i></button>
								</div>
								<div class="btn-group">
									<button type="button" class="btn btn-black" data-dismiss="modal"><i class="fa fa-times"></i></button>
								</div>
							</div>
						</form>
						<script>
							function search_all_submit(f) {

								if (f.stx.value.length < 2) {
									alert("검색어는 두글자 이상 입력하십시오.");
									f.stx.select();
									f.stx.focus();
									return false;
								}

								var url = f.opt.value;

								f.opt.value = '';

								if(url) {
									f.action = url;
								} else {
									f.action = "<?php echo $at_href['isearch'];?>";
								}
								return true;
							}
						</script>
					</div>
				</div>
			</div>
		</div>

		<div class="navbar <?php echo $at_set['menu'];?> at-navbar en" role="navigation">

			<div class="text-center navbar-toggle-box">
				<button type="button" class="navbar-toggle btn btn-black pull-left" data-toggle="collapse" data-target=".navbar-collapse">
					<i class="fa fa-bars"></i> Menu
				</button>

				<div class="pull-right">
					<button type="button" class="navbar-toggle btn btn-color" data-toggle="modal" data-target="#searchAll" onclick="return false;">
						<i class="fa fa-search"></i>
					</button>

					<button type="button" class="navbar-toggle btn btn-black asideButton">
						<i class="fa fa-outdent"></i>
					</button>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="container">
				<!-- Right Menu -->
				<div class="hidden-xs pull-right navbar-menu-right">
					<a href="#" class="btn btn-color" data-toggle="modal" data-target="#searchAll" onclick="return false;">
						<i class="fa fa-search"></i>
					</a>

					<a href="#" class="btn btn-black asideButton">
						<i class="fa fa-outdent"></i>
					</a>
				</div>
				<!-- Left Menu -->
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li<?php echo ($is_main && !$gid) ? ' class="active"' : '';?>>
							<a href="<?php echo $idx_url;?>"><?php echo $idx_name;?></a>
						</li>
						<?php for ($i=0; $i < count($tmenu); $i++) { if(!$tmenu[$i]['gr_id']) continue; // 멀티 메뉴 ?>
							<?php if($tmenu[$i]['is_sub']) { //서브메뉴가 있을 때 ?>
								<li class="dropdown<?php echo ($tmenu[$i]['on'] == "on") ? ' active' : '';?>">
									<a href="<?php echo $tmenu[$i]['href'];?>" class="dropdown-toggle" <?php echo(G5_IS_MOBILE) ? 'data-toggle="dropdown"' : 'data-hover="dropdown"';?> data-close-others="true"<?php echo $tmenu[$i]['target'];?>>
										<?php echo $tmenu[$i]['name'];?><i class="fa fa-circle <?php echo $tmenu[$i]['new'];?>"></i>
									</a>
									<ul class="dropdown-menu">
									<?php for($j=0; $j < count($tmenu[$i]['sub']); $j++) { ?>
										<?php if(!G5_IS_MOBILE && $tmenu[$i]['sub'][$j]['is_sub']) { //서브메뉴가 있을 때 ?>
											<li class="dropdown-submenu<?php echo ($tmenu[$i]['sub'][$j]['on'] == "on") ? ' sub-on' : '';?>">
												<a tabindex="-1" href="<?php echo $tmenu[$i]['sub'][$j]['href'];?>"<?php echo $tmenu[$i]['sub'][$j]['target'];?>>
													<?php echo $tmenu[$i]['sub'][$j]['name'];?><i class="fa fa-circle sub-<?php echo $tmenu[$i]['sub'][$j]['new'];?>"></i>
													<i class="fa fa-caret-right sub-caret pull-right"></i>
												</a>
												<ul class="dropdown-menu dropdown-menu-sub">
												<?php for($k=0; $k < count($tmenu[$i]['sub'][$j]['sub']); $k++) { ?>
													<li<?php echo ($tmenu[$i]['sub'][$j]['sub'][$k]['on'] == "on") ? ' class="sub-on"' : '';?>>
														<a tabindex="-1" href="<?php echo $tmenu[$i]['sub'][$j]['sub'][$k]['href'];?>"<?php echo $tmenu[$i]['sub'][$j]['sub'][$k]['target'];?>><?php echo $tmenu[$i]['sub'][$j]['sub'][$k]['name'];?></a>
													</li>
												<?php } ?>
												</ul>
											</li>
										<?php } else { //서브메뉴가 없을 때 ?>
											<li<?php echo ($tmenu[$i]['sub'][$j]['on'] == "on") ? ' class="sub-on"' : '';?>>
												<a href="<?php echo $tmenu[$i]['sub'][$j]['href'];?>"<?php echo $tmenu[$i]['sub'][$j]['target'];?>>
													<?php echo $tmenu[$i]['sub'][$j]['name'];?><i class="fa fa-circle <?php echo $tmenu[$i]['sub'][$j]['new'];?>"></i>
												</a>
											</li>
										<?php } ?>
									<?php } ?>
									</ul>
								</li>
							<?php } else { //서브메뉴가 없을 때 ?>
								<li<?php echo ($tmenu[$i]['on'] == "on") ? ' class="active"' : '';?>>
									<a href="<?php echo $tmenu[$i]['href'];?>"<?php echo $tmenu[$i]['target'];?>>
										<?php echo $tmenu[$i]['name'];?><i class="fa fa-circle <?php echo $tmenu[$i]['new'];?>"></i>
									</a>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="navbar-menu-bar"></div>
		</div>
	</header>

	<?php // Title
		if($is_main) { // Main Title 
			$at_content = (G5_IS_MOBILE) ? 'main at-main-mobile' : 'main';
			@include_once($layout_path.'/index.head.php');
		} else {
			$at_content = (G5_IS_MOBILE) ? 'page at-page-mobile' : 'page';
			if($page_title) { //Page Title
				if($bo_table) $page_title = '<a href="'.G5_BBS_URL.'/board.php?bo_table='.$bo_table.'"><span class="white">'.$page_title.'</span></a>';
				$page_background = ($at_set['page_title'] && $at_set['page_title'] != 'none') ? ' style="background-image: url(\''.$at_set['page_title'].'\');"' : '';
				$page_title_class = ($page_background && G5_IS_MOBILE) ? ' mobile-bg' : '';
				echo '<div class="page-title'.$page_title_class.'"'.$page_background.'><div class="container">'.PHP_EOL;
				echo '<h2>'.$page_title.'</h2>'.PHP_EOL;
				if($page_desc) echo '<ol class="breadcrumb hidden-xs"><li class="active">'.$page_desc.'</li></ol>'.PHP_EOL;
				echo '</div></div>'.PHP_EOL;
			}
		} 
	?>

	<div class="at-content<?php echo (G5_IS_MOBILE) ? ' at-content-mobile' : '';?>">
		<?php if($col_name) { ?>
			<div class="container at-container">
			<?php if($col_name == "two") { ?>
				<div class="row">
					<div class="col-md-<?php echo $col_content;?><?php echo ($at_set['side']) ? ' pull-right' : '';?> contentArea">
						<div class="at-<?php echo $at_content;?>">
			<?php } else { ?>
				<div class="at-<?php echo $at_content;?>">
			<?php } ?>
		<?php } ?>

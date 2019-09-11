<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($boset['mode']) {
	apms_script('masonry');
	apms_script('imagesloaded');
	apms_script('infinite');
}

?>

<div class="list-infinite-media">
	<div class="list-media bg-white">
		<?php include($board_skin_path.'/list.rows.php'); ?>
	</div>

	<div class="clearfix"></div>

	<?php if (count($list) == 0) { echo '<div class="text-center text-muted list-none">게시물이 없습니다.</div>'; } ?>

	<?php if($boset['mode']) { ?>
		<div id="list-nav">
			<a href="<?php echo $board_skin_url;?>/list.rows.php?bo_table=<?php echo $bo_table;?><?php echo preg_replace("/&amp;page\=([0-9]+)/", "", $qstr);?>&amp;npg=<?php echo ($page > 1) ? ($page - 1) : 0;?>&amp;page=2"></a>
		</div>
		<?php if($boset['mode'] == "2") { ?>
			<div class="list-more">
				<a id="list-more" href="#" title="더보기"><i class="fa fa-arrow-circle-down"></i><span class="sound_only">더보기</span></a>
			</div>
		<?php } ?>
		<script type="text/javascript">
			$(function(){
				var $container = $('.list-media');

				$container.imagesLoaded(function(){
					$container.animate({ opacity: 1 });
					$container.masonry({
						itemSelector : '.list-item',
						columnWidth  : '.list-item',
						isAnimated: true
					});
				});

				$container.infinitescroll({
					navSelector  : '#list-nav',    // selector for the paged navigation
					nextSelector : '#list-nav a',  // selector for the NEXT link (to page 2)
					itemSelector : '.list-item',     // selector for all items you'll retrieve
					loading: {
						finishedMsg: 'No more items to load.',
						img: '<?php echo APMS_PLUGIN_URL;?>/img/loader.gif',
					}
				}, function( newElements ) { // trigger Masonry as a callback
					var $newElems = $( newElements ).css({ opacity: 0 });
					$newElems.imagesLoaded(function(){
						$newElems.animate({ opacity: 1 });
						$container.masonry( 'appended', $newElems, true);
					});
				});
				<?php if($boset['mode'] == "2") { ?>
				$(window).unbind('.infscr');
				$('#list-more').click(function(){
				   $container.infinitescroll('retrieve');
				   $('#list-nav').show();
					return false;
				});
				$(document).ajaxError(function(e,xhr,opt){
					if(xhr.status==404) $('#list-nav').remove();
				});
				<?php } ?>
			});
		</script>
	<?php } ?>
	<div class="clearfix"></div>
</div>

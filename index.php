<?php get_header(); ?>
<div class="main-content-w">
<?php
	if ( isset($_GET['order']) ){
		switch ($_GET['order']){
			case 'rand' : $orderby = 'rand'; break;
			case 'commented' : $orderby = 'comment_count'; break;
			case 'alpha' : $orderby = 'title'; break;
			default : $orderby = 'title';
		}
		if($_GET['order'] == 'rand' || $_GET['order'] == 'commented' || $_GET['order'] == 'alpha'){
			global $wp_query;
			$args= array('orderby' => $orderby, 'order' => 'DESC');
			$arms = array_merge($args, $wp_query->query);
			query_posts($arms);
		}
	}
	if (have_posts())
?>
	<?php defindPrimarySidebar(true); ?>
	<div class="main-content-i">
		<?php 
		require_once(get_template_directory().'/inc/setLayoutVars.php');
		//精选内容开始
		if(get_option('wf_show_featured')){
			if(get_option('wf_featured_type') == 'compact'){
				_e(do_shortcode('[os_featured_slider]'));
			}else{
				_e(do_shortcode('[os_featured_carousel]'));
			}
		}
		?>
		<div class="content side-padded-content">
		<?php
		// 顶部栏目
		if(is_active_sidebar('sidebar-3') && get_option('wf_show_topbar')){
			echo '<div class="top-sidebar-wrapper">';
			dynamic_sidebar('sidebar-3');
			echo '</div>';
		}
		//内容开始
		?>
			<div class="index-isotope <?php echo $isotope_class; ?>" data-layout-mode="<?php echo $layout_mode; ?>">
				<?php $os_current_box_counter = 1; $os_ad_block_counter = 0; ?>
				<?php if(have_posts()) : while(have_posts()): the_post(); ?>
					<?php get_template_part($template_part, get_post_format()); ?>
					<?php //os_ad_between_posts(); ?>
				<?php endwhile; endif; ?>
			</div>
			<?php require_once(get_template_directory().'/inc/pagingMode.php') ?>
		</div>
		<?php require_once(get_template_directory().'/inc/copyright.php') ?>
	</div>
</div>
<?php get_footer(); ?>
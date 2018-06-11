<?php
/**
 * 模板头部
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="<?php is_front_page() ? _e(get_option('wf_description')) : wp_title(''); ?>"/>
	<?php
	if(is_front_page()){ // 判断是否为首页
		$terms = get_the_terms($id, 'label'); // 输出文章的关键字
		if(count($terms)) foreach($terms as $term){ $arr[] = $term->name; }
	}
	?>
<meta name="keywords" content="<?php is_front_page() ? _e(get_option('wf_keywords')) : _e(implode(' ',$arr)); ?>" />
	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
	<![endif]-->
<?php wp_head(); ?>
<?php _e(str_replace('\\','',get_option('wf_statistics'))); ?>
<?php _e(str_replace('\\','',get_option('wf_baidu_push'))); ?>

</head>
<body <?php body_class(); ?>>
	<div class="menu-block">
	<?php if(get_option('wf_menu_position') == "top"): //如果是顶部菜单 ?>
	<?php if(get_current_menu_style() == 'v2'){ //判断菜单版本 ?>
		<div class="menu-inner-w">
			<div class="logo">
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<?php if(get_option('wf_logo_image')): ?>
						<img src="<?php _e(get_option('wf_logo_image')); ?>" alt="">
					<?php endif; ?>
					<?php if(get_option('wf_logo_image')): ?>
						<span><?php bloginfo('name'); ?></span>
					<?php endif; ?>
				</a>
			</div>
		<?php wp_nav_menu(array('theme_location'  => 'side_menu', 'fallback_cb' => false, 'container_class' => 'os_menu')); ?>
			<div class="menu-search-form-w">
				<?php get_search_form(); ?>
			</div>
			<div class="menu-social-w hidden-sm hidden-md">
				<?php if( function_exists('zilla_social') ) zilla_social(); ?>
			</div>
		</div>
	<?php }else{ ?>
		<div class="menu-inner-w">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php if(get_option('wf_logo_image')): ?>
								<img src="<?php _e(get_option('wf_logo_image')); ?>" alt="">
							<?php endif; ?>
							<?php if(get_option('wf_logo_text')): ?>
								<span><?php _e(get_option('wf_logo_text')); ?></span>
							<?php endif; ?>
							</a>
						</div>
					</div>
					<div class="col-sm-4">
						<?php if(function_exists('zilla_social')) zilla_social(); ?>
					</div>
					<div class="col-sm-4">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</div>
		<?php wp_nav_menu(array('theme_location'  => 'side_menu', 'fallback_cb' => false, 'container_class' => 'os_menu')); ?>
	<?php } ?>
	<?php else: ?>
		<div class="logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if(get_option('wf_logo_image')): ?>
				<img src="<?php _e(get_option('wf_logo_image')); ?>" alt="<?php _e(get_option('wf_logo_text')); ?>" title="<?php _e(get_option('wf_logo_text')); ?>"/>
			<?php endif; ?>
			<?php if(get_option('wf_logo_text')): ?>
				<span><?php _e(get_option('wf_logo_text')); ?></span>
			<?php endif; ?>
			</a>
		</div>
			<?php if(get_option('wf_search_position') == 'above_menu'){ get_search_form(); } ?>
			<div class="divider"></div>
			<?php wp_nav_menu(array('theme_location'  => 'side_menu', 'fallback_cb' => false, 'container_class' => 'os_menu')); ?>
			<?php if(get_option('wf_search_position') == 'under_menu'){ get_search_form(); }  ?>
			<div class="divider"></div>
			<?php if(get_option('wf_search_position') == 'above_social'){ get_search_form(); } ?>
			<?php if(function_exists('zilla_social') ) zilla_social(); ?>
			<?php if(get_option('wf_search_position') == 'under_social'){ get_search_form(); } ?>
			<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
				<div class="under-menu-sidebar-wrapper">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<div class="menu-toggler-w">
		<a href="#" class="menu-toggler">
			<i class="fa os-icon-bars"></i>
			<span class="menu-toggler-label"><?php _e('Menu', 'pluto') ?></span>
		</a>
		<?php if(get_field('show_sidebar_on_mobile', 'option')){ ?>
			<a href="#" class="sidebar-toggler">
				<i class="fa os-icon-bars"></i>
				<span class="sidebar-toggler-label"><?php _e('Sidebar', 'pluto') ?></span>
			</a>
		<?php } ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
			<?php if(get_option('wf_logo_image')): ?>
				<img src="<?php _e(get_option('wf_logo_image')); ?>" alt="">
			<?php endif; ?>
			<?php if(get_option('wf_logo_text')): ?>
				<span><?php _e(get_option('wf_logo_text')); ?></span>
			<?php endif; ?>
		</a>
	</div>
	<?php if(get_field('show_sidebar_on_mobile', 'option')){ ?>
		<div class="sidebar-main-toggler">
			<i class="fa os-icon-bars"></i>
		</div>
	<?php } ?>
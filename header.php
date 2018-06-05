<?php
/**
 * 模板头部
 */
?><!DOCTYPE html>
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
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="爱看电影网关注提供720p高清、1080p高清、蓝光原盘高清、高清3d高清、最新热门磁力链迅雷下载网站，是下载了解电影天堂！" />
	<meta name="keywords" content="电影天堂、高清电影下载、1080p高清、高清电影、720p、1080p、蓝光原盘、磁力链、电影下载" />
	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
	<![endif]-->
</head>

<body <?php body_class(); ?>>
	<div class="menu-block <?php if(get_field('hide_widgets_under_menu', 'option') == TRUE) echo 'hidden-on-smaller-screens'; ?>">
	<?php if(get_current_menu_position() == "top"): ?>
	<?php if(get_current_menu_style() == 'v2'){ ?>
		<div class="menu-inner-w">
			<div class="logo">
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<?php if(get_field('logo_image', 'option')): ?>
						<img src="<?php the_field('logo_image', 'option'); ?>" alt="">
					<?php endif; ?>
					<?php if(get_field('logo_text', 'option')): ?>
						<span><?php the_field('logo_text', 'option'); ?></span>
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
									<?php if(get_field('logo_image', 'option')): ?>
										<img src="<?php the_field('logo_image', 'option'); ?>" alt="">
									<?php endif; ?>
									<?php if(get_field('logo_text', 'option')): ?>
										<span><?php the_field('logo_text', 'option'); ?></span>
									<?php endif; ?>
								</a>
							</div>
						</div>
						<div class="col-sm-4">
							<?php if( function_exists('zilla_social') ) zilla_social(); ?>
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
					<?php if(get_field('logo_image', 'option')): ?>
						<img src="<?php the_field('logo_image', 'option'); ?>" alt="">
					<?php endif; ?>
					<?php if(get_field('logo_text', 'option')): ?>
						<span><?php the_field('logo_text', 'option'); ?></span>
					<?php endif; ?>
				</a>
			</div>
			<?php if(get_field('search_form_position', 'option') == 'above_menu') get_search_form(); ?>

			<div class="divider"></div>

			<?php wp_nav_menu(array('theme_location'  => 'side_menu', 'fallback_cb' => false, 'container_class' => 'os_menu')); ?>



			<?php if(get_field('search_form_position', 'option') == 'under_menu') get_search_form(); ?>



			<div class="divider"></div>

			<?php if(get_field('search_form_position', 'option') == 'above_social') get_search_form(); ?>


			<?php if( function_exists('zilla_social') ) zilla_social(); ?>


			<?php if(get_field('search_form_position', 'option') == 'under_social') get_search_form(); ?>



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
			<?php if(get_field('logo_image', 'option')): ?>
				<img src="<?php the_field('logo_image', 'option'); ?>" alt="">
			<?php endif; ?>
			<?php if(get_field('logo_text', 'option')): ?>
				<span><?php the_field('logo_text', 'option'); ?></span>
			<?php endif; ?>
		</a>
	</div>
	<?php if(get_field('show_sidebar_on_mobile', 'option')){ ?>
		<div class="sidebar-main-toggler">
			<i class="fa os-icon-bars"></i>
		</div>
	<?php } ?>
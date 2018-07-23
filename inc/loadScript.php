<?php
/* JS CSS 加载函数 */
function loadScript() {
    // 字体部分
	// if(get_field('font_library', 'option') == "adobe_typekit_fonts"){
	// 	wp_enqueue_script( 'pluto_typekit', '//use.typekit.net/' . get_field('adobe_typekit_id', 'option') . '.js');
	// 	add_action( 'wp_head', 'pluto_load_typekit' );
	// }elseif(get_field('font_library', 'option') == "myfonts"){
	// 	add_action( 'wp_head', 'pluto_load_myfonts_script' );
	// }else{
	// 	// 谷歌字体
	// 	if(get_field('google_fonts_href', 'option')){
	// 		wp_enqueue_style( 'pluto-google-font', get_field('google_fonts_href', 'option'), array(), null );
	// 	}else{
	// 		wp_enqueue_style( 'pluto-google-font', 'http://fonts.googleapis.com/css?family=Droid+Serif:400,700|Open+Sans:300,400,700', array(), null );
	// 	}
	// }

	// 固定边栏
	wp_enqueue_script( 'pluto-flexslider', get_template_directory_uri() . '/res/js/jquery.flexslider.min.js', array( 'jquery' ), WATERFALL_THEME_VERSION, true );
	// 回到顶部链接
	wp_enqueue_script( 'pluto-back-to-top', get_template_directory_uri() . '/res/js/back-to-top.js', array( 'jquery' ), WATERFALL_THEME_VERSION, true );

	// Init Lightbox
	// if(get_field('disable_default_image_lightbox', 'option') != true){
	// 	wp_enqueue_style( 'pluto-magnific-popup', get_template_directory_uri() . '/res/css/magnific-popup.css', array(), WATERFALL_THEME_VERSION );
	// 	wp_enqueue_script( 'pluto-magnific-popup', get_template_directory_uri() . '/res/js/jquery.magnific-popup.min.js', array( 'jquery' ), WATERFALL_THEME_VERSION, true );
	// 	wp_enqueue_script( 'pluto-magnific-popup-init', get_template_directory_uri() . '/res/js/init-lightbox.js', array( 'jquery', 'pluto-magnific-popup' ), WATERFALL_THEME_VERSION, true );
	// }

	// Load our main stylesheet.
	wp_enqueue_style( 'pluto-style', get_stylesheet_uri() );
	// Load editor styles
	wp_enqueue_style( 'pluto-editor-style', get_template_directory_uri() . '/res/css/editor-style.css', array(), WATERFALL_THEME_VERSION );

	// Color scheme

	if ( is_rtl() ) {
		// If theme uses right-to-left language
		wp_enqueue_style( 'pluto-main-less-rtl', get_template_directory_uri() . '/res/less/include-list-rtl.less', array(), WATERFALL_THEME_VERSION );
	}else{
		wp_enqueue_style( 'pluto-main-less', get_template_directory_uri() . '/res/less/include-list.less', array(), WATERFALL_THEME_VERSION );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'pluto-jquery-debounce', get_template_directory_uri() . '/res/js/jquery.ba-throttle-debounce.min.js', array( 'jquery' ), WATERFALL_THEME_VERSION, true );
	// infinite scroll helpers
	if(get_option('wf_navigation_type') == 'infinite' || get_option('wf_navigation_type') == 'infinite_button'){
		wp_enqueue_script( 'pluto-os-infinite-scroll', get_template_directory_uri() . '/res/js/infinite-scroll.js', array( 'jquery', 'pluto-jquery-debounce' ), WATERFALL_THEME_VERSION, true );
	}

	// Load isotope
	wp_enqueue_script( 'pluto-images-loaded', get_template_directory_uri() . '/res/js/imagesloaded.pkgd.min.js', array( 'jquery' ), WATERFALL_THEME_VERSION, true );
	wp_enqueue_script( 'pluto-isotope', get_template_directory_uri() . '/res/js/isotope.pkgd.min.js', array( 'jquery', 'pluto-images-loaded' ), WATERFALL_THEME_VERSION, true );
	wp_enqueue_script( 'pluto-jquery-mousewheel', get_template_directory_uri() . '/res/js/jquery.mousewheel.js', array( 'jquery' ), WATERFALL_THEME_VERSION, true );
	wp_enqueue_script( 'pluto-perfect-scrollbar', get_template_directory_uri() . '/res/js/perfect-scrollbar.js', array( 'jquery', 'pluto-jquery-mousewheel' ), WATERFALL_THEME_VERSION, true );

	// Load owl carousel plugin
	wp_enqueue_script( 'pluto-owl-carousel', get_template_directory_uri() . '/res/js/owl.carousel.min.js', array( 'jquery', 'pluto-jquery-mousewheel' ), WATERFALL_THEME_VERSION, true );
	wp_enqueue_style( 'pluto-owl-carousel', get_template_directory_uri() . '/res/css/owl.carousel.css', array(), WATERFALL_THEME_VERSION );

	if(is_single()){
		// Load qrcode generator script only for single post
		wp_enqueue_script( 'pluto-qrcode', get_template_directory_uri() . '/res/js/qrcode.min.js', array( 'jquery' ), WATERFALL_THEME_VERSION, true );
		wp_enqueue_script( 'pluto-bootstrap-transition', get_template_directory_uri() . '/res/js/bootstrap/transition.js', array( 'jquery' ), WATERFALL_THEME_VERSION, true );
		wp_enqueue_script( 'pluto-bootstrap-modal', get_template_directory_uri() . '/res/js/bootstrap/modal.js', array( 'jquery', 'pluto-bootstrap-transition' ), WATERFALL_THEME_VERSION, true );
	}

	// if protect images checkbox in admin is set to true - load script
	// if(get_field('protect_images_from_copying', 'option') === true){
	// 	wp_enqueue_script( 'pluto-protect-images', get_template_directory_uri() . '/res/js/image-protection.js', array( 'jquery' ), WATERFALL_THEME_VERSION, true );
	// }

	// Load default scripts for the theme
	wp_enqueue_script( 'pluto-script', get_template_directory_uri() . '/res/js/functions.js', array( 'jquery' ), WATERFALL_THEME_VERSION, true );
}

add_action( 'wp_enqueue_scripts', 'loadScript' );
?>
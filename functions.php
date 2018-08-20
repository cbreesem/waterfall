<?php

// 定义模板版本
if (!defined('WATERFALL_THEME_VERSION')) define('WATERFALL_THEME_VERSION', '1.0');

require_once get_template_directory().'/inc/shortCodes.php';
require_once get_template_directory().'/inc/manageSetup.php';
require_once get_template_directory().'/inc/modelTags.php';
require_once get_template_directory().'/inc/menuAndSidebar.php';

require_once dirname( __FILE__ ).'/inc/helpers.php';
require_once dirname( __FILE__ ).'/inc/loadScript.php';

require_once get_template_directory().'/inc/less2Css.php';
require_once get_template_directory().'/inc/lessVariables.php';

add_action('in、it', 'html_page_permalink', -1);
function html_page_permalink() {
    global $wp_rewrite;
    if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
        $wp_rewrite->page_structure = $wp_rewrite->page_structure.'.html';
    }
}
function nice_trailingslashit($string, $type_of_url) {
    if ( $type_of_url != 'single' && $type_of_url != 'page' )
    $string = trailingslashit($string);
    return $string;
}
add_filter('user_trailingslashit', 'nice_trailingslashit', 10, 2);

// 自定义排序
function orderCustom( $query ) {
    if ((is_home() || is_archive()) && $query->is_main_query()) {
      $query->set( 'meta_key', $_GET['order']);
      $query->set( 'orderby', array('meta_value_num' => 'DESC', 'date' => 'DESC'));
      $query->set( 'order', 'DESC' );
    }
    return $query;
}
add_action('pre_get_posts', 'orderCustom');

if(!function_exists('waterfallSetup')){
    function waterfallSetup(){
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( "custom-header" );
        add_theme_support( "custom-background" );
        add_editor_style();

        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 672, 372, false );
        add_image_size( 'pluto-full-width', 1038, 576, false );
        add_image_size( 'pluto-index-width', 400, 700, false );
        add_image_size( 'pluto-fixed-height', 400, 300, true );
        add_image_size( 'pluto-fixed-height-image', 400, 700, true );
        add_image_size( 'pluto-top-featured-post', 200, 150, true );
        add_image_size( 'pluto-carousel-post', 600, 400, true );

        register_nav_menus(array('side_menu' => __('主菜单', 'WaterFall' )));
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));
        add_theme_support('post-formats', array('aside','image','video','audio','quote','link','gallery'));

        function searchFilter($query) {
            if ($query->is_search) {
                $query->set('post_type', 'post');
            }
            return $query;
        }
        add_filter('pre_get_posts','searchFilter');
    }
}
add_action('after_setup_theme', 'waterfallSetup');

add_action( 'wp_head', 'add_ajax_library' );
function add_ajax_library() {
    $html = '<script type="text/javascript">';
        $html .= 'var ajaxurl = "'.admin_url( 'admin-ajax.php' ).'"';
    $html .= '</script>';
    echo $html;
} 
require_once dirname( __FILE__ ).'/inc/infiniteScroll.php';



// 移除顶部多余信息
remove_action('wp_head', 'index_rel_link');//当前文章的索引
remove_action('wp_head', 'feed_links_extra', 3);// 额外的feed,例如category, tag页
remove_action('wp_head', 'start_post_rel_link', 10, 0);// 开始篇
remove_action('wp_head', 'parent_post_rel_link', 10, 0);// 父篇
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // 上、下篇.
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//rel=pre
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );//rel=shortlink
remove_action('wp_head', 'rel_canonical' );
wp_deregister_script('l10n');

remove_action('wp_head','wlwmanifest_link');//移除head中的rel="wlwmanifest"
remove_filter('the_content', 'wptexturize');//禁用半角符号自动转换为全角
remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
remove_action('wp_head', 'wp_generator' ); //去除版本信息
remove_action('wp_head', 'rsd_link' );//清除离线编辑器接口
remove_action('wp_head', 'feed_links',2 );
remove_action('wp_head', 'feed_links_extra',3 );//清除feed信息

?>
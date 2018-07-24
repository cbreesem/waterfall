<?php

require_once get_template_directory() . '/inc/shortCodes.php';
require_once get_template_directory() . '/inc/manageSetup.php';
require_once dirname( __FILE__ ) . '/inc/helpers.php';
require_once dirname( __FILE__ ) . '/inc/loadScript.php';

// 定义模板版本
if (!defined('WATERFALL_THEME_VERSION')) define('WATERFALL_THEME_VERSION', '1.0');

require_once get_template_directory() . '/inc/less2Css.php';
require_once get_template_directory() . '/inc/lessVariables.php';

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

// 自定义扩展标签
add_action('init','createLanguage');
add_action('init','createDistrict');
add_action('init','createYear');
add_action('init','createLabel');
add_action('init','createDirectors');
add_action('init','createScriptwriters');
add_action('init','createActors');
function createLanguage(){
    $labels = array(
        'name' => _x( '影片语言筛选', '影片语言' ),
        'singular_name' => _x( 'language', '语言名称' ),
        'search_items' =>  __( '语言搜索' ),
        'all_items' => __( '所有语言' ),
        // 'parent_item' => __( 'Parent color' ),
        // 'parent_item_colon' => __( 'Parent color:' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的语言' ),
        'new_item_name' => __( '新的语言名称' ),
      );
    register_taxonomy('language','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}
function createDistrict(){
    $labels = array(
        'name' => _x( '影片地区筛选', '影片地区' ),
        'singular_name' => _x( 'district', '地区名称' ),
        'search_items' =>  __( '地区搜索' ),
        'all_items' => __( '所有地区' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的地区' ),
        'new_item_name' => __( '新的地区名称' ),
      );
    register_taxonomy('district','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}
function createYear(){
    $labels = array(
        'name' => _x( '影片年代筛选', '影片年代' ),
        'singular_name' => _x( 'year', '年代名称' ),
        'search_items' =>  __( '年代搜索' ),
        'all_items' => __( '所有年代' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的年代' ),
        'new_item_name' => __( '新的年代名称' ),
      );
    register_taxonomy('year','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}
function createLabel(){
    $labels = array(
        'name' => _x( '影片标签筛选', '影片标签' ),
        'singular_name' => _x( 'label', '标签名称' ),
        'search_items' =>  __( '年代搜索' ),
        'all_items' => __( '所有年代' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的年代' ),
        'new_item_name' => __( '新的年代名称' ),
      );
    register_taxonomy('label','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}
function createDirectors(){
    $labels = array(
        'name' => _x( '影片导演筛选', '导演标签' ),
        'singular_name' => _x( 'directors', '导演名称' ),
        'search_items' =>  __( '导演搜索' ),
        'all_items' => __( '所有导演' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的导演' ),
        'new_item_name' => __( '新的导演名称' ),
      );
    register_taxonomy('directors','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}
function createScriptwriters(){
    $labels = array(
        'name' => _x( '影片编剧筛选', '编剧标签' ),
        'singular_name' => _x( 'scriptwriters', '编剧名称' ),
        'search_items' =>  __( '编剧搜索' ),
        'all_items' => __( '所有编剧' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的编剧' ),
        'new_item_name' => __( '新的编剧名称' ),
      );
    register_taxonomy('scriptwriters','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}
function createActors(){
    $labels = array(
        'name' => _x( '影片演员筛选', '演员标签' ),
        'singular_name' => _x( 'actors', '演员名称' ),
        'search_items' =>  __( '演员搜索' ),
        'all_items' => __( '所有演员' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的演员' ),
        'new_item_name' => __( '新的编剧演员' ),
      );
    register_taxonomy('actors','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}

/**
 * Register Pluto widget areas.
 */
function widgetsInit() {
    // require get_template_directory() . '/inc/widgets.php';
    register_sidebar( array(
      'name'          => __('主要侧栏'),
      'id'            => 'sidebar-1',
      'description'   => __('页面右边的侧栏'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h1 class="widget-title">',
      'after_title'   => '</h1>',
    ) );
    register_sidebar( array(
      'name'          => __('菜单下栏目'),
      'id'            => 'sidebar-2',
      'description'   => __('Sidebar which appears under the menu'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h1 class="widget-title">',
      'after_title'   => '</h1>',
    ) );
    register_sidebar( array(
      'name'          => __( '顶部栏目', 'pluto' ),
      'id'            => 'sidebar-3',
      'description'   => __( 'Sidebar which appears on the top of the page.', 'pluto' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h1 class="widget-title">',
      'after_title'   => '</h1>',
    ) );
  }
add_action('widgets_init', 'widgetsInit');

function os_the_primary_sidebar($masonry=false){
    // $condition = $masonry ? (os_get_show_sidebar_on_masonry() == true) : true;
    $condition = true;
    if((get_field('sidebar_position', 'option') != "none") && is_active_sidebar( 'sidebar-1' ) && $condition){
        $sidebar = dynamic_sidebar('sidebar-1');
        echo '<div class="primary-sidebar-wrapper">
            <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                '.$sidebar.'
            </div>
        </div>';
    }
}
// 添加页面菜单class
add_filter('body_class','menuBodyClass');
function menuBodyClass($classes){
    // 判断菜单方位及风格加载其样式
    switch(get_option('wf_menu_position')){
        case 'top':
            $classes[] = 'menu-position-top';
            switch (get_option('wf_menu_style')) {
                case 'v1':
                    $classes[] = 'menu-style-v1';
                    break;
                case 'v2':
                    $classes[] = 'menu-style-v2 menu-fixed';
                    break;
                default:
                    $classes[] = 'menu-style-v2 menu-fixed';
                    break;
            }
            break;
        case 'right':
            $classes[] = 'menu-position-right';
            break;
        default:
            $classes[] = 'menu-position-left';
            break;
    }
    // 加载菜单打开方式样式
    $classes[] = get_option('wf_menu_open_style') == 'click' ? 'menu-trigger-click' : 'menu-trigger-hover';

    // 加载侧栏的样式
    if(is_home()){
        if(get_option('wf_show_sidebar_on_index')){
            switch (get_option('wf_sidebar_position')) {
                case 'left':
                    $classes[] = 'sidebar-position-left';
                    break;
                case 'right':
                    $classes[] = 'sidebar-position-right';
                    break;
                default:
                    $classes[] = 'no-sidebar';
                    break;
            }
        } else {
            $classes[] = 'no-sidebar';
        }
    } else {
        switch (get_option('wf_sidebar_position')) {
            case 'left':
                $classes[] = 'sidebar-position-left';
                break;
            case 'right':
                $classes[] = 'sidebar-position-right';
                break;
            default:
                $classes[] = 'no-sidebar';
                break;
        }
    }
    if(get_option('')) $classes[] = 'no-ads-on-smartphones';
    if(get_option('')) $classes[] = 'no-ads-on-tablets';
    // 判断是否为固定高度加载其样式
    if(get_option('wf_use_fixed_height_index_posts')) $classes[] = 'fixed-height-index-posts';
    // 加载导航方式
    switch(get_option('wf_navigation_type')){
        case 'infinite':
            $classes[] = 'with-infinite-scroll';
            break;
        case 'infinite_button':
            $classes[] = 'with-infinite-button';
            break;
        default:
            break;
    }
    $classes[] = is_archive() || is_home() || get_option('page_fixed_width') == true ? 'page-fluid-width' : 'page-fixed-width';
    
    return $classes;
}

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
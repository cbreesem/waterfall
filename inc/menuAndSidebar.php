<?php
function widgetsInit() {
    // require get_template_directory().'/inc/widgets.php';
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
      'name'          => __( '顶部栏目'),
      'id'            => 'sidebar-3',
      'description'   => __( 'Sidebar which appears on the top of the page.', 'pluto' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h1 class="widget-title">',
      'after_title'   => '</h1>',
    ) );
  }
add_action('widgets_init', 'widgetsInit');

// 添加页面菜单css样式
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
    // 加载手机广告样式
    if(!get_option('wf_enable_ads_on_smartphones')) $classes[] = 'no-ads-on-smartphones';
    // 加载平板广告样式
    if(!get_option('wf_enable_ads_on_tablets')) $classes[] = 'no-ads-on-tablets';
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
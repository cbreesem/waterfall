<?php

// 自定义排序
add_action('pre_get_posts', 'orderCustom');

function orderCustom( $query ) {
    if ((is_home() || is_archive()) && $query->is_main_query()) {
      $query->set( 'meta_key', $_GET['order']);
      $query->set( 'orderby', array('meta_value_num' => 'DESC', 'date' => 'DESC'));
      $query->set( 'order', 'DESC' );
    }
    return $query;
}

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
// 字符串显示函数
function customShow($str){
    echo $str;
}

?>
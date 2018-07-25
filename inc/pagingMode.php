<?php
/* 分页代码 */
if(getNextPostsLink($wp_query)){
    echo '<div class="isotope-next-params" data-params="'.getNextPostsLink($wp_query).'" data-layout-type="'.$layout_type.'" data-template-type="'.$template_type.'"></div>';
    if(get_option('wf_navigation_type') == 'infinite_button'){
        echo '<div class="load-more-posts-button-w">
            <a href="#"><i class="os-icon-plus"></i><span>载入更多内容</span></a>
            </div>';
    }
}
echo '<div class="pagination-w hide-for-isotope">';
if(function_exists('wp_pagenavi') && get_option('wf_navigation_type') != 'default'){
    wp_pagenavi();
}else{
    posts_nav_link();
}
echo '</div>';
?>

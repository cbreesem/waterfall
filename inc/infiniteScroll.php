<?php
/*
 * 无限加载服务器响应函数
 */

add_action( 'wp_ajax_load_infinite_content', 'loadInfiniteContent' );
add_action( 'wp_ajax_nopriv_load_infinite_content', 'loadInfiniteContent' );

function loadInfiniteContent(){
    $new_posts = '';
    $post_query_args = $_POST['next_params'].'&post_status=publish';
    $os_query = new WP_Query($post_query_args);
    while ($os_query->have_posts()) : $os_query->the_post();
        $content_partial = 'content';
        if(isset($_POST['layout_type'])){
            if($_POST['layout_type'] == 'v2'){
                $content_partial = 'v2-content';
            }
            if($_POST['layout_type'] == 'v3'){
                $content_partial = 'v3-content';
            }
            if($_POST['layout_type'] == 'v3-simple'){
                $content_partial = 'v3-content';
                global $forse_hide_element_read_more;
                global $forse_hide_element_date;
                $forse_hide_element_read_more = true;
                $forse_hide_element_date = true;
            }
            if(in_array($_POST['template_type'], array('page-masonry-condensed-facebook', 'page-masonry-simple-facebook'))){
                global $facebook_likes;
                $facebook_likes = true;
            }
            if($_POST['template_type'] == 'page-masonry-condensed-fixed-height'){
                global $forse_fixed_height;
                $forse_fixed_height = true;
            }
            if($_POST['template_type'] == 'page-masonry-condensed-with-author'){
                global $show_author_face;
                $show_author_face = true;
            }
        }
        $new_posts.= loadTemplatePart( $content_partial, get_post_format() );
    endwhile;
    if($os_query->query['paged'] < $os_query->max_num_pages){
        $next_params = getNextPostsLink($os_query);
    }else{
        $next_params = null;
    }
    wp_reset_postdata();
    $json_response = json_encode(array());
    if($new_posts != ''){
        $json_response = json_encode(array('success' => TRUE, 'has_posts' => TRUE, 'new_posts' => $new_posts, 'next_params' => $next_params, 'no_more_posts_message' => __('No more posts', 'pluto')));
    }else{
        $json_response = json_encode(array('success' => TRUE, 'has_posts' => FALSE, 'no_more_posts_message' => __('No more posts', 'pluto')));
    }
    echo $json_response;
    die();
}

?>
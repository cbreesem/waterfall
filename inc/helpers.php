<?php
/* 获取列表单元所用的共享按钮 */
function listTopShareButtons(){
    $element = unserialize(get_option('wf_show_element_on_index'));
    if(in_array('share',$element)){
        if(is_rtl()){
            echo '<div class="post-top-share">
                    <span class="share-activator-label share-activator caption">'.__("分享").'</span>
                    <i class="fa os-icon-plus share-activator-icon share-activator"></i>
                    <div class="os_social-head-w">'.do_shortcode('[os_social_buttons]').'</div>
                </div>';
        }else{
            echo '<div class="post-top-share">
                    <i class="fa os-icon-plus share-activator-icon share-activator"></i>
                    <span class="share-activator-label share-activator caption">'.__("分享").'</span>
                    <div class="os_social-head-w">'.do_shortcode('[os_social_buttons]').'</div>
                </div>';
        }
    }
}
/* 获取列表单元中的媒体内容 */
function listMediaContent($size=false, $forse_single=false){
    switch (get_post_format()) {
        case 'video':
            global $wp_embed;
            echo '<div class="post-video-box post-media-body">
                    '.$wp_embed->run_shortcode('[embed]'.get_field('video_url').'[/embed]').'
                </div>';
            break;
        case 'gallery':
                $images = get_field('gallery_of_images');
                if($images){
                    echo '<div class="post-gallery-box post-media-body">
                            <div id="slider-<?php the_ID(); ?>" class="flexslider">
                                <ul class="slides">';
                    foreach ($images as $image) {
                        if($size != false){
                            $img_src = $image['sizes']["{$size}"];
                        }else{
                            if(is_single()){
                                $img_src = $image['sizes']['large'];
                            }else{
                                // 是否固定元素块高度
                                $img_src = get_option('wf_use_fixed_height_index_posts') == true ? $image['sizes']['pluto-fixed-height'] : $image['sizes']['pluto-index-width'];
                            }
                        }
                        echo '<li><img src="'.$img_src.'" alt="'.$image['alt'].'" /></li>';
                    }
                    echo '</ul>
                            </div>
                        </div>';
                }else{
                    outputPostThumbnail($size, $forse_single);
                }
            break;
        case 'image':
            outputPostThumbnail($size, $forse_single);
            break;
        default:
            outputPostThumbnail($size, $forse_single);
            break;
    }
}
/* 输出递交内容的图标 */
function outputPostThumbnail($size=false, $forse_single=false){
    if (has_post_thumbnail()) {
        if(is_single() || $forse_single){
            echo '<div class="post-media-body">
                    <div class="figure-link-w">
                        <a href="'.wp_get_attachment_url(get_post_thumbnail_id()).'" class="figure-link os-lightbox-activator">
                            <figure>';
            $thumb_size = $size != false ? $size : 'full';
            the_post_thumbnail($thumb_size);
            if(get_option('wf_image_hover_effect') != true){
                echo '<div class="figure-shade"></div><i class="figure-icon os-icon-thin-098_zoom_in_magnify_plus"></i>';
            }
            echo '</figure>
                        </a>
                    </div>
                </div>';
        }else{
            
            if ($size != false) {
                $img_html = get_the_post_thumbnail(get_the_ID(), $size);
            }else{
                
                if(basename(get_page_template()) == 'page-blog.php'){
                    
                    $img_html =  get_the_post_thumbnail(get_the_ID(), 'full');
                } else {
                    // 是否固定元素块高度
                    $img_html = get_option('wf_use_fixed_height_index_posts') == true ? get_the_post_thumbnail(get_the_ID(), 'pluto-fixed-height') : get_the_post_thumbnail(get_the_ID(), 'pluto-index-width');
                    echo $img_html;
                }
                $shade_html = get_option('wf_image_hover_effect') == true ? '' : '<div class="figure-shade"></div><i class="figure-icon os-icon-thin-044_visability_view_watch_eye"></i>';
                $os_link = get_post_format() == 'link' ? get_field('external_link') : get_permalink();
                $new_window = get_post_format() == 'link' ? 'target="_blank"' : "";
                echo '<div class="post-media-body">
                        <div class="figure-link-w">
                            <a href="'.$os_link.'" '.$new_window.' class="figure-link">
                                <figure>'.$img_html.$shade_html.'</figure>
                            </a>
                        </div>
                    </div>';
            }
        }
    }
}
/* 获取下一页链接 */
function getNextPostsLink($os_query){
    $current_page = ( isset($os_query->query['paged']) ) ? $os_query->query['paged'] : 1;
    $next_page = ($current_page < $os_query->max_num_pages) ? $current_page + 1 : false;
    if($next_page){
        return http_build_query(wp_parse_args( array('paged' => $next_page), $os_query->query));
    }else{
        return false;
    }
}
/*  */
function loadTemplatePart($template_name, $part_name=null) {
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

?>
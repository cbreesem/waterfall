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
function listMediaContent($size = false, $forse_single = false){
    switch (get_post_format()) {
        case 'video':
            global $wp_embed;
            echo '<div class="post-video-box post-media-body">
                    .'$wp_embed->run_shortcode('[embed]'.get_field('video_url').'[/embed]')'.
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
                                $img_src = (os_get_use_fixed_height_index_posts() == true) ? $image['sizes']['pluto-fixed-height'] : $image['sizes']['pluto-index-width'];
                            }
                        }
                        echo '<li><img src="'.$img_src.'" alt="'.$image['alt'].'" /></li>';
                    }
                    echo '</ul>
                            </div>
                        </div>';
                }else{
                    os_output_post_thumbnail($size, $forse_single);
                }
            break;
        case "image":
            os_output_post_thumbnail($size, $forse_single);
            break;
        default:
            os_output_post_thumbnail($size, $forse_single);
            break;
    }
}
/* 输出递交内容的图标 */
function outputPostThumbnail($size = false, $forse_single = false){
    if (has_post_thumbnail()) {
        if(is_single() || $forse_single){
            echo '<div class="post-media-body">
                    <div class="figure-link-w">
                        <a href="'.wp_get_attachment_url(get_post_thumbnail_id()).'" class="figure-link os-lightbox-activator">
                            <figure>';
            $thumb_size = $size != false ? $size : 'full';
            the_post_thumbnail($thumb_size);
            if(get_field('disable_image_hover_effect', 'option') != true){
                echo '<div class="figure-shade"></div><i class="figure-icon os-icon-thin-098_zoom_in_magnify_plus"></i>';
            }
            echo '</figure>
                        </a>
                    </div>
                </div>';
        }else{

        }
        # code...
    }
    if(has_post_thumbnail()):
        if(is_single() || $forse_single): ?>
            <div class="post-media-body">
                <div class="figure-link-w">
                    
                </div>
            </div> <?php
        else:
            if($size != false){
                $img_html = get_the_post_thumbnail(get_the_ID(), $size);
            }else{
                if ( basename(get_page_template()) == 'page-blog.php' ) {
                    $img_html =  get_the_post_thumbnail(get_the_ID(), 'full');
                }else{
                    $img_html = (os_get_use_fixed_height_index_posts() == true) ? get_the_post_thumbnail(get_the_ID(), 'pluto-fixed-height') : get_the_post_thumbnail(get_the_ID(), 'pluto-index-width');
                }
            }
            $shade_html = (get_field('disable_image_hover_effect', 'option') == true) ? "" : '<div class="figure-shade"></div><i class="figure-icon os-icon-thin-044_visability_view_watch_eye"></i>';
            $os_link = get_post_format() == 'link' ? get_field('external_link') : get_permalink(); ?>
            <?php $new_window = (get_post_format() == 'link') ? 'target="_blank"' : ""; ?>
            <div class="post-media-body"><div class="figure-link-w"><a href="<?php echo $os_link; ?>" <?php echo $new_window ?> class="figure-link"><figure><?php echo $img_html; ?><?php echo $shade_html; ?></figure></a></div></div>
            <?php
        endif;
    endif;
}
?>
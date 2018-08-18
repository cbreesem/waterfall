<div class="item-isotope">
    <article id="post-<?php the_ID(); ?>" <?php post_class('pluto-post-box'); ?>>
        <div class="post-body">
            <?php
                $year = get_the_terms(get_the_ID(),'year');
                listTopShareButtons();
                getMediaContent();
                $element = unserialize(get_option('wf_show_element_on_index'));
                if(in_array('title', $element) || in_array('category', $element) || in_array('excerpt', $element)){
                    echo '<div class="post-content-body">';

                    if(in_array('title', $element)){
                        echo '<h4 class="post-title entry-title"> '.$year[0]->name.'年 | <a href="'.esc_url(get_permalink()).'">';
                        the_title();
                        echo '</a></h4>';
                    }
                    if(in_array('category', $element)) echo get_the_category_list();
                    if(in_array('excerpt', $element)) echo '<div class="post-content entry-summary">'.wp_trim_words(get_the_excerpt(), get_option('wf_index_excerpt_length'), '').'</div>';

                    echo '</div>';
                }
            ?>
        </div>
        <?php
            if(in_array('date', $element) || in_array('author', $element) || in_array('like', $element)){
                echo '<div class="post-meta entry-meta">';

                if(in_array('date', $element)){
                    echo '<div class="meta-date">
                        <i class="fa os-icon-clock-o"></i>
                        <time class="entry-date updated" datetime="'.get_the_date('c').'">'.get_the_date('M j').'</time>
                    </div>';
                }
                if(in_array('view_count', $element) && function_exists('echo_tptn_post_count')){
                    echo '<div class="meta-view-count">
                        <i class="fa os-icon-eye"></i>
                        <span>'.do_shortcode('[tptn_views]').'</span>
                    </div>';
                }
                if(in_array('like', $element) && function_exists('zilla_likes')){
                    echo '<div class="meta-like">'.zilla_likes().'</div>';
                }
                if(in_array('author', $element)){
                    echo '<div class="meta-author">';
                    if(!is_rtl()) _e('by');
                    echo '<strong class="author vcard"><a href="'.esc_url(get_author_posts_url(get_the_author_meta('ID'))).'" class="url fn n" rel="author">'.get_the_author().'</a></strong>';
                    if(is_rtl()) _e('by');
                    echo '</div>';
                }
                echo '</div>';
            }
        ?>
    </article>
</div>
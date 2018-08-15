<article id="post-<?php the_ID(); ?>" <?php post_class('pluto-page-box'); ?>>
    <div class="post-body">
        <div class="single-post-top-features">
            <?php //osetin_single_top_social_share(); ?>
            <?php if(is_single()): ?>
                <?php if(get_field('disable_reading_mode', 'option') != TRUE): ?>
                <a href="#" class="single-post-top-qr">
                    <i class="fa os-icon-qrcode"></i>
                    <span class="caption"><?php _e('在手机上查看', 'pluto'); ?></span>
                </a>
                <a href="#" class="single-post-top-reading-mode hidden-xs" data-message-on="<?php _e('进入全屏模式', 'pluto'); ?>" data-message-off="<?php _e('Exit Reading Mode', 'pluto'); ?>">
                    <i class="fa os-icon-eye"></i>
                    <span><?php _e('进入全屏模式', 'pluto'); ?></span>
                </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <h1 class="post-title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> (<?php $year = get_the_terms($id, 'year'); echo $year[0]->name;?>)</h1>
        <?php edit_post_link( __( 'Edit', 'twentyfourteen' ), '<div class="edit-link">', '</div>' ); ?>

        <div class="post-meta-top entry-meta">
            <?php if(is_rtl()): ?>
                <?php echo get_the_category_list(); ?>
                <?php the_tags('<ul class="post-tags" style="float: left;"><li style="float: left;">','</li><li style="float: left;">','</li></ul>'); ?>
            <?php else: ?>
                <?php the_tags('<ul class="post-tags" style="float: left;"><li style="float: left;">','</li><li style="float: left;">','</li></ul>'); ?>
                <?php echo get_the_category_list(); ?>
            <?php endif; ?>
        </div>

        <?php if(is_single()){ ?>
            <?php if(get_field('hide_featured_image_on_single_post', 'option') != true && (get_post_format() != 'quote')){ ?>
                <?php osetin_get_media_content(false, true); ?>
            <?php } ?>
        <?php }else{ ?>
            <?php osetin_get_media_content('pluto-full-width', true); ?>
        <?php } ?>

        <?php if(get_post_meta($post->ID, "playdate", $single = true)){ ?>
        <div class="post-content">上 映：<?php echo get_post_meta($post->ID, "playdate", $single = true); ?></div>
        <?php } ?>
        <?php if(get_post_meta($post->ID, "duration", $single = true)){ ?>
        <div class="post-content">片 长：<?php echo get_post_meta($post->ID, "duration", $single = true); ?></div>
        <?php } ?>
        <?php $language = get_the_terms($id, 'language'); ?>
        <?php if($language){ ?>
        <div class="post-content">语 言：
            <?php foreach($language as $term){ echo '<a href="'.get_term_link( $term ).'">'.$term->name.'</a> '; } ?>
        </div>
        <?php } ?>
        <?php $district = get_the_terms($id, 'district'); ?>
        <?php if($district){ ?>
        <div class="post-content">地 区：
            <?php foreach($district as $term){ echo '<a href="'.get_term_link( $term ).'">'.$term->name.'</a> '; } ?>
        </div>
        <?php } ?>
        <?php if(get_post_meta($post->ID, "alias", $single = true)){ ?>
        <div class="post-content">别 名：<?php echo get_post_meta($post->ID, "alias", $single = true); ?></div>
        <?php } ?>
        <?php
            $url = get_post_meta($post->ID, "douban", $single = true);
            $html = file_get_contents($url);
            $preg = '/<strong class="ll rating_num" property="v:average">([0-9]{1,2})+(\.[0-9]{1,2})<\/strong>/';
            preg_match($preg, $html, $arr);
            $preg = '/([0-9]{1,2})+(\.[0-9]{1,2})/';
            preg_match($preg, $arr[0], $arr);
            $score = $arr[0];
            $preg = '/<span property="v:votes">[0-9]{1,6}<\/span>/';
            preg_match($preg, $html, $arr);
            $preg = '/[0-9]{1,6}/';
            preg_match($preg, $arr[0], $arr);
            $count = $arr[0];
        ?>
        <div class="post-content">豆 瓣：
        <?php if($score){ ?>
            <a href="<?php echo get_post_meta($post->ID, "douban", $single = true); ?>"><?php echo $score; ?>分</a> 来自<?php echo $count; ?>位豆瓣网友的评价</div>
        <?php }else{ ?>
            <a href="<?php echo get_post_meta($post->ID, "douban", $single = true); ?>">豆瓣网友们都很忙，没时间打分，去帮忙打个分吧！</a></div>
        <?php } ?>
        <?php
            $url = get_post_meta($post->ID, "imdb", $single = true);
            $html = file_get_contents($url);
            $preg = '/<span itemprop="ratingValue">([0-9]{1,2})+(\.[0-9]{1,2})<\/span>/';
            preg_match($preg, $html, $arr);
            $preg = '/([0-9]{1,2})+(\.[0-9]{1,2})/';
            preg_match($preg, $arr[0], $arr);
            $score = $arr[0];
            $preg = '/<span class="small" itemprop="ratingCount">([0-9]{1,3})+(\,[0-9]{1,3})<\/span>/';
            preg_match($preg, $html, $arr);
            $preg = '/([0-9]{1,3})+(\,[0-9]{1,3})/';
            preg_match($preg, $arr[0], $arr);
            $count = $arr[0];
        ?>
        <div class="post-content">IMDB：
        <?php if($score){ ?>
            <a href="<?php echo get_post_meta($post->ID, "imdb", $single = true); ?>"><?php echo $score; ?>分</a> 来自<?php echo $count; ?>位国际友人的评价</div>
        <?php }else{ ?>
            <a href="<?php echo get_post_meta($post->ID, "imdb", $single = true); ?>">国际友人们懒得打分</a></div>
        <?php } ?>
        <?php $terms = get_the_terms($id, 'directors'); ?>
        <?php if(count($terms)){ ?>
        <div class="post-content">导 演：
            <?php foreach($terms as $term){ echo '<a href="'.get_term_link( $term ).'">'.$term->name.'</a> '; } ?>
        </div>
        <?php } ?>
        <?php $terms = get_the_terms($id, 'scriptwriters'); ?>
        <?php if(count($terms)){ ?>
        <div class="post-content">编 剧：
            <?php foreach($terms as $term){ echo '<a href="'.get_term_link( $term ).'">'.$term->name.'</a> '; } ?>
        </div>
        <?php } ?>
        <?php $terms = get_the_terms($id, 'actors'); ?>
        <?php if(count($terms)){ ?>
        <div class="post-content">主 演：
            <?php foreach($terms as $term){ echo '<a href="'.get_term_link( $term ).'">'.$term->name.'</a> '; } ?>
        </div>
        <?php } ?>
        <?php $terms = get_the_terms($id, 'label'); ?>
        <?php if(count($terms)){ ?>
        <div class="post-content">网友标注：
            <?php foreach($terms as $term){ echo '<a href="'.get_term_link( $term ).'">'.$term->name.'</a> '; } ?>
        </div>
        <?php } ?>

        <div class="panel panel-default">
          <!-- Default panel contents -->
            <div class="panel-heading"><h4>剧情大纲</h4></div>
            <div class="panel-body post-content entry-content"><?php  ?></div>
            <ul class="list-group">
        <?php
            $links = get_post_meta($post->ID, "links", $single = true);
            $links = explode('|,|', $links);
            foreach ($links as $key => $value) {
                $arr = explode('|*|', $value);
                echo '<li class="list-group-item post-content"><a href="'.$arr[1].'">'.$arr[0].'</a><span class="pull-right">'.$arr[2].'</span></li>';
            }
        ?>
            </ul>
        </div>

    </div>
    <div class="post-meta entry-meta">
        <div class="meta-like">
            <?php // if( function_exists('zilla_likes') ) zilla_likes(); ?>
            <?php os_facebook_like(); ?>
        </div>
        <div class="os_social-foot-w hidden-xs"><?php echo do_shortcode('[os_social_buttons]'); ?></div>
    </div>

    <div class="modal fade" id="qrcode-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title"><?php _e('SCAN THIS QR CODE WITH YOUR PHONE', 'pluto') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div id="qrcode"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php _e('Close', 'pluto'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
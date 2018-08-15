<article id="post-<?php the_ID(); ?>" <?php post_class('pluto-page-box'); ?>>
    <div class="post-body">
        <div class="single-post-top-features">
            <?php listTopShareButtons(); ?>
        </div>
        <h1 class="post-title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <small>(<?php $year = get_the_terms($id, 'year'); echo $year[0]->name;?>年)</small></h1>

        <div class="post-meta-top entry-meta">
            <?php if(is_rtl()): ?>
                <?php echo get_the_category_list(); ?>
                <?php the_tags('<ul class="post-tags" style="float: left;"><li style="float: left;">','</li><li style="float: left;">','</li></ul>'); ?>
            <?php else: ?>
                <?php the_tags('<ul class="post-tags" style="float: left;"><li style="float: left;">','</li><li style="float: left;">','</li></ul>'); ?>
                <?php echo get_the_category_list(); ?>
            <?php endif; ?>
        </div>

        <?php
        if(is_single()){
            if(get_option('wf_hide_featured_image_on_single_post') != true && (get_post_format() != 'quote')){
                getMediaContent(false, true);
            }
        }else{
            getMediaContent('pluto-full-width', true);
        }
        if(get_post_meta($post->ID, "playdate", $single = true)){
            echo '<div class="post-content">上 映：'.get_post_meta($post->ID, "playdate", $single = true).'</div>';
        }
        if(get_post_meta($post->ID, "duration", $single = true)){
            echo '<div class="post-content">片 长：'.get_post_meta($post->ID, "duration", $single = true).'</div>';
        }
        $language = get_the_terms($id, 'language');
        if($language){
            echo '<div class="post-content">语 言：';
            foreach($language as $term){ echo '<a href="'.get_term_link( $term ).'">'.$term->name.'</a> '; }
            echo '</div>';
        }
        $district = get_the_terms($id, 'district');
        if($district){
            echo '<div class="post-content">地 区：';
            foreach($district as $term){ echo '<a href="'.get_term_link( $term ).'">'.$term->name.'</a> '; }
            echo '</div>';
        }
        if(get_post_meta($post->ID, "alias", $single = true)){
            echo '<div class="post-content">别 名：'.get_post_meta($post->ID, "alias", $single = true).'</div>';
        }
        $douban_url = get_post_meta($post->ID, "douban", $single = true);
        $douban_score = get_post_meta($post->ID, "douban_score", $single = true);
        if($douban_url && $douban_score){
            echo '<div class="post-content">豆 瓣：<a href="'.$douban_url.'">'.$douban_score.'分</a></div>';
        }
        $imdb_url = get_post_meta($post->ID, "imdb", $single = true);
        $imdb_score = get_post_meta($post->ID, "imdb_score", $single = true);
        if($douban_url && $douban_score){
            echo '<div class="post-content">IMDB：<a href="'.$imdb_url.'">'.$imdb_score.'分</a></div>';
        }
        ?>
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
            <div class="panel-body post-content entry-content"><?php the_content(); ?></div>
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
<article id="post-<?php the_ID(); ?>" <?php post_class('pluto-page-box'); ?>>
    <div class="post-body">
        <h1 class="post-title entry-title"><?php the_title(); ?></h1>

        <div class="panel panel-default">
            <div class="panel-body post-content entry-content"><?php the_content(); ?></div>
            <ul class="list-group">
            </ul>
        </div>

    </div>
    <div class="post-meta entry-meta">
        <div class="meta-like">

        </div>
        <div class="os_social-foot-w hidden-xs"><?php echo do_shortcode('[os_social_buttons]'); ?></div>
    </div>
</article>
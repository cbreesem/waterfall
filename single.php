<?php
/* 内容页模板 */
?>

<?php get_header(); ?>
<div class="main-content-w">
    <?php defindPrimarySidebar(); ?>
    <div class="main-content-i">
        <div class="content side-padded-content reading-mode-content">
            <?php setPostViews(get_the_ID());  ?>
            <?php if(is_active_sidebar('sidebar-3')){ ?>
                <div class="top-sidebar-wrapper"><?php dynamic_sidebar('sidebar-3'); ?></div>
            <?php } ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php get_template_part('single-content', get_post_format() ); ?>
                <?php wp_link_pages(); ?>
                <div class="post-navigation-classic">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php if (get_adjacent_post(false, '', true)): ?>
                            <div class="post-navigation-previous">
                                <div class="arrow"><i class="fa os-icon-angle-left"></i></div>
                                <div class="caption"><?php _e('上一部', 'pluto') ?></div>
                                <div class="navi-link"><?php previous_post_link('%link'); ?></div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <?php if (get_adjacent_post(false, '', false)): ?>
                            <div class="post-navigation-next">
                                <div class="arrow"><i class="fa os-icon-angle-right"></i></div>
                                <div class="caption"><?php _e('下一部', 'pluto') ?></div>
                                <div class="navi-link"><?php next_post_link('%link'); ?></div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; endif; ?>
            <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()){
                    comments_template();
                }
            ?>
        </div>
        <?php require_once(get_template_directory().'/inc/copyright.php') ?>
    </div>
</div>
<?php get_footer(); ?>
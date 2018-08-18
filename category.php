<?php
/**
 * 分类页面
 */

get_header(); ?>

<div class="main-content-w">
    <?php defindPrimarySidebar(); ?>
    <div class="main-content-i">
            <?php if ( have_posts() ) : ?>

                <header class="archive-header">
                    <h3><?php printf( __( '当前所在分类: %s', 'pluto' ), single_cat_title( '', false ) ); ?></h3>

                    <?php
                        // Show an optional term description.
                        $term_description = term_description();
                        if ( ! empty( $term_description ) ) :
                            printf( '<div class="taxonomy-description">%s</div>', $term_description );
                        endif;
                    ?>
                </header><!-- .archive-header -->
                <?php require_once(get_template_directory().'/inc/setLayoutVars.php'); ?>
                <div class="content side-padded-content">
                    <div class="index-isotope <?php echo $isotope_class; ?>" data-layout-mode="<?php echo $layout_mode; ?>">
                        <?php $os_current_box_counter = 1; $os_ad_block_counter = 0; ?>
                        <?php
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            get_template_part($template_part, get_post_format());
                            // os_ad_between_posts();
                        endwhile; ?>

                    </div>
                    <?php require_once(get_template_directory().'/inc/pagingMode.php') ?>
                </div>
                <?php
            else :
                // If no content, include the "No posts found" template.
                get_template_part( 'content', 'none' );
            endif; ?>
        <?php require_once(get_template_directory().'/inc/copyright.php') ?>
    </div>
</div>

<?php
get_footer();

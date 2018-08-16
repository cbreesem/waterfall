<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @since Pluto 1.0
 */

get_header(); ?>

<div class="main-content-w">
    <?php defindPrimarySidebar(); ?>
    <div class="main-content-i">
    <?php if ( have_posts() ) : ?>

        <header class="search-results-header">
            <h3><?php printf( __( '%s 的搜索结果', 'pluto' ), get_search_query() ); ?></h3>
        </header><!-- .page-header -->
        <?php require_once(get_template_directory().'/inc/setLayoutVars.php'); ?>
        <div class="content side-padded-content">
            <div class="index-isotope <?php echo $isotope_class; ?>" data-layout-mode="<?php echo $layout_mode; ?>">
                <?php
                $os_current_box_counter = 1; $os_ad_block_counter = 0;
                while ( have_posts() ) : the_post();

                    /*
                     * Include the post format-specific template for the content. If you want to
                     * use this in a child theme, then include a file called called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */
                    get_template_part( $template_part, get_post_format() );

                    // os_ad_between_posts();

                endwhile; ?>
            </div>
            <?php require_once(get_template_directory().'/inc/pagingMode.php') ?>
        </div>
        <?php

    else :
        // If no content, include the "No posts found" template.
        get_template_part( 'content', 'none' );
    endif;
    ?>
        <?php require_once(get_template_directory().'/inc/copyright.php') ?>
    </div>
</div>

<?php
get_footer();
<?php
/**

 */

get_header(); ?>

<div class="main-content-w">
    <?php defindPrimarySidebar(); ?>
    <div class="main-content-i">
        <?php if(have_posts()): ?>
            <header class="archive-header">
                <h3 class="archive-title">
                <?php printf( __('当前所浏览的标签: %s', '高清下载网'), single_tag_title('', false)); ?>
                </h3>
                <?php
                    // 显示标签备注
                    $term_description = term_description();
                    if(!empty( $term_description)){
                        printf( '<div class="taxonomy-description">%s</div>', $term_description );
                    }
                ?>
            </header><!-- .archive-header -->

            <?php require_once(get_template_directory().'/inc/setLayoutVars.php'); ?>

            <div class="content side-padded-content">
                    <div class="index-isotope <?php echo $isotope_class; ?>" data-layout-mode="<?php echo $layout_mode; ?>">
                    <?php
                    $os_current_box_counter = 1; $os_ad_block_counter = 0;
                    while ( have_posts() ) : the_post();
                        get_template_part( $template_part, get_post_format() );
                        // os_ad_between_posts();
                    endwhile; ?>
                </div>
                <?php require_once(get_template_directory().'/inc/pagingMode.php') ?>
            </div>
            <?php
            else :
                get_template_part('content', 'none');
            endif;
            ?>
        <?php require_once(get_template_directory().'/inc/copyright.php') ?>
    </div>
</div>
<?php
get_footer();

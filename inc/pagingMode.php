<?php
/* 分页代码 */
?>
<?php if(getNextPostsLink($wp_query)): ?>
    <div class="isotope-next-params" data-params="<?php echo getNextPostsLink($wp_query); ?>" data-layout-type="<?php echo $layout_type; ?>" data-template-type="<?php echo $template_type; ?>"></div>
    <?php if(get_option('wf_navigation_type') == 'infinite_button'): ?>
    <div class="load-more-posts-button-w">
    <a href="#"><i class="os-icon-plus"></i> <span><?php _e('载入更多内容', 'pluto'); ?></span></a>
    </div>
    <?php endif; ?>
<?php endif; ?>
<div class="pagination-w hide-for-isotope">
    <?php if(function_exists('wp_pagenavi') && get_option('wf_navigation_type') != 'default'): ?>
    <?php wp_pagenavi(); ?>
    <?php else: ?>
    <?php posts_nav_link(); ?>
    <?php endif; ?>
</div>
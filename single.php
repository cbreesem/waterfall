<?php
/* 内容页模板 */

get_header();
?>
<div class="main-content-w">
    <?php //os_the_primary_sidebar(); ?>
    <div class="main-content-i">
        <div class="content side-padded-content reading-mode-content">
        <?php
        // if(is_active_sidebar('sidebar-3')){
        //     echo '<div class="top-sidebar-wrapper">';
        //     dynamic_sidebar( 'sidebar-3' );
        //     echo '</div>';
        // } 
        if(have_posts()){
            while(have_posts()){
                the_post();
        ?>


        <?php
            }
        }
        // if(comments_open() || get_comments_number()){
        //     comments_template();
        // }
        // echo '</div>';
        ?>
    </div>
</div>
<?php get_footer(); ?>
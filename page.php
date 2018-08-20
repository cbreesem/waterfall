<?php
get_header(); ?>

<div class="main-content-w">
	<?php defindPrimarySidebar(); ?>
	<div class="main-content-i">
		<div class="content padded-top padded-bottom">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php get_template_part('page-content', get_post_format() ); ?>
				</div>
			<?php endwhile; endif; ?>
		</div>
		<?php require_once(get_template_directory().'/inc/copyright.php') ?>
	</div>
</div>
<?php
get_footer();
?>
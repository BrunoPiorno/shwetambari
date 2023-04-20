<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php if( have_rows('content_blocks') ): ?>
	  <?php while ( have_rows('content_blocks') ) : the_row(); ?>
	    <?php get_template_part('modules/flexible_contents'); ?>
	  <?php endwhile; ?>
	<?php else: ?>
		<section>
			<div class="container">
			  <?php the_content();?>
			</div>
		</section>
	<?php endif; ?>

<?php endwhile;	?>

<?php get_footer(); ?>

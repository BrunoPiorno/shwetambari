<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<?php get_header(); ?>

	<?php get_template_part('modules/hero'); ?>

	<section class="search-results-cont">
		<div class="container">
		<?php
			if( have_posts() ):
				while( have_posts() ):
					the_post();

					get_template_part('modules/'.BAM_Functions::getPostTypeFolder().'/grid');
				endwhile;
			else:
		?>
			<h2><?php the_field('no_results_text','option'); ?></h2>
		<?php
			endif;
		?>
		</div>

		<div class="container">
			<?php wp_pagenavi(); ?>
		</div>
	</section>

<?php get_footer(); ?>

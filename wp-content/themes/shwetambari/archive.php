<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<?php get_header(); ?>

	<?php get_template_part('modules/hero'); ?>

	<?php if( get_post_type() == 'video' ): ?>
		<?php get_template_part('modules/featured_video'); ?>
	<?php endif; ?>

	<section class="archive_section">
	    <div class="container">
	        <div class="archive_section__list">
			<?php
				if( have_posts() ):
					while( have_posts() ):
						the_post();

						get_template_part('modules/'.BAM_Functions::getPostTypeFolder().'/grid');
					endwhile;
				else:
			?>
				<section class="page-404__text">
					<div class="container center">
						<h2><?php the_field('no_results_text','option'); ?></h2>
					</div>
				</section>
			<?php
				endif;
			?>
			</div><!-- /video-home__list -->
			<?php wp_pagenavi(); ?>
		</div><!-- /container -->
	</section><!-- /video-home -->

<?php get_footer(); ?>

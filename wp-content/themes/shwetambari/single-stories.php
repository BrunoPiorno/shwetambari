<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<section class="single-stories">
		<?php if ($hero_image = get_field('hero_image')): ?>
			<div class="single-stories__hero">
				<div class="single-stories__hero--image">
					<img src="<?php echo $hero_image['sizes']['large']; ?>" alt="" />
				</div>
			</div>
		<?php endif; ?>

		<div class="single-stories__cont">
			<div class="container">
					<div class="single-stories__cont--title"><?php the_title(); ?></div>
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post(); ?>

					<div class="single-stories__cont--block">
						<?php if ($left_image = get_field('left_image')): ?>
							<div class="single-stories__cont--image">
								<img src="<?php echo $left_image['sizes']['large']; ?>" alt="" />
							</div>
						<?php endif; ?>

						<?php if ($text = get_field('text')): ?>
							<div class="single-stories__cont--text"><?php echo $text ?></div>
						<?php endif; ?>
				    </div>	<!--/postBox -->

				<?php endwhile;
				?>	
			</div>	<!--/container -->
		</div>	<!--/row -->
	</section>
	

	</main><!-- .site-main -->

	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>


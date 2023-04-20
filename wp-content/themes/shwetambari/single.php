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

	<?php while ( have_posts() ) : the_post(); ?>
		<section class="news-single">
			<section class="news-single__top">
				<div class="container">
					<h1 class="news-single__title h1"><?php the_title(); ?></h1>
				  <div class="news-single__image"><?php the_post_thumbnail(); ?></div>
				</div>
			</section>

			<section class="news-single__content">
				<div class="container"><?php the_content(); ?></div>
			</section>

			<section class="news-single__navigator">
				<div class="container">
				<?php
					$next_post_obj  = get_adjacent_post( '', '', false );
					$next_post   	= isset( $next_post_obj->ID ) ? $next_post_obj->ID : '';
					$prev_post_obj  = get_adjacent_post( '', '', true );
					$prev_post   	= isset( $prev_post_obj->ID ) ? $prev_post_obj->ID : '';
				?>
			  	<?php if( $prev_post ): ?><a href="<?php echo get_permalink( $prev_post ); ?>" class="button prev">PREVIOUS</a><?php endif; ?>
			  	<?php if( $next_post ): ?><a href="<?php echo get_permalink( $next_post ); ?>" class="button next">NEXT</a><?php endif; ?>
				</div>
			</div>
		</section>
	<?php endwhile;	?>
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php get_footer(); ?>

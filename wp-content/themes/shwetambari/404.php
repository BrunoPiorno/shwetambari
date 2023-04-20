<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<section class="page-404">
	<div class="container">
	  <div class="h3"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentysixteen' ); ?></div>
		<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?></p>
	</div>
</section>

<?php get_footer(); ?>

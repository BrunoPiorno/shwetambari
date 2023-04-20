<?php /* Template Name: Home */ ?>
<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
      
	<?php if( have_rows('content_blocks') ): ?>
            <div class="home-grid">
	            <?php while ( have_rows('content_blocks') ) : the_row(); ?>
	                  <?php get_template_part('modules/flexible_contents'); ?>
	            <?php endwhile; ?>
            </div>
	<?php else: ?>
		<section>
			<div class="container">
			      <?php the_content();?>
			</div>
		</section>
	<?php endif; ?>

<?php endwhile;	?>	



<?php get_footer(); ?>

<?php /* Template Name: About */ ?>
<?php get_header(); ?>
<?php
	if ( have_posts() ) : while ( have_posts() ) :
            the_post();
?>
<h1 class="about-main-title"><?php the_title(); ?></h1>

<?php if( have_rows('blocks') ):?>
<section class="about-blocks">
	<div class="container">
  <?php while ( have_rows('blocks') ) : the_row(); ?>
		<div class="about-blocks__item">
				<?php if ($title = get_sub_field('title')): ?>
					<div class="about-blocks__item__title--mobile"><?php echo $title ?></div>
				<?php endif; ?>
				<?php if ($image = get_sub_field('image')): ?>
					<div class="about-blocks__item__image">
						<div class="image-background">
							<img src="<?php echo $image['sizes']['large']; ?>" alt="" />
						</div>
					</div>
				<?php endif; ?>
				<div class="about-blocks__item__text-cont">	
					<?php if ($title = get_sub_field('title')): ?>
						<h2 class="about-blocks__item__title"><?php echo $title ?></h2>
					<?php endif; ?>
					<?php if ($text = get_sub_field('text')): ?>
						<div class="about-blocks__item__text"><?php echo $text ?></div>
					<?php endif; ?>
				</div>
		</div>
  <?php endwhile; ?>
	</div>
</section>
<?php endif; ?>


<?php
endwhile; endif;
?>

<?php get_footer(); ?>

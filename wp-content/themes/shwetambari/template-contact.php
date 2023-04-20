<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>
<?php
	if ( have_posts() ) : while ( have_posts() ) :
            the_post();
?>

<section class="contact-blocks">
	<div class="container">
		<?php if ($logo = get_field('logo')): ?>
			<div class="contact-blocks__logo"><img src="<?php echo $logo['sizes']['large']; ?>" alt="" /></div>
		<?php endif; ?>
		<?php if ($title = get_field('title')): ?>
			<h1 class="contact-blocks__title"><?php echo $title ?></h1>
		<?php endif; ?>
		<?php if ($text = get_field('text')): ?>
			<div class="contact-blocks__text"><?php echo $text ?></div>
		<?php endif; ?>
		<div class="socials">
			<?php if (get_field('instagram')) { ?>
				<a href="<?php the_field('instagram') ?>" target="_blank" class="instagram"></a>
			<?php }  ?>
			<?php if (get_field('facebook')) { ?>
				<a href="<?php the_field('facebook') ?>" target="_blank" class="facebook"></a>
			<?php }  ?>
			<?php if (get_field('pinterest')) { ?>
				<a href="<?php the_field('pinterest') ?>" target="_blank" class="pinterest"></a>
			<?php }  ?>
		</div>	<!--/socials -->
	</div>
</section>

<?php
endwhile; endif;
?>

<?php get_footer(); ?>

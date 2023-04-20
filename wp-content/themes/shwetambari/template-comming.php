<?php /* Template Name: Comming Soon */ ?>
<?php get_header(); ?>
<?php
	if ( have_posts() ) : while ( have_posts() ) :
            the_post();
?>

<?php $image_background = get_field('image_background'); ?>

<section class="comming-soon"  style="background-image: url(<?php echo $image_background['sizes']['large']; ?>)">

	<?php if ($form = get_field('form')):?>
		<div class="comming-soon__cont__form">
			<div class="comming-soon__cont__form--text-cont">
			<a href="javascript:void(0)" class="close_popup"></a>

				<?php echo $form ?>
			</div>
		</div>
	<?php endif; ?>
    <div class="comming-soon__cont">

        <?php if ($logo = get_field('logo')): ?>
            <div class="comming-soon__cont__logo">
                <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"/>
            </div>
        <?php endif; ?>

		<div class="comming-soon__cont__content">
			<?php if ($title = get_field('title')): ?>
				<div class="comming-soon__cont__title"><?php echo $title ?></div>
			<?php endif; ?>  

			<div class="comming-soon__cont__link" href="javascript:void(0)"> JOIN FOR UPDATES</a>		
		</div>
        
    </div>
</section>


<?php
endwhile; endif;
?>
<?php get_footer(); ?>
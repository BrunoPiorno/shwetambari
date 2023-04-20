<?php
$image = get_sub_field('image');
$imagen_responsive = get_sub_field('imagen_responsive');
$button = get_sub_field('button');
?>

<section class="page__hero">
  <div class="page__hero__image"><div class="image-background"><img src="<?php echo $image['sizes']['large']; ?>" /></div></div>
  
  <div class="page__hero__image--responsive">
    <div class="image-background">
      <img src="<?php echo $imagen_responsive['sizes']['medium_large']; ?>" />
    </div>
  </div>
  
  <div class="page__hero__text-cont">
    <?php if ($title = get_sub_field('title')): ?>
      <h1 class="page__hero__title"><?php echo $title; ?></h1>
    <?php endif; ?>
  </div>
</section>
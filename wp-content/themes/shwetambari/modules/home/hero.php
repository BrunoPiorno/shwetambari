<?php
$image = get_sub_field('image');
$imagen_responsive = get_sub_field('imagen_responsive');
$button = get_sub_field('button');
?>

<section class="home__hero">
  <div class="home__hero__image"><div class="image-background"><img src="<?php echo $image['sizes']['large']; ?>" /></div></div>
  
  <div class="home__hero__image--responsive">
    <div class="image-background">
      <img src="<?php echo $imagen_responsive['sizes']['medium_large']; ?>" />
    </div>
  </div>
  
  <div class="home__hero__text-cont">
    <?php if ($title_up = get_sub_field('title_up')): ?>
      <h5 class="home__hero__title_up"><?php echo $title_up; ?></h5>
    <?php endif; ?>
    <?php if ($title = get_sub_field('title')): ?>
      <div class="home__hero__title"><?php echo $title; ?></div>
    <?php endif; ?>
    <?php if ($hidden_title = get_sub_field('hidden_title')): ?>
      <h1 class="home__hero__hidden"><?php echo $hidden_title; ?></h1>
    <?php endif; ?>
    <?php if( $button ): ?>
      <a class="home__hero__link" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
    <?php endif; ?>
  </div>
</section>

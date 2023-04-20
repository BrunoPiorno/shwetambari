<section class="banners">
  <div class="container">
    <?php if( have_rows('banners') ):?>
      <div class="banners__list">
        <?php while ( have_rows('banners') ) : the_row();
        $link = get_sub_field('link');
        $button = get_sub_field('button');
        ?>
          <?php if( $link ): ?>
            <a class="banners__item" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
              <?php else: ?>
                <div class="banners__item">
              <?php endif; ?>
                <?php if ($image = get_sub_field('image')): ?>
                  <div class="banners__item__image"><div class="image-background"><img src="<?php echo $image['sizes']['medium_large']; ?>" /></div></div>
                <?php endif; ?>
                <?php if( $link ): ?>
                  <div class="banners__item__title"><?php echo $link['title']; ?></div>
                <?php endif; ?>
                <?php if( $button ): ?>
                   <div class="button-responsive" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></div>
                <?php endif; ?>
              <?php if( $link ): ?>
            </a>
          <?php else: ?>
            </div>
          <?php endif; ?>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

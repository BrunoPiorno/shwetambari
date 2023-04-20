<?php
$block_type = get_sub_field('block_type');
$image = get_sub_field('image');
$text = get_sub_field('text');
$custom_link = get_sub_field('custom_link');
$text_color = get_sub_field('text_color');
$blockClass=($block_type==0)?'half':'full';

?>

<div class="home-grid__item <?php echo $blockClass;?>">
      <?php if( $custom_link ): ?>
            <?php $target=(strlen($custom_link["target"])>0)?'target="'.$custom_link["target"].'"':'';?>
            <a href="<?php echo $custom_link["url"];?>" <?php echo $target;?> class="home-grid__item--image">
      <?php else:?>
            <div class="home-grid__item--image">
      <?php endif;?>

      <img src="<?php echo $image['sizes']['large']; ?>" />

      <?php if( $custom_link ): ?>
            </a>
      <?php else:?>
            </div>
      <?php endif;?>

      
      <?php if($text):?>
            <?php $textColor=sanitize_title($text_color);?>
            <div class="product-overlay">
		      <h2 class="product-overlay__text <?php echo $textColor;?>"><?php echo $text;?></h2>
      	</div>
      <?php endif;?>

</div>

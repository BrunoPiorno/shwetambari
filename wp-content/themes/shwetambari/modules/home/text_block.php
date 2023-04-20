<?php
$block_type = get_sub_field('block_type');
$text = get_sub_field('text');
$blockClass=($block_type==0)?'half':'full';
?>

<div class="home-grid__item <?php echo $blockClass;?>">
      <div class="text_block">
            <div class="text_block__text"><?php echo $text;?></div>
      </div>
</div>

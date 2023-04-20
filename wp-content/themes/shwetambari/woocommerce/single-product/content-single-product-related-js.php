<?php
    $variation  = new WC_Product_Variation($args);
    $image_id = get_post_meta($args, '_thumbnail_id', true);
    if($image_id){
        $image = wp_get_attachment_image_src($image_id, 'medium_large')[0];
    } else {
        $image = $placeholder_url;
    }
    //$price = $variation->get_price();
    $price = floatval($variation->get_price());

    $link = $variation->get_permalink();
    ?>
    
    <div class="product">
        <a href="<?php echo $link;?>">
            <div class="product__image">
                <div class="image-background">
                    <img src="<?php echo $image;?>">				
                </div>
            </div>
            <div class="product-overlay">
                <h2 class="woocommerce-loop-product__title"><?php echo get_the_title($args);?></h2>
                <span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $price;?></bdi></span></span>
            </div>
        </a>
    </div>
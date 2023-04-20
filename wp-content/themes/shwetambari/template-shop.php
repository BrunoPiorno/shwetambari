<?php /* Template Name: Shop */ ?>
<?php get_header(); ?>

<?php

$categories = get_terms( array(
    'taxonomy' => 'product_cat',
    'hide_empty' => 'false',
    'orderby' => 'menu_order',
    'order'   => 'ASC'
) );
?>

<div class="woocommerce columns-3 ">
    <div class="container">
        <h1 class="title__shop"> <?php echo the_title();?></h1>
    </div>
    <ul class="products columns-3">
        <?php foreach( $categories as $category ): 
            $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
            $image_url = wp_get_attachment_url( $thumbnail_id );?>
            <?php if(!$image_url): 
                $image_url = wc_placeholder_img_src( $size );
            endif;?>
            <li class="product">
                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                    <div class="product__image">
                        <div class="image-background">
                            <img src="<?php echo $image_url;?>" class="woocommerce-placeholder wp-post-image" alt="Placeholder"/>
                        </div>  
                    </div>
                    <div class="product-overlay">
                        <h2 class="woocommerce-loop-product__title"><?php echo $category->name; ?></h2>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>	



<?php get_footer(); ?>

<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$placeholder_url = wc_placeholder_img_src( 'woocommerce_single');

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="product__cont">
		<div class="product__top">
			<?php
			/**
			* Hook: woocommerce_before_single_product_summary.
			*
			* @hooked woocommerce_show_product_sale_flash - 10
			* @hooked woocommerce_show_product_images - 20
			*/
			do_action( 'woocommerce_before_single_product_summary' );
			?>

			<div class="summary entry-summary">
				<?php
				/**
				* Hook: woocommerce_single_product_summary.
				*
				* @hooked woocommerce_template_single_title - 5
				* @hooked woocommerce_template_single_rating - 10
				* @hooked woocommerce_template_single_price - 10
				* @hooked woocommerce_template_single_excerpt - 20
				* @hooked woocommerce_template_single_add_to_cart - 30
				* @hooked woocommerce_template_single_meta - 40
				* @hooked woocommerce_template_single_sharing - 50
				* @hooked WC_Structured_Data::generate_product_data() - 60
				*/
				do_action( 'woocommerce_single_product_summary' );
				?>

				<?php /* if ($text_product = get_field('text_product','options')): ?>
					<div class="text_proudct__title"><?php echo $text_product; ?></div>
				<?php endif; */?>



				<?php if ($read_more = get_field('read_more')): ?>
					<div class="read_more"><?php echo $read_more; ?></div>
				<?php endif; ?>

				<div class="links">
					<?php for ($i=1; $i <= 4; $i++) { 
						$origin = ($i === 4) ? get_the_ID():'option';
						$title_popup = get_field('title_popup_'.$i, $origin); ?>

						<div class="woocommerce-popup js-popup" id="<?php echo $i; ?>">
							<a href="javascript:void(0)" class="close_popup"></a>
							<a class="woocommerce-popup__title" href="javascript:void(0)"><?php echo $title_popup;?></a>
							<?php if ($text_popup = get_field('text_popup_'.$i, $origin)):?>
								<div class="woocommerce-popup--text-cont"><?php echo $text_popup ?></div>
							<?php endif; ?>
						</div>

						<?php if ($title_popup): ?>
							<div class="links__cont">
								<a href="javascript:void(0)" class="links__cont__item js-open-popup" data-popup="<?php echo $i;?>"><?php echo $title_popup; ?></a>
							</div>
						<?php endif; ?>	
					<?php } ?>
				</div>

				<?php $image_placeholder = get_field('image_placeholder');?>
				<?php 
				$default = $product->get_default_attributes();
				if( have_rows('variation_gallery') && count(get_field('variation_gallery')) > 1 ): $variation_cnt = 0;?>
					<div class="available">
						<div class="available__title">Also available in</div>
						<div class="available__cont"> 
							<?php while( have_rows('variation_gallery') ) : the_row();
								$image = get_sub_field('variation_thumbnail');
								$image = $image['sizes']['thumbnail'];
								if(!$image): $image = $placeholder_url;endif;
								$color = get_sub_field('variation_color');
                                			($color === $default['pa_color']) ? $jsactive = $default['pa_color'] : $jsactive = '';
								?>
								<div class="available__cont__color<?php echo ( ($color === $default['pa_color']) || (!$key && empty($default)) ) ? ' active':''; ?>" data-variation-id="<?php echo $variation_cnt; ?>" data-variation="<?php echo $color;?>">
									<div class="available__cont__color__image">
										<div class="image-background">
											<img src="<?php echo $image; ?>" alt="<?php echo $color;?>" />
										</div>
									</div>
									<div class="available__cont__color__title"><?php echo $color;?></div>
								</div>
							<?php $variation_cnt++; endwhile; ?>
						</div>
					</div>			
				<?php endif; ?>


			</div>

			<?php
			/**
			* Hook: woocommerce_after_single_product_summary.
			*
			* @hooked woocommerce_output_product_data_tabs - 10
			* @hooked woocommerce_upsell_display - 15
			* @hooked woocommerce_output_related_products - 20
			*/
			//do_action( 'woocommerce_after_single_product_summary' );
			?>

		</div>

		<div class="product__bottom">	
			
			<?php if( have_rows('variation_gallery') ): ?>
				<?php $cuenta = 1;?>
				<?php while( have_rows('variation_gallery') ) : the_row();
					if(get_sub_field('video_thumbnail')):
						$image_placeholder = get_sub_field('video_thumbnail');
					endif;
                    		$variations = get_sub_field('variation_color'); 
                    		?>
                  		<div class="variation_option <?php if($variation_cnt == 0 && $jsactive == $variations) echo 'js-loaded';?>"
                    			<?php echo 'data-variation="'.$variations.'" ';?> 
						<?php if($variation_cnt != 0) echo 'style="display:none;"';?>>
					
						<?php $images = get_sub_field('variation_gallery');
                        
                        		if( $images ): ?>
							<div class="product__single__gallery product__single__gallery--variation">
                                			<?php if($variation_cnt == 0): ?> 
                                    			<?php foreach( $images as $order => $image ):
                                        				if($image['type'] == 'video'):?>
                                            				<div class="product__single__gallery__item product__single__gallery__item--video">
                                                				<div>
                                                    					<video id="product__video__js"  playsinline onended="videoEnded(this)">
                                                        					<source data-src="<?php echo $image['url']; ?>#t=0.1" src="" type="video/mp4">
                                                    					</video>
                                                    					<div class="controls">
                                                        					<div class="video-controls pause">PAUSE</div>
                                                    					</div>
                                                    					<svg class="play-button" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="100px" width="100px" viewBox="0 0 320.001 320.001" style="enable-background:new 0 0 320.001 320.001;" xml:space="preserve">
                                                        					<path fill="#ffffff"  d="M295.84,146.049l-256-144c-4.96-2.784-11.008-2.72-15.904,0.128C19.008,5.057,16,10.305,16,16.001v288 c0,5.696,3.008,10.944,7.936,13.824c2.496,1.44,5.28,2.176,8.064,2.176c2.688,0,5.408-0.672,7.84-2.048l256-144 c5.024-2.848,8.16-8.16,8.16-13.952S300.864,148.897,295.84,146.049z"/>
                                                    					</svg>
					                                                <?php if($image_placeholder):?>
                                                        					<div class="image_placeholder">
                                                            					<div class="image-background">
                                                                						<img src="<?php echo esc_url($image_placeholder['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($image_placeholder	['alt']); ?>" />
                                                            					</div>
                                                        					</div>
                                                    					<?php endif; ?>
                                                				</div>
                                            				</div>
                                        				<?php else: ?>
                                            				<div class="product__single__gallery__item">
                                                				<img src="<?php echo esc_url($image['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                            				</div>
                                        				<?php endif; ?>
                                    			<?php endforeach; ?>
                                			<?php endif; ?>
                            			</div>
						<?php endif; ?>
					

						<?php
						$related_products = get_sub_field('related_products');
						?>			
						<?php if( $related_products ): ?>
                            			<?php //if($cuenta == 1): //FIRST/DEFAULT?>
							<div class="woocommerce cat-releated-products">
								<div class="container">
									<?php if ($title_product_style = get_field('title_product_style','options')): ?>
										<div class="products__archive__title"><?php echo $title_product_style ?></div>
									<?php endif;  ?>
									<?php //echo do_shortcode('[products ids="'.implode(",", $posts).'"]');?>
                                    			<div class="products">
                                        				<?php if($variation_cnt == 0): ?>
                                            				<?php while( have_rows('related_products') ) : the_row();
												$variation_selected = get_sub_field('variation');
												$variation  = new WC_Product_Variation($variation_selected);
												
												$image_id = get_post_meta($variation_selected, '_thumbnail_id', true);
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
														<h2 class="woocommerce-loop-product__title"><?php echo get_the_title($variation_selected);?></h2>
														<span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $price;?></bdi></span></span>
													</div>
												</a>
												</div>
                                            				<?php endwhile; ?>
                                        				<?php endif;?>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				<?php $cuenta++; endwhile; ?>
			<?php else: ?>
				<?php 
				$images = get_field('gallery');
				if( $images ): ?>
					<div class="product__single__gallery">
						<?php foreach( $images as $image ): ?>
							<?php if($image['type'] == 'video'):?>
								<div class="product__single__gallery__item product__single__gallery__item--video">
									<video  playsinline>
										<source data-src="<?php echo $image['url']; ?>#t=0.1" src="" type="video/mp4">
									</video>
									<div class="controls">
										<div class="video-controls pause">PAUSE</div>
									</div>
									<svg class="play-button" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="100px" width="100px" viewBox="0 0 320.001 320.001" style="enable-background:new 0 0 320.001 320.001;" xml:space="preserve">
										<path fill="#ffffff"  d="M295.84,146.049l-256-144c-4.96-2.784-11.008-2.72-15.904,0.128C19.008,5.057,16,10.305,16,16.001v288 c0,5.696,3.008,10.944,7.936,13.824c2.496,1.44,5.28,2.176,8.064,2.176c2.688,0,5.408-0.672,7.84-2.048l256-144 c5.024-2.848,8.16-8.16,8.16-13.952S300.864,148.897,295.84,146.049z"/>
									</svg>
									<?php if($image_placeholder):?>
										<div class="image_placeholder">
											<div class="image-background">
												<img src="<?php echo esc_url($image_placeholder['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($image_placeholder	['alt']); ?>" />
											</div>
										</div>
									<?php endif; ?>
								</div>
							<?php else: ?>
								<div class="product__single__gallery__item">
									<img src="<?php echo esc_url($image['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php
				$term = get_queried_object();
				$posts = get_field('related_products'); ?>				
				<?php if( $posts ): ?>
					<div class="woocommerce cat-releated-products">
						<div class="container">
							<?php if ($title_product_style = get_field('title_product_style','options')): ?>
								<div class="products__archive__title"><?php echo $title_product_style ?></div>
							<?php endif;  ?>
							<?php echo do_shortcode('[products ids="'.implode(",", $posts).'"]');?>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>

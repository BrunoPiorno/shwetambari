<?php
    if ( !defined( 'ABSPATH' ) ) exit;

    if( !class_exists('SHWETAMBARI_Variations') )
    {
        class SHWETAMBARI_Variations
        {
            public function __construct()
            {
                add_action('wp_enqueue_scripts',                array($this,'script_enqueuer'),99);

                add_action('wp_ajax_nopriv_load_gallery_product_js', array($this,'load_gallery_product_js'));
                add_action('wp_ajax_load_gallery_product_js',        array($this,'load_gallery_product_js'));
                //self::load_variations();
            }

            public function script_enqueuer(){
                $scheme     =   is_ssl() ? 'https':'http';
                $params     =   array(
                                    'ajax_url'      =>  admin_url('admin-ajax.php',$scheme),
                                    'nonce'         =>  wp_create_nonce('shwetambari-nonce')
                                );
                    
                wp_register_script('shwetambari-theme',     plugins_url('assets/functions.js', dirname(__FILE__)), array('jquery'), '',true );
                wp_enqueue_style(  'shwetambari-theme',     plugin_dir_url(dirname( __FILE__ )) . 'assets/style.css', array() );
                wp_localize_script('shwetambari-theme',     'SHWETAMBARI', $params);
                wp_enqueue_script( 'shwetambari-theme');
            }
            public static function load_gallery_product_js()
            {

                if( !wp_verify_nonce( $_POST['nonce'], 'shwetambari-nonce' ) ):
                    echo 'Invalid nonce';
                    exit;
                endif;

                $product_id = $_POST['product_id'];
                $gallery_id = $_POST['gallery_id'];
                $pr_v = get_field('variation_gallery', $product_id);
                $variation = $pr_v[$gallery_id];
                $variation_gallery = $variation;
                //$variation_gallery['placeholder'] = $variation['video_thumbnail'];
                $related_products = $variation['related_products'];
                

                $html_related_products  = "";
                ob_start();
                for ($rel = 0; $rel < count($related_products); $rel++){
                    $variation_selected = $related_products[$rel]['variation'];
                    get_template_part('woocommerce/single-product/content-single-product-related-js', '', $variation_selected);
                }
                $html_related_products  =   ob_get_clean();

                $html_variation_gallery  = "";
                ob_start();
                $variation_selected = $variation_gallery;
                get_template_part('woocommerce/single-product/content-single-product-variations-js', '', $variation_selected);
                $html_variation_gallery  =   ob_get_clean();

                $result     =   array('status' => 'ok', 'related' => $html_related_products, 'variation' => $html_variation_gallery);
                wp_send_json($result);
                exit;
            }
        }
    }
    new SHWETAMBARI_Variations();
?>
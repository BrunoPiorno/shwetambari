<?php
    /*
    Plugin Name: Shwetambari Functions
    Plugin URI:
    Description: 
    Author: Bruno Piorno
    Version: 1.0
    */
?>
<?php
    defined( 'ABSPATH' ) || die();
    if( isset($_GET['debug']) ):
        ini_set('display_errors',1);
        error_reporting(E_ALL);
    endif;

    add_action( 'woocommerce_before_single_product', 'customise_product_page' );
    function customise_product_page() {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 15);
    // ... any other removes and adds here
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

    }
     
    function isPreorder($product_id) { 
        $delivery_date  = get_field('delivery_date', $product_id, false);
        $delivery = \DateTime::createFromFormat ('Ymd', $delivery_date);
        $is_preorder = ($delivery >= new \Datetime());
        return $is_preorder;
    };     

    add_action('woocommerce_single_product_summary', function(){
        if( isPreorder(get_the_ID())){
          echo '<div class="preorder">PRE-ORDER</div>';
        } 
    }, 1);
    add_action('woocommerce_single_product_summary', function(){
        if( isPreorder(get_the_ID()))   
        echo '<div class="date"> Delivery date:  '. get_field('delivery_date').'</div>';
    },20);
    

    add_action('wp_enqueue_scripts', function(){
        wp_enqueue_script('js-readmore','//cdn.jsdelivr.net/npm/readmore-js@2.2.1/readmore.min.js', array('jquery'), '',true);
    },99);
    
    // delete choose an option dropdown

    add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'wc_remove_options_text');
    function wc_remove_options_text( $args ){
        $args['show_option_none'] = '';
        return $args;
    }


    function edit_address_labels_checkout($address_fields){
        $address_fields['first_name']['label']='First Name';
        $address_fields['last_name']['label']='Last Name';
        $address_fields['company']['label']='Company Name';
        $address_fields['address_1']['label']='Street Address';
        
        return $address_fields;
    }
    add_filter('woocommerce_default_address_fields','edit_address_labels_checkout');

    function claserama_edit_checkout_fields($fields){
        $fields['billing']['billing_email']['label']='Email Address';
        return $fields;
    }
    add_filter('woocommerce_checkout_fields','claserama_edit_checkout_fields');

    // edit button checkout place order
    add_filter('woocommerce_order_button_text', function(){ return 'Place Order'; });



    function my_account_menu_order() {
        $menuOrder = array(
            'dashboard'          => __( 'Dashboard', 'woocommerce' ),
            'orders'             => __( 'Orders', 'woocommerce' ),
            'downloads'          => __( 'Download', 'woocommerce' ),
            'edit-address'       => __( 'Addresses', 'woocommerce' ),
            'edit-account'    	=> __( 'Account Details', 'woocommerce' ),
            'customer-logout'    => __( 'Logout', 'woocommerce' ),
        );
        return $menuOrder;
    }
    add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );


    add_filter('acf/load_field/name=variation_color', function($field){
        $product_id = get_the_ID();
        $colors  = wc_get_product_terms($product_id, 'pa_color');
        $choices = [];
        if( !empty($colors) ):
            foreach( $colors as $color ):
                $choices[$color->slug] = $color->name;
            endforeach; 
        endif;
        $field['choices'] = $choices;
        return $field;
    });

    add_filter('acf/load_field/name=variation', function($field){
        // esto debe recorrer el related products, por cada row, chequear el product, y traer los colores de ese product
        global $wpdb;
        $variations = $wpdb->get_results("SELECT ID, post_title FROM {$wpdb->posts} where post_type = 'product_variation' AND post_status = 'publish' ORDER BY post_title ASC");
        $choices = [];
        $colors = [];
        if( !empty($variations) ):
           foreach( $variations as $variation ):
               $variation_id = $variation->ID;
               $variation  = new WC_Product_Variation($variation_id);
               $attributes = $variation->get_variation_attributes();
               $color = get_term_by('slug', $attributes['attribute_pa_color'], 'pa_color');
               $name = get_the_title($variation_id) . ' - ' .$color->name;
               if(!in_array($name, $colors)){
                $choices[$variation_id] = $name;
                $colors[] = $name;  
               }
           endforeach;
        endif; 
        $field['choices'] = $choices;
        return $field;
    });

    add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );
    add_filter( 'woocommerce_is_attribute_in_product_name', '__return_false' );
    add_filter( 'woocommerce_add_to_cart_validation', 'check_edit_product', 10, 2);
    
    function check_edit_product($is_valid, $product_id)
    {
        $action= isset($_REQUEST['edit']) ? $_REQUEST['edit']:0;
        if($action > 0):
            foreach ( WC()->cart->get_cart() as $item_key => $item ) :
                if ( $item['variation_id'] == $action ) :
                    WC()->cart->remove_cart_item( $item_key ); // we remove it
                    break;
                endif;
            endforeach;
        endif;
        return true;
    }
    
    add_action('woocommerce_before_add_to_cart_button', function(){
        echo '<input type="hidden" name="edit" value="'.((isset($_GET['v']) && ($_GET['v'] >= 0)) ? intval($_GET['v']) : 0).'">';
    });
    
    add_action('woocommerce_product_single_add_to_cart_text', 'update_edit_button');
    function update_edit_button() {
        $action = ((isset($_GET['v'])) && ($_GET['v'] >= 0 )) ? 'Update' : 'Add to cart';
        foreach( WC()->cart->get_cart() as $cart_item_key => $values ) :
            $_product = $values['data'];
            if( get_the_ID() == $_product->id ) :
                return __($action, 'woocommerce');
            endif;
        endforeach;
        return __($action, 'woocommerce');
    }
    
    function filter_woocommerce_get_variation_values($cart_item) {
        if( $cart_item['variation_id'] > 0):
            $item_data = $cart_item['data'];
            $attributes = $item_data->get_attributes();
            if( $item_data && count($attributes) ):
                echo '<dl class="variation">';
                foreach ( $attributes as $attribute => $attribute_term ):
                    $term = get_term_by('slug', $attribute_term, $attribute);
                    $name = $term->name;
                    echo '<dd class="variation-'.$term->taxonomy.'">'.$name.'</dd>';
                endforeach;  
                echo '</dl>';
            endif;
        endif;
    }

    function get_variant_image($product_id, $color)
    {
        if( !function_exists('wc_get_product') )
            return false;

        $product    = wc_get_product($product_id);
        $variations = $product->get_available_variations();

        if( !empty($variations) ):
            foreach( $variations as $variation ):
                if( $variation['attributes']['attribute_pa_color'] === $color )
                    return get_post_meta($variation['id'], '_thumbnail_id', true);
            endforeach;
        endif;

        return false;
    }

add_action('admin_enqueue_scripts', 'ds_admin_theme_style');
add_action('login_enqueue_scripts', 'ds_admin_theme_style');
function ds_admin_theme_style() {
	if (!current_user_can( 'manage_options' )) {
		echo '<style>.update-nag, .updated, .error, .is-dismissible { display: none; }</style>';
	}
}

    require_once('lib/variations_js.php');
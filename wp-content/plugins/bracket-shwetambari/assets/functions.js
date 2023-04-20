jQuery.noConflict();
jQuery(document).ready(function($) {
    function load_gallery_product_js(variation, variation_name){
        if($('.variation_option[data-variation="'+variation_name+'"] .products > div').hasClass('loading-gallery')) return false;
        var product_id = $('.woocommerce-variation-add-to-cart input[name="product_id"]').val();
        if(!$('.variation_option[data-variation="'+variation_name+'"]').hasClass('js-loaded')){
            $('.variation_option[data-variation="'+variation_name+'"] .products').html("<div></div><div class='loading-gallery'></div><div></div>");
            $('.variation_option[data-variation="'+variation_name+'"] .product__single__gallery--variation').html("<div class='loading-gallery'></div>");
            jQuery.ajax({
                type:       'POST',
                url:        SHWETAMBARI.ajax_url,
                dataType:   'JSON',
                data:       { action: 'load_gallery_product_js', nonce: SHWETAMBARI.nonce, product_id: product_id, gallery_id: variation },
                success:    function(data){
                    console.log(data);
                    $('.variation_option[data-variation="'+variation_name+'"]').addClass('js-loaded');
                    $('.variation_option[data-variation="'+variation_name+'"] .products').html(data.related);
                    $('.variation_option[data-variation="'+variation_name+'"] .product__single__gallery--variation').html(data.variation);

                    $('.slick-slider').slick('refresh');

                    var videoid = jQuery('.variation_option[data-variation="'+variation_name+'"] .product__single__gallery--variation #product__video__js');
                    setTimeout(function(){
                        var datasrc = videoid.find("source").attr("data-src");
                        videoid.find("source").attr("src", datasrc);
                        videoid.load(0);
                        videoid.trigger('load');
                    },1000);
                }
            });
        }
    }

    $('.woocommerce-variation-add-to-cart input[name="variation_id"]').on('change',function(){
        if($('#pa_color option').length > 1) {
            var variation = $("select#pa_color option:selected").val();
            var ww=$(window).width();
            $('.variation_option,.woocommerce-product-gallery').hide();
            $('.variation_option[data-variation="'+variation+'"],.woocommerce-product-gallery[data-variation="'+variation+'"]').show();
            if(ww<750) {
                $('.variation_option[data-variation="'+variation+'"] .product__single__gallery').slick('refresh');
                $('.variation_option[data-variation="'+variation+'"] .cat-releated-products .products').slick('refresh'); 
            }
            
            var price = $('.woocommerce-variation.single_variation .woocommerce-variation-price .price').html();
            $('.woocommerce div.product .summary > p.price').html(price);
            $(".available__cont__color").removeClass("active");
            $(".available__cont__color[data-variation='"+variation+"']").addClass("active");
            if(ww<750) {
                $('html, body').animate({scrollTop : 90},800);
            }
            var variation_id = "";
            variation_id = $(".available__cont__color[data-variation='"+variation+"']").data("variation-id");
            load_gallery_product_js(variation_id, variation);
        }
	});
});
jQuery.noConflict();

jQuery(document).ready(function ($) {
	/*AOS.init({
		duration: 600
	});*/
	$.fn.extend({
		scrollTo: function($diff, $duration = 1000 ){
			$diff   =   $diff || 0;
			$('html, body').stop().animate({scrollTop: this.offset().top-$diff}, $duration);
		},
	});

	$(window).scroll(function(){
		var sticky = $('body'),
		scroll = $(window).scrollTop();

		if (scroll >= 10) sticky.addClass('scrolled');
		else sticky.removeClass('scrolled');
	});

	$('.home-grid__item.half').matchheight();


	$('.responsive__btn').click(function(){
		$(this).toggleClass('open');
		$('.responsive__menu').slideToggle();
	});

	$('.responsive__btn').click(function(){
		$("body").toggleClass("menu-open");
	});

	$(window).on('resize', () => {
		if( $(window).width() > 1050 )	return;
		$('.header .responsive__menu .menu__cont .menu-primary-menu-container ul li.menu-item-has-children .menu__arrow').length || $('.header .responsive__menu .menu__cont .menu-primary-menu-container ul li.menu-item-has-children').prepend('<span class="menu__arrow"></span>');
		$('.header .responsive__menu .menu__cont .menu-primary-menu-container ul li.menu-item-has-children > span').unbind('click').click(function(){
			$(this).parent().toggleClass('active');
			$(this).parent().find('.sub-menu').slideToggle();
		});
	}).trigger('resize');

	$('.comming-soon__cont__link').on('click', function(){
		$('.comming-soon__cont__form').fadeIn();
	});

	$(document).mouseup(e => {
        let container = $('.comming-soon__cont__form .gform_wrapper');
        if( !container.is(e.target) && container.has(e.target).length === 0 ){
            $('.comming-soon__cont__form').fadeOut();
            return;
        }
    });
    $(document).keyup(e => ( e.which == 27 ) && $('.comming-soon__cont__form').fadeOut());

	$('.close_popup').click(function(){
		$('.comming-soon__cont__form, .woocommerce-popup, .footer__popup--terms, .footer__popup--faqs' ).fadeOut();
	});

	$('.js-open-popup').click(function(){
		$('.woocommerce-popup').hide();
		let popupId = $(this).data('popup');
		$('.woocommerce-popup#'+popupId).fadeIn();
	});


	$("a[href='#open-terms-popup']").click(function(){ 
		$( '.footer__popup--terms').show();
	 });

	 $("a[href='#open-newsletter-popup']").click(function(){ 
		$( '.comming-soon__cont__form').show();
	 });

	 $("a[href='#open-faqs-popup']").click(function(){ 
		$( '.footer__popup--faqs').show();
	 });


	 $(document).mouseup(function(e){
		var container = $('.js-popup');
		if( !container.is(e.target) && (container.has(e.target).length === 0) )
			$('.close_popup').click();
	});


	  $('.read_more').readmore({
		speed: 150, //Açılma Hızı
		collapsedHeight: 0, // 100px sonra yazının kesileceğini belirtir.
		moreLink: '<a class="ac" href="#">Read More <i class="fas fa-sort-down"></i></a>', // açma linki yazısı
		lessLink: '<a class="kapat" href="#">Read More	<i class="fas fa-sort-up"></i></a>', // kapatma linki yazısı
	  });


	  //$('.banners__list, .product__single__gallery, .variation_option, .cat-releated-products .products').slick({
	$('.banners__list, .product__single__gallery').slick({
		dots: false,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1,
		mobileFirst: true,
		responsive: [
		   {
			  breakpoint: 750,
			  settings: "unslick"
		   }
		]
	});
	/*
	$('.variation_option').slick({
		dots: false,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1,
		mobileFirst: true,
		responsive: [
		   {
			  breakpoint: 750,
			  settings: "unslick"
		   }
		]
	});
	*/
	$('.cat-releated-products .products').slick({
		dots: false,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1,
		mobileFirst: true,
		responsive: [
		   {
			  breakpoint: 750,
			  settings: "unslick"
		   }
		]
	});
/*	
	$('.faqs__text__cont--faqs').click(function(){
		let isOpen = $(this).hasClass('open');
		$('.faqs__text__cont--faqs.open').removeClass('open').next('.panel').slideUp();
		if( !isOpen )
		{
			$(this).addClass('open').next('.panel').slideDown(400);
		}
	});
*/
	

	

	$(document).on('click', '.play-button',  function(e){
		if($('body').hasClass('single-product')){
			var parent = $(this).parents('.product__single__gallery__item--video').not('.loaded');
			parent.each(function(){
				var datasrc = jQuery(this).find("source").attr("data-src");
				if(jQuery(this).find("source").attr("src") == ""){
					jQuery(this).find("source").attr("src", datasrc);
					jQuery(this).find("video").load(0);
					jQuery(this).find("video").trigger('load');
				}
				$(this).addClass('loaded');
			});
		}else{
			// New Home Videos
			if($('body').hasClass('home')){
				var parent = $(this).parents('.home-grid__item--video').not('.loaded');
				parent.each(function(){
					var datasrc = jQuery(this).find("source").attr("data-src");
					if(jQuery(this).find("source").attr("src") == ""){
						jQuery(this).find("source").attr("src", datasrc);
						jQuery(this).find("video").load(0);
						jQuery(this).find("video").trigger('load');
					}
					$(this).addClass('loaded');
				});
			} else {
				var parent = $(this).parents('.image_banner__video').not('.loaded');
				parent.find('video source').each(function(){
					var datasrc = jQuery(this).attr("data-src");
					jQuery(this).attr("src", datasrc);
					jQuery(this).parent().load();
					jQuery(this).parent().attr("id", 'homevid'+i);
				});
				jQuery('.image_banner__video video').trigger('load'); 
				jQuery('.image_banner__video video').load(0);
				parent.addClass('loaded');
			}
		}
	
		

		$(this).hide();
		$(this).parent().find('.image_placeholder').hide();
	  	$(this).parent().find('video').get(0).play();
		$(this).parent().find('.controls').show();
	});
	$(document).on('click', '.pause',  function(e){
		$(this).parent().hide();
		$(this).parent().parent().find('video').get(0).pause();
	    $(this).parent().parent().find('.play-button').show();
	    //$(this).parent().parent().find('.image_placeholder').show();
	});

	$(".available__cont__color").click(function() {
		var variation = $(this).data('variation');
		$('select#pa_color').val(variation).change();
		$(".available__cont__color").removeClass("active");
		$(this).addClass("active");
	});

	setTimeout(function(){
		let selectedColor = $('select#pa_color option:selected').val();
		( $('select#pa_color').length && selectedColor ) && $('select#pa_color').val(selectedColor).change();
	},1000);

	
});

function videoEnded(obj){
	jQuery(obj).parent().find('.play-button').show();
	jQuery(obj).parent().find('.controls').hide();
	jQuery(obj).parent().find('.image_placeholder').show();
}